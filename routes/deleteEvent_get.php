<?php

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $event_id = $_GET['event_id'] ?? null;

    if (!$event_id) {
        die("ข้อมูลไม่ครบถ้วน");
    }

    $deleteEvent = deleteEventById($event_id);

    // ✅ เรียกใช้ฟังก์ชัน cancelRe
    if ($deleteEvent) {
        header("Location: /profile");
        exit();
    } else {
        echo "<script>alert('เกิดข้อผิดพลาด'); window.history.back();</script>";
    }
}
?>
