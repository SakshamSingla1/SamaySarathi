<?php
    session_start();
    
    $con=mysqli_connect('localhost','root','','atc');
    $id = mysqli_real_escape_string($con,$_GET['ID']);


    mysqli_query($con,"DELETE FROM department WHERE dep_id='$id'");
    echo "<script type='text/javascript'>alert('Department Deleted!!');document.location='department.php'</script>";
?>