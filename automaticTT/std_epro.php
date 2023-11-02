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
	<link rel="stylesheet" type="text/css" href="std_epro.css">
	<title>Edit Profile</title>
</head>
<body>
	<div class="nav">
      <div class="menuToggle"></div>
      <ul>
          <li class="list active" style="--clr:#8FE9FF;">
              <a href="std_prof.php">
                  <span class="icon">
                    <ion-icon name="person-outline"></ion-icon>
                  </span>
                  <span class="text">Profile</span>
              </a>
          </li>
          <li class="list" style="--clr:#8FE9FF;">
              <a href="std_time.php">
                  <span class="icon">
                      <ion-icon name="calendar-outline"></ion-icon>
                  </span>
                  <span class="text">Time Table</span>
              </a>
          </li>
          <li class="list" style="--clr:#8FE9FF;">
              <a href="std_logout.php">
                  <span class="icon">
                    <ion-icon name="log-out-outline"></ion-icon>
                  </span>
                  <span class="text">Logout</span>
              </a>
          </li>
      </ul>
    </div>

    <div class="div">
      <h1 class="h1">Edit Profile</h1>
    </div>

    <div class="box">
        <form method="post" enctype="multipart/form-data">
          <button type="button" class="btn1">
            <ion-icon name="camera-outline"></ion-icon>
            <input type="file" id="file" name="img1" accept=".jpg, .jpeg, .png">
          </button>
      <?php
        if(empty($raw['std_pic'])){
      ?>
        <img class="img" src="img/user.png">
      <?php
      }
      else{
        ?>
        <img class="img" src="img/<?php echo $raw['std_pic'];?>">
      <?php
      }
      ?>

      <table class="content-table">
        <tr>
            <td>First Name</td>
            <td>:</td>
            <td><div class="input-field"><input type="text" name="fname" value="<?php echo $raw['std_fname'];?>"/></div></td>
        </tr>
        <tr>
            <td>Last Name</td>
            <td>:</td>
            <td><div class="input-field"><input type="text" name="lname" value="<?php echo $raw['std_lname'];?>"/></div></td>
        </tr>
        <tr>
            <td>Email</td>
            <td>:</td>
            <td><div class="input-field"><input type="email" name="email" value="<?php echo $raw['std_email'];?>"/></div></td>
        </tr>
        <tr>
            <td>Enrollment No.</td>
            <td>:</td>
            <td><?php echo $raw['std_enrno'];?></td>
        </tr>
        <tr>
            <td>Password</td>
            <td>:</td>
            <td>
            <div class="input-field"><input type="password" name="pass" id="myInput" value="<?php echo $raw['std_pass']; ?>"/>
            <span class="eye" onclick="myFun()">
                <ion-icon id="hide1" name="eye"></ion-icon>
                <ion-icon id="hide2" name="eye-off"></ion-icon>
                </span>
            </div></td>
        </tr>
        <tr>
            <td>Mobile</td>
            <td>:</td>
            <td><div class="input-field"><input type="text" name="mob" value="<?php echo $raw['std_mob'];?>"/></div></td>
        </tr>
        <tr>
            <td>Address</td>
            <td>:</td>
            <td><div class="input-field"><input type="text" name="add" value="<?php echo $raw['std_add'];?>"/></div></td>
        </tr>
        <tr>
            <td>Gender</td>
            <td>:</td>
            <td><div class="input-field"><input type="text" name="g" value="<?php echo $raw['std_gender'];?>"/></div></td>
        </tr>
        <tr>
            <td>Birth Date</td>
            <td>:</td>
            <td><div class="input-field"><input type="date" name="dob" value="<?php echo $raw['std_dob'];?>"/></div></td>
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
            <td colspan="3"><input type="submit" value="Update" class="btn" name="submit" /></td>
        </tr>
      </table>
    </form>
    </div>

    <?php
      if(isset($_POST['submit'])){
        $mi=$_FILES['img1']['name'];
        $tm=$_FILES['img1']['tmp_name'];
        $s=$_FILES['img1']['size'];
        $id=$raw['std_id'];
        $fn=$_POST['fname'];
        $ln=$_POST['lname'];
        $em=$_POST['email'];
        $pa=$_POST['pass'];
        $mob=$_POST['mob'];
        $add=$_POST['add'];
        $g=$_POST['g'];
        $dob=$_POST['dob'];
    
        move_uploaded_file($tm, 'img/'.$mi);
        if(empty($raw['std_pic'])){
          $u="UPDATE student SET std_fname='$fn',std_lname='$ln',std_email='$em',std_pass='$pa',std_mob='$mob',std_add='$add',std_gender='$g',std_dob='$dob',std_pic='$mi' WHERE std_id='$id'";
    
          mysqli_query($con,$u);
          echo "<script type='text/javascript'>alert('Profile Updated');document.location='std_prof.php'</script>";
        }
        else if(empty($mi)){
          $u="UPDATE student SET std_fname='$fn',std_lname='$ln',std_email='$em',std_pass='$pa',std_mob='$mob',std_add='$add',std_gender='$g',std_dob='$dob' WHERE std_id='$id'";
    
          mysqli_query($con,$u);
          echo "<script type='text/javascript'>alert('Profile Updated');document.location='std_prof.php'</script>";
        }
        else{
          $u="UPDATE student SET std_fname='$fn',std_lname='$ln',std_email='$em',std_pass='$pa',std_mob='$mob',std_add='$add',std_gender='$g',std_dob='$dob',std_pic='$mi' WHERE std_id='$id'";
    
          mysqli_query($con,$u);
          echo "<script type='text/javascript'>alert('Profile Updated');document.location='std_prof.php'</script>";
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