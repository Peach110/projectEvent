<?php
// ตรวจสอบว่าเป็น POST Request
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // รับข้อมูลจากฟอร์ม
    $event_id = $_POST["event_id"] ?? null;
    $user_id = $_POST["user_id"] ?? null;
   // $status = $_POST["status"] ?? null;

    // ตรวจสอบค่าที่รับมา
    if ($event_id && $user_id) {
        // เรียกฟังก์ชัน selectEvent และเก็บผลลัพธ์ที่ได้
        $eventDetails = selectEvent($event_id, $user_id);

        if ($eventDetails) {
            // ส่งข้อมูลที่ได้ไปยังหน้าแสดงผล
            renderView('selectEvent_get', ['eventDetails' => $eventDetails]);
            exit();
        } else {
            echo "ไม่พบข้อมูลกิจกรรมนี้";
        }
    } else {
        echo "ข้อมูลกิจกรรมหรือผู้ใช้ไม่ถูกต้อง";
    }
} else {
    // กรณีที่ไม่ได้ส่งข้อมูล POST
    echo "ไม่มีข้อมูลสำหรับการประมวลผล";
}