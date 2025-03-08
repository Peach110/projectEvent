<?php
header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $conn = getConnection();

    $userId = isset($_POST['user_id']) ? (int) $_POST['user_id'] : 0;
    $eventId = isset($_POST['event_id']) ? (int) $_POST['event_id'] : 0;

    if ($userId <= 0 || $eventId <= 0) {
        echo json_encode(['success' => false, 'message' => 'ข้อมูลไม่ถูกต้อง']);
        exit();
    }

    $isRegistered = reQuestEvent($userId, $eventId);
    if ($isRegistered === 'already_registered') {
        echo json_encode(['success' => false, 'message' => 'คุณได้ขอข้าร่วมไปแล้ว']);
        exit();
    }

    $joinStatus = joinEvent($userId, $eventId);
    if ($joinStatus === true) {
        echo json_encode(['success' => true, 'message' => 'เข้าร่วมกิจกรรมสำเร็จ']);
    } else {
        echo json_encode(['success' => false, 'message' => 'ไม่สามารถเข้าร่วมกิจกรรมได้']);
        $conn->rollback();
        exit;
    }
    exit();
}