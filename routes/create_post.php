<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $_POST["title"];
    $description = $_POST["description"];
    $location = $_POST["location"]; 
    $start_date = $_POST["start_date"];
    $end_date = $_POST["end_date"];

    if (!isset($_SESSION['user_id'])) {
        die("User not logged in.");
    }
    $creator_id = $_SESSION['user_id'];

    $event_images = [];
    if (!empty($_FILES['event_images']['name'][0])) {
        $upload_dir = "uploads/";
        if (!file_exists($upload_dir)) {
            if (!mkdir($upload_dir, 0777, true)) {
                die("Failed to create upload directory.");
            }
        }

        $allowed_types = ['image/jpeg', 'image/png'];
        foreach ($_FILES['event_images']['name'] as $key => $name) {
            if ($_FILES['event_images']['error'][$key] == 0) {
                $image_type = $_FILES['event_images']['type'][$key];
                if (!in_array($image_type, $allowed_types)) {
                    die("Invalid file type. Only JPG and PNG are allowed.");
                }

                $image_name = time() . "_" . basename($name);
                $target_path = $upload_dir . $image_name;

                if (move_uploaded_file($_FILES['event_images']['tmp_name'][$key], $target_path)) {
                    $event_images[] = $image_name;
                } else {
                    die("Failed to upload file: " . $name);
                }
            }
        }
    }

    if (create($title, $description, $location, $start_date, $end_date, $creator_id, $event_images)) {
        $result = changeRole($creator_id);
        if ($result === true) {
            renderView('events_get');
            echo "Role changed successfully!";
            exit;
        } else {
            echo "Error: " . $result['error'];
        }
    } else {
        echo "Error creating event.";
    }
}
?>