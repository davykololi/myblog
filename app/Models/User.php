<?php

namespace App\Models;

use Cache;
use Auth;
use App\Models\Article;
use App\Models\Comment;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Traits\HasGravatar;
use App\Casts\TimestampsCast;
use Spatie\Permission\Traits\HasRoles;
use App\Enums\UserRoleEnum;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, CanResetPassword, Sluggable, HasGravatar, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = ['name','email','assigned_role','password','slug'];
    protected $appends = ['absolute_url'];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];
    
    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'name'=>TimestampsCast::class,
        'assigned_role' => UserRoleEnum::class
    ];

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

    public function profile(): HasOne
    {
        return $this->hasOne(Profile::class,'user_id','id');
    }

    public function articles(): HasMany
    {
        return $this->hasMany(Article::class,'user_id','id');
    }

    public function comments(): HasManyThrough
    {
        return $this->hasManyThrough(Comment::class,Article::class,'user_id','article_id','id');
    }

    public function getAbsoluteUrlAttribute()
    {
        return route('author.articles', $this->slug);
    }

    public function isOnline()
    {
        return Cache::has('user-is-online-'.$this->id);
    }

    public function scopeEagerLoaded($query)
    {
        return $query->with('articles','comments','profile');
    }

    public function isAdmin()
    {
        return $this->assigned_role === UserRoleEnum::Admin;
    }

    public function isEditor()
    {
        return $this->assigned_role === UserRoleEnum::Editor;
    }

    public function isAuthor()
    {
        return $this->assigned_role === UserRoleEnum::Author;
    }

    public function isVisitor()
    {
        return $this->assigned_role === UserRoleEnum::Visitor;
    }
}
