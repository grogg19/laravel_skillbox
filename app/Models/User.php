<?php

namespace App\Models;

use App\Helpers\CacheCleanable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Cache;

class User extends Authenticatable
{
    use HasFactory, Notifiable, CacheCleanable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    protected static $tags = ['users'];


    public function articles()
    {
        return $this->hasMany(Article::class, 'owner_id');
    }

    public function news()
    {
        return $this->hasMany(News::class, 'author_id');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class, 'owner_id');
    }

    public function role()
    {
        return $this->belongsTo(UserRole::class);
    }

    public function isAdmin()
    {
        return !empty($this->role) && $this->role->slug == 'admin';
    }


}
