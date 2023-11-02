<?php
    session_start();

    $con=mysqli_connect('localhost','root','','atc');

    $dep="SELECT DISTINCT dep_id,dep_name FROM department group by dep_name order by dep_id";
    $q=mysqli_query($con, $dep);
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="add_sub.css">
	<title>Add Subject</title>
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
          <li class="list" style="--clr:#86C6EA;">
              <a href="semester.php">
                  <span class="icon">
                    <ion-icon name="grid-outline"></ion-icon>
                  </span>
                  <span class="text">Semester</span>
              </a>
          </li>
          <li class="list active" style="--clr:#86C6EA;">
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
            <h3>Add Subject</h3>
            <select id="department" name="department">
              <option value="Department" disabled selected>Department</option>
              <?php
                while($n=mysqli_fetch_array($q)){
              ?>
              <option id="<?php echo $n['dep_id']?>" value="<?php echo $n['dep_id']?>"><?php echo $n['dep_name']?></option>
              <?php } 
              ?>
            </select>
            <select id="semester" name="semester">
                <option value="Semester" disabled selected>Semester</option>
            </select>
            <input type="text" placeholder="Subject Name" name="sub_name">
            <input type="text" placeholder="Lecture per week" name="lec">
            <select id="type" name="type">
                <option value="Semester" disabled selected>Select type</option>
                <option value="Theory">Theory</option>
                <option value="Practical">Practical</option>
            </select>
            <input type="submit" value="Add Subject" class="btn2" name="sub">
            <input type="reset" value="reset" class="btn3">
        </form>
    </div>
</body>
</html>

<?php
    if(isset($_POST['sub'])){
        $sub_name=$_POST['sub_name'];
        $dep_id=$_POST['department'];
        $sem_id=$_POST['semester'];
        $lec_per_week=$_POST['lec'];
        $type=$_POST['type'];

        $su=mysqli_query($con, "SELECT * FROM subject WHERE sub_name='$sub_name' and lec_type='$type'");
        $row=mysqli_num_rows($su);

        if(empty($sub_name) || empty($dep_id) || empty($sem_id) || empty($type)){
            echo "<script type='text/javascript'>alert('You must enter Data!!');document.location='add_sub.php'</script>";
        }
        if ($row){
            ?>
                <script type="text/javascript">
                    alert('Subject Already Exists!!');
                    window.location="add_sub.php";
                </script>
            <?php
        }
        else{
          $ins="insert into subject(sub_name,sem_id,dep_id,lec_per_week,lec_type) values('$sub_name','$sem_id','$dep_id','$lec_per_week','$type')";
          $insq=mysqli_query($con,$ins);

          if(mysqli_affected_rows($con)==1){
            ?>
                <script type="text/javascript">
                    alert('Subject Added Successfuly...');
                    window.location="subject.php";
                </script>
            <?php
            }
            else{
            ?>
                <script type="text/javascript">
                    alert('Is there any issue!!');
                    window.location="add_sub.php";
                </script>
            <?php
            }
        }
    }
?>

<script src="jquery.main.js" type="text/javascript"></script>

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

<script type="text/javascript">
    $(document).ready(function(){
        $("#department").change(function(){
            var did = $("#department").val();
            $.ajax({
                url: 'data.php',
                method: 'POST',
                data: {dID:did},
                success:function(data){
                    $('#semester').html(data);
                }
            });
        });
    });
</script>

<script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>