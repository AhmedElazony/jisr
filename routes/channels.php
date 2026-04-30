<?php

use Illuminate\Support\Facades\Broadcast;

Broadcast::channel('user.{id}', function ($user, $id) {
    return (int) $user->id === (int) $id;
});

Broadcast::channel('transaction.user.{userId}', function ($user, $userId) {
    return (int) $user->id === (int) $userId;
});
