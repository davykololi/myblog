<?php

namespace App\Models;

use App\Models\Article;
use App\Models\Category;
use Illuminate\Support\Str;
use App\Casts\TimestampsCast;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory, Sluggable;
    protected $table = 'categories';
    protected $primaryKey = 'id';
	protected $fillable = ['name','slug','description','keywords'];
    protected $with = ['articles'];
    protected $appends = ['absolute_url'];
    protected $casts = ['name'=>TimestampsCast::class,'description'=>TimestampsCast::class];
    const EXCERPT_LENGTH = 100;

    protected static function boot()
    {
        parent::boot();
        static::deleting(function ($category) {
            foreach($category->articles as $article){
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

	public function articles(): HasMany
	{
		return $this->hasMany(Article::class,'category_id','id');
	}

    public function excerpt()
    {
        return Str::limit(strip_tags($this->description),Category::EXCERPT_LENGTH);
    }

    public function getAbsoluteUrlAttribute()
    {
        return route('category.articles', $this->slug);
    }

    public function getAll()
    {
    	return static::eagerLoaded()->latest('id')->get();
    }

    public function categoryId($id)
    {
    	return static::findOrFail($id);
    }

    public function deleteCategory($id)
    {
    	return static::destroy($id);
    }

    public function paginated()
    {
    	return static::latest()->paginate(config('blog.articles_per_page'));
    }

    public function categorySlug($slug)
    {
        return static::query()->whereSlug($slug)->first();
    }

    public function categoryWithArticles()
    {
        return static::with('articles')->get();
    }

    public function scopeEagerLoaded($query)
    {
        return $query->with('articles');
    }
}
