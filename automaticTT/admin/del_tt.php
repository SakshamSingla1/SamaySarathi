<?php
    session_start();
    
    $con=mysqli_connect('localhost','root','','atc');
    $id = mysqli_real_escape_string($con,$_GET['ID']);
    $id1 = mysqli_real_escape_string($con,$_GET['ID1']);

    mysqli_query($con,"DELETE FROM timetable WHERE sem_id='$id' AND dep_id='$id1'");
    echo "<script type='text/javascript'>alert('Time Table Deleted!!');document.location='timetable.php'</script>";
?>