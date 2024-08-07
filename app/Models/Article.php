<?php

namespace App\Models;

use File;
use Response;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Category;
use App\Models\Comment;
use Illuminate\Support\Str;
use App\Casts\TimestampsCast;
use Illuminate\Support\Facades\URL;
use Cviebrock\EloquentSluggable\Sluggable;
use Spatie\Feed\Feedable;
use Spatie\Feed\FeedItem;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model implements Feedable
{
    use HasFactory, Sluggable;
    protected $table = 'articles';
    protected $primaryKey = 'id'; 
    protected $appends = ['published','reading_time','created_date','image_url','excerpt','absolute_url'];
    protected $fillable = ['title','image','caption','content','description','keywords','total_views','is_published','published_at','user_id','category_id','slug','published_by'];
    const EXCERPT_LENGTH = 100;
    protected $casts = ['title'=>TimestampsCast::class,'description'=>TimestampsCast::class,'caption'=>TimestampsCast::class,'user_id'=>'int','category_id'=>'int','is_published'=>'boolean','total_views'=>'int','created_at' => 'date','published_at'=>'datetime'];

    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }

    public function toFeedItem(): FeedItem
    {
        return FeedItem::create()
            ->id($this->absolute_url)
            ->title($this->title)
            ->summary($this->description)
            ->updated($this->updated_at)
            ->link($this->absolute_url)
            ->authorName($this->user->name);
    }

    public static function getFeedItems()
    {
        return Article::eagerLoaded()->published()->latest()->limit(50)->get();
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($article) {
            if(is_null($article->user_id)) {
                $article->user_id = auth()->user()->id;
            }
        });

        static::deleting(function ($article) {
            $article->comments()->delete();
            $article->tags()->detach();
        });
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class)->withDefault();
    }

    public function tags(): BelongsToMany
    {
        return $this->belongsToMany(Tag::class)->withTimestamps();
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class)->withDefault();
    }

    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class,'article_id','id');
    }

    public function getExcerptAttribute()
    {
        return Str::limit(strip_tags($this->content),Article::EXCERPT_LENGTH);
    }

    public function scopeEagerLoaded($query)
    {
        return $query->with('user','category','tags','comments')->withCount('comments');
    }

    public function getAbsoluteUrlAttribute(): string
    {
        return route('article.details',$this->slug);
    }

    public function scopePublished($query)
    {
        return $query->where('is_published', true);
    }

    public function scopeDrafted($query)
    {
        return $query->where('is_published', false);
    }

    public function getPublishedAttribute()
    {
        return $this->is_published ? 'Yes' : 'No';
    }

    public function getCreatedDateAttribute()
    { 
        return Carbon::parse($this->created_at)->format('F d, Y');    
    }

    public function getEtagAttribute()
    {
        return hash('sha256', "product-{$this->id}-{$this->updated_at}");
    }

    public function scopeOneWeek($query)
    {	
    	$date = Carbon::now()->subDays(7);
        
        return $query->where('created_at', '<', $date);
    } 
    /**
    * Recursive routine to set a unique slug
    *
    * @param string $title
    * @param mixed $extra
    */
    protected function setUniqueSlug($title, $extra)
    {
        $slug = str_slug($title.'-'.$extra);
        if (static::whereSlug($slug)->exists()){
            $this->setUniqueSlug($title, $extra + 1);
            return;
        }
        $this->attributes['slug'] = $slug;
    } 

    public function getImageUrlAttribute()
    {
        return URL::asset('/storage/'.$this->image);
    }

    public function getReadingTimeAttribute()
    {
        $words = str_word_count(strip_tags($this->attributes['content']));
        $min = ceil($words/200);
        return $min . ' min read';
    }
}
