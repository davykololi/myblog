<?php

namespace App\Models;

use App\Models\User;
use App\Models\Article;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $table = 'comments';
    protected $fillable = ['content','user_id','article_id'];
    protected $with = ['article','user'];
    protected $appends = ['created_date'];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class)->withDefault();
    }

    public function article(): BelongsTo
    {
        return $this->belongsTo(Article::class)->withDefault();
    }

    public function getCreatedDateAttribute()
    { 
        return Carbon::parse($this->created_at)->diffForHumans();    
    }
}
