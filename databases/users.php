<?php
function getUsers(): mysqli_result|bool
{
    $conn = getConnection();
    $sql = 'select * from users';
    $result = $conn->query($sql);
    return $result;
}

function getUserById(int $id): array|bool
{
    $conn = getConnection();
    $sql = 'select * from users where user_id = ?';
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows == 0) {
        return false;
    }
    return $result->fetch_assoc();
}

function userSignin(int $user_id, string $prefix, string $username, string $password, string $email, string $full_name, string $gender, string $birth_date): bool {
    $conn = getConnection();

    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    $sql = 'INSERT INTO users (user_id, prefix, username, password, email, full_name, gender, birth_date) VALUES (?, ?, ?, ?, ?, ?, ?, ?)';
    $stmt = $conn->prepare($sql);

    if (!$stmt) {
        die("Prepare failed: " . $conn->error);
    }

    $stmt->bind_param('isssssss', $user_id, $prefix, $username, $hashedPassword, $email, $full_name, $gender, $birth_date);
    $stmt->execute();

    if ($stmt->affected_rows > 0) {
        return true;
    } else {
        echo "Error: " . $stmt->error;  // แสดงข้อผิดพลาดจริง
        return false;
    }

    $stmt->close();
    $conn->close();
}



function changeRole($userId): array|bool
{
    $conn = getConnection();
    if (!$conn) {
        return ["error" => "Failed to connect to database"];
    }

    $update_role = "UPDATE users SET role ='admin' WHERE user_id=?";
    $stmt = $conn->prepare($update_role);
    
    if (!$stmt) {
        return ["error" => "Failed to prepare statement: " . $conn->error];
    }

    $stmt->bind_param("i", $userId);
    $success = $stmt->execute();

    if ($success) {
        echo "สร้างกิจกรรมสำเร็จ! และปรับสิทธิ์เป็นผู้สร้างกิจกรรมเรียบร้อย";
        $stmt->close();
        $conn->close();
        return true;
    } else {
        $error = $stmt->error;
        $stmt->close();
        $conn->close();
        return ["error" => "เกิดข้อผิดพลาด: " . $error];
    }
}

function canJoinEvent($userId, $eventId): bool
{
    $conn = getConnection();
    if (!$conn) {
        return false;
    }

    $check_role_query = "SELECT role FROM users WHERE user_id = ?";
    $stmt = $conn->prepare($check_role_query);
    if (!$stmt) {
        return false;
    }

    $stmt->bind_param("i", $userId);
    $stmt->execute();
    $stmt->bind_result($role);
    $stmt->fetch();
    $stmt->close();

    if ($role === 'admin') {
        $check_event_query = "SELECT creator_id FROM events WHERE event_id = ?";
        $stmt = $conn->prepare($check_event_query);
        if (!$stmt) {
            return false;
        }

        $stmt->bind_param("i", $eventId);
        $stmt->execute();
        $stmt->bind_result($creator_id);
        $stmt->fetch();
        $stmt->close();

        if ($creator_id == $userId) {
            return false; 
        }
    }

    return true; 
}

function joinEvent(int $userId, int $eventId): bool {
    $conn = getConnection();
    if (!$conn) {
        error_log("❌ ไม่สามารถเชื่อมต่อฐานข้อมูล");
        return false;
    }

    $checkCreatorQuery = "SELECT creator_id FROM events WHERE event_id = ?";
    $stmt = $conn->prepare($checkCreatorQuery);
    if (!$stmt) {
        error_log("❌ SQL Error: {$conn->error}");
        return false;
    }

    $stmt->bind_param("i", $eventId);
    $stmt->execute();
    $result = $stmt->get_result();
    $event = $result->fetch_assoc();

    if ($event && $event['creator_id'] == $userId) {
        error_log("❌ ผู้ใช้เป็นเจ้าของกิจกรรม ไม่สามารถเข้าร่วมได้ user_id={$userId} event_id={$eventId}");
        return false; 
    }

    $checkQuery = "SELECT 1 FROM event_registrations WHERE user_id = ? AND event_id = ?";
    $stmt = $conn->prepare($checkQuery);
    if (!$stmt) {
        error_log("❌ SQL Error: {$conn->error}");
        return false;
    }

    $stmt->bind_param("ii", $userId, $eventId);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        error_log("❌ ผู้ใช้ลงทะเบียนไปแล้ว user_id={$userId} event_id={$eventId}");
        return false;
    }

    $insertQuery = "INSERT INTO event_registrations (user_id, event_id) VALUES (?, ?)";
    $stmt = $conn->prepare($insertQuery);
    if (!$stmt) {
        error_log("❌ SQL Error: {$conn->error}");
        return false;
    }

    $stmt->bind_param("ii", $userId, $eventId);
    if ($stmt->execute()) {
        error_log("✅ ลงทะเบียนสำเร็จ user_id={$userId} event_id={$eventId}");
        return true;
    } else {
        error_log("❌ ลงทะเบียนล้มเหลว: {$stmt->error}");
        return false;
    }
}
