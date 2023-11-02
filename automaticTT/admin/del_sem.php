<?php
    session_start();
    
    $con=mysqli_connect('localhost','root','','atc');
    $id = mysqli_real_escape_string($con,$_GET['ID']);


    mysqli_query($con,"DELETE FROM semester WHERE sem_id='$id'");
    echo "<script type='text/javascript'>alert('Semester Deleted!!');document.location='semester.php'</script>";
?>