<?php

use App\Broadcasting\ArticleChannel;
use App\Broadcasting\ReportChannel;
use Illuminate\Support\Facades\Broadcast;

/*
|--------------------------------------------------------------------------
| Broadcast Channels
|--------------------------------------------------------------------------
|
| Here you may register all of the event broadcasting channels that your
| application supports. The given channel authorization callbacks are
| used to check if an authenticated user can listen to the channel.
|
*/

Broadcast::channel('App.Models.User.{id}', function ($user, $id) {
    return (int) $user->id === (int) $id;
});

Broadcast::channel('articles', ArticleChannel::class, ['guards' => ['web', 'admin']]);

Broadcast::channel('reports.user.{user}',  ReportChannel::class);
