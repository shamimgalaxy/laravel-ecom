<?php

use Illuminate\Support\Facades\Broadcast;

// Default Laravel user channel
Broadcast::channel('App.Models.User.{id}', function ($user, $id) {
    return (int) $user->id === (int) $id;
});

// ShopGrids live chat channel (public — no auth required)
Broadcast::channel('chat', function () {
    return true;
});