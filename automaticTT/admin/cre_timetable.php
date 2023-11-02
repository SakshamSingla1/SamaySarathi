<?php
    session_start();
    include("timetablegen.php");
    error_reporting(E_ERROR | E_PARSE);

    $con=mysqli_connect('localhost','root','','atc');

    $s="SELECT DISTINCT dep_id,dep_name FROM department group by dep_name order by dep_id";
    $q=mysqli_query($con, $s);
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="cre_time.css">
	<title>Create Time Table</title>
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
          <li class="list active" style="--clr:#86C6EA;">
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
            <h3>Create Time Table</h3>
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
            <input type="submit" value="Create Time Table" class="btn2" name="sub">
            <input type="reset" value="reset" class="btn3" onclick="resetForm()">
        </form>
      </div>

<?php

  if(isset($_POST['sub'])){
    $dep=$_POST['department'];
    $sem=$_POST['semester'];

    $weekDays = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday'];
    $lunch = "LUNCH";
    $div=['A', 'B', 'C', 'D', 'E', 'F'];

    $query = "select * from department where dep_id = $dep";
    $que=mysqli_query($con, $query);
    $row = mysqli_fetch_assoc($que);
    $branch = $row['dep_name'];

    $query = "select * from semester where sem_id = $sem";
    $que=mysqli_query($con, $query);
    $row = mysqli_fetch_assoc($que);
    $semester = $row['sem_name'];

    $tt = mysqli_query($con, "select * from timetable where dep_id='$dep' and sem_id='$sem'");
    $raw = mysqli_num_rows($tt);
    if($branch && $semester){
      echo "<div class='div1'><b>".$branch." ".$semester." Semester</b></div>";
    }
    if($raw){
      echo "<div class='div1' style='color: red;'><b>Time Table Already exists!!</b></div><br>";
    }
    else{
      for($d=0;$d<6;$d++){
        $weekTimeTable = generate_time_table($con, $dep, $sem);
        echo "<div class='div1'>";

      if($weekTimeTable){
        $division=$div[$d];
        echo "Div : ".$division;
  ?>
        <table border="1" class='content-table'>
        <thead>
        <tr>
          <th>Days/Lecture</th>
          <th>Lecture 1<br>09:00-10:00</th>
          <th>Lecture 2<br>10:00-11:00</th>
          <th>Lecture 3<br>11:00-12:00</th>
          <th>Lecture 4<br>12:00-01:00</th>
          <th>Break<br>1:00-02:00</th>
          <th>Lecture 5<br>02:30-03:30</th>
          <th>Lecture 6<br>03:30-04:30</th>
        </tr>
      </thead>
  <?php
        for($i = 0; $i < 5; $i++){
          echo "<tr>";
          echo "<th>".$weekDays[$i]."</th>";  
          for($j = 0; $j < 6; $j++){
              if($weekTimeTable[$i][$j]['lec_type'] === 'Practical' && !($i == 3 && $j == 3)){
                echo "<th colspan=2>".$weekTimeTable[$i][$j]['sub_name']."</th>";
                  $division = $div[$d];
                  $day = $weekDays[$i];
                  $slot = $j / 2 + 1;
                  $subject = $weekTimeTable[$i][$j]['sub_name'];
                  $lecType = $weekTimeTable[$i][$j]['lec_type'];
                  
                  $insertQuery = "INSERT INTO timetable (division, day, lecture_slot, subject_name, lecture_type, dep_id, sem_id) VALUES ('$division', '$day', '$slot', '$subject', '$lecType', '$dep', '$sem')";
                  mysqli_query($con, $insertQuery);
                $j++;
              }
              
              else{
                echo "<th>".$weekTimeTable[$i][$j]['sub_name']."</th>";
                  $division = $div[$d];
                  $day = $weekDays[$i];
                  $slot = $j + 1; 
                  $subject = $weekTimeTable[$i][$j]['sub_name'];
                  $lecType = $weekTimeTable[$i][$j]['lec_type'];
                  
                  $insertQuery = "INSERT INTO timetable (division, day, lecture_slot, subject_name, lecture_type, dep_id, sem_id) VALUES ('$division', '$day', '$slot', '$subject', '$lecType', '$dep', '$sem')";
                  mysqli_query($con, $insertQuery);
              }
              if($j === 3){
                echo "<th><b style='text-sze=24'>".$lunch[$i]."</b></th>";
                  $slot = 7; 
                  $subject = 'LUNCH';
                  $lecType = 'Break';
                  
                  $insertQuery = "INSERT INTO timetable (division, day, lecture_slot, subject_name, lecture_type, dep_id, sem_id) VALUES ('$division', '$day', '$slot', '$subject', '$lecType', '$dep', '$sem')";
                  mysqli_query($con, $insertQuery);
              }
          }
          echo "</tr>";
          ?>
          <?php
        }
  ?>
        </table>
    </div>
  <?php
        }
        else{
          echo "<div style='text-size=28'><b>Not enough data for selected Course and semester.</b></div>";
        }
    }
  }
}
?>

</body>
</html>

<script src="jquery.main.js" type="text/javascript"></script>

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
<script>
  function resetForm() {
    // Get the form element by its ID
    var form = document.getElementById('timeTableForm');
    
    // Reset the form to its initial state
    form.reset();
    
    // Optionally, you can add additional logic here to reset specific elements or perform other actions after the reset.
  }
</script>
