<?php
    session_start();

    $con=mysqli_connect('localhost','root','','atc');

    $s="SELECT * FROM subject WHERE sem_id = '".$_POST['sID']."'";
    $q=mysqli_query($con, $s);
    $output .= '<option value="Subject" disabled selected>Subject</option>';
    while($row=mysqli_fetch_array($q)){
        $output .= '<option value="'.$row['sub_id'].'">'.$row['sub_name'].'</option>';
    }
    echo $output;
?>