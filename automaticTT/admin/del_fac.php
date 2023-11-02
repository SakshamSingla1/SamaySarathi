<?php
    session_start();
    
    $con=mysqli_connect('localhost','root','','atc');
    $id = mysqli_real_escape_string($con,$_GET['ID']);


    mysqli_query($con,"DELETE FROM faculty WHERE fac_id='$id'");
    echo "<script type='text/javascript'>alert('Faculty Deleted!!');document.location='faculty.php'</script>";
?>