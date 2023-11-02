<?php
    session_start();

    $con=mysqli_connect('localhost','root','','atc');
    $id = mysqli_real_escape_string($con,$_GET['ID']);

    $q=mysqli_query($con,"select * from semester where sem_id='$id'");
    $res=mysqli_fetch_assoc($q);
    $dep_id=$res['dep_id'];
    $q1=mysqli_query($con,"select * from department where dep_id='$dep_id'");
    $res1=mysqli_fetch_assoc($q1);
    $dep_name=$res1['dep_name'];


    if(isset($_POST['sub'])){
      $updetesname=$_POST['name'];
      mysqli_query($con,"update semester set sem_name='$updetesname' where sem_id='$id' ");
      echo "<script type='text/javascript'>alert('Semester Updeted Successfuly..,');
          document.location='semester.php'</script>";
    }
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="stle.css">
	<title>Update Semester</title>
</head>
<body>
	<div class="nav">
      <div class="menuToggle"></div>
      <ul>
          <li class="list" style="--clr:#8FE9FF;">
              <a href="ad_prof.php">
                  <span class="icon">
                    <ion-icon name="person-outline"></ion-icon>
                  </span>
                  <span class="text">Profile</span>
              </a>
          </li>
          <li class="list" style="--clr:#8FE9FF;">
              <a href="department.php">
                  <span class="icon">
                      <ion-icon name="business-outline"></ion-icon>
                  </span>
                  <span class="text">Department</span>
              </a>
          </li>
          <li class="list active" style="--clr:#8FE9FF;">
              <a href="semester.php">
                  <span class="icon">
                    <ion-icon name="grid-outline"></ion-icon>
                  </span>
                  <span class="text">Semester</span>
              </a>
          </li>
          <li class="list" style="--clr:#8FE9FF;">
              <a href="subject.php">
                  <span class="icon">
                    <ion-icon name="book-outline"></ion-icon>
                  </span>
                  <span class="text">Subject</span>
              </a>
          </li>
          <li class="list" style="--clr:#8FE9FF;">
              <a href="student.php">
                  <span class="icon">
                    <ion-icon name="person-circle-outline"></ion-icon>
                  </span>
                  <span class="text">Student</span>
              </a>
          </li>
          <li class="list" style="--clr:#8FE9FF;">
              <a href="faculty.php">
                  <span class="icon">
                    <ion-icon name="people-circle-outline"></ion-icon>
                  </span>
                  <span class="text">Faculty</span>
              </a>
          </li>
          <li class="list" style="--clr:#8FE9FF;">
              <a href="timetable.php">
                  <span class="icon">
                    <ion-icon name="calendar-outline"></ion-icon>
                  </span>
                  <span class="text">Time Table</span>
              </a>
          </li>
      </ul>
    </div>

    <div class="box">
        <form method="post">
            <h3>Update Semester</h3>
            <input type="text" placeholder="Department" name="dep_name" value="<?php echo $dep_name;?>" readonly>
            <input type="text" placeholder="Semester" name="name" value="<?php echo $res['sem_name'];?>">
            <input type="submit" value="Update Semester" class="btn2" name="sub">
            <input type="reset" value="reset" class="btn3">
        </form>
    </div>
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