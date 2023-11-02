<?php
	session_start();

	$con=mysqli_connect('localhost','root','','atc');
	mysqli_select_db($con, 'atc');

	$email = $_POST['email'];
    $pass = $_POST['psw'];

    $s = "select * from admin where ad_email = '$email' && ad_pass = '$pass'";

    $res=mysqli_query($con, $s);
    $num=mysqli_num_rows($res);

    if($num==0){
        echo "<script type='text/javascript'>alert('Invalid  Email or Password,Please try again!');
				  document.location='index.php'</script>";
    }
    else{
        $_SESSION['email']=$email;
        $_SESSION['username'] = $user['ad_name']; // Store the user's name in the session
    echo "<script type='text/javascript'>alert('Welcome, " . $user['ad_name'] . "');
                  document.location='ad_prof.php'</script>";
    }
?>