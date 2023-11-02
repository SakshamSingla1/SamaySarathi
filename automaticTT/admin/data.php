<?php
    session_start();

    $con=mysqli_connect('localhost','root','','atc');

    $s="SELECT * FROM semester WHERE dep_id = '".$_POST['dID']."' ORDER BY sem_name";
    $q=mysqli_query($con, $s);
    $output .= '<option value="Semester" disabled selected>Semester</option>';
    while($row=mysqli_fetch_array($q)){
        $output .= '<option value="'.$row['sem_id'].'">'.$row['sem_name'].'</option>';
    }
    echo $output;
?>