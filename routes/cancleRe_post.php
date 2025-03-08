<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $event_id = $_POST['event_id'] ?? null;
    $user_id = $_POST['user_id'] ?? null;

    if (!$event_id || !$user_id) {
        die("ข้อมูลไม่ครบถ้วน");
    }

    $cancle = cancleRe($event_id, $user_id);

    // ✅ เรียกใช้ฟังก์ชัน cancelRe
    if ($cancle) {
        header("Location: /profile");
        exit();
    } else {
        echo "<script>alert('เกิดข้อผิดพลาด'); window.history.back();</script>";
    }
}
?>
