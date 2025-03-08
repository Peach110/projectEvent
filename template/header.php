<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Home</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Cabin:ital,wght@0,400..700;1,400..700&family=Kanit:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Noto+Sans+Thai:wght@100..900&display=swap"
        rel="stylesheet">

    <style>
        .login-link {
            margin-left: 20px;
            text-decoration: none;
            color: aliceblue;
            transition: color 0.3s, border-bottom 0.3s;
            border-bottom: 3px solid transparent;
        }

        .login-link:hover {
            color: rgb(98, 219, 252);
            border-bottom: 3px solid#7ac7ee;
        }

        .kanit-extralight {
            font-family: "Kanit", sans-serif;
            font-weight: 200;
            font-style: normal;
        }

        #dropdownMenu {
            display: none;
            flex-direction: column;
            gap: 10px;
        }

        @keyframes rotate {
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(-180deg);
            }
        }

        .rotate-icon {
            animation: rotate 0.3s ease-in-out forwards;

        }

        .reset-icon {
            animation: rotateReverse 0.3s ease-in-out forwards;
        }

        @keyframes rotateReverse {
            0% {
                transform: rotate(180deg);
            }

            100% {
                transform: rotate(deg);
            }
        }
    </style>
</head>

<body class="kanit-extralight" style="background-color: aliceblue;">

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>

    <nav class="navbar fixed-top" data-bs-theme="white" style="height: 10%;">
        <nav style="display: flex; align-items: center; gap: 10px; width: 100%;height: 100%; background-color: rgba(131, 154, 162, 0.13); 
            backdrop-filter: blur(10px); -webkit-backdrop-filter: blur(10px); 
            border: 1px solid rgba(255, 255, 255, 0.5); border-radius: 1px;
            box-shadow: 0 4px 10px rgb(255, 255, 255); margin-top: -16px;">
            <a style="border-radius: 100px;" class="login-link btn btn-primary" href="/">หน้าแรก</a>
            <?php
            if (isset($_SESSION['timestamp'])) {
                ?>
                <a style="border-radius: 100px;" class="login-link btn btn-primary" href="/profile">ข้อมูลของคุณ</a>
                <a style="border-radius: 100px;" class="login-link btn btn-primary" href="/events">กิจกรรม</a>
                <a style="border-radius: 100px;" class="login-link btn btn-primary" href="/create">สร้างกิจกรรม</a>

                <form action="/events" method="get"
                    style="display: flex; align-items: center; margin-left: 20px; position: relative;">
                    <!-- ช่องค้นหา -->
                    <input class="form-control me-2 mt-3" style="width: 200px; background-color:rgba(121, 210, 233, 0.28);"
                        type="text" name="keyword" placeholder="ค้นหา..วันที่ได้ตรงมือนี้ ->">

                    <!-- ปุ่มเพื่อเปิด/ปิด dropdown -->
                    <button type="button" class="mt-3" id="dropdownButton" onclick="toggleDropdown()"
                        style="border:none; background: transparent; font-size: 20px; cursor: pointer;">
                        &#9757;
                    </button>

                    <!-- Dropdown menu -->
                    <div id="dropdownMenu"
                        style="display: none; position: absolute; top: 100%; left: 0; margin-top: 10px; background-color: white; border: 1px solid #ccc; border-radius: 5px; padding: 10px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); z-index: 1000;">
                        <p style="margin-bottom: 5px;">ค้นหาวันเริ่มกิจกรรม</p>
                        <input class="form-control"
                            style="width: 150px; background-color:rgba(121, 210, 233, 0.28); margin-bottom: 10px;"
                            type="date" name="start_date">
                        <p style="margin-bottom: 5px;">ค้นหาวันสิ้นสุดกิจกรรม</p>
                        <input class="form-control" style="width: 150px; background-color:rgba(121, 210, 233, 0.28);"
                            type="date" name="end_date">
                    </div>

                    <!-- ปุ่ม Submit -->
                    <button class="mt-3" type="submit"
                        style="border:none; background: transparent; font-size: 40px; cursor: pointer;">
                        &#128269;
                    </button>
                </form>

                <a class="btn btn-danger"
                    style="border-radius: 100px; margin-left: 530px; text-decoration: none; color: aliceblue;"
                    href="/logout" onmouseover="this.style.color='whitesmoke'"
                    onmouseout="this.style.color='aliceblue'">ออกจากระบบ</a>
                <?php
            } else {
                ?>
                <a style="border-radius: 100px;" class="login-link btn btn-primary" href="/signin">ลงชื่อเข้าใช้</a>
                <a style="border-radius: 100px;" class="login-link btn btn-primary" href="/login">เข้าสู่ระบบ</a>
                <?php
            }
            ?>
        </nav>
    </nav>
</body>
<script>
    function toggleDropdown() {
        const dropdownMenu = document.getElementById("dropdownMenu");
        const dropdownButton = document.getElementById("dropdownButton");

        if (dropdownMenu.style.display === "none" || dropdownMenu.style.display === "") {
            dropdownMenu.style.display = "flex";
            dropdownButton.classList.remove("reset-icon");
            dropdownButton.classList.add("rotate-icon");
        } else {
            dropdownMenu.style.display = "none";
            dropdownButton.classList.remove("rotate-icon");
            dropdownButton.classList.add("reset-icon");
        }
    }
</script>

</html>