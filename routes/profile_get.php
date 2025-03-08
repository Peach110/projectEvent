<?php

$result = getUserById($_SESSION['user_id']);
$events = getUserRegister($_SESSION['user_id']);
$event = getEventsByUser($_SESSION['user_id']);

renderView('profile_get',['result' => $result, 'event_registrations'=> $events, 'event' => $event]);