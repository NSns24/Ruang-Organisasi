<?php

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

Broadcast::channel('new-member.{id}', function($user, $id) {
    return (int)$user->id === (int)$id;
});

Broadcast::channel('invitation-respond.{id}', function($user, $id) {
    return (int)$user->id === (int)$id;
});

Broadcast::channel('chat.{project_id}.{user_to}', function($user, $project_id, $user_to) {
	if($user_to != 0) {
		return (int)$user->id === (int)$user_to;
	}
	else {
		return true;
	}
});
