<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="shtime.css">
	<title>Show Time Table</title>
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

    <div class="div">
      <h1 class="h1">Show Time Table</h1>
    </div>

    <?php
        session_start();
        
        $con = mysqli_connect('localhost','root','','atc');
        
        $id = mysqli_real_escape_string($con,$_GET['ID']);
        $id1 = mysqli_real_escape_string($con,$_GET['ID1']);

        $divq = mysqli_query($con, "select * from timetable where sem_id='$id' and dep_id='$id1' group by division");

        echo "<div class='div1'>";

        while($divn = mysqli_fetch_array($divq)){
            $division=$divn['division'];
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
            $dayq = mysqli_query($con, "select * from timetable where division='$division' group by day order by field(day, 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday')");
            while($dayn = mysqli_fetch_array($dayq)){
                $weekDays = $dayn['day'];
                echo "<tr>";
                echo "<th>".$weekDays."</th>";  
                $weekTimeTable = mysqli_query($con, "select * from timetable where division='$division' and day='$weekDays'");
                while($wt = mysqli_fetch_array($weekTimeTable)){
                    if($wt['lecture_type'] === 'Practical'){
                    echo "<th colspan=2>".$wt['subject_name']."</th>";
                    }
                    else{
                        echo "<th>".$wt['subject_name']."</th>";
                    }
                }
            }
            echo "</tr>";
            echo "</table>";
        }
    ?>
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