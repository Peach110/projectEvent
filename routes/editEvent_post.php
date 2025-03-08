<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $event_id = $_POST["event_id"];
    $title = $_POST["title"];
    $description = $_POST["description"];
    $location = $_POST["location"];
    $start_date = $_POST["start_date"];
    $end_date = $_POST["end_date"];

    $creator_id = $_SESSION['user_id']; 

    $event_image = NULL;
    if (isset($_FILES['event_image']) && $_FILES['event_image']['error'] == 0) {
        $upload_dir = "uploads/";
        if (!file_exists($upload_dir)) {
            mkdir($upload_dir, 0777, true);
        }

        $image_name = time() . "_" . basename($_FILES['event_image']['name']); 
        $target_path = $upload_dir . $image_name;

        $allowed_types = ['image/jpeg', 'image/png'];
        if (!in_array($_FILES['event_image']['type'], $allowed_types)) {
            die("ประเภทไฟล์ไม่ถูกต้อง ต้องเป็น JPG หรือ PNG เท่านั้น");
        }

        if (move_uploaded_file($_FILES['event_image']['tmp_name'], $target_path)) {
            $event_image = $image_name; 
        } else {
            die("อัปโหลดไฟล์ไม่สำเร็จ");
        }
    }

    if (empty($title) || empty($description) || empty($location) || empty($start_date) || empty($end_date)) {
        die("กรุณากรอกข้อมูลให้ครบถ้วน");
    }

    $result = editEvent($event_id, $title, $description, $location, $start_date, $end_date, $event_image);

    if ($result) {
        header("Location: /profile");
        exit();
    } else {
        echo "ไม่สามารถอัปเดตกิจกรรมได้";
    }
}
?>
