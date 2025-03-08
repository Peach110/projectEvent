<?php
function getUserRegister(string $userID):mysqli_result|bool{
    $conn = getConnection();
    $sql = "SELECT * FROM event_registrations WHERE user_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $userID);
    $stmt->execute();
    $result = $stmt->get_result();
    return $result;
}

function reQuestEvent(string $user_id, string $event_id): string|bool {
    $conn = getConnection();

    // ตรวจสอบว่าผู้ใช้ได้ลงทะเบียนไปแล้วหรือไม่
    $sql = 'SELECT * FROM event_registrations WHERE user_id = ? AND event_id = ?';
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('ii', $user_id, $event_id); 
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        error_log("DEBUG: พบว่าขอเข้าร่วมซ้ำ user_id = $user_id, event_id = $event_id");
        $stmt->close();
        $conn->close();
        return 'already_registered';
    }
else {
        error_log('Database Error: ' . $stmt->error);
        $stmt->close();
        $conn->close();
        return false; // คืนค่า false เมื่อเกิดข้อผิดพลาด
    }
}


function getEventParticipants($event_id, $admin_id): mysqli_result|bool {
    $conn = getConnection();
    $sql = "SELECT ep.user_id, u.username, ep.status, ep.registered_at
            FROM event_registrations ep
            JOIN users u ON ep.user_id = u.user_id
            JOIN events e ON ep.event_id = e.event_id
            WHERE ep.event_id = ? AND e.creator_id = ?";
    
    $stmt = $conn->prepare($sql);
    if (!$stmt) {
        die("Prepare failed: " . $conn->error);
    }

    $stmt->bind_param("ii", $event_id, $admin_id);
    
    $stmt->execute();
    
    return $stmt->get_result();
}


function accep($event_id, $user_id, $status): bool
{
    $conn = getConnection();

    // ✅ อัปเดตสถานะใน event_registrations
    $sql = 'UPDATE event_registrations SET status = ? WHERE event_id = ? AND user_id = ?';
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('sii', $status, $event_id, $user_id);

    if (!$stmt->execute()) {
        $stmt->close();
        $conn->close();
        return false; // ถ้าอัปเดตไม่สำเร็จให้ return false
    }
    $stmt->close();

    // ✅ ถ้าสถานะเป็น "approved" ให้เพิ่มข้อมูลลง event_attendance
    if ($status === 'approved') {
        $sql = 'INSERT INTO event_attendance (event_id, user_id) VALUES (?, ?)';
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('ii', $event_id, $user_id);

        if (!$stmt->execute()) {
            $stmt->close();
            $conn->close();
            return false; // ถ้า INSERT ไม่สำเร็จให้ return false
        }
        $stmt->close();
    }

    $conn->close();
    return true; // ถ้าทุกอย่างสำเร็จให้ return true
}


function reject($event_id, $user_id, $status): mysqli_result|bool
{
    $conn = getConnection();

    // ✅ INSERT ข้อมูลลง event_attendance
    $sql = 'UPDATE event_registrations SET status = ? WHERE event_id = ? AND user_id = ?';
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('sii', $status, $event_id, $user_id);

    if (!$stmt->execute()) {
        return false; // ถ้า INSERT ไม่สำเร็จ ให้ return false
    }
    else{
        return true; // ส่งเป็น array
    }
    $stmt->close();
}

function selectJoin($event_id): array|bool
{
    $conn = getConnection();

    // ✅ SELECT ข้อมูลผู้เข้าร่วม
    $sql = "SELECT e.user_id, u.full_name, e.status, e.registered_at
            FROM event_registrations e
            JOIN users u ON e.user_id = u.user_id
            WHERE e.event_id = ? ";

    $stmt = $conn->prepare($sql);

    if (!$stmt) {
        die("Error preparing statement: " . $conn->error);
    }

    $stmt->bind_param("i", $event_id);
    $stmt->execute();
    $result = $stmt->get_result();

    // ✅ ดึงข้อมูลทั้งหมดเป็น array
    $participants = $result->fetch_all(MYSQLI_ASSOC);

    $stmt->close();
    return !empty($participants) ? $participants : false;
}

function cancleRe($event_id, $user_id): bool
{
    $conn = getConnection();
    
    $sql = "DELETE FROM event_registrations WHERE event_id = ? AND user_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ii", $event_id, $user_id);

    if ($stmt->execute()) {
        $stmt->close();
        
        return true; // ✅ ลบสำเร็จ
    } else {
        $stmt->close();
        
        return false; // ❌ ลบไม่สำเร็จ
    }
}

// ฟังก์ชัน selectEvent เพื่อดึงข้อมูลจากฐานข้อมูล
function selectEvent($event_id, $user_id) {
    $conn = getConnection();

    // ✅ อัปเดตข้อมูลการเช็คอิน
    $sql = "UPDATE event_attendance SET checked_in_at = NOW() WHERE event_id = ? AND user_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ii", $event_id, $user_id);
    
    $success = $stmt->execute(); // บันทึกผลลัพธ์การ execute
    $stmt->close(); // ปิด statement หลังจากการ execute

    // สร้างคำสั่ง SQL เพื่อดึงข้อมูลกิจกรรม
    $sql = "SELECT e.event_id, e.title, e.description, 
            e.location, e.start_date, e.end_date, et.checked_in_at, ei.image_url 
            FROM events e 
            JOIN event_images ei ON ei.event_id = e.event_id
            JOIN event_registrations er ON e.event_id = er.event_id
            JOIN event_attendance et ON et.event_id = e.event_id
            WHERE e.event_id = ? AND er.user_id = ?";
    
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ii", $event_id, $user_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $eventData = $result->fetch_assoc(); // คืนค่าข้อมูลกิจกรรม
    } else {
        $eventData = null; // หากไม่พบข้อมูลกิจกรรม
    }

    $stmt->close(); // ปิด statement หลังจากการดึงข้อมูล
    $conn->close(); // ปิดการเชื่อมต่อฐานข้อมูล

    return $eventData; // คืนค่าผลลัพธ์
}

function deleteEventById($event_id): bool
{
    $conn = getConnection();
    
    $sql = "DELETE FROM events WHERE event_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $event_id);

    if ($stmt->execute()) {
        $stmt->close();
        
        return true; 
    } else {
        $stmt->close();
        
        return false; 
    }
}
