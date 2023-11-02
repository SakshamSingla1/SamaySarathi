<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="st.css">
	<title>Profile</title>
</head>
<body>
	<div class="nav">
      <div class="menuToggle"></div>
      <ul>
          <li class="list active" style="--clr:#86C6EA;">
              <a href="ad_prof.php">
                  <span class="icon">
                    <ion-icon name="person-outline"></ion-icon>
                  </span>
                  <span class="text">Profile</span>
              </a>
          </li>
          <li class="list" style="--clr:#86C6EA;">
              <a href="department.php">
                  <span class="icon">
                      <ion-icon name="business-outline"></ion-icon>
                  </span>
                  <span class="text">Department</span>
              </a>
          </li>
          <li class="list" style="--clr:#86C6EA;">
              <a href="semester.php">
                  <span class="icon">
                    <ion-icon name="grid-outline"></ion-icon>
                  </span>
                  <span class="text">Semester</span>
              </a>
          </li>
          <li class="list" style="--clr:#86C6EA;">
              <a href="subject.php">
                  <span class="icon">
                    <ion-icon name="book-outline"></ion-icon>
                  </span>
                  <span class="text">Subject</span>
              </a>
          </li>
          <li class="list" style="--clr:#86C6EA;">
              <a href="student.php">
                  <span class="icon">
                    <ion-icon name="person-circle-outline"></ion-icon>
                  </span>
                  <span class="text">Student</span>
              </a>
          </li>
          <li class="list" style="--clr:#86C6EA;">
              <a href="faculty.php">
                  <span class="icon">
                    <ion-icon name="people-circle-outline"></ion-icon>
                  </span>
                  <span class="text">Faculty</span>
              </a>
          </li>
          <li class="list" style="--clr:#86C6EA;">
              <a href="timetable.php">
                  <span class="icon">
                    <ion-icon name="calendar-outline"></ion-icon>
                  </span>
                  <span class="text">Time Table</span>
              </a>
          </li>
      </ul>
    </div>

    <div class="div">
      <h1 class="h1">Profile</h1>
    </div>
      <a href="add_admin.php">
        <button type="button" class="btn">
          <span class="btnicon">
            <ion-icon name="add-outline"></ion-icon>
          </span>
          <span class="btntext">Add Admin</span>
        </button>
      </a>
    <?php
      session_start();
      $con=mysqli_connect('localhost','root','','atc');

      $s="select * from admin where ad_email='$_SESSION[email]'";

      $q=mysqli_query($con, $s);
      $raw=mysqli_fetch_assoc($q);
    ?>

<div class="box1">
    <?php
    if (!empty($raw['ad_pic'])) {
        $profilePicUrl = "aimg/" . $raw['ad_pic'];
    } else {
        $profilePicUrl = "../img/user.png"; // Default picture
    }
    ?>
    <img class="img" src="<?php echo $profilePicUrl;?>" alt="Profile Picture">
    <table class="content-table">
        <tbody>
            <tr>
                <td>Name</td>
                <td>:</td>
                <td><?php echo $raw['ad_name']; ?></td>
            </tr>
            <tr>
                <td>Email</td>
                <td>:</td>
                <td><?php echo $raw['ad_email']; ?></td>
            </tr>
            <tr>
                <form method="post">
                    <td colspan="3"><input type="submit" value="Edit Profile" class="btn2" name="submit" /></td>
                </form>
            </tr>
        </tbody>
    </table>

    <?php
    if (isset($_POST['submit'])) {
        header('location:ad_epro.php');
    }
    ?>
</div>

      <a href="ad_logout.php">
        <button type="button" class="btn3">
          <span class="btnicon">
            <ion-icon name="exit-outline"></ion-icon>
          </span>
          <span class="btntext">Logout</span>
        </button>
      </a>

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