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
	<link rel="stylesheet" type="text/css" href="add_std.css">
	<title>Add Student</title>
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
          <li class="list active" style="--clr:#86C6EA;">
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
      <h1 class="h1">Add Student</h1>
    </div>

    <div class="box">
        <form method="post" enctype="multipart/form-data">
          <button type="button" class="btn1">
            <ion-icon name="camera-outline"></ion-icon>
            <input type="file" id="file" name="img1" accept=".jpg, .jpeg, .png">
          </button>
          
        <img class="img" src="../img/user.png">

      <table class="content-table">
        <tr>
            <td>First Name</td>
            <td>:</td>
            <td><div class="input-field"><input type="text" name="fname" placeholder="Enter First Name"/></div></td>
        </tr>
        <tr>
            <td>Last Name</td>
            <td>:</td>
            <td><div class="input-field"><input type="text" name="lname" placeholder="Enter Last Name"/></div></td>
        </tr>
        <tr>
            <td>Email</td>
            <td>:</td>
            <td><div class="input-field"><input type="email" name="email" placeholder="Enter Email"/></div></td>
        </tr>
        <tr>
            <td>Enrollment No.</td>
            <td>:</td>
            <td><div class="input-field"><input type="text" name="en" placeholder="Enter Enrollment No."/></div></td>
        </tr>
        <tr>
            <td>Password</td>
            <td>:</td>
            <td>
            <div class="input-field"><input type="password" name="pass" id="myInput" placeholder="Enter Password"/>
            <span class="eye" onclick="myFun()">
                <ion-icon id="hide1" name="eye"></ion-icon>
                <ion-icon id="hide2" name="eye-off"></ion-icon>
                </span>
            </div></td>
        </tr>
        <tr>
            <td>Mobile</td>
            <td>:</td>
            <td><div class="input-field"><input type="text" name="mob" placeholder="Enter Mobile No."/></div></td>
        </tr>
        <tr>
            <td>Address</td>
            <td>:</td>
            <td><div class="input-field"><input type="text" name="add" placeholder="Enter Address"/></div></td>
        </tr>
        <tr>
            <td>Gender</td>
            <td>:</td>
            <td><div class="input-field">
              <select name="g">
                  <option value="Gender" disabled selected>Select Gender</option>
                  <option value="Male">Male</option>
                  <option value="Female">Female</option>
              </select>  
            </div></td>
        </tr>
        <tr>
            <td>Birth Date</td>
            <td>:</td>
            <td><div class="input-field"><input type="date" name="dob" placeholder="Enter Birth Date"/></div></td>
        </tr>
        <tr>
            <td>Department</td>
            <td>:</td>
            <td><div class="input-field">
                <select id="department" name="department">
                <option value="Department" disabled selected>Department</option>
                <?php
                    while($n=mysqli_fetch_array($q)){
                ?>
                <option id="<?php echo $n['dep_id']?>" value="<?php echo $n['dep_id']?>"><?php echo $n['dep_name']?></option>
                <?php } 
                ?>
                </select>
            </div></td>
        </tr>
        <tr>
            <td>Semester</td>
            <td>:</td>
            <td><div class="input-field">
                <select id="semester" name="semester">
                    <option value="Semester" disabled selected>Semester</option>
                </select>
            </div></td>
        </tr>
        <tr>
            <td>Division</td>
            <td>:</td>
            <td><div class="input-field"><input type="text" name="div" placeholder="Enter Division"/></div></td>
        </tr>
        <tr>
            <td colspan="3"><input type="submit" value="Add" class="btn" name="submit" /></td>
        </tr>
      </table>
    </form>
    </div>

    <?php
      if(isset($_POST['submit'])){
        $mi=$_FILES['img1']['name'];
        $tm=$_FILES['img1']['tmp_name'];
        $s=$_FILES['img1']['size'];
        $fn=$_POST['fname'];
        $ln=$_POST['lname'];
        $em=$_POST['email'];
        $en=$_POST['en'];
        $pa=$_POST['pass'];
        $mob=$_POST['mob'];
        $add=$_POST['add'];
        $g=$_POST['g'];
        $dob=$_POST['dob'];
        $dep=$_POST['department'];
        $sem=$_POST['semester'];
        $div=$_POST['div'];

    
        move_uploaded_file($tm, '../img/'.$mi);
        if(empty($fn) || empty($ln) || empty($em) || empty($en) || empty($pa) || empty($mob) || empty($add) || empty($g) || empty($dob) || empty($div) || empty($sem) || empty($div)){
          echo "<script type='text/javascript'>alert('Please Enter All Details!!');document.location='add_std.php'</script>";
        }else{
          $u="insert into student(std_fname,std_lname,std_email,std_enrno,std_pass,std_mob,std_add,std_gender,dep_id,sem_id,std_div,std_dob,std_pic) values('$fn','$ln','$em','$en','$pa','$mob','$add','$g','$dep','$sem','$div','$dob','$mi')";
    
          mysqli_query($con,$u);
          echo "<script type='text/javascript'>alert('Student Added Successfuly!!');document.location='student.php'</script>";
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