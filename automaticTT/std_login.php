<?php
session_start();

$con = mysqli_connect('localhost', 'root', '', 'atc');
mysqli_select_db($con, 'atc');

$enrno = $_POST['enrno'];
$pass = $_POST['psw'];

$s = "select * from student where std_enrno = '$enrno' && std_pass = '$pass'";

$res = mysqli_query($con, $s);
$num = mysqli_num_rows($res);

if ($num == 0) {
    echo "<script type='text/javascript'>alert('Invalid Username or Password, Please try again!');
                  document.location='index.php'</script>";
} else {
    $user = mysqli_fetch_assoc($res); // Fetch user data
    $_SESSION['enrno'] = $enrno;
    $_SESSION['username'] = $user['std_fname']; // Store the user's name in the session
    echo "<script type='text/javascript'>alert('Welcome, " . $user['std_fname'] . "');
                  document.location='std_prof.php'</script>";
}
?>