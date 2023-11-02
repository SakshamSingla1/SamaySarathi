<?php
    session_start();
    
    $con=mysqli_connect('localhost','root','','atc');
    $id = mysqli_real_escape_string($con,$_GET['ID']);


    mysqli_query($con,"DELETE FROM subject WHERE sub_id='$id'");
    echo "<script type='text/javascript'>alert('Subject Deleted!!');document.location='subject.php'</script>";
?>