<?php
    include 'connection.php';
    session_start();
    $admin_id = $_SESSION['admin_name'];

    if (!isset($admin_id)){
        header('location:index.php');
    }

    if (isset($_POST['logout'])){
        session_destroy();
        header('location:index.php');
    }
    if(isset($_POST['add'])){
        $filter_name = filter_var($_POST['lname'].', ' .$_POST['fname'], FILTER_SANITIZE_STRING);
        $name = mysqli_real_escape_string($conn, $filter_name);

        $filter_student_num = filter_var($_POST['sid'], FILTER_SANITIZE_STRING);
        $student_num = mysqli_real_escape_string($conn, $filter_student_num);

        $filter_program = filter_var($_POST['program'], FILTER_SANITIZE_STRING);
        $program = mysqli_real_escape_string($conn, $filter_program);

        $filter_department = filter_var($_POST['dept'], FILTER_SANITIZE_STRING);
        $department = mysqli_real_escape_string($conn, $filter_department);
    
        $filter_email = filter_var($_POST['email'], FILTER_SANITIZE_STRING);
        $email = mysqli_real_escape_string($conn, $filter_email);
    
        $filter_password = filter_var($_POST['password'], FILTER_SANITIZE_STRING);
        $password = mysqli_real_escape_string($conn, $filter_password);
    
        $filter_cpassword = filter_var($_POST['cpassword'], FILTER_SANITIZE_STRING);
        $cpassword = mysqli_real_escape_string($conn, $filter_cpassword);
  
        $filter_user_type = filter_var($_POST['user_type'], FILTER_SANITIZE_STRING);
        $user_type = mysqli_real_escape_string($conn, $filter_user_type);
    
        $select_user = mysqli_query($conn, "SELECT * FROM `user` WHERE email = '$email'") or die ('query failed');
    
        if(mysqli_num_rows($select_user)>0){
          $message[] = 'Student Already Exist';
    
        }else{
          if ($password != $cpassword){
            $message[] = 'Password Not Match';
          }else{
            mysqli_query($conn, "INSERT INTO `user` (`name`, `student_num`, `program`, `department`, `email` , `password`, `user_type`) VALUES ('$name','$student_num', '$program', '$department', '$email', '$password', '$user_type' )") or die ('query failed');
            $message[] = 'Professor Added Successfully';
            sleep(3);
            header('location:admin_setting_display.php');
          }
        }
      }
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <link rel="icon" href="Resources/NULOGO.webp" type="image/x-icon" />
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>NU | Evaluation</title>
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN"
      crossorigin="anonymous"
    />
    <link rel="stylesheet" href="Src/style.css" />
  </head>
  <body>
    <div class="containers">
      <div class="navigation">
        <ul>
          <li>
            <a href="admin_home.php" class="icon">
              <img
                src="Resources/NULOGO.webp"
                width="60px"
                style="padding-top: 10px"
              />
              <span class="title"><?php echo $_SESSION['admin_name']; ?></span>
            </a>
          </li>
          <li>
            <a href="admin_home.php">
              <span class="icon">
                <ion-icon name="home-outline"></ion-icon>
              </span>
              <span class="title">Dashboard</span>
            </a>
          </li>
          <li>
            <a href="admin_students.php">
              <span class="icon">
                <ion-icon name="people-outline"
                  ></ion-icon
                >
              </span>
              <span class="title">Students</span>
            </a>
          </li>
          <li>
            <a href="admin_participant.php">
              <span class="icon">
                <ion-icon name="person-outline"></ion-icon> 
                  </ion-icon
                >
              </span>
              <span class="title">Participant</span>
            </a>
          </li>
          <li>
            <a href="admin_questions.php">
              <span class="icon">
                <ion-icon name="chatbubble-outline"></ion-icon>
              </span>
              <span class="title">Questions</span>
            </a>
          </li>
          <li>
            <a href="admin_summary.php">
              <span class="icon">
                <ion-icon name="school-outline"></ion-icon>
              </span>
              <span class="title">Summary</span>
            </a>
          </li>
          <li>
            <a href="admin_setting.php">
              <span class="icon">
                <ion-icon name="lock-closed-outline"></ion-icon>
              </span>
              <span class="title">Admin</span>
            </a>
          </li>
          <li>
            <form method="post">
              <button href="index.php" name="logout" type="submit">
                <span class="icon">
                  <ion-icon name="log-out-outline"></ion-icon>
                </span>
                <span class="title">Logout</span>
              </button>
            </form>
          </li>
        </ul>
      </div>
      <div class="main">
        <div class="topbar">
          <div class="toggle">
            <ion-icon name="menu-outline"></ion-icon>
          </div>
        </div>
        <div class="div-container student-div d-flex">
          <button class="btn" onclick="history.back()">
            <ion-icon name="caret-back-outline"></ion-icon>
          </button>
          <h3>Add Admin</h3>
        </div>
        <div class="div-container add-user-div">
          <form method="post">
            <input hidden name="sid" value="none">
            <input hidden name="program" value="none">
            <input hidden name="dept" value="none">
            <input hidden name="user_type" value="admin" >
            <div class="row">
              <div class="col-lg-12 col-sm-12 ">
                <label for="fname">First Name: </label>
                <input
                  class="form-control"
                  type="text"
                  name="fname"
                  id="name"
                  placeholder="Juan"
                  required
                />
              </div>
              <div class="col-lg-12 col-sm-12 ">
                <label for="lname">Last Name: </label>
                <input
                  class="form-control"
                  type="text"
                  name="lname"
                  id="lname"
                  placeholder="Dela Cruz"
                  required
                />
              </div>
              <div class="col-lg-12 col-sm-12">
                <label for="email">Email: </label>
                <input
                  class="form-control"
                  type="text"
                  name="email"
                  id="email"
                  placeholder="delacruzj@students.nu-laguna.edu.ph"
                  required
                />
              </div>
              <div class="col-lg-12 col-sm-12">
                <label for="pass">Password: </label>
                <input
                  class="form-control"
                  type="text"
                  name="password"
                  id="pass"
                  required
                />
              </div>
              <div class="col-lg-12 col-sm-12">
                <label for="cpass">Password: </label>
                <input
                  class="form-control"
                  type="text"
                  name="cpassword"
                  id="cpass"
                  required
                />
              </div>
              <?php
                    if(isset($message)){
                      foreach ($message as $message) {
                      echo'
                          <div class="alert alert-danger" role="alert text-center  "  style=" margin-top: 20px" >
                          '.$message.'
                          </div>
                        ';
                      }
                    }
                ?>
              <div class="text-center addstudent-btn">
                <button class="btn btn-outline-success" name="add">ADD ADMIN</button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
    <script src="Src/main.js"></script>
    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
      crossorigin="anonymous"
    ></script>
    <script
      type="module"
      src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"
    ></script>
    <script
      nomodule
      src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"
    ></script>
  </body>
</html>
