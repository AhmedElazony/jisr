<?php

use Illuminate\Support\Facades\Broadcast;

Broadcast::channel('App.Domains.User.Models.User.{id}', function ($user, $id) {
    return (int) $user->id === (int) $id;
});

Broadcast::channel('transaction.{userId}', function ($user, $userId) {
	return (int) $user->id === (int) $userId;
});
