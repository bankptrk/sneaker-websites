<?php 
    include "connect.php";
  
    session_start();
    if(isset($_SESSION["username"]) and isset($_SESSION["cart"])) {
        $username = $_SESSION["username"];
        $total = $_SESSION["sumprice"];
        $time = date("Y-m-d:h:i:s",time());

        $stmt = $pdo->prepare("SELECT * FROM orders");
        $stmt->execute();

        $findord_id = 0;
        while ($row = $stmt->fetch()):
            $findord_id = $row["ord_id"];
        endwhile;
        $findord_id = $findord_id + 1;
        

        $sql = "INSERT INTO orders(ord_id, username, total) VALUES('$findord_id','$username','$total')";
        mysqli_query($conn,$sql);
        
        $stmt = $pdo->prepare("SELECT * FROM item");
        $stmt->execute();

        $finditem_id = 0;
        while ($row = $stmt->fetch()):
            $finditem_id = $row["tid"];
        endwhile;
        $finditem_id = $finditem_id + 1;
        
        foreach ($_SESSION["cart"] as $item) {
            $pid = $item["pid"];
            $quantity = $item["qty"];
            $sql2 = "INSERT INTO item(tid, ord_id, pid, quantity) VALUES('$finditem_id','$findord_id','$pid','$quantity')";
            mysqli_query($conn,$sql2);
            $finditem_id += 1;
        }
        mysqli_close($conn);

        session_destroy();
        header("location: home.php");
    } else {
        header("location: signin.php");
    }
?>