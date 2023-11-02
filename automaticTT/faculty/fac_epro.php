<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="fac_epro.css">
	<title>Edit Profile</title>
</head>
<body>
	<div class="nav">
      <div class="menuToggle"></div>
      <ul>
          <li class="list active" style="--clr:#FFBE9D;">
              <a href="fac_prof.php">
                  <span class="icon">
                    <ion-icon name="person-outline"></ion-icon>
                  </span>
                  <span class="text">Profile</span>
              </a>
          </li>
          <li class="list" style="--clr:#FFBE9D;">
              <a href="schedule.php">
                  <span class="icon">
                      <ion-icon name="calendar-outline"></ion-icon>
                  </span>
                  <span class="text">Schedule</span>
              </a>
          </li>
          <li class="list" style="--clr:#FFBE9D;">
              <a href="fac_logout.php">
                  <span class="icon">
                    <ion-icon name="log-out-outline"></ion-icon>
                  </span>
                  <span class="text">Logout</span>
              </a>
          </li>
      </ul>
    </div>

      <?php
        session_start();

        $con=mysqli_connect('localhost','root','','atc');

        $q=mysqli_query($con, "select * from faculty where fac_email='$_SESSION[email]'");
        $raw=mysqli_fetch_assoc($q);
        $dep=$raw['dep_id'];
        $sem=$raw['sem_id'];
        $sub=$raw['sub_id'];
        $q1=mysqli_query($con, "select * from department where dep_id=$dep");
        $raw1=mysqli_fetch_assoc($q1);
        $q2=mysqli_query($con, "select * from semester where sem_id=$sem");
        $raw2=mysqli_fetch_assoc($q2);
        $q3=mysqli_query($con, "select * from subject where sub_id=$sub");
        $raw3=mysqli_fetch_assoc($q3);
      ?>

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
        if(empty($raw['fac_pic'])){
      ?>
        <img class="img" src="../img/user.png">
      <?php
      }
      else{
        ?>
        <img class="img" src="fimg/<?php echo $raw['fac_pic'];?>">
      <?php
      }
      ?>

    <table class="content-table">
        <tr>
            <td>Name</td>
            <td>:</td>
            <td><div class="input-field"><input type="text" name="name" value="<?php echo $raw['fac_name'];?>"/></div></td>
        </tr>
        <tr>
            <td>Email</td>
            <td>:</td>
            <td><div class="input-field"><input type="email" name="email" value="<?php echo $raw['fac_email'];?>"/></div></td>
        </tr>
        <tr>
            <td>Password</td>
            <td>:</td>
            <td>
            <div class="input-field"><input type="password" name="pass" id="myInput" value="<?php echo $raw['fac_pass'];?>"/>
            <span class="eye" onclick="myFun()">
                <ion-icon id="hide1" name="eye"></ion-icon>
                <ion-icon id="hide2" name="eye-off"></ion-icon>
                </span>
            </div></td>
        </tr>
        <tr>
            <td>Mobile</td>
            <td>:</td>
            <td><div class="input-field"><input type="text" name="mob" value="<?php echo $raw['fac_mob'];?>"/></div></td>
        </tr>
        <tr>
            <td>Address</td>
            <td>:</td>
            <td><div class="input-field"><input type="text" name="add" value="<?php echo $raw['fac_add'];?>"/></div></td>
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
            <td>Subject</td>
            <td>:</td>
            <td><?php echo $raw3['sub_name'];?></td>
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
        $id=$raw['fac_id'];
        $fn=$_POST['name'];
        $em=$_POST['email'];
        $pa=$_POST['pass'];
        $mob=$_POST['mob'];
        $add=$_POST['add'];
    
        move_uploaded_file($tm, 'fimg/'.$mi);
        if(empty($raw['fac_pic'])){
            $u="UPDATE faculty SET fac_name='$fn',fac_email='$em',fac_pass='$pa',fac_mob='$mob',fac_add='$add',fac_pic='$mi' WHERE fac_id='$id'";
      
            mysqli_query($con,$u);
            echo "<script type='text/javascript'>alert('Profile Updated');document.location='fac_prof.php'</script>";
          }
          if(empty($mi)){
              $u="UPDATE faculty SET fac_name='$fn',fac_email='$em',fac_pass='$pa',fac_mob='$mob',fac_add='$add' WHERE fac_id='$id'";
      
            mysqli_query($con,$u);
            echo "<script type='text/javascript'>alert('Profile Updated');document.location='fac_prof.php'</script>";
          }
          else{
              $u="UPDATE faculty SET fac_name='$fn',fac_email='$em',fac_pass='$pa',fac_mob='$mob',fac_add='$add',fac_pic='$mi' WHERE fac_id='$id'";
      
            mysqli_query($con,$u);
            echo "<script type='text/javascript'>alert('Profile Updated');document.location='fac_prof.php'</script>";
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