<?php
    $keyword = $_GET["keyword"];
    $conn = mysqli_connect("localhost","root","");
    if($conn){
        mysqli_select_db($conn,"sneakers");
        mysqli_query($conn,"SET NAMES utf8");
    }

    $sql = "SELECT * FROM product WHERE pname LIKE '%$keyword%'";
    $objQuery = mysqli_query($conn,$sql);
    ?>
    <?php while($row = mysqli_fetch_array($objQuery)){?>
            <img src="img/<?=$row["pid"]?>.jpg" height="300px">
            product: <?=$row["pname"]?><br>
            type: <?=$row["ptype"]?><br>
            price: <?=$row["price"]?><br>
        <?php }?>
    
    
