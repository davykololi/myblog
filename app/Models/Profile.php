<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasFactory;

    protected $table = 'profiles';
    protected $primaryKey = 'id';
    protected $fillable = ['avatar','country','city','postal_address','postal_code','facebook_link','x_link','linkedin_link','instagram_link','twitter_site','user_info','user_id'];

    public function user()
    {
        return $this->belongsTo(User::class)->withDefault();
    }
}
