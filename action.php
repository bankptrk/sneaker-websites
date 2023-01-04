
<?php
    $conn = new mysqli("localhost","root","","sneakers");
    if($conn->connect_error){
        die("Failed to connect!".$conn->connect_error);
    }
    if(isset($_POST['query'])){
        $inpText =$_POST['query'];
        $query="SELECT * FROM product WHERE pname LIKE '%$inpText%' 
        ";
        $result = $conn->query($query);
        if($result->num_rows>0){
            while($row=$result->fetch_assoc()){
                echo "<a href='#' class='list-group-item'>".$row['pname']."</a>";
            }
        }
        else{
            echo "<p class = 'list-group-item border-1'>No record</p>";
        }
    }
?>