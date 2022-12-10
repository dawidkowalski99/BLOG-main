<?php

/*
|--------------------------------------------------------------------------
| Broadcast Channels
|--------------------------------------------------------------------------
|
| Rejestrowanie wszystkich kanałów transmisji jakie aplikacja wspiera.
| Nadawanie uprawnień służy do weryfikaacji autentyczności czy użytkownik może nasłuchiwać kanał.
*/

Broadcast::channel('App.User.{id}', function ($user, $id) {
    return (int) $user->id === (int) $id;
});
