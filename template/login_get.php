<style>
    /* สร้างครึ่งวงกลม */
    .half-circle {
        width: 800px;
        height: 1200px;
        /* ควรเป็น 2 เท่าของ width */
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

<body class="kanit-extralight" style="background-image:url('https://images.pexels.com/photos/1072179/pexels-photo-1072179.jpeg');
    background-size: cover;
    width: 100%;
    height: 100%">
    <section>

        <div class="container" style="display: flex; justify-content: start; align-items: start; margin-top: 10%;">
            <div class="card mb-3 mt-5"
                style="display: flex; justify-content: center; align-items: center; width: 35%;
                    height: 400px;
                    background-color: rgba(109, 153, 165, 0.17); 
                    backdrop-filter: blur(10px); -webkit-backdrop-filter: blur(10px); 
                    border: 1px solid rgba(255, 255, 255, 0.5); border-radius: 15px;box-shadow: 0 4px 10px rgb(0, 123, 255);">

                <h1 class="mt-5 mb-3" style="color:rgb(0, 123, 255);">เข้าสู่ระบบ</h1>

                <div class="card-body">
                    <form action="/login" method="post">

                        <div class="row g-3 align-items-center ">
                            <div class="col-auto">
                                <input style="width: 300px;" type="email" id="email" name="email" class="form-control"
                                    placeholder="อีเมลของคุณ">
                            </div>
                        </div>

                        <div class="row g-3 align-items-center mt-3">
                            <div class="col-auto">
                                <input style="width: 300px;" type="password" id="password" name="password"
                                    class="form-control" placeholder="รหัสผ่าน">
                            </div>
                        </div>
                        <a href="/home" class="btn btn-danger mt-5">ยกเลิก</a>
                        <input style="margin-left: 160px" class="btn btn-primary mt-5" type="submit"
                            value="ยืนยัน">
                        
                    </form>
                    <?php if (isset($_SESSION['message']) && !empty($_SESSION['message'])): ?>
                        <p style="text-align: center; color: red;"><?= $_SESSION['message'] ?></p>
                    <?php endif; ?>

                </div>
            </div>
        </div>
    </section>

    <div class="half-circle"></div>
    <div style="display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;">
        <h1 style="margin-top: -450px; margin-left: 750px; font-size: 60px; color: aliceblue;">สวัสดี ยินดีต้อนรับ</h1>
        <p class="mt-3" style="margin-left:750px; padding-left: 150px; padding-right: 150px; text-align: center; color: aliceblue;">ในหน้านี้คุณสามาถลงชื่อเข้าใช้ไดเ้แบบรวดเร็วและทันใจ ทางเราขอขอบคุณที่ไว้ใจ
        และเยี่ยมชมทางเว็บไซต์ของเรา</p>
    </div>
</body>