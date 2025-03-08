<?php
$keyword = $_GET['keyword'] ?? null;
$start_date = $_GET['start_date'] ?? null;
$end_date = $_GET['end_date'] ?? null;

// แปลงรูปแบบวันที่
if ($start_date) {
    $start_date = date('Y-m-d', strtotime($start_date));
}
if ($end_date) {
    $end_date = date('Y-m-d', strtotime($end_date));
}

$conn = getConnection();
$sql = "SELECT e.*, ei.image_url 
        FROM events e
        LEFT JOIN event_images ei ON e.event_id = ei.event_id
        WHERE 1=1";

$params = [];
$types = "";

if ($keyword) {
    $sql .= " AND e.title LIKE ?";
    $params[] = "%$keyword%";
    $types .= "s";
}

if ($start_date && $end_date) {
    $sql .= " AND e.start_date >= ? AND e.end_date <= ?";
    $params[] = $start_date;
    $params[] = $end_date;
    $types .= "ss";
} elseif ($start_date) {
    $sql .= " AND e.start_date >= ?";
    $params[] = $start_date;
    $types .= "s";
} elseif ($end_date) {
    $sql .= " AND e.end_date <= ?";
    $params[] = $end_date;
    $types .= "s";
}

$stmt = $conn->prepare($sql);
if (!empty($params)) {
    $stmt->bind_param($types, ...$params);
}

$stmt->execute();
$result = $stmt->get_result();

$events = [];
while ($row = $result->fetch_assoc()) {
    $event_id = $row['event_id'];
    if (!isset($events[$event_id])) {
        $events[$event_id] = $row;
        $events[$event_id]['images'] = [];
    }
    if (!empty($row['image_url'])) {
        $events[$event_id]['images'][] = $row['image_url'];
    }
}
?>

<!DOCTYPE html>
<html lang="th">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>กิจกรรมที่เปิดให้ลงทะเบียน</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">

    <style>
    .fade-in-up {
        opacity: 0;
        transform: translateY(50px);
        transition: opacity 1s ease-out, transform 1s ease-out;
    }

    .fade-in-up.visible {
        opacity: 1;
        transform: translateY(0);
    }
</style>
</head>

<body>
    <h2 class="text-center mb-4 text-primary" style="margin-top: 150px; font-size: 40px;">กิจกรรมที่เปิดให้ลงทะเบียน
    </h2>

    <?php if (empty($events)): ?>
        <p class="text-center text-danger">ไม่พบกิจกรรมที่ตรงกับการค้นหา</p>
    <?php else: ?>
        <?php foreach ($events as $event): ?>
            <div class="container my-4 fade-in-up">
                <div class="card" style="border-color: aliceblue; margin-bottom: 300px; border-radius: 40px; background-color:rgba(255, 255, 255, 0.17);">
                    <div class="card-body text-center">
                        <h1 class="text-primary mb-3"> <?= htmlspecialchars($event['title']) ?> </h1>

                        <?php if (!empty($event['images'])): ?>
                            <div id="carousel<?= $event['event_id'] ?>" class="carousel slide" data-bs-ride="carousel">
                                <div class="carousel-inner">
                                    <?php foreach ($event['images'] as $index => $image): ?>
                                        <div class="carousel-item <?= $index === 0 ? 'active' : '' ?>">
                                            <img src="uploads/<?= htmlspecialchars($image) ?>" class="d-block w-100"
                                                style="border-radius: 40px;" alt="รูปกิจกรรม">
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                                <button class="carousel-control-prev" type="button"
                                    data-bs-target="#carousel<?= $event['event_id'] ?>" data-bs-slide="prev">
                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                </button>
                                <button class="carousel-control-next" type="button"
                                    data-bs-target="#carousel<?= $event['event_id'] ?>" data-bs-slide="next">
                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                </button>
                            </div>
                        <?php else: ?>
                            <p class="text-muted">ไม่มีรูปภาพ</p>
                        <?php endif; ?>
                        <div style="font-size: 20px;">
                            <p class="mt-3"><strong style="color:rgb(0, 123, 255);">รายละเอียด:</strong>
                                <?= htmlspecialchars($event['description']) ?></p>
                            <p><strong style="color:rgb(0, 123, 255);">สถานที่:</strong>
                                <?= htmlspecialchars($event['location']) ?></p>
                            <p><strong style="color:rgb(0, 123, 255);">เริ่ม:</strong>
                                <?= htmlspecialchars($event['start_date']) ?> |
                                <strong style="color:rgb(0, 123, 255);">สิ้นสุด:</strong>
                                <?= htmlspecialchars($event['end_date']) ?>
                            </p>
                            <p><strong style="color:rgb(0, 123, 255);">จำกัด:</strong>
                                <?= htmlspecialchars($event['max_participants']) ?> คน</p>
                        </div>


                        <form class="requestForm" action="/request" method="POST">
                            <input type="hidden" name="user_id" value="<?= $_SESSION['user_id'] ?>">
                            <input type="hidden" name="event_id" value="<?= $event['event_id'] ?>">
                            <button class="btn btn-primary w-20">ขอเข้าร่วม</button>
                        </form>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    <?php endif; ?>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const fadeInElements = document.querySelectorAll('.fade-in-up');

            const checkVisibility = () => {
                fadeInElements.forEach(element => {
                    const elementTop = element.getBoundingClientRect().top;
                    const elementBottom = element.getBoundingClientRect().bottom;

                    if (elementTop < window.innerHeight && elementBottom >= 0) {
                        element.classList.add('visible');
                    }
                });
            };

            window.addEventListener('scroll', checkVisibility);
            checkVisibility();
        });
    </script>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const forms = document.querySelectorAll(".requestForm");

            forms.forEach(form => {
                form.addEventListener("submit", function (event) {
                    event.preventDefault();

                    Swal.fire({
                        title: 'คุณแน่ใจใช่ไหมที่จะเข้าร่วมกิจกรรมนี้?',
                        icon: 'question',
                        showCancelButton: true,
                        confirmButtonText: 'ใช่',
                        cancelButtonText: 'ไม่'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            const formData = new FormData(form);

                            fetch("/request", {
                                method: "POST",
                                body: formData
                            })
                                .then(response => response.json())
                                .then(data => {
                                    if (data.success) {
                                        Swal.fire({
                                            title: 'สำเร็จ!',
                                            text: 'ลงทะเบียนรายวิชาสำเร็จ',
                                            icon: 'success',
                                            confirmButtonText: 'ตกลง'
                                        }).then(() => {
                                            window.location.href = "/profile";
                                        });
                                    } else {
                                        Swal.fire({
                                            title: 'เกิดข้อผิดพลาด',
                                            text: data.message || "ไม่ทราบสาเหตุ",
                                            icon: 'error',
                                            confirmButtonText: 'ตกลง'
                                        });
                                    }
                                })
                                .catch(error => {
                                    Swal.fire({
                                        title: 'เกิดข้อผิดพลาด',
                                        text: 'เกิดข้อผิดพลาดในการส่งคำขอ',
                                        icon: 'error',
                                        confirmButtonText: 'ตกลง'
                                    });
                                });
                        }
                    });
                });
            });
        });
    </script>
    </div>
</body>

</html>