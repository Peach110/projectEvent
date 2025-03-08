<?php
$event_id = $_POST['event_id'];
$admin_id = $_POST['user_id'];
$result = getEventParticipants($event_id, $admin_id);
$event = getEventsByEvenID($_POST['event_id']);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $event_id = $_POST['event_id'] ?? '';
    $user_id = $_POST['user_id'] ?? '';

    if ($event_id && $user_id) {
        echo "Event ID: $event_id<br>";
        echo "User ID: $user_id";
    } else {
        echo "ข้อมูลไม่ครบถ้วน";
    }
    $result = getEventParticipants($event_id, $user_id);
    $event = getEventsByEvenID($_POST['event_id']);
}

?>

<head>
    <style>
        .half-circle {
            width: 800px;
            height: 1200px;
            background-color: rgb(0, 98, 255);
            border-top-left-radius: 0px;
            border-bottom-left-radius: 0px;
            position: fixed;
            right: 0;
            top: 50%;
            transform: translateY(-50%);
            z-index: -2;
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
</head>

ิ<div style="color: aliceblue;">
    <h2 style="margin-left: 230px; color:rgb(128, 230, 130) " class="mb-2 mt-4">กิจกรรมที่คุณสร้าง</h2>
    <div style="display: flex; justify-content: center; align-items: center;">
        <table border="1" style="background-color:rgba(13, 55, 17, 0.32); border-collapse: collapse; 
        text-align: center; vertical-align: middle; width: 70%; color: aliceblue; font-size: 18px;" class="mt-3">
            <thead style="color:rgb(128, 230, 130)">
                <tr>
                    <th>รหัสกิจกรรม</th>
                    <th>หัวข้อกิจกรรม</th>
                    <th>คำอธิบาย</th>
                    <th>สถานที่</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($event as $events): ?>
                    <tr>
                        <td><?= $events['event_id'] ?></td>
                        <td><?= $events['title'] ?></td>
                        <td><?= $events['description'] ?></td>
                        <td><?= $events['location'] ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    </section>

    <div class="half-circle"></div>
    <div class="circle"></div>
    <div class="circle1"></div>
    <div class="circle2"></div>
    <div class="circle3"></div>
    <div class="circle4"></div>
    <div class="circle4"></div>

    <h2 style="margin-left: 230px; color:rgb(128, 230, 130)" class="mb-2 mt-4">รายชื่อคนขอเข้าร่วม</h2>
    <div style="display: flex; justify-content: center; align-items: center;">
        <table border="1" style="background-color:rgba(13, 55, 17, 0.32); border-collapse: collapse; 
        text-align: center; vertical-align: middle; width: 70%; color: aliceblue; font-size: 18px;" class="mt-3">
            <thead style="color:rgb(128, 230, 130)">
                <tr>
                    <th>User ID</th>
                    <th>Username</th>
                    <th>Status</th>
                    <th>Registered At</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($result): ?>
                    <?php while ($row = $result->fetch_assoc()): ?>
                        <?php if ($row['status'] === 'pending'): // ✅ แสดงเฉพาะ pending 
                        ?>
                            <tr>
                                <td><?= htmlspecialchars($row['user_id']) ?></td>
                                <td><?= htmlspecialchars($row['username']) ?></td>
                                <td><?= htmlspecialchars($row['status']) ?></td>
                                <td><?= htmlspecialchars($row['registered_at']) ?></td>
                                <?php foreach ($event as $events): ?>
                                    <td>
                                        <form action="/accept" method="POST" onsubmit="return confirmSubmission();">
                                            <input type="hidden" name="user_id" value="<?= $row['user_id'] ?>">
                                            <input type="hidden" name="event_id" value="<?= $events['event_id'] ?>">
                                            <input type="hidden" name="status" value="<?= $row['status'] ?>">
                                            <input type="hidden" name="getevent" value="<?= $event_id ?>">
                                            <input type="hidden" name="getuser" value="<?= $user_id ?>">
                                            <input type="hidden" name="action" value="approve">
                                            <button type="submit" class="btn btn-success" >
                                                อนุมัติ
                                            </button>
                                        </form>
                                    </td>
                                    <td>
                                        <form action="/accept" method="POST" onsubmit="return confirmSubmission();">
                                            <input type="hidden" name="user_id" value="<?= $row['user_id'] ?>">
                                            <input type="hidden" name="event_id" value="<?= $events['event_id'] ?>">
                                            <input type="hidden" name="status" value="<?= $row['status'] ?>">
                                            <input type="hidden" name="getevent" value="<?= $event_id ?>">
                                            <input type="hidden" name="getuser" value="<?= $user_id ?>">
                                            <input type="hidden" name="action" value="reject">
                                            <button type="submit" class="btn btn-danger" >
                                                ปฏิเสธ
                                            </button>
                                        </form>
                                    </td>
                                <?php endforeach; ?>
                            </tr>
                        <?php endif; ?>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="4">ไม่สามารถดึงข้อมูลได้ หรือคุณไม่มีสิทธิ์ดูข้อมูลนี้</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
    <h2 style="margin-left: 230px; color:rgb(128, 230, 130)" class="mb-2 mt-4">รายชื่อคนเข้าร่วม</h2>
    <div style="display: flex; justify-content: center; align-items: center;">
        <table border="1" style="background-color:rgba(13, 55, 17, 0.32); border-collapse: collapse; 
        text-align: center; vertical-align: middle; width: 70%; color: aliceblue; font-size: 18px;" class="mt-3">
            <thead style="color:rgb(128, 230, 130)">
                <tr>
                    <th>User ID</th>
                    <th>Username</th>
                    <th>Status</th>
                    <th>Registered At</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $event_id = $_POST['event_id'] ?? null;
                $accep = $event_id ? selectJoin($event_id) : false;
                ?>

                <?php if ($accep && count($accep) > 0): ?>
                    <?php foreach ($accep as $participant): ?>
                        <?php if ($participant['status'] === 'approved'): ?>
                            <tr>
                                <td><?= htmlspecialchars($participant['user_id']) ?></td>
                                <td><?= htmlspecialchars($participant['full_name']) ?></td>
                                <td><?= htmlspecialchars($participant['status']) ?></td>
                                <td><?= htmlspecialchars($participant['registered_at']) ?></td>
                            </tr>
                        <?php endif; ?>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="4">ยังไม่มีผู้เข้าร่วม</td>
                    </tr>
                <?php endif; ?>

            </tbody>
        </table>
    </div>
</div>
<script>
    function confirmSubmission() {
        return confirm("คุณต้องการดูรายละเอียดกิจกรรมนี้หรือไม่?");
    }
</script>

