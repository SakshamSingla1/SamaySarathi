<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="st.css">
	<title>Edit Profile</title>
</head>
<body>
	<div class="nav">
      <div class="menuToggle"></div>
      <ul>
          <li class="list active" style="--clr:#8FE9FF;">
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
          <li class="list" style="--clr:#8FE9FF;">
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

    <div class="div">
      <h1 class="h1">Edit Profile</h1>
    <?php
      session_start();
      $con=mysqli_connect('localhost','root','','atc');

      $s="select * from admin where ad_email='$_SESSION[email]'";

      $q=mysqli_query($con, $s);
      $raw=mysqli_fetch_assoc($q);
    ?>

    <div class="box2">
        <form method="post" enctype="multipart/form-data">
          <button type="button" class="bttn">
            <ion-icon name="camera-outline"></ion-icon>
            <input type="file" id="file" name="img1" accept=".jpg, .jpeg, .png">
          </button>
      <?php
        if(empty($raw['ad_pic'])){
      ?>
        <img class="img" src="../img/user.png">
      <?php
      }
      else{
        ?>
        <img class="img" src="aimg/<?php echo $raw['ad_pic'];?>">
      <?php
      }
      ?>

      <table class="content-table">
        <tbody>
            <tr>
                <td>Name</td>
                <td>:</td>
                <td><div class="input-field"><input type="text" name="name" value="<?php echo $raw['ad_name'];?>"/></div></td>
            </tr>
            <tr>
                <td>Email</td>
                <td>:</td>
                <td><div class="input-field"><input type="email" name="email" value="<?php echo $raw['ad_email'];?>"/></div></td>
            </tr>
            <tr>
            <td>Password</td>
            <td>:</td>
            <td>
            <div class="input-field"><input type="password" name="pass" id="myInput" value="<?php echo $raw['ad_pass']; ?>"/>
            <span class="eye" onclick="myFun()">
                <ion-icon id="hide1" name="eye"></ion-icon>
                <ion-icon id="hide2" name="eye-off"></ion-icon>
                </span>
            </div></td>
        </tr>
          <tr>
            <td colspan="3"><input type="submit" value="Update" class="btn2" name="submit" /></td>
          </tr>
        </tbody>
      </table>
    </form>
    </div>
    </div>

    <?php
      if(isset($_POST['submit'])){
        $mi=$_FILES['img1']['name'];
        $tm=$_FILES['img1']['tmp_name'];
        $s=$_FILES['img1']['size'];
        $id=$raw['ad_id'];
        $fn=$_POST['name'];
        $em=$_POST['email'];
        $pa=$_POST['pass'];
    
        move_uploaded_file($tm, 'aimg/'.$mi);
        if(empty($raw['ad_pic'])){
          $u="UPDATE admin SET ad_name='$fn',ad_email='$em',ad_pass='$pa',ad_pic='$mi' WHERE ad_id='$id'";
    
          mysqli_query($con,$u);
          echo "<script type='text/javascript'>alert('Profile Updated');document.location='ad_prof.php'</script>";
        }
        else{
            $u="UPDATE admin SET ad_name='$fn',ad_email='$em',ad_pass='$pa' WHERE ad_id='$id'";
    
          mysqli_query($con,$u);
          echo "<script type='text/javascript'>alert('Profile Updated');document.location='ad_prof.php'</script>";
        }
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


<script>
  const img = document.querySelector('.img');
  const file = document.querySelector('#file');

  file.addEventListener('change', function(){
    const choosedFile = this.files[0];

    if(choosedFile){
      const reader = new FileReader();

      reader.addEventListener('load', function(){
        img.setAttribute('src', reader.result);
      });

      reader.readAsDataURL(choosedFile);
    }
  });
</script>

<script>
	function myFun() {
		var x = document.getElementById("myInput");
		var y = document.getElementById("hide1");
		var z = document.getElementById("hide2");

		if(x.type === 'password'){
			x.type = "text";
			y.style.display = "block";
			z.style.display = "none";
		}
		else{
			x.type = "password";
			y.style.display = "none";
			z.style.display = "block";
		}
	}
</script>

<script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>