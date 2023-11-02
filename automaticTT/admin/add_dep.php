<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="stle.css">
	<title>Add Department</title>
</head>
<body>
	<div class="nav">
      <div class="menuToggle"></div>
      <ul>
          <li class="list" style="--clr:#86C6EA;">
              <a href="ad_prof.php">
                  <span class="icon">
                    <ion-icon name="person-outline"></ion-icon>
                  </span>
                  <span class="text">Profile</span>
              </a>
          </li>
          <li class="list active" style="--clr:#86C6EA;">
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

    <div class="box">
        <form method="post">
            <h3>Add Department</h3>
            <input type="text" placeholder="Department Name" name="name">
            <input type="submit" value="Add Department" class="btn2" name="sub">
            <input type="reset" value="reset" class="btn3">
        </form>
    </div>
</body>
</html>


<?php
    session_start();

    $con=mysqli_connect('localhost','root','','atc');

    if(isset($_POST['sub'])){
        $name=$_POST['name'];

        $que=mysqli_query($con,"select * from department where dep_name='$name'");
        $row=mysqli_num_rows($que);

        if(empty($name)){
            echo "<script type='text/javascript'>alert('You must enter Department  Name!!');document.location='add_dep.php'</script>";
        }
        if ($row) {
            ?>
                <script type="text/javascript">
                    alert('Department Already Exists!!');
                    window.location="add_dep.php";
                </script>
            <?php
        }
        else{
          $ins="insert into department(dep_name) values('$name')";
          $insq=mysqli_query($con,$ins);

          if(mysqli_affected_rows($con)==1){
            ?>
                <script type="text/javascript">
                    alert('Department Added Successfuly...');
                    window.location="department.php";
                </script>
            <?php
            }
            else{
            ?>
                <script type="text/javascript">
                    alert('Is there any issue!!');
                    window.location="add_dep.php";
                </script>
            <?php
            }
        }
    }
?>

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