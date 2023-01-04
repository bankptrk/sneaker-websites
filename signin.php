<?php session_start(); ?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>ล็อกอิน</title>
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
                 width: 100%;
                 margin: 0px;
                 text-align: center;
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
            @media screen and (max-width: 800px){
                .signupbtn{
                    width: 50%;
                    margin-top:5%;
                }
            }
            @media screen and (min-width: 1400px) {
                .container{
                    text-align:left;
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
        .dark-theme{
                background: #2f2f2f;
                color:white;
            }

            .dark-theme .signupbtn{
                background: white;
                color:black;
            }
        .theme-btn{
            cursor: pointer;
                width: 75px;
                float: right;
                margin-top: 7px;
                padding-bottom:12px;
                padding-left:20px;
                text-align:center;
        }
        </style>
    </head> 
    <body>
        <div class="headertop">
        <button class="theme-btn">Theme</button>
            <div class="headertop-right">
                <a href="home.php">Home</a>
                <a href="signup.php">Sign up</a>
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
        <form method="post" action="signin-check.php">
            <div style="display:flex">
                <div class="container">
                    <h1>Login</h1>
                    <p>กรอกข้อมูลเพื่อเข้าสู่ระบบ</p>
                    <hr>

                    <label for="username"><b>Username</b></label>
                    <input type="text" pattern="[A-Za-z]{1,10}" placeholder="ชื่อผู้ใช้" name="username" required>

                    <label for="password"><b>Password</b></label>
                    <input type="password" pattern="[A-Za-z\d]{5,10}" placeholder="รหัสผ่าน" name="password" required>

                    <div class="clearfix">
                        <button type="submit" class="signupbtn">ลงชื่อเข้าใช้</button>
                    </div>
                </div>
            </div>
        </form>
         <script>
            let body = document.body;
            let themeButton = document.querySelector('.theme-btn');

            themeButton.addEventListener('click',()=>{
                body.classList.toggle('dark-theme');
            });
        </script>
    </body>
</html>
