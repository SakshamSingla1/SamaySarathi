<?php
    session_start();

    $con=mysqli_connect('localhost','root','','atc');
    $id = mysqli_real_escape_string($con,$_GET['ID']);

    $q=mysqli_query($con,"select * from faculty where fac_id='$id'");
    $raw=mysqli_fetch_assoc($q);
    $dep=$raw['dep_id'];
    $sem=$raw['sem_id'];
    $sub=$raw['sub_id'];
    $image=$raw['fac_pic'];
    $q1=mysqli_query($con, "select * from department where dep_id=$dep");
    $raw1=mysqli_fetch_assoc($q1);
    $q2=mysqli_query($con, "select * from semester where sem_id=$sem");
    $raw2=mysqli_fetch_assoc($q2);
    $q3=mysqli_query($con, "select * from subject where sub_id=$sub");
    $raw3=mysqli_fetch_assoc($q3);
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="update_fac.css">
	<title>Update Faculty</title>
</head>
<body>
	<div class="nav">
      <div class="menuToggle"></div>
      <ul>
          <li class="list" style="--clr:#8FE9FF;">
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
          <li class="list active" style="--clr:#8FE9FF;">
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
      <h1 class="h1">Update Faculty</h1>
    </div>

    <div class="box">
        <form method="post" enctype="multipart/form-data">
          <button type="button" class="btn1">
            <ion-icon name="camera-outline"></ion-icon>
            <input type="file" id="file" name="img1" accept=".jpg, .jpeg, .png">
          </button>
      <?php
        if(empty($image)){
      ?>
        <img class="img" src="../img/user.png">
      <?php
      }
      else{
        ?>
        <img class="img" src="../faculty/fimg/<?php echo $image?>">
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
            <td><div class="input-field">
                <select id="department" name="department">
                <option value="Department" disabled selected><?php echo $raw1['dep_name'];?></option>
                <?php
                $dep="SELECT DISTINCT dep_id,dep_name FROM department group by dep_name order by dep_id";
                $q=mysqli_query($con, $dep);
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
                    <option value="Semester" disabled selected><?php echo $raw2['sem_name'];?></option>
                </select>
            </div></td>
        </tr>
        <tr>
            <td>Subject</td>
            <td>:</td>
            <td><div class="input-field">
                <select id="subject" name="subject">
                    <option value="Subject" disabled selected><?php echo $raw3['sub_name'];?></option>
                </select>
            </div></td>
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
        $fn=$_POST['name'];
        $em=$_POST['email'];
        $pa=$_POST['pass'];
        $mob=$_POST['mob'];
        $add=$_POST['add'];
        $dep=$_POST['department'];
        $sem=$_POST['semester'];
        $sub=$_POST['subject'];
    
        move_uploaded_file($tm, '../faculty/fimg/'.$mi);
        if(empty($raw['fac_pic'])){
          $u="UPDATE faculty SET fac_name='$fn',fac_email='$em',fac_pass='$pa',fac_mob='$mob',fac_add='$add',fac_pic='$mi' WHERE fac_id='$id'";
    
          mysqli_query($con,$u);
          echo "<script type='text/javascript'>alert('Profile Updated');document.location='faculty.php'</script>";
        }
        if(empty($mi)){
            $u="UPDATE faculty SET fac_name='$fn',fac_email='$em',fac_pass='$pa',fac_mob='$mob',fac_add='$add',dep_id='$dep',sem_id='$sem',sub_id='$sub' WHERE fac_id='$id'";
    
          mysqli_query($con,$u);
          echo "<script type='text/javascript'>alert('Profile Updated');document.location='faculty.php'</script>";
        }
        else if(empty($dep) || empty($sem) || empty($sub)){
            $u="UPDATE faculty SET fac_name='$fn',fac_email='$em',fac_pass='$pa',fac_mob='$mob',fac_add='$add',fac_pic='$mi' WHERE fac_id='$id'";
      
            mysqli_query($con,$u);
            echo "<script type='text/javascript'>alert('Profile Updated');document.location='faculty.php'</script>";
          }
        else{
            $u="UPDATE faculty SET fac_name='$fn',fac_email='$em',fac_pass='$pa',fac_mob='$mob',fac_add='$add',dep_id='$dep',sem_id='$sem',sub_id='$sub',fac_pic='$mi' WHERE fac_id='$id'";
    
          mysqli_query($con,$u);
          echo "<script type='text/javascript'>alert('Profile Updated');document.location='faculty.php'</script>";
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

<script type="text/javascript">
    $(document).ready(function(){
        $("#semester").change(function(){
            var sid = $("#semester").val();
            $.ajax({
                url: 'data1.php',
                method: 'POST',
                data: {sID:sid},
                success:function(data){
                    $('#subject').html(data);
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