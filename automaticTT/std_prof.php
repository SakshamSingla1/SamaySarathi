<?php
    session_start();

    $con=mysqli_connect('localhost','root','','atc');

    $q=mysqli_query($con, "select * from student where std_enrno='$_SESSION[enrno]'");
    $raw=mysqli_fetch_assoc($q);
    $dep=$raw['dep_id'];
    $sem=$raw['sem_id'];
    $q1=mysqli_query($con, "select * from department where dep_id=$dep");
    $raw1=mysqli_fetch_assoc($q1);
    $q2=mysqli_query($con, "select * from semester where sem_id=$sem");
    $raw2=mysqli_fetch_assoc($q2);
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="csss.css">
	<title>Profile</title>
</head>
<body>
	<div class="nav">
      <div class="menuToggle"></div>
      <ul>
          <li class="list active" style="--clr:#219884;">
              <a href="std_prof.php">
                  <span class="icon">
                    <ion-icon name="person-outline"></ion-icon>
                  </span>
                  <span class="text">Profile</span>
              </a>
          </li>
          <li class="list" style="--clr:#219884;">
              <a href="std_time.php">
                  <span class="icon">
                      <ion-icon name="calendar-outline"></ion-icon>
                  </span>
                  <span class="text">Time Table</span>
              </a>
          </li>
          <li class="list" style="--clr:#219884;">
              <a href="std_logout.php">
                  <span class="icon">
                    <ion-icon name="log-out-outline"></ion-icon>
                  </span>
                  <span class="text">Logout</span>
              </a>
          </li>
      </ul>
    </div>

    <div class="welcome-message">
        <?php echo $welcomeMessage; ?>
    </div>

    <div class="div">
      <h1 class="h1">Profile</h1>
    </div>

    <div class="box">
      <?php
        if(empty($raw['std_pic'])){
      ?>
        <img class="img" src="img/user.png">
      <?php
      }
      else{
        ?>
        <img class="img" src="img/<?php echo $raw['std_pic']; ?>">
      <?php
      }
      ?>

      <table class="content-table">
          <tr>
            <td>Name</td>
            <td>:</td>
            <td><?php echo $raw['std_fname'];?> <?php echo $raw['std_lname'];?></td>
          </tr>
          <tr>
            <td>Email</td>
            <td>:</td>
            <td><?php echo $raw['std_email'];?></td>
          </tr>
          <tr>
            <td>Enrollment No.</td>
            <td>:</td>
            <td><?php echo $raw['std_enrno'];?></td>
          </tr>
          <tr>
            <td>Mobile</td>
            <td>:</td>
            <td><?php echo $raw['std_mob'];?></td>
          </tr>
          <tr>
            <td>Address</td>
            <td>:</td>
            <td><?php echo $raw['std_add'];?></td>
          </tr>
          <tr>
            <td>Gender</td>
            <td>:</td>
            <td><?php echo $raw['std_gender'];?></td>
          </tr>
          <tr>
            <td>Birth Date</td>
            <td>:</td>
            <td><?php echo $raw['std_dob'];?></td>
          </tr>
          <tr>
            <td>Department</td>
            <td>:</td>
            <td><?php echo $raw1['dep_name'];?></td>
          </tr>
          <tr>
            <td>Semester</td>
            <td>:</td>
            <td><?php echo $raw2['sem_name'];?></td>
          </tr>
          <tr>
            <td>Division</td>
            <td>:</td>
            <td><?php echo $raw['std_div'];?></td>
          </tr>
          <tr>
            <form method="post">
              <td colspan="3"><input type="submit" value="Edit Profile" class="btn2" name="submit" /></td>
            </form>
          </tr>
      </table>
    </div>

    <?php
      if(isset($_POST['submit'])){
        header('location:std_epro.php');
      }
    ?>

</body>
</html>

<script>
	const menuToggle = document.querySelector('.menuToggle');
	const nav = document.querySelector('.nav');
	menuToggle.onclick=function(){
	nav.classList.toggle('open')
	}

	const list = document.querySelectorAll('.list');
	function activeLink(){
	  list.forEach((item) =>
	  item.classList.remove('active'));
	  this.classList.add('active');
	}
	list.forEach((item) =>
	item.addEventListener('click',activeLink))
</script>

<script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>