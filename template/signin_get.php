้

<head>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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
        
    </style>
</head>

<body>
    <div class="container" style=" width: 40%; margin-top: 100px; margin-left: 80px;">
        <div class="card" style="border-collapse: collapse; text-align: center; vertical-align: middle; width: 100%;
            height: 70%;
            background-color: rgba(98, 144, 160, 0.13); 
            backdrop-filter: blur(10px); -webkit-backdrop-filter: blur(10px); 
            border: 1px solid rgba(255, 255, 255, 0.5); border-radius: 15px;
            box-shadow: 0 4px 10px rgb(0, 123, 255); padding: 20px;">

            <h1 class="mb-3 mt-3" style="color:rgb(0, 123, 255);">ลงชื่อเข้าใช้</h1>
            <p style="color:rgb(0, 123, 255);">ลงทะเบียนง่ายๆ สบายๆ ด้วยไสตล์คุณ</p>

            <form action="/signin" method="post" id="signin">
                <!-- รหัสนิสิต -->
                <div class="row mb-3">
                    <div class="col">
                        <input style="width: 40%; margin: 0 auto;" type="text" class="form-control" name="user_id"
                            placeholder="ใส่ไอดีของคุณ" required>
                    </div>
                </div>

                <!-- เพศ -->
                <div style="display: flex; justify-content: center; align-items: center;">
                    <div class="row mb-3">
                        <div class="col">
                            <select style="width: 80px; margin: 0 auto; " class="form-control" name="gender" required>
                                <option value="" disabled selected>เพศ</option>
                                <option value="ชาย">ชาย</option>
                                <option value="หญิง">หญิง</option>
                                <option value="ตัวแม่ตัวมัม">ตัวแม่</option>
                            </select>
                        </div>
                    </div>

                    <!-- คำนำหน้า -->
                    <div class="row mb-3">
                        <div class="col">
                            <select style="width: 140px; margin:0 auto; margin-left: 20px;" class="form-control" name="prefix" required>
                                <option value="" disabled selected>เลือกคำนำหน้า</option>
                                <option value="นาย">นาย</option>
                                <option value="นาง">นาง</option>
                                <option value="นางสาว">นางสาว</option>
                            </select>
                        </div>
                    </div>
                </div>

                <!-- ชื่อ-นามสกุล -->
                <div class="row mb-3">
                    <div class="col">
                        <input style="width: 70%; margin: 0 auto;" type="text" class="form-control" name="full_name"
                            placeholder="ชื่อ-นามสกุล" required>
                    </div>
                </div>

                <!-- วันเกิด -->
                <div class="row mb-4">
                    <div class="col">
                        <input style="width: 50%; margin: 0 auto;" class="form-control" type="date" name="birth_date"
                            required>
                    </div>
                </div>

                <!-- ชื่อในระบบ -->
                <div class="row mb-3">
                    <div class="col">
                        <input style="width: 60%; margin: 0 auto;" type="text" class="form-control" name="username"
                            placeholder="ตั้งชื่อในระบบของคูณ" required>
                    </div>
                </div>

                <!-- อีเมล -->
                <div class="row mb-3">
                    <div class="col">
                        <input style="width: 70%; margin: 0 auto;" type="text" class="form-control" name="email"
                            placeholder="อีเมล" required>
                    </div>
                </div>

                <!-- รหัสผ่าน -->
                <div class="row mb-3">
                    <div class="col">
                        <input style="width: 70%; margin: 0 auto;" type="text" class="form-control" name="password"
                            placeholder="รหัสผ่าน" required>
                    </div>
                </div>

                <!-- ส่งฟอร์ม -->
                <div class="row">
                    <div class="col">
                        <a href="/home" class="btn btn-danger mt-3">ยกเลิก</a>
                        <button class="btn btn-primary mt-3" style="width: 13%; margin-left: 200px;" type="button"
                            onclick="submitForm()">สมัคร</button>
                            
                    </div>
                </div>
            </form>
            
        </div>
    </div>
    <div class="half-circle"></div>
    <div style="display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;">
        <h1 style="margin-top: -700px; margin-left: 750px; font-size: 60px; color: aliceblue;">สวัสดี ยินดีต้อนรับ</h1>
        <p class="mt-3" style="margin-left:750px; padding-left: 150px; padding-right: 150px; text-align: center; color: aliceblue;">ในหน้านี้คุณสามาถลงชื่อเข้าใช้ไดเ้แบบรวดเร็วและทันใจ ทางเราขอขอบคุณที่ไว้ใจ
        และเยี่ยมชมทางเว็บไซต์ของเรา</p>
    </div>


    <script>
        function submitForm() {
            const form = document.getElementById('signin');
            const formData = new FormData(form);

            fetch('/signin', {
                method: 'post',
                body: formData
            })

                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        Swal.fire({
                            title: 'สำเร็จ!',
                            text: 'User registered successfully!',
                            icon: 'success',
                            confirmButtonText: 'OK'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                window.location.href = '/login_get';
                            }
                        });
                    } else {
                        Swal.fire({
                            title: 'ผิดพลาด!',
                            text: data.message || 'เกิดข้อผิดพลาดในการลงทะเบียน',
                            icon: 'error',
                            confirmButtonText: 'OK'
                        });
                    }
                })
                .catch(error => {
                    Swal.fire({
                        title: 'ผิดพลาด!',
                        text: 'เกิดข้อผิดพลาด,ไอดีหรืออีเมลของคุณอาจจะซ้ำกับคนอื่น',
                        icon: 'error',
                        confirmButtonText: 'OK'
                    });
                });
        }
    </script>
</body>