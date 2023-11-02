<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" type="text/css" href="subject.css">
  <title>Subject</title>
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

    <div class="div">
      <h1 class="h1">Subject</h1>
      <a href="add_sub.php">
        <button type="button" class="btn">
          <span class="btnicon">
            <ion-icon name="add-outline"></ion-icon>
          </span>
          <span class="btntext">Add Subject</span>
        </button>
      </a>

      <?php
        session_start();
        $con=mysqli_connect('localhost','root','','atc');

        $d = mysqli_query($con, "SELECT * FROM department");

        if (mysqli_num_rows($d) > 0) {
            while ($dr = mysqli_fetch_assoc($d)) {
        ?>
            <table class="content-table">
              <thead>
                <tr>
                  <th colspan="4"><?php echo $dr["dep_name"]; ?></th>
                </tr>
              </thead>
        <?php
                $dep_id = $dr["dep_id"];
                $s = mysqli_query($con, "SELECT * FROM semester WHERE dep_id = $dep_id");

                if (mysqli_num_rows($s) > 0) {
                    while ($sr = mysqli_fetch_assoc($s)) {
        ?>
                <tbody>
                  <tr>
                    <td colspan="3" style="color: #fff; background: #86C6EA;"><?php echo $sr["sem_name"]; ?></td>
                  </tr>
        <?php
                      $sem_id = $sr['sem_id'];
                      $su = mysqli_query($con, "SELECT * FROM subject WHERE sem_id = $sem_id ORDER BY sub_name");

                      if (mysqli_num_rows($su) > 0) {
                        while ($sur = mysqli_fetch_assoc($su)) {
                          $id = $sur['sub_id'];
        ?>
                              <tr>
                                <td><?php echo $sur["sub_name"]; ?> (<?php echo $sur["lec_type"]; ?>)<td>
                                <td>
                                  <a href="update_sub.php?ID=<?php echo $id; ?>">
                                    <button type="button" class="bttn1">
                                      <span class="btntext">Update</span>
                                    </button>
                                  </a>
                                  <a href="del_sub.php?ID=<?php echo $id; ?>">
                                    <button type="button" class="bttn">
                                      <span class="btntext">Delete</span>
                                    </button>
                                  </a>
                                </td>
                              </tr>
                  </tbody>
        <?php
                        }
                      }
        ?>
        <?php
                } 
            }
        }
      }
      ?>
            </table>
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