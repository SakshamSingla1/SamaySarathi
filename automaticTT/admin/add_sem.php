<?php
    session_start();

    $con=mysqli_connect('localhost','root','','atc');

    $s="SELECT DISTINCT dep_id,dep_name FROM department group by dep_name order by dep_id";
    $q=mysqli_query($con, $s);
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="stle.css">
	<title>Add Semester</title>
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
          <li class="list" style="--clr:#86C6EA;">
              <a href="department.php">
                  <span class="icon">
                      <ion-icon name="business-outline"></ion-icon>
                  </span>
                  <span class="text">Department</span>
              </a>
          </li>
          <li class="list active" style="--clr:#86C6EA;">
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
            <h3>Add Semester</h3>
            <select name="dep_name">
              <option value="Department">Department</option>
              <?php
                while($n=mysqli_fetch_array($q)){
                  $name=$n['dep_name'];
              ?>
              <option value="<?php echo "$name";?>"><?php echo "$name";?></option>
              <?php } 
              ?>
            </select>
            <input type="text" placeholder="Semester" name="name">
            <input type="submit" value="Add Semester" class="btn2" name="sub">
            <input type="reset" value="reset" class="btn3">
        </form>
    </div>
</body>
</html>

<?php
    if(isset($_POST['sub'])){
        $name=$_POST['name'];
        $dep_name=$_POST['dep_name'];

        $que=mysqli_query($con,"select * from semester where sem_name='$name'");
        $row=mysqli_num_rows($que);

        $q1=mysqli_query($con,"select * from department where dep_name='$dep_name'");
        $res=mysqli_fetch_assoc($q1);
        $dep_id=$res['dep_id'];

        if(empty($name) || empty($dep_name)){
            echo "<script type='text/javascript'>alert('You must enter Department or Semester!!');document.location='add_sem.php'</script>";
        }
        if ($row) {
            ?>
                <script type="text/javascript">
                    alert('Semester Already Exists!!');
                    window.location="add_sem.php";
                </script>
            <?php
        }
        else{
          $ins="insert into semester(sem_name,dep_id) values('$name','$dep_id')";
          $insq=mysqli_query($con,$ins);

          if(mysqli_affected_rows($con)==1){
            ?>
                <script type="text/javascript">
                    alert('Semester Added Successfuly...');
                    window.location="semester.php";
                </script>
            <?php
            }
            else{
            ?>
                <script type="text/javascript">
                    alert('Is there any issue!!');
                    window.location="add_sem.php";
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