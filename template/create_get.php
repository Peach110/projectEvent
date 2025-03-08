
<!DOCTYPE html>
<html lang="th">

<head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>สร้างกิจกรรม</title>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">

        <style>
                /* สร้างครึ่งวงกลม */
                .half-circle {
                        width: 800px;
                        height: 1100px;
                        background-color: rgb(0, 98, 255);
                        border-top-left-radius: 600px;
                        border-bottom-left-radius: 600px;
                        position: fixed;
                        right: 0;
                        top: 50%;
                        transform: translateY(-50%);
                        z-index: -1;
                }

                .kanit-extralight {
                        font-family: "Kanit", sans-serif;
                        font-weight: 200;
                        font-style: normal;
                }
        </style>
</head>

<body class="kanit-extralight">
        <div style=" width: 30%;" class="container">
                <div class="card" style="margin-top: 150px; margin-left: -400px; color:rgb(0, 123, 255); border-collapse: collapse;  vertical-align: middle; width: 100%;
        height: 80%;
        background-color: rgba(98, 144, 160, 0.13); 
        backdrop-filter: blur(10px); -webkit-backdrop-filter: blur(10px); 
        border: 1px solid rgba(255, 255, 255, 0.5); border-radius: 15px;
        box-shadow: 0 4px 10px rgb(0, 123, 255); padding: 20px;">
                        <h2 class="mt-3 mb-3">สร้างกิจกรรมใหม่</h2>
                        <form action="/create" method="POST" enctype="multipart/form-data">
                                <!-- สำหรับอัพโหลดรุปภาพ วดอ -->
                                <input type="hidden" name="creator_id" value="1">

                                <div class="mb-3">
                                        <label class="form-label">ชื่อกิจกรรม</label>
                                        <input type="text" name="title" class="form-control" required>
                                </div>
                                <div class="mb-3">
                                        <label class="form-label">รายละเอียดกิจกรรม</label>
                                        <textarea name="description" class="form-control" required></textarea>
                                </div>
                                <div class="mb-3">
                                        <label class="form-label">สถานที่</label>
                                        <input type="text" name="location" class="form-control" required>
                                </div>
                                <div class="mb-3">
                                        <label class="form-label">วันที่เริ่ม</label>
                                        <input type="datetime-local" name="start_date" class="form-control" required>
                                </div>
                                <div class="mb-3">
                                        <label class="form-label">วันที่สิ้นสุด</label>
                                        <input type="datetime-local" name="end_date" class="form-control" required>
                                </div>
                                <div class="mb-3">
                                        <label class="form-label">อัปโหลดรูปภาพ</label>
                                        <input type="file" name="event_images[]" class="form-control" multiple required>
                                </div>

                                <div style="display:flex; justify-content: end; align-items: end; gap: 20px;">
                                        <a href="/home" class="btn btn-danger">ยกเลิก</a>
                                        <button type="submit" class="btn btn-primary">สร้างกิจกรรม</button>
                                </div>
                        </form>

                </div>
        </div>
        <div class="half-circle"></div>
        <div style="display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;">
                <h1
                        style="margin-top: -800px; margin-left: 750px; font-size: 60px; color: aliceblue; text-align: center;">
                        ยินดีต้อนรับสู่<br>หน้าสร้างกิจกรรม!</h1>

                <p class="mt-3"
                        style="margin-left:750px; padding-left: 150px; padding-right: 150px; text-align: center; color: aliceblue;">
                        ในหน้านี้คุณสามาถสร้างกิจกรรมได้เองเลย และจะทำให้เห็นคนขอเข้าร่วมได้ด้วยนะ อยู่ในหน้า
                        "ข้อมูลของคุณ" โอเคงั้นเราขออธิบายรายละเอียดเกี่ยวกับหน้านี้เลยละกัน<br><br>1.ชื่อกิจกรรม
                        <br>คือชื่อกิจกรรมที่คุณอยากสร้างชื่ออะไรก็ได้ **แต่ขอสุภาพๆน้า<br> <br>2.รายละเอียดกิจกรรม <br>
                        ก็ตรงตามตัวเลย คือรายละเอียดของกิจกรรมที่คุณสร้างว่ามีอะไรบ้าง <br><br> 3.สถานที่ <br> คือ
                        สถานที่ที่จัดกิจกรรม ว่าอยู่ที่ไหน ถ้าทิ้งลิ้งค์โลเคชั่นไว้จะดีมากเลย <br><br> 4-5.
                        วันที่และเวลาเริ่ม-สิ้นสุดของกิจกรรม <br><br> คือวันที่และเวลาเริ่มวันที่เท่าไหร่
                        สิ้นสุดวันที่เท่าไหร่ และเวลาไหน <br><br> และสุดท้ายคือรูปภาพกิจกรรมของคุณ
                        ทางเราขอขอบคุณที่ไว้ใจ
                        และเยี่ยมชมทางเว็บไซต์ของเรา
                </p>
        </div>
</body>

</html>