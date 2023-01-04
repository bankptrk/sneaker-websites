<?php
    include "connect.php";

    session_start();

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
        <title>ข้อมูลของ <?=$_SESSION["username"]?></title>
        <style>
            body {margin: 0; font-family: Arial, Helvetica, sans-serif;}
            * {box-sizing: border-box}

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

            .headertop a:hover {
                background-color: #ddd;
            }

            .headertop-right {
                float: right;
            }

            /* Create two equal columns that floats next to each other */
            .column {
                float: left;
                width: 50%;
                height: 300px; /* Should be removed. Only for demonstration */
            }

            /* Full-width input fields */
            input[type=text], input[type=password], input[type=email] {
                width: 100%;
                padding: 15px;
                margin: 5px 0 22px 0;
                display: inline-block;
                border: none;
                background: #f1f1f1;
            }

            input[type=text]:focus, input[type=password]:focus {
                background-color: #ddd;
                outline: none;
            }

            hr {
                border: 1px solid #f1f1f1;
                margin-bottom: 25px;
            }

            /* Set a style for all buttons */
            button {
                background-color: black;
                color: white;
                padding: 14px 20px;
                margin: 8px 0;
                border: none;
                cursor: pointer;
                width: 100%;
                opacity: 0.9;
            }

            button:hover {
                opacity:1;
            }

            /* Float cancel and signup buttons and add an equal width */
            .cancelbtn, .signupbtn {
                float: left;
                width: 50%;
            }

            /* Add padding to container elements */
            .container {
                padding: 40px 10px 80px 80px;
            }

            /* Clear floats */
            .clearfix::after {
                content: "";
                clear: both;
                display: table;
            }

            /* Change styles for cancel button and signup button on extra small screens */
            @media screen and (max-width: 300px) {
                .cancelbtn, .signupbtn {
                    width: 100%;
                }
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
        .dark-theme{
                background: #2f2f2f;
                color:white;
            }
        .theme-btn{
            background-color: black;
                cursor: pointer;
                width: 75px;
                
                padding-bottom: 10px;
                opacity: 0.9;
                float: right;
        }
        .dark-theme .edit{
            
           color: white; /* แก้ปุ่ม แก้ไข */
        }
            <style>
            table { width: 800px; border: solid 1px gray; border-collapse: collapse; font: 16px tahoma; }
            caption { font: bold 18px tahoma; color: brown; }
            th:first-child { width: 10%; }
            th:last-child { width: 30%; }
            td { background: white; }
            th { background: gray; color: white; }
            td, th { border: solid 1px  white; padding: 3px; vertical-align: top; }
        </style>
        <script>
            // ใช้สำหรับปรับปรุงจำนวนสินค้า
            function update(pid) {
                var qty = document.getElementById(pid).value;
                // ส่งรหัสสินค้า และจำนวนไปปรับปรุงใน session
                document.location = "cart.php?action=update&pid=" + pid + "&qty=" + qty; 
            }
        </script>
    </head>
    <body>
        <div class="headertop">
        <button class="theme-btn">Theme</button>
            <div class="headertop-right">
                <a href="home.php">Home</a>
                <a href="logout.php">Logout</a>
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
        <div style="display:flex">
            <div class="column" style="padding: 40px 30px 80px 150px">
                <p style="font-size:22px" >การสั่งซื้อทั้งหมด</p>
                <hr>
                <?php
                    $stmt = $pdo->prepare("SELECT ord_id, total FROM orders WHERE username LIKE ?");
                    $value = '%'.$_GET["username"].'%';
                    $stmt->bindParam(1,$value);
                    $stmt->execute();
                ?>
                <table style="padding-bottom: 40px">
                    <tr>
                        <th>รหัสการสั่งซื้อ</th>
                        <th>ราคา</th>
                    </tr>
                <?php while($row = $stmt->fetch()): ?>
                    <tr>
                        <td><?=$row["ord_id"]?></td>
                        <td><?=formatMoney($row["total"])?> บาท</td>
                    </tr>
                <?php endwhile; ?>
                </table>
                <p style="font-size:22px" >สินค้าทั้งหมดที่ซื้อ</p>
                <hr>
                <?php
                    $stmt = $pdo->prepare("SELECT * FROM product WHERE pid IN (SELECT pid FROM item WHERE ord_id IN (SELECT ord_id FROM orders WHERE username LIKE ?))");
                    $value = '%'.$_GET["username"].'%';
                    $stmt->bindParam(1,$value);
                    $stmt->execute();
                ?>
                <table style="padding-bottom: 40px">
                    <tr>
                        <th>รหัส</th>
                        <th>ชื่อ</th>
                        <th>ประเภท</th>
                        <th>ราคา</th>
                        <th>ไซส์</th>
                    </tr>
                <?php while($row = $stmt->fetch()): ?>
                    <tr>
                        <td><?=$row["pid"]?></td>
                        <td><?=$row["pname"]?></td>
                        <td><?=$row["ptype"]?></td>
                        <td><?=formatMoney($row["price"])?> บาท</td>
                        <td>US <?=$row["psize"]?></td>
                    </tr>
                <?php endwhile; ?>
                </table>
            </div>
            <div class="column" style="padding: 40px 150px 80px 30px">
                <p style="font-size:22px" >ข้อมูล</p>

                <hr>
                <?php
                    $stmt = $pdo->prepare("SELECT * FROM member WHERE username LIKE ?");
                    $value = '%'.$_GET["username"].'%';
                    $stmt->bindParam(1,$value);
                    $stmt->execute();
                ?>
                <?php while($row = $stmt->fetch()): ?>
                ชื่อผู้ใช้งาน : <?=$row["username"]?><br><br>
                ชื่อ : <?=$row["fname"]?><br><br>
                นามสกุล : <?=$row["lname"]?><br><br>
                ที่อยู่ : <?=$row["address"]?><br><br>
                เบอร์ : <?=$row["mobile"]?><br><br>
                อีเมล : <?=$row["email"]?><br><br>
                <?php endwhile; ?>
                <a class="edit" href="editmember.php?username=<?=$_SESSION["username"]?>">แก้ไขข้อมูล</a>
                <hr>
            </div>
        </div>
    </body>
    <script>
            let body = document.body;
            let themeButton = document.querySelector('.theme-btn');

            themeButton.addEventListener('click',()=>{
                body.classList.toggle('dark-theme');
            });
        </script>
</html>