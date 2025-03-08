<?php

function getEvent(): mysqli_result|bool
{
    $conn = getConnection();
    $sql = 'SELECT e.*, i.image_url
            FROM events e 
            LEFT JOIN event_images i ON e.event_id = i.event_id';
    $result = $conn->query($sql);
    return $result;
}


function create($title, $description, $location, $start_date, $end_date, $creator_id, $uploaded_images)
{
    $conn = getConnection();
    $conn->begin_transaction();

    $sql = "INSERT INTO events (title, description, location, start_date, end_date, creator_id) VALUES (?,?,?,?,?,?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('sssssi', $title, $description, $location, $start_date, $end_date, $creator_id);

    if ($stmt->execute()) {
        $event_id = $stmt->insert_id;

        if (!empty($uploaded_images)) {
            foreach ($uploaded_images as $event_image) {
                $sql_image = "INSERT INTO event_images (event_id, image_url) VALUES (?, ?)";
                $stmt_image = $conn->prepare($sql_image);
                $stmt_image->bind_param('is', $event_id, $event_image);
                if (!$stmt_image->execute()) {
                    $conn->rollback();
                    return false;
                }
            }
        }

        $conn->commit();
        return true;
    } else {
        $conn->rollback();
        return false;
    }
}

function getEventsByUser(string $creator_id): mysqli_result|bool
{
    $conn = getConnection();
    $sql = 'SELECT * FROM events WHERE creator_id = ?';
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $creator_id);
    $stmt->execute();
    $result = $stmt->get_result();
    return $result;
}

function getEventsByKeywordAndDate(?string $keyword = null, ?string $start_date = null, ?string $end_date = null): mysqli_result|bool
{
    $conn = getConnection();
    $sql = "SELECT * FROM events WHERE 1";
    
    $params = [];
    $types = "";

    if ($keyword) {
        $sql .= " AND title LIKE ?";
        $params[] = "%" . $keyword . "%";
        $types .= "s";
    }

    if ($start_date && $end_date) {
        $sql .= " AND (start_date BETWEEN ? AND ? OR end_date BETWEEN ? AND ? OR (start_date <= ? AND end_date >= ?))";
        $params[] = $start_date;
        $params[] = $end_date;
        $params[] = $start_date;
        $params[] = $end_date;
        $params[] = $start_date;
        $params[] = $end_date;
        $types .= "ssssss";
    } elseif ($start_date) {
        $sql .= " AND (start_date >= ? OR end_date >= ?)";
        $params[] = $start_date;
        $params[] = $start_date;
        $types .= "ss";
    } elseif ($end_date) {
        $sql .= " AND (end_date <= ? OR start_date <= ?)";
        $params[] = $end_date;
        $params[] = $end_date;
        $types .= "ss";
    }

    $stmt = $conn->prepare($sql);
    if (!empty($params)) {
        $stmt->bind_param($types, ...$params);
    }

    $stmt->execute();
    return $stmt->get_result();
}


function editEvent($event_id, $title, $description, $location, $start_date, $end_date, $image_url = null)
{
    $conn = getConnection();
    $conn->begin_transaction(); 

    $sql = "UPDATE events SET title = ?, description = ?, location = ?, start_date = ?, end_date = ? WHERE event_id = ?";
    $stmt = $conn->prepare($sql);

    if ($stmt === false) {
        die("เกิดข้อผิดพลาดในการเตรียมคำสั่ง SQL: " . $conn->error);
    }

    $stmt->bind_param("sssssi", $title, $description, $location, $start_date, $end_date, $event_id);
    $result = $stmt->execute();

    if (!$result) {
        $conn->rollback();
        die("เกิดข้อผิดพลาดในการอัปเดตกิจกรรม: " . $stmt->error);
    }

    if (!empty($image_url)) {

        $sql_get_old_image = "SELECT image_url FROM event_images WHERE event_id = ?";
        $stmt_old = $conn->prepare($sql_get_old_image);
        $stmt_old->bind_param("i", $event_id);
        $stmt_old->execute();
        $stmt_old->bind_result($old_image);
        $stmt_old->fetch();
        $stmt_old->close();

        if ($old_image && file_exists("uploads/" . $old_image)) {
            unlink("uploads/" . $old_image);
        }


        $sql_image = "UPDATE event_images SET image_url = ? WHERE event_id = ?";
        $stmt_image = $conn->prepare($sql_image);
        if ($stmt_image === false) {
            $conn->rollback();
            die("เกิดข้อผิดพลาดในการเตรียมคำสั่งอัปเดตรูปภาพ: " . $conn->error);
        }

        $stmt_image->bind_param("si", $image_url, $event_id);
        $result_image = $stmt_image->execute();

        if (!$result_image) {
            $conn->rollback();
            die("เกิดข้อผิดพลาดในการอัปเดตรูปภาพ: " . $stmt_image->error);
        }
    }

    $conn->commit();
    $stmt->close();
    $conn->close();

    return true;
}


function getEditEvent(int $event_id): mysqli_result|bool
{
    $conn = getConnection();
    $sql = 'SELECT e.*, i.image_url
            FROM events e 
            LEFT JOIN event_images i ON e.event_id = i.event_id
            WHERE e.event_id = ?';

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $event_id);
    $stmt->execute();
    
    return $stmt->get_result();
}

function getEventsByEvenID(string $event_id): mysqli_result|bool
{
    $conn = getConnection();
    $sql = 'SELECT * FROM events WHERE event_id = ?';
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $event_id);
    $stmt->execute();
    $result = $stmt->get_result();
    return $result;
}
?>