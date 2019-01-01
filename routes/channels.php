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

Broadcast::channel('chat.{project_id}.{chat_type}', function($user, $project_id, $chat_type) {
	if(is_numeric($chat_type)) {
		return (int)$user->id === (int)$chat_type;
	}
	else {
		return true;
	}
});
