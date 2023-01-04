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
        <title>Admin</title>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
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
                border-radius: 4px;
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
            input[type=text], input[type=password] {
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
            <style>
            table { width: 800px; border: solid 1px gray; border-collapse: collapse; font: 16px tahoma; }
            caption { font: bold 18px tahoma; color: brown; }
            th:first-child { width: 15%; }
            th:last-child { width: 20%;}
            td:last-child {text-align: center;}    
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
            <div class="headertop-right">
                <a href="index.html">JSON</a>
                <a href="logout.php">ออกจากระบบ</a>
            </div>
        </div>
        <div style="display:flex">
            <div class="column" style="padding: 40px 30px 80px 150px">
                <p style="font-size:22px" >จำนวนการสั่งซื้อของลูกค้า</p>
                <hr>
                <?php
                    $stmt = $pdo->prepare("SELECT member.fname, member.lname, COUNT(orders.username) FROM member JOIN orders ON member.username = orders.username GROUP BY member.username");
                    $stmt->execute();
                ?>
                <table style="padding-bottom: 40px">
                    <tr>
                        <th style="width: 35%;">ชื่อ</th>
                        <th>สกุล</th>
                        <th>จำนวนการสั่งซื้อ</th>
                    </tr>
                <?php while($row = $stmt->fetch()): ?>
                    <tr>
                        <td><?=$row["fname"]?></td>
                        <td><?=$row["lname"]?></td>
                        <td><?=$row["COUNT(orders.username)"]?></td>
                    </tr>
                <?php endwhile; ?>
                </table>
                <p style="font-size:22px" >การสั่งซื้อทั้งหมดของลูกค้า</p>
                <hr>
                <?php
                    $stmt = $pdo->prepare("SELECT ord_id, fname, lname, total FROM orders JOIN member ON orders.username = member.username");
                    $stmt->execute();
                ?>
                <table style="padding-bottom: 40px">
                    <tr>
                        <th style="width: 20%;">รหัสการสั่งซื้อ</th>
                        <th>ชื่อ</th>
                        <th>นามสกุล</th>
                        <th>ราคารวม</th>
                    </tr>
                <?php while($row = $stmt->fetch()): ?>
                    <tr>
                        <td style="text-align: center;"><?=$row["ord_id"]?></td>
                        <td><?=$row["fname"]?></td>
                        <td><?=$row["lname"]?></td>
                        <td style="text-align: right;"><?=formatMoney($row["total"])?> บาท</td>
                        <td style="width: 1%;"><a href="delete.php?ord_id=<?=$row["ord_id"]?>">ลบ</a></td>
                    </tr>
                <?php endwhile; ?>
                </table>
            </div>
            <div class="column" style="padding: 40px 150px 80px 30px">
                <p style="font-size:22px" >ค้นหาข้อมูลลูกค้าที่ซื้อสินค้า</p>

                <hr>
                ข้อมูลสินค้าทั้งหมด
                <?php
                    $stmt = $pdo->prepare("SELECT * FROM product");
                    $stmt->execute();
                ?>
                <table style="padding-bottom: 40px">
                    <tr>
                        <th>รหัสสินค้า</th>
                        <th>ชื่อสินค้า</th>
                        <th>ประเภท</th>
                        <th>ราคา</th>
                        <th>สี</th>
                        <th>ไซส์</th>
                    </tr>
                <?php while($row = $stmt->fetch()): ?>
                    <tr>
                        <td style="text-align: center;"><?=$row["pid"]?></td>
                        <td><?=$row["pname"]?></td>
                        <td><?=$row["ptype"]?></td>
                        <td><?=formatMoney($row["price"])?></td>
                        <td><?=$row["pcolour"]?></td>
                        <td style="text-align: right;"><?=$row["psize"]?> US</td>
                    </tr>
                <?php endwhile; ?>
                </table>
                <div class="search-container">
                <form method="post" action="admin.php">
                    รหัสสินค้า : <input type="text" pattern="[1-5]{1}" placeholder="Search.." name="pid">
                    <button type="submit"><i class="fa fa-search"></i></button>
                </form>
                <?php if(!empty($_POST)) { ?>
                    <?php
                        $stmt = $pdo->prepare("SELECT fname, lname, address, mobile, email FROM member WHERE username IN (SELECT username FROM orders WHERE ord_id IN (SELECT ord_id FROM item WHERE pid LIKE ?))");
                        $value = '%'.$_POST["pid"].'%';
                        $stmt->bindParam(1,$value);
                        $stmt->execute();
                    ?>
                    <table style="padding-bottom: 40px">
                        <tr>
                            <th>ชื่อ</th>
                            <th>สกุล</th>
                            <th>ที่อยู่</th>
                            <th>เบอร์โทร</th>
                            <th>อีเมล</th>
                        </tr>
                    <?php while($row = $stmt->fetch()): ?>
                        <tr>
                            <td><?=$row["fname"]?></td>
                            <td><?=$row["lname"]?></td>
                            <td><?=$row["address"]?></td>
                            <td><?=$row["mobile"]?></td>
                            <td><?=$row["email"]?></td>
                        </tr>
                    <?php endwhile; ?>
                    </table>
                <?php } ?>
            </div>
            </div>
        </div>
    </body>
</html>
