<?php
// ตรวจสอบว่ามีค่าที่ส่งมาหรือไม่
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['status'], $_POST['user_id'], $_POST['event_id'], $_POST['action'], $_POST['getevent'], $_POST['getuser'])) {
    $action = $_POST['action'];  // รับค่าการกระทำ (approve หรือ reject)
    $user_id = $_POST['user_id'];
    $event_id = $_POST['event_id'];
    $current_status = $_POST['status']; // สถานะปัจจุบันที่รับมา
    $getuser = $_POST['getuser'];
    $getevent = $_POST['getevent'];

    // ตรวจสอบว่า status เป็น 'pending' เท่านั้นถึงจะสามารถอนุมัติได้
    if ($current_status === 'pending' && $action === 'approve') {
        $status = 'approved'; // อัปเดตเป็น 'approved'

        // เรียกใช้งานฟังก์ชันเพื่ออัปเดตสถานะ
        $accep = accep($event_id, $user_id, $status);

        // ถ้าอัปเดตสำเร็จ ให้เปลี่ยนหน้าไป Eventregistered_get.php
        if ($accep) {
            // สร้างฟอร์ม POST อัตโนมัติ
            echo "<form id='redirectForm' method='POST' action='/Eventregistered'>
                    <input type='hidden' name='event_id' value='$getevent'>
                    <input type='hidden' name='user_id' value='$getuser'>
                  </form>
                  <script>
                    // ส่งฟอร์มอัตโนมัติ
                    document.getElementById('redirectForm').submit();
                  </script>";
            exit();
        } else {
            echo "<script>alert('เกิดข้อผิดพลาด! ลองใหม่อีกครั้ง'); window.history.back();</script>";
        }
    } elseif ($current_status === 'pending' && $action === 'reject') {
        $status = 'rejected';
        $accep = reject($event_id, $user_id, $status);

        // ถ้าอัปเดตสำเร็จ ให้เปลี่ยนหน้าไป Eventregistered_get.php
        if ($accep) {
            // สร้างฟอร์ม POST อัตโนมัติ
            echo "<form id='redirectForm' method='POST' action='/Eventregistered'>
                    <input type='hidden' name='event_id' value='$getevent'>
                    <input type='hidden' name='user_id' value='$getuser'>
                  </form>
                  <script>
                    // ส่งฟอร์มอัตโนมัติ
                    document.getElementById('redirectForm').submit();
                  </script>";
            exit();
        } else {
            echo "<script>alert('เกิดข้อผิดพลาด! ลองใหม่อีกครั้ง'); window.history.back();</script>";
        }
    } else {
        echo "<script>alert('สถานะไม่ถูกต้อง หรือคำขอไม่ใช่ pending'); window.history.back();</script>";
    }
}
?>
