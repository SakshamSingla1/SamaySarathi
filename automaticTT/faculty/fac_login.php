<?php
	session_start();

	$con=mysqli_connect('localhost','root','','atc');
	mysqli_select_db($con, 'atc');

	$email = $_POST['email'];
    $pass = $_POST['psw'];

    $s = "select * from faculty where fac_email = '$email' && fac_pass = '$pass'";

    $res=mysqli_query($con, $s);
    $num=mysqli_num_rows($res);

    if($num==0){
        echo "<script type='text/javascript'>alert('Invalid  Email or Password,Please try again!');
				  document.location='index.php'</script>";
    }
    else{
        $_SESSION['email']=$email;
        $_SESSION['username'] = $user['fac_name']; // Store the user's name in the session
    echo "<script type='text/javascript'>alert('Welcome, " . $user['fac_name'] . "');
                  document.location='fac_prof.php'</script>";
    }
?>