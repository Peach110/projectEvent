<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $user_id = $_POST['user_id'];
    $prefix = $_POST['prefix'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $email = $_POST['email'];
    $full_name = $_POST['full_name'];
    $gender = $_POST['gender'];
    $birth_date = $_POST['birth_date'];

    // ตรวจสอบว่ามีการเชื่อมต่อฐานข้อมูลหรือไม่
    $conn = getConnection(); // ต้องมีฟังก์ชัน getConnection() ที่เชื่อมต่อกับฐานข้อมูล
    if ($conn) {
        // ตรวจสอบว่ามีผู้ใช้งานซ้ำหรือไม่
        $sql_check = "SELECT username FROM users WHERE username = ?";
        $stmt_check = $conn->prepare($sql_check);
        $stmt_check->bind_param('s', $username);
        $stmt_check->execute();
        $stmt_check->store_result();

        if ($stmt_check->num_rows > 0) {
            // หากพบชื่อผู้ใช้ที่ซ้ำกัน
            echo json_encode(['success' => false, 'message' => 'ชื่อผู้ใช้นี้ถูกใช้งานแล้ว']);
        } else {
            // ถ้าไม่ซ้ำ ให้ลงทะเบียนผู้ใช้ใหม่
            $isRegistered = userSignin($user_id, $prefix, $username, $password, $email, $full_name, $gender, $birth_date);
            
            if ($isRegistered) {
                echo json_encode(['success' => true, 'message' => 'ลงทะเบียนสำเร็จ']);
            } else {
                echo json_encode(['success' => false, 'message' => 'ไม่สามารถลงทะเบียนได้']);
            }
        }

        $stmt_check->close();
        $conn->close();
    } else {
        echo json_encode(['success' => false, 'message' => 'ไม่สามารถเชื่อมต่อฐานข้อมูล']);
    }

} else {
    renderView('signin_get');
}
?>
