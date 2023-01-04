<?php
    session_start();

    include "connect.php"; 
    function formatMoney($number, $fractional=false) {
        if ($fractional) {
            $number = sprintf('%.2f', $number);
        }
        while (true) {
            $replaced = preg_replace('/(-?\d+)(\d\d\d)/', '$1,$2', $number);
            if ($replaced != $number) {
                $number = $replaced;
            } else { break; }
        }
        return $number;
    }
?>
<html>
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title><?=$_GET["pname"]?></title>
        <style>
            body {
                margin: 0;
                font-family: Arial, Helvetica, sans-serif;
            }

            .headertop {
                overflow: hidden;
                background: #f1f1f1;
                padding-right: 10px;
            }

            .headertop a {
                float: left;
                color: black;
                text-align: center;
                padding: 12px;
                text-decoration: none;
                font-size: 13px; 
                line-height: 10px;
                border-radius: 4px;
            }

            .headertop a:hover {
                background-color: #ddd;
            }

            .headertop-right {
                float: right;
            }

            /* The container */
            .container {
                display: block;
                position: relative;
                padding-left: 35px;
                margin-bottom: 12px;
                cursor: pointer;
                font-size: 22px;
                -webkit-user-select: none;
                -moz-user-select: none;
                -ms-user-select: none;
                user-select: none;
            }

            /* Hide the browser's default checkbox */
            .container input {
                position: absolute;
                opacity: 0;
                cursor: pointer;
                height: 0;
                width: 0;
            }

            /* Create a custom checkbox */
            .checkmark {
                position: absolute;
                top: 0;
                left: 0;
                height: 25px;
                width: 25px;
                background-color: #eee;
                margin-left:30%;
            }

            /* On mouse-over, add a grey background color */
            .container:hover input ~ .checkmark {
                background-color: #ccc;
            }

            /* When the checkbox is checked, add a black background */
            .container input:checked ~ .checkmark {
                background-color: black;
            }

            /* Create the checkmark/indicator (hidden when not checked) */
            .checkmark:after {
                content: "";
                position: absolute;
                display: none;
            }

            /* Show the checkmark when checked */
            .container input:checked ~ .checkmark:after {
                display: block;
            }

            /* Style the checkmark/indicator */
            .container .checkmark:after {
                left: 9px;
                top: 5px;
                width: 5px;
                height: 10px;
                border: solid white;
                border-width: 0 3px 3px 0;
                -webkit-transform: rotate(45deg);
                -ms-transform: rotate(45deg);
                transform: rotate(45deg);
            }

            .button {
                background-color: white;
                border: 2px solid #555555;
                color: black;
                padding: 16px 32px;
                text-align: center;
                text-decoration: none;
                display: inline-block;
                font-size: 16px;
                margin: 4px 2px;
                transition-duration: 0.4s;
                cursor: pointer;
                border-radius: 12px;
            }

            .button1:hover {
                background-color: #555555;
                color: white;
            }
            .header .headertop {
            transition: all 200ms ease-in-out;
            border: 1px solid #eeeded;
        }
        .headertop-right {
            float: right;
        }
        .headertop a:hover {
            background-color: #000;
            color: #ffffff;
        }
        .headertop {
                overflow: hidden;
                background: #f1f1f1;
                padding-right: 10px;
            }

            .headertop a {
            float: left;
            color: black;
            text-align: center;
            padding: 12px;
            text-decoration: none;
            font-size: 13px;
            line-height: 10px;
            border: 1px solid black;
            margin: 10px 15px 15px 0px;
        }
        .img {
        display: flex;
        padding: 50px 20px 15px 20px;
        text-align: center;
    }
    .product{
        padding: 80px 80px 80px 10px;
    }
        @media screen and (max-width: 900px) {
        .topnav .search-container {
        float: none;
         }
        .topnav a,
        .topnav input[type="text"],
        .topnav {
         float: none;
        display: block;
        width: 100%;
        height: 20%;
        margin: 0;
        padding: 2%;
        }
        .search-container button {
        align-items: center;
        width: 100%;
        padding: 2%;
        }
        .topnav input[type="text"] {
        border: 1px solid #ccc;
        }
        .img {
        display: block;
        padding: 15px 15px 15px 20px;
        }
        footer {
            position:absolute;
            bottom: -2400;
        }
    }
    .dark-theme{
                background: #2f2f2f;
                color:white;
        }
    .theme-btn{
            background-color: black;
                cursor: pointer;
                width: 75px;
                float: right;
                margin-top: 6px;
                /* text-align:center; */
                color: white;  
                padding-bottom: 11px;
                padding-top: 11px;
            }


        </style>
    </head>
    <body>
        <div class="headertop">
        <button class="theme-btn">Theme</button>
            <div class="headertop-right">
                <a href="home.php">Home</a>
                <?php
                if (!empty($_SESSION["username"])) {
                ?>
                    <a href="home.php?">Hi, <b><?=$_SESSION["username"]?></b></a>
                <?php } ?>
                <?php
                if (empty($_SESSION["username"])) {
                ?>
                    <a href="signup.php">Sign up</a>
                    <a href="signin.php">Login</a>
                <?php } ?>
                <?php
                if (!empty($_SESSION["cart"])) {
                ?>
                    <a href="showcart.php?action=" id="cart">
                        <?php
                        $countitem = 0;
                            foreach ($_SESSION["cart"] as $item) {
                                $countitem += $item["qty"];
                            }
                            echo "Cart(".$countitem.")";
                        ?>
                    </a>
                <?php } ?>
            </div>
        </div>

        <?php
            $stmt = $pdo->prepare("SELECT * FROM product WHERE pid = ?");
            $stmt->bindParam(1, $_GET["pid"]);       
            $stmt->execute();
            $row = $stmt->fetch();
        ?>
        <div class="img">
            <div class="product">
                <img id="image1" src='img/<?=$row["pid"]?>.jpg' width='450' onmouseover="bigimg()" onmouseout="deimg()">
            </div>
            <div class="product">
                <img id="image2" src='img/<?=$row["pid"]?>-<?=$row["pid"]?>.jpg' width='450' onmouseover="bigimg2()" onmouseout="deimg2()">
            </div>
            <div style="padding: 80px 50px 80px 5px">
                <h1><?=$row["pname"]?></h1>
                <h3><?=$row["ptype"]?></h3>
                <?=$row["pdetail"]?><br><br>
                ราคา <?=formatMoney($row["price"]);?> บาท
                <br><br>เลือกไซส์<br><br>
                <form method="post" action="cart.php?action=add&pid=<?=$row["pid"]?>&pname=<?=$row["pname"]?>&price=<?=$row["price"]?>&psize=<?=$row["psize"]?>&ptype=<?=$row["ptype"]?>">
                    <div style="padding: 0px 0px 150px 0px">
                        <label class="container">US <?=$row["psize"]?>
                            <input type="radio" id="psize" name="psize" value="<?=$row["psize"]?>" required>
                            <span class="checkmark"></span>
                        </label>
                    </div>
                    จำนวนสินค้า
                    <input type="number" name="qty" value="1" min="1" max="9"><br><br>
                    <input type="submit" class="button button1" value="เพิ่มสินค้าในตะกร้า">
                </form>
            </div>
        </div>
        <script> //DOM จิ้มรูปแล้วขยาย
            let bigimg = () =>{
                document.getElementById("image1").style.width="600";
            }
            let deimg = ()=>{
                document.getElementById("image1").style.width="450";
            }
            let bigimg2 = () =>{
                document.getElementById("image2").style.width="600";
            }
            let deimg2 = ()=>{
                document.getElementById("image2").style.width="450";
            }
        </script>
        <script> //DOM เปลี่ยนธีม
            let body = document.body;
            let themeButton = document.querySelector('.theme-btn');

            themeButton.addEventListener('click',()=>{
                body.classList.toggle('dark-theme');
            });
        </script>
    </body>
</html>
