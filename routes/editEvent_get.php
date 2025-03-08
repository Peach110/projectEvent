<?php
$event_id = $_GET['event_id'] ?? 0; 
$result = getEditEvent($event_id);

if ($result && $result->num_rows > 0) {
    $event = $result->fetch_assoc();
    renderView('editEvent_get', ['event' => $event]);
} else {
    die("ไม่พบข้อมูลกิจกรรมนี้");
}