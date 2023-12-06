<?php
  include  'connection.php';
  session_start();
  if(isset($_POST['login-btn'])){
    
    $filter_email = filter_var($_POST['email'], FILTER_SANITIZE_STRING);
    $email = mysqli_real_escape_string($conn, $filter_email);

    $filter_password = filter_var($_POST['password'], FILTER_SANITIZE_STRING);
    $password = mysqli_real_escape_string($conn, $filter_password);

    $select_user = mysqli_query($conn, "SELECT * FROM `user` WHERE email = '$email' AND password = '$password'") or die ('query failed');

    if(mysqli_num_rows($select_user)>0){
      $row = mysqli_fetch_assoc($select_user);
      if($row['user_type'] == 'admin') {
        $_SESSION['admin_name'] = $row['name'];
        $_SESSION['admin_email'] = $row['email'];
        $_SESSION['admin_id'] = $row['id'];
        $id = $_SESSION['id'];
        sleep(1);
        header('location:admin_home.php');

      }else if($row['user_type'] == 'user') {
        $_SESSION['user_name'] = $row['name'];
        $_SESSION['user_email'] = $row['email'];
        $_SESSION['user_id'] = $row['id'];
        sleep(3);
        header('location:student_home.php');
        
      }else if($row['user_type'] == 'professor') {
        $_SESSION['prof_name'] = $row['name'];
        $_SESSION['prof_email'] = $row['email'];
        $_SESSION['prof_id'] = $row['id'];
        sleep(3);
        header('location:professor_home.php');
      }else{
      $message[]= 'Incorrect email or password';
      }   
    }
  }
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <link rel="icon" href="Resources/NULOGO.webp" type="image/x-icon" />
    <link rel="icon" href="Resources/silakbologo.png" type="image/x-icon" />
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ"
      crossorigin="anonymous"
    />
    <script
      src="https://kit.fontawesome.com/8a364c3095.js"
      crossorigin="anonymous"
    ></script>
    <style>
      @import url("https://fonts.googleapis.com/css2?family=Arsenal&family=Poiret+One&family=Rajdhani:wght@300&display=swap");
    </style>
    <link rel="stylesheet" type="text/css" href="Src/style.css" />
    <title>Login</title>
  </head>
  <body>
    <div
      class="container d-flex justify-content-center align-items-center min-vh-100"
    >
      <div class="row border rounded-5 p-3 bg-white shadow box-area">
        <div
          class="col-md-6 rounded-4 d-flex justify-content-center align-items-center flex-column left-box"
          style="background: #35408e"
        >
          <div class="featured-image mb-3">
            <img
              src="Resources/NULOGO.webp"
              class="img-fluid"
              style="width: 250px"
            />
          </div>
        </div>
        <div class="col-md-6 right-box">
          <form method="post">
            <div class="row align-items-center">
              <div class="header-text mb-4">
                <h2>Login</h2>
                <p>Welcome Back Nationalians!</p>
              </div>
              <div class="input-group mb-3">
                <input
                  name="email"
                  type="text"
                  class="form-control form-control-lg bg-light fs-6"
                  placeholder="Email address"
                  required
                />
              </div>
              <div class="input-group mb-3">
                <input
                  name="password"
                  type="password"
                  class="form-control form-control-lg bg-light fs-6"
                  placeholder="Password"
                  required
                />
              </div>

              <div class="input-group mb-5 d-flex justify-content-between">
                <div class="form-check">
                  <input
                    type="checkbox"
                    class="form-check-input"
                    id="formCheck"
                  />
                  <label for="formCheck" class="form-check-label text-secondary"
                    ><small>Remember Me</small></label
                  >
                </div>
                <div class="forgot">
                  <small><a href="#">Forgot Password?</a></small>
                </div>
              </div>
              <div class="input-groups">
              <?php
                    if(isset($message)){
                      foreach ($message as $message) {
                      echo'
                          <div class="alert alert-danger" role="alert text-center "  >
                          '.$message.'
                          </div>
                        ';
                      }
                    }
                ?>
              </div>
              <div class="input-group mb-3">
                <button
                  name="login-btn"
                  class="btn btn-lg btn-primary w-100 fs-6"
                >
                  Login
                </button>
              </div>
              <div class="input-group mb-3">

              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
    <script src="Src/main.js"></script>
    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe"
      crossorigin="anonymous"
    ></script>
  </body>
</html>
