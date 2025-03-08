<?php


function getStudentEnrollmentByStudentId(int $studentId): mysqli_result|bool
{
    $conn = getConnection();
    $sql = 'SELECT
    c.course_id,
    c.course_name,
    c.course_code,
    c.instructor,
    e.enrollment_id,
    e.enrollment_date,
    s.student_id
    FROM
    enrollment.courses c
    INNER JOIN enrollment.enrollment e ON
    c.course_id = e.course_id
    INNER JOIN enrollment.students s ON
    e.student_id = s.student_id where s.student_id = ?';
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $studentId);
    $stmt->execute();
    $result = $stmt->get_result();
    return $result;
}
function WithdrawCoursesById(int $id): bool
{
    $conn = getConnection();
    $sql = 'delete from enrollment where course_id = ?';
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('i', $id);
    try {
        $stmt->execute();
        if ($stmt->affected_rows > 0) {
            return true;
        } else {
            return false;
        }
    } catch (Exception $e) {
        return false;
    }
}

function registerCourseById(int $studentId, int $courseId): bool
{
    $conn = getConnection();

    $checkSql = 'SELECT * FROM event_registrations.users WHERE user_id = ? AND event_id = ?';
    $checkStmt = $conn->prepare($checkSql);
    $checkStmt->bind_param('ii', $studentId, $courseId);
    $checkStmt->execute();
    $checkStmt->store_result(); 

    if ($checkStmt->num_rows > 0) {
        error_log("DEBUG: พบว่าลงทะเบียนซ้ำ student_id = $studentId, course_id = $courseId");
        return false;   
    }


    $sql = 'INSERT INTO enrollment.enrollment (student_id, course_id, enrollment_date) VALUES (?, ?, CURDATE())';
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('ii', $studentId, $courseId);

    if ($stmt->execute()) {
        return true;

    } else {
        error_log('Database Error: ' . $stmt->error);
        return false;
    }
}

function enrollEventRS(int $userId, int $eventId): mysqli_result|bool
{
    $conn = getConnection();

    // ตรวจสอบว่ามี student_id และ course_id ในตาราง students และ courses หรือไม่
    $sqlCheckUser_id = 'SELECT ur.user_id
                        FROM event_registrations er
                        JOIN users ur ON er.user_id = ur.user_id
                        WHERE er.user_id = ?;';
                        
    $sqlCheckEvent_id =     'SELECT e.event_id
                            FROM event_registrations er
                            JOIN events e ON er.event_id = e.event_id
                            WHERE e.event_id = ?;';
    
    // ตรวจสอบ student_id   
    $stmt = $conn->prepare($sqlCheckUser_id);
    $stmt->bind_param("i", $userId);
    $stmt->execute();
    $resultStudent = $stmt->get_result();
    
    if ($resultStudent->num_rows === 0) {
        return false; // ถ้าไม่มี student_id ในตาราง students
    }
    
    // ตรวจสอบ course_id
    $stmt = $conn->prepare($sqlCheckEvent_id);
    $stmt->bind_param("i", $eventId);
    $stmt->execute();
    $resultCourse = $stmt->get_result();
    
    if ($resultCourse->num_rows === 0) {
        return false; // ถ้าไม่มี course_id ในตาราง courses
    }

    // ตรวจสอบว่า student_id ลงทะเบียนวิชาเดียวกันไปแล้วหรือไม่
    $sqlCheckEnrollment = 'SELECT * FROM event_registrations.event_registrations WHERE user_id = ? AND event_id = ?';
    $stmt = $conn->prepare($sqlCheckEnrollment);
    $stmt->bind_param("ii", $studentId, $courseId);
    $stmt->execute();
    $resultEnrollment = $stmt->get_result();
    
    if ($resultEnrollment->num_rows > 0) {
        return false; 
        
    }

    // ถ้ามี student_id และ course_id ในตาราง students และ courses ให้แทรกข้อมูลในตาราง enrollment
    $sql = 'INSERT INTO event_registrations.event_registrations (event_id, user_id, registered_at   ) 
            VALUES (?, ?, NOW())';
    
    $stmt = $conn->prepare($sql);
    
    if ($stmt === false) {
        return false; // ถ้าการเตรียมคำสั่ง SQL ผิดพลาด
    }
    // Binding the parameters (student_id, course_id)
    $stmt->bind_param("ii", $studentId, $courseId);
    // Executing the statement
    $executeResult = $stmt->execute();
    // Checking if the insert was successful
    return $executeResult;
}

