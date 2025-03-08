<head>
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
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
</head>

<body class="kanit-extralight">
    <section>
        <div style="display: flex; justify-content: center; align-items: center;">
            <div style="border-color: aliceblue; border-radius: 30px; margin-top: 200px; display: flex; justify-content: center; align-items: center;
        width: 70%; height: 500px; background-color:rgb(255, 255, 255);box-shadow: 0 2px 5px rgb(0, 123, 255);"
                class="card mb-3">
                <img class="mb-3"
                    style="margin-top: -200px; width: 200px; height: 200px; border-radius: 100px; box-shadow: 0 4px 10px rgb(130, 132, 134);"
                    src="https://static.vecteezy.com/system/resources/thumbnails/005/544/718/small_2x/profile-icon-design-free-vector.jpg"
                    alt="">
                <table style=" display: flex; justify-content: center; align-items: center; color: aliceblue;">
                    <tr style="display: flex; justify-content: center; align-items: center;">
                        <td style="font-size: 40px; color: rgb(69, 69, 71);"><?= $data['result']['full_name'] ?></td>
                    </tr>
                    <tr style="display: flex; justify-content: center; align-items: center;">
                        <td style="text-align: center; font-size: 20px; color: rgb(69, 69, 71);">
                            <?= $data['result']['email'] ?>
                        </td>
                    </tr>
                    <tr style="display: flex; justify-content: center; align-items: center;">
                        <td style="text-align: center; font-size: 22px; color: rgb(69, 69, 71); padding-top: 30px;">
                            เพศ: <?= $data['result']['gender'] ?>
                        </td>
                    </tr>

                    <tr style="display: flex; justify-content: center; align-items: center;">
                        <td style="font-size: 22px; text-align: center; color: rgb(69, 69, 71);">วันเกิด:
                            <?= $data['result']['birth_date'] ?>
                        </td>
                    </tr>

                    <tr style="display: flex; justify-content: center; align-items: center; padding-top: 30px;">
                        <td
                            style="font-size: 22px; color: rgb(69, 69, 71); display: flex; flex-direction: column; align-items: center;">
                            <?= $data['result']['user_id'] ?>
                            <span>ID</span>
                        </td>

                        <td
                            style="font-size: 22px; color: rgb(69, 69, 71); display: flex; flex-direction: column; align-items: center; margin-left: 100px;">
                            <?= $data['result']['role'] ?>
                            <span>Role</span>
                        </td>

                        <td
                            style="font-size: 22px; color: rgb(69, 69, 71); display: flex; flex-direction: column; align-items: center; margin-left: 100px;">
                            <?= $data['result']['username'] ?>
                            <span>Name</span>
                        </td>
                    </tr>

                </table>
            </div>
        </div>

        <div class="half-circle"></div>
        <div class="circle"></div>
        <div class="circle1"></div>
        <div class="circle2"></div>
        <div class="circle3"></div>
        <div class="circle4"></div>
        <div class="circle4"></div>


        <h2 style="margin-left: 230px; color:rgb(0, 123, 255);">คำขอเข้าร่วมกิจกรรมของคุณ</h2>
        <div style="display: flex; justify-content: center; align-items: center;">
            <table style="border-radius: 10px; border-color: aliceblue; background-color:rgb(252, 255, 252);box-shadow: 0 4px 10px rgb(0, 123, 255); border-collapse: collapse; 
        text-align: center; vertical-align: middle; width: 70%; color: aliceblue; font-size: 18px;" class="mt-3">
                <thead style="color:rgb(0, 123, 255);">
                    <tr>
                        <th>รหัสกิจกรรม</th>
                        <th>รหัสนิสิต</th>
                        <th>สถานะ</th>
                        <th>วันที่ขอเข้าร่วม</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($data['event_registrations'] as $events): ?>
                        <?php if ($events['status'] === 'pending'): // ✅ แสดงเฉพาะ status เป็น pending 
                                    ?>
                            <tr style="color:rgb(54, 54, 52);">
                                <td><?= htmlspecialchars($events['event_id']) ?></td>
                                <td><?= htmlspecialchars($events['user_id']) ?></td>
                                <td><?= htmlspecialchars($events['status']) ?></td>
                                <td><?= htmlspecialchars($events['registered_at']) ?></td>
                                <td>
                                    <!-- ✅ ใช้ form เพื่อส่งค่า -->
                                    <form action="/cancleRe" method="POST" onsubmit="return confirmSubmission1();">
                                        <input type="hidden" name="event_id"
                                            value="<?= htmlspecialchars($events['event_id']) ?>">
                                        <input type="hidden" name="user_id" value="<?= htmlspecialchars($events['user_id']) ?>">
                                        <button type="submit" class="btn btn-danger btn-sm ">ยกเลิกคำขอ</button>
                                    </form>
                                </td>
                            </tr>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </section>
    <script>
    function confirmSubmission1() {
        swal({
            title: "คุณแน่ใจหรือไม่?",
            text: "คุณกำลังจะยกเลิกคำขอกิจกรรมนี้!",
            icon: "warning",
            buttons: {
                cancel: "ไม่",
                confirm: "ใช่",
            },
            dangerMode: {
                confirm: "ตกลง",
            },
        })
            .then((willDelete) => {
                if (willDelete) {
                    document.querySelector("form[action='/cancleRe']").submit();
                }
            });
        return false;
    }
</script>

    <h2 style="margin-left: 230px; color:rgb(199, 10, 10); " class="mb-2 mt-4">คำขอเข้าร่วมกิจกรรมที่ถูกปฏิเสธ</h2>
    <div style="display: flex; justify-content: center; align-items: center;" class="mb-4">
        <table style="border-radius: 10px; border-color:aliceblue; background-color:rgb(255, 255, 255); border-collapse: collapse; box-shadow: 0 4px 10px rgb(0, 123, 255);
        text-align: center; vertical-align: middle; width: 70%; color: aliceblue; font-size: 18px;" class="mt-3">
            <thead style="color:rgb(0, 123, 255);">
                <tr>
                    <th>รหัสกิจกรรม</th>
                    <th>รหัสนิสิต</th>
                    <th>สถานะ</th>
                    <th>วันที่ขอเข้าร่วม</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($data['event_registrations'] as $events): ?>
                    <?php if ($events['status'] === 'rejected'): // ✅ แสดงเฉพาะ status เป็น pending 
                                ?>
                        <tr style="color:rgb(54, 54, 52);">
                            <td><?= htmlspecialchars($events['event_id']) ?></td>
                            <td><?= htmlspecialchars($events['user_id']) ?></td>
                            <td><?= htmlspecialchars($events['status']) ?></td>
                            <td><?= htmlspecialchars($events['registered_at']) ?></td>

                        </tr>
                    <?php endif; ?>
                <?php endforeach; ?>

            </tbody>
        </table>
    </div>
    <h2 style="margin-left: 230px; color:rgb(11, 141, 32); " class="mb-2 mt-4">กิจกรรมที่คุณเข้าร่วม</h2>
    <div style="display: flex; justify-content: center; align-items: center;" class="mb-4">
        <table style="border-radius: 10px; border-color:aliceblue; background-color:rgb(255, 255, 255); border-collapse: collapse; box-shadow: 0 4px 10px rgb(0, 123, 255);
        text-align: center; vertical-align: middle; width: 70%; color: aliceblue; font-size: 18px;" class="mt-3">
            <thead style="color:rgb(0, 123, 255);">
                <tr>
                    <th>รหัสกิจกรรม</th>
                    <th>รหัสนิสิต</th>
                    <th>สถานะ</th>
                    <th>วันที่ขอเข้าร่วม</th>
                    <th>ดูกิจกรรมที่เข้าร่วม</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($data['event_registrations'] as $events): ?>
                    <?php if ($events['status'] === 'approved'): // ✅ แสดงเฉพาะ status เป็น approved 
                                ?>
                        <tr style="color:rgb(54, 54, 52);">
                            <td><?= htmlspecialchars($events['event_id']) ?></td>
                            <td><?= htmlspecialchars($events['user_id']) ?></td>
                            <td><?= htmlspecialchars($events['status']) ?></td>
                            <td><?= htmlspecialchars($events['registered_at']) ?></td>
                            <td>
                                <form action="/selectEvent" method="POST" onsubmit="return confirmSubmission();">
                                    <input type="hidden" name="event_id" value="<?= htmlspecialchars($events['event_id']) ?>">
                                    <input type="hidden" name="user_id" value="<?= htmlspecialchars($events['user_id']) ?>">
                                    <!-- <input type="hidden" name="status" value="<?= htmlspecialchars($events['status']) ?>"> -->
                                    <button type="submit" class="btn btn-danger btn-sm mb-3">ดูกิจกรรม/เช็คอิน</button>
                                </form>
                            </td>
                        </tr>
                    <?php endif; ?>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    </section>

    <h2 style="margin-left: 230px; color:rgb(0, 123, 255); " class="mb-2 mt-4">กิจกรรมที่คุณสร้าง</h2>
    <div style="display: flex; justify-content: center; align-items: center;" class="mb-4">
        <table style="border-radius: 10px; border-color:aliceblue; background-color:rgb(255, 255, 255); border-collapse: collapse; box-shadow: 0 4px 10px rgb(0, 123, 255);
        text-align: center; vertical-align: middle; width: 70%; color: aliceblue; font-size: 18px;" class="mt-3">
            <thead style="color:rgb(0, 123, 255);">
                <tr>
                    <th>รหัสกิจกรรม</th>
                    <th>หัวข้อกิจกรรม</th>
                    <th>คำอธิบาย</th>
                    <th>สถานที่</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($data['event'] as $event): ?>
                    <tr style="color:rgb(54, 54, 52);">
                        <td><?= $event['event_id'] ?></td>
                        <td><?= $event['title'] ?></td>
                        <td><?= $event['description'] ?></td>
                        <td><?= $event['location'] ?></td>
                        <td>
                            <form action='/editEvent' method='GET'>
                                <input type='hidden' name='event_id' value="<?= $event['event_id'] ?>">
                                <button type='submit' class='btn btn-warning'>แก้ไข</button>
                            </form>
                        </td>

                        <td>
                            <form action='/Eventregistered' method='POST'>
                                <input type='hidden' name='user_id' value="<?= $_SESSION['user_id'] ?>">
                                <input type='hidden' name='event_id' value="<?= $event['event_id'] ?>">
                                <button type='submit' class='btn btn-primary'>ดูกิจกรรม</button>
                            </form>
                        </td>
                        <td>
                            <form action="/deleteEvent" method="get" onsubmit="return confirmSubmission()">
                                <input type='hidden' name='event_id' value="<?= $event['event_id'] ?>">
                                <button class="btn btn-danger ">ยกเลิก</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    </section>
</body>

<script>
    function confirmSubmission() {
        swal({
            title: "คุณแน่ใจหรือไม่?",
            text: "คุณกำลังจะยกเลิกกิจกรรมนี้!",
            icon: "warning",
            buttons: {
                cancel: "ไม่",
                confirm: "ใช่",
            },
            dangerMode: {
                confirm: "ตกลง",
            },
        })
            .then((willDelete) => {
                if (willDelete) {
                    document.querySelector("form[action='/deleteEvent']").submit();
                }
            });
        return false;
    }
</script>