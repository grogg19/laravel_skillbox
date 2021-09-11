<?php

namespace App\Models;

use App\Helpers\CacheCleanable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

/**
 * Class Message
 * @package App\Models
 */
class Message extends Model
{
    use HasFactory, CacheCleanable;

    protected $guarded = [];

    protected static $tags = ['messages'];
}
