<?php
$event_id = $_POST['event_id'];
$admin_id = $_POST['user_id'];  

$result = getEventParticipants($event_id, $admin_id);

if ($result) {
renderView('Eventregistered_get');
} else {
    echo "ไม่สามารถดึงข้อมูลได้ หรือคุณไม่มีสิทธิ์ดูข้อมูลนี้";
}