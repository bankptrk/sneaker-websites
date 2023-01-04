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
        <title>ร้านค้าอย่างเป็นทางการของ Sneakers</title>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Montserrat&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
        <style>
            * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }


        footer {
            position:absolute;
            bottom: -400;
            left: 0;
            right: 0;
            background-color: #242424;
            color: #ffffff;
            height: auto;
            width: 100vw;
            padding-top: 40px;
        }

        .footer-content {
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
            text-align: center;
        }

        .footer-content h3 {
            font-size: 1.8rem;
            font-weight: 400;
            text-transform: capitalize;
            line-height: 3rem;
        }

        .footer-content p {
            max-width: 500px;
            margin: 10px auto;
            line-height: 28px;
            font-size: 14px;
        }

        .footer-bottom {
            background-color: #000;
            width: 100vw;
            padding: 20px 0;
            text-align: center;
        }

        .footer-bottom p {
            font-size: 14px;
            word-spacing: 2px;
            text-transform: capitalize;
        }

        .footer-bottom span {
            text-transform: uppercase;
            font-weight: 200;
        }

        body {
            margin: 0px auto;
            font-family: 'Montserrat Alternates', sans-serif;
            background-color: #ffffff;
        }

        .headertop {
            padding: 0 auto;
            position: fixed;
            left: 0;
            right: 0;
            width: 100%;
            z-index: 9999;
            transition: all 300ms ease-in-out;
        }

        .headertop {
            padding-right: 15px;
            background-color: #ffffff;
        }

        .nav {
            border: 1px solid black;
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

        #register {
            color: #ffffff;
            background-color: #2f2f2f;
        }

        #register:hover {
            background-color: #000;
            color: #ffffff;
        }

        .headertop a:hover {
            background-color: #000;
            color: #ffffff;
        }

        .headertop-right {
            float: right;
        }

        .second-header {
            margin: 0 auto;
            overflow: hidden;
            padding: 10px 0px 10px 0px;
        }

        .second-header a {
            float: left;
            color: black;
            text-align: center;
            padding: 12px;
            text-decoration: none;
            font-size: 18px;
            line-height: 25px;
            border-radius: 4px;
        }

        .second-header a:hover {
            background-color: #ddd;
            color: black;
        }

        .header-center {
            display: flex;
            justify-content: center;
            background: #f1f1f1;
            margin: 100px auto;
        }

        .header-center a {
            margin: 0px 5px 0px 5px;
            font-size: larger;
        }
        .img {
        display: flex;
        padding: 0px 20px 15px 20px;
        text-align: center;
        }
        .product {
            padding: 50px 10px 10px 15px; 
            text-align: center;
        }

        @media screen and (max-width: 1300px) { 
        }
        .header a {
        float: none;
        display: block;
        text-align: center;
        }

        .header-right {
        float: none;
        }

        .topnav {
            overflow: hidden;
            background-color: white;
            margin: 0 auto;
            text-align: center;
        }

        #search-text {
            border: 1px solid #A3A3A3;
            width: 500px;
            height: 44px;
            border-radius: 3px;
            background-color: #fdfdfd;
        }

        .topnav input[type=text] {
            padding: 6px;
            margin-top: 8px;
            font-size: 17px;
            border: none;
        }

        .topnav .search-container button {
            padding: 12px 12px;
            margin-top: 8px;
            margin-right: 16px;
            background: #ddd;
            font-size: 17px;
            border: none;
            cursor: pointer;
        }

        .topnav .search-container button:hover {
            background: #ccc;
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
            bottom: -2600;
        }}

        @media screen and (min-width: 901px) and (max-width: 1200px) {
        .img {
        padding: 0px 15px 20px;
        display: block;
        float: center;
        text-align: center;
        padding: 12px;
        text-decoration: none;
        font-size: 18px;
        line-height: 25px;
        border-radius: 4px;
        }
        footer {
            position:absolute;
            bottom: -2600;
        }
    }
        .header .headertop {
            transition: all 200ms ease-in-out;
            border: 1px solid #eeeded;

        }
        #show-list{
            background-color: #ffffff;
            width: 500px;
            position: relative;
            left: 650px;
        }
        .dark-theme{
                background: #2f2f2f;
                color:white;
            }
        .dark-theme .headertop{
            background: #2f2f2f;
            color:white;
        }
        .dark-theme .headertop a{
            color: #2f2f2f;
            background: white;
        }

        .dark-theme #register {
            background-color: #2f2f2f;
            color:white;  
        }

        .dark-theme #register:hover {
            background-color: white;
            color:#2f2f2f;
        }

        .dark-theme .headertop a:hover {
            background-color: #2f2f2f;
            color: #ffffff;
        }

        .dark-theme .headertop-right{
            background: #2f2f2f;
        }

        .dark-theme .header-center{
            background: gray;
            color:white;
        }

        .dark-theme .header-center a{
            background: gray;
            color:white;
        }
        .dark-theme .topnav{
            background: #2f2f2f;
        }
        .dark-theme #submit{
            background: white;
            color:#2f2f2f;
            border-radius:2px;
        }
        .theme-btn{
            cursor: pointer;
            color: black;
            background: #2f2f2f;
            padding:10px;
            margin:10px;
            color:white;
        }
        </style>
    </head>
    <body>
        <header>
            <nav>
        <div class="headertop">
            <div class="headertop-right">
                <?php
                if (!empty($_SESSION["username"])) {
                ?>
                    <a href="about.php?username=<?=$_SESSION["username"]?>">Hi <b><?=$_SESSION["username"]?></b></a>
                    <a href="logout.php">Logout</a>
                <?php } ?>
                <?php
                if (empty($_SESSION["username"])) {
                ?>
                    <a href="signup.php" id="register">Sign up</a>
                    <a href="signin.php" id="login">Login</a>
                <?php } ?>
                <?php
                if (!empty($_SESSION["cart"])) {
                ?>
                    <a href="showcart.php?action=" id="cart">Cart(<?=sizeof($_SESSION['cart'])?>)</a>
                <?php } ?>
            </div>
        </div>
        </nav>
        </header>
        
        <section>
        <div class="second-header">
            <!-- <a href="" class="logo">Sneakers</a> -->
            <div class="header-center"> 
                <!-- เรียกใช้ DOM -->
                <a href="home.php" id="show" onmouseover="menu()" onmouseout="returmenu()">Show All</a>
                <a href="home.php?ptype=basketball" id="bask" onmouseover="menu2()" onmouseout="returmenu2()">Basketball</a>
                <a href="home.php?ptype=running" id="run" onmouseover="menu3()" onmouseout="returmenu3()">Running</a>
                <a href="home.php?ptype=tennis" id="tenn" onmouseover="menu4()" onmouseout="returmenu4()">Tennis</a>
            </div>
        </div>

        <div class="topnav">
            <div class="search-container">
                <form method="post" action="home.php">
                    <input type="text" id="search-text" onkeyup="send()" placeholder="Search.." name="pname">
                    <button type="submit" id="submit"><i class="fa fa-search"></i></button>
                    <div class="list-group" id="show-list"></div>
                </form>
            </div>
        </div>
        </section>

        <footer>
        <div class="footer-content">
            <h3>Nike</h3>
            <p>We champion continual progress for athletes and sport by taking action to help athletes reach their potential. Every job at NIKE, Inc. is grounded in a team-first mindset, cultivating a culture of innovation and a shared purpose to leave an enduring impact.</p>

        </div>
        <div class="footer-bottom">
            <p>&copy;2022 Sneakers</p>
            <span>
            <button class="theme-btn">Dark Theme</button>
            <!-- <button class="theme-btn" onclick="lighttheme()">Light Theme</button> -->
            </span>
        </div>
    </footer>

        <?php
            if(!empty($_GET)) {
                $stmt = $pdo->prepare("SELECT * FROM product WHERE ptype LIKE ?");
                $value = '%'.$_GET["ptype"].'%';
                $stmt->bindParam(1,$value);
            } else if(!empty($_POST)) {
                $stmt = $pdo->prepare("SELECT * FROM product WHERE pname LIKE ?");
                $value = '%'.$_POST["pname"].'%';
                $stmt->bindParam(1,$value);
            } else {
                $stmt = $pdo->prepare("SELECT * FROM product");
            }
            
            $stmt->execute();
            while ($row = $stmt->fetch()):
        ?>
                <div class="img">
                    <div class="product">
                        <a href="detail.php?pid=<?= $row["pid"] ?>&pname=<?= $row["pname"] ?>">
                            <div class="product">
                                <img src='img/<?= $row["pid"] ?>.jpg' width='240'>
                        </a><br>
                    </div>
                    <?= $row["pname"] ?><br><?= $row["ptype"] ?><br><br><?= formatMoney($row["price"]) ?> บาท
                </div>
        <?php 
            endwhile; 
        ?>
    <div id="result"></div>
    <script>
        const body = document.body;
        let lastScroll = 0;

        window.addEventListener('scroll', () => {
            if (window.scrollY >= 50) {
                body.classList.add('header');
            } else {
                body.classList.remove('header');
            }
            console.log(window.scrollY);
        })
    </script>
    <script type="text/javascript">
        $(document).ready(function(){
            $("#search-text").keyup(function(){
                var searchText = $(this).val();
                if(searchText!=''){
                    $.ajax({
                        url:'action.php',
                        method: 'post',
                        data:{query:searchText},
                        success:function(response){
                            $("#show-list").html(response);
                        }

                    });
                }
                else{
                    $("#show-list").html('');
                }
            });
            $(document).on('click','a',function(){
                $("#search-text").val($(this).text());
                $("#show-list").html('');
            });
        });
    </script>
     <script>
        // DOM ขยายเมนู
        let menu=()=>{
            document.getElementById("show").style.fontSize="30"; //ดึง ID show มาแล้วกำหนดค่า font=30
        }
        let returmenu=()=>{
            document.getElementById("show").style.fontSize="larger";//คืนค่า ID show กลับตาม css
        }
        let menu2=()=>{
            document.getElementById("bask").style.fontSize="30";
        }
        let returmenu2=()=>{
            document.getElementById("bask").style.fontSize="larger";
        }
        let menu3=()=>{
            document.getElementById("run").style.fontSize="30";
        }
        let returmenu3=()=>{
            document.getElementById("run").style.fontSize="larger";
        }
        let menu4=()=>{
            document.getElementById("tenn").style.fontSize="30";
        }
        let returmenu4=()=>{
            document.getElementById("tenn").style.fontSize="larger";
        }
    </script>
        <script>
            let themebody = document.body; //ใช้ DOM เรียก tag body มาเป็น Element ใน script
            let themeButton = document.querySelector('.theme-btn'); //เรียกใช้ class selector ชื่อ theme-btn เก็บไว้ใน themeButton

            themeButton.addEventListener('click',()=>{ //ดักจับ Event จาก themeButton เมื่อกดคลิ๊ก แล้วเรียกใช้ css dark-theme
                themebody.classList.toggle('dark-theme'); //classList เข้าถึง class ของBody // toggle = สวิชไฟ กด1ทีเปิด กด1ทีปิด
            });
        </script>
    </body>
</html>