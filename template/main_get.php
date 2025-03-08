<?php
$users_id = $_SESSION['user_id'];
$user = getUserById($users_id);
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        #typing-effect {
            font-size: 60px;
            font-family: 'Courier New', monospace;
            white-space: nowrap;
            overflow: hidden;
            width: 0;
            animation: typing 4s steps(60) 1s forwards;
            display: inline-block;
            text-align: center;
        }

        @keyframes typing {
            to {
                width: 100%;
            }
        }

        #typing-effect::after {
            content:'';
            animation: none;
            border: none;
        }

        .kanit-extralight {
                        font-family: "Kanit", sans-serif;
                        font-weight: 200;
                        font-style: normal;
                }
    </style>
</head>

<body class="kanit-extralight">
    <div style="display: flex; justify-content: center; align-items: center; height: 100vh;">
        <h1 id="typing-effect" style="color:rgb(0, 123, 255);">
            ยินดีต้อนรับ, <?php echo htmlspecialchars($user['username']); ?>
        </h1>
    </div>

</body>

</html>