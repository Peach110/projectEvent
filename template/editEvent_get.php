<?php
$event_id = $_GET['event_id'] ?? 0;

$event = null;
if ($event_id) {
    $result = getEditEvent($event_id);
    if ($result && $result->num_rows > 0) {
        $event = $result->fetch_assoc();
    }
}

if (!$event) {
    die("ไม่พบข้อมูลกิจกรรมนี้");
}
?>
<style>
    /* สร้างครึ่งวงกลม */
    .half-circle {
        width: 800px;
        height: 1200px;
        /* ควรเป็น 2 เท่าของ width */
        background-color: rgb(0, 98, 255);
        border-top-left-radius: 0px;
        border-bottom-left-radius: 0px;
        position: fixed;
        right: 0;
        top: 50%;
        transform: translateY(-50%);
        z-index: -1;
    }


    .circle {
        width: 200px;
        height: 200px;
        /* ควรเป็น 2 เท่าของ width */
        background-color: rgba(93, 144, 225, 0.7);
        border-radius: 100%;
        position: fixed;
        right: 0;
        top: 50%;
        transform: translateY(100%);
        z-index: -1;
    }

    .circle {
        width: 180px;
        height: 180px;
        /* ควรเป็น 2 เท่าของ width */
        background-color: rgba(93, 144, 225, 0.7);
        border-radius: 100%;
        position: fixed;
        right: 0;
        top: 50%;
        transform: translateY(100%);
        z-index: -1;
    }

    .circle1 {
        width: 200px;
        height: 200px;
        /* ควรเป็น 2 เท่าของ width */
        background-color: rgba(93, 144, 225, 0.7);
        border-radius: 100%;
        position: fixed;
        right: 50px;
        top: 80%;
        transform: translateY(-400%);
        z-index: -1;
    }

    .circle2 {
        width: 200px;
        height: 200px;
        /* ควรเป็น 2 เท่าของ width */
        background-color: rgba(93, 144, 225, 0.7);
        border-radius: 100%;
        position: fixed;
        right: 30%;
        top: 50%;
        transform: translateY(-200%);
        z-index: -1;
    }

    .circle3 {
        width: 200px;
        height: 200px;
        /* ควรเป็น 2 เท่าของ width */
        background-color: rgba(93, 144, 225, 0.7);
        border-radius: 100%;
        position: fixed;
        right: 30%;
        top: 80%;
        transform: translateY(30%);
        z-index: -1;
    }

    .circle4 {
        width: 150px;
        height: 150px;
        /* ควรเป็น 2 เท่าของ width */
        background-color: rgba(93, 144, 225, 0.7);
        border-radius: 100%;
        position: fixed;
        right: 10%;
        top: 40%;
        transform: translateY(10%);
        z-index: -1;
    }

    .kanit-extralight {
                        font-family: "Kanit", sans-serif;
                        font-weight: 200;
                        font-style: normal;
                }
</style>
<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>แก้ไขกิจกรรม</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body class="kanit-extralight">
<div class="container" style="margin-top: 100px; display: flex; justify-content: center; align-items: center;">
    <div class="card mb-3" style="margin-left: -100px; color:rgb(0, 123, 255); border-collapse: collapse; vertical-align: middle; width: 80%;
        height: 100%; 
        background-color: rgba(98, 144, 160, 0.13); 
        backdrop-filter: blur(10px); -webkit-backdrop-filter: blur(10px); 
        border: 1px solid rgba(255, 255, 255, 0.5); border-radius: 15px;
        box-shadow: 0 4px 10px rgb(0, 123, 255); padding: 20px;">
        
        <h2>แก้ไขกิจกรรม</h2>
        
        <form action="/editEvent" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="event_id" value="<?= htmlspecialchars($event['event_id']) ?>">

            <div class="mb-3">
                <label class="form-label">ชื่อกิจกรรม</label>
                <input type="text" name="title" class="form-control" value="<?= htmlspecialchars($event['title']) ?>" required>
            </div>
            <div class="mb-3">
                <label class="form-label">รายละเอียดกิจกรรม</label>
                <textarea name="description" class="form-control" required><?= htmlspecialchars($event['description']) ?></textarea>
            </div>
            <div class="mb-3">
                <label class="form-label">สถานที่</label>
                <input type="text" name="location" class="form-control" value="<?= htmlspecialchars($event['location']) ?>" required>
            </div>
            <div class="mb-3">
                <label class="form-label">วันที่เริ่ม</label>
                <input type="datetime-local" name="start_date" class="form-control" value="<?= !empty($event['start_date']) ? date('Y-m-d\TH:i', strtotime($event['start_date'])) : '' ?>" required>
            </div>
            <div class="mb-3">
                <label class="form-label">วันที่สิ้นสุด</label>
                <input type="datetime-local" name="end_date" class="form-control" value="<?= !empty($event['end_date']) ? date('Y-m-d\TH:i', strtotime($event['end_date'])) : '' ?>" required>
            </div>

            <?php if (!empty($event['image_url']) && file_exists('uploads/' . $event['image_url'])): ?>
                <div class="mb-3">
                    <label class="form-label">รูปภาพที่อัปโหลดแล้ว</label><br>
                    <img class="container-fluid" style="width: 500px;" src="uploads/<?= $event['image_url'] ?>" alt="รูปกิจกรรม">
                    <br><br>
                </div>
            <?php endif; ?>

            <div class="mb-3">
                <label class="form-label">อัปโหลดรูปภาพใหม่ (ถ้ามี)</label>
                <input type="file" name="event_image" class="form-control">
            </div>
            
            <div style="display:flex; justify-content: end; align-items: end; gap:10px ;">
                <a href="/profile" class="btn btn-danger">ยกเลิก</a>
                <button type="submit" class="btn btn-success">ยืนยัน</button>
                
            </div>
        </form>

    </div>
</div> 

    
    <div class="half-circle"></div>
    <div class="circle"></div>
    <div class="circle1"></div>
    <div class="circle2"></div>
    <div class="circle3"></div>
    <div class="circle4"></div>
    <div class="circle4"></div>
</body>
</html>