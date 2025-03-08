<?php
// ตั้งค่า timezone ให้เป็น Asia/Bangkok
date_default_timezone_set('Asia/Bangkok');

// ตรวจสอบว่า 'checked_in_at' มีค่า
if (!empty($data['eventDetails']['checked_in_at'])) {
    // แปลงเวลาเป็นรูปแบบ DateTime
    $checked_in_at = new DateTime($data['eventDetails']['checked_in_at']);
    $checked_in_at->setTimezone(new DateTimeZone('Asia/Bangkok')); // กำหนด Timezone ให้เป็น Asia/Bangkok
    $formatted_time = $checked_in_at->format('d/m/Y H:i:s'); // รูปแบบที่คุณต้องการให้แสดง
} else {
    $formatted_time = 'ไม่พบข้อมูลการเช็คอิน'; // กรณีไม่มีข้อมูล
}

?>
<!DOCTYPE html>
<html lang="th">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>รายละเอียดกิจกรรม</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <style>
        .event-header {
            background-color: #f8f9fa;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .event-title {
            color: #007bff;
            font-size: 1.5rem;
            font-weight: bold;
        }

        .event-image {
            max-width: 100%;
            border-radius: 5px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .event-details p {
            font-size: 1.1rem;
            margin-bottom: 10px;
        }

        .event-details strong {
            color: #333;
        }

        .btn-back {
            margin-top: 20px;
        }
    </style>
</head>

<body>
    <div class="container mt-5">
        <div class="event-header">
            <?php if (!empty($data['eventDetails'])): ?>
                <h2 class="event-title"><?= htmlspecialchars($data['eventDetails']['title']) ?></h2>
                <p><strong>กิจกรรม ID:</strong> <?= htmlspecialchars($data['eventDetails']['event_id']) ?></p>
                <p><strong>รายละเอียด:</strong> <?= htmlspecialchars($data['eventDetails']['description']) ?></p>
                <p><strong>สถานที่:</strong> <?= htmlspecialchars($data['eventDetails']['location']) ?></p>
                <p><strong>วันที่เริ่ม:</strong> <?= htmlspecialchars($data['eventDetails']['start_date']) ?></p>
                <p><strong>วันที่สิ้นสุด:</strong> <?= htmlspecialchars($data['eventDetails']['end_date']) ?></p>
                <p><strong>เช็คอินล่าสุด:</strong> <?= htmlspecialchars($data['eventDetails']['checked_in_at']) ?></p>
                <!-- ตรวจสอบว่า 'image_url' มีค่าและแสดงรูป -->
                <?php if (!empty($data['eventDetails']['image_url'])): ?>
                    <div class="mb-3">
                        <!-- แสดงรูปจากโฟลเดอร์ uploads -->
                        <img class="event-image" src="uploads/<?= htmlspecialchars($data['eventDetails']['image_url']) ?>" alt="รูปกิจกรรม">
                    </div>
                <?php endif; ?>
            <?php else: ?>
                <p>ไม่พบข้อมูลกิจกรรมนี้</p>
            <?php endif; ?>
        </div>

        <!-- ปุ่มกลับไปที่โปรไฟล์ -->
        <a href="/profile" class="btn btn-primary btn-lg btn-back">กลับไปที่โปรไฟล์</a>
    </div>
</body>

</html>