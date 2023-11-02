<?php
    session_start();
    
    $con=mysqli_connect('localhost','root','','atc');
    $id = mysqli_real_escape_string($con,$_GET['ID']);


    mysqli_query($con,"DELETE FROM student WHERE std_id='$id'");
    echo "<script type='text/javascript'>alert('Student Deleted!!');document.location='student.php'</script>";
?>