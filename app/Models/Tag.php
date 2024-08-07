<?php

namespace App\Models;

use App\Models\Article;
use App\Models\Tag;
use Illuminate\Support\Str;
use App\Casts\TimestampsCast;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasFactory, Sluggable;
    protected $table = 'tags';
    protected $primaryKey = 'id';
	protected $fillable = ['name','slug','description','keywords'];
    protected $with = ['articles'];
    protected $appends = ['absolute_url'];
    protected $casts = ['name'=>TimestampsCast::class,'description'=>TimestampsCast::class];
    const EXCERPT_LENGTH = 100;

    protected static function boot()
    {
        parent::boot();
        static::deleting(function ($tag) {
            foreach($tag->articles as $article){
                $article->delete();
            }
        });
    }

    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }

	public function articles()
	{
		return $this->belongsToMany(Article::class)->withTimestamps();
	}

    public function getAbsoluteUrlAttribute()
    {
        return route('tag.articles', $this->slug);
    }

    public function excerpt()
    {
        return Str::limit(strip_tags($this->description),Tag::EXCERPT_LENGTH);
    }

    public function tagId($id)
    {
    	return static::findOrFail($id);
    }

    public function deleteTag($id)
    {
    	return static::destroy($id);
    }

    public function paginated()
    {
    	return static::latest()->paginate(config('blog.articles_per_page'));
    }

    public function tagSlug($slug)
    {
        return static::query()->whereSlug($slug)->first();
    }

    public function scopeEagerLoaded($query)
    {
        return $query->with('articles');
    }
}
