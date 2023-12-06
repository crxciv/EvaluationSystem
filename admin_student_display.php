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
          <h3>All Student Info</h3>
        </div>

        <div class="div-container view-student-div">
          <table class="student-view-table table-bordered table">
            <thead >
              <tr >
                <th>Name</th>
                <th>Student No.</th>
                <th>Program</th>
                <th>Department</th>
                <th>Email</th>
                <th>Password</th>
              </tr>
            </thead>
            <tbody>
            <?php 
              $select_user = mysqli_query($conn, "SELECT * FROM `user` WHERE user_type = 'user'") or die ('query failed');
              if(mysqli_num_rows($select_user)>0){
                while($fetch_user = mysqli_fetch_assoc($select_user)){
            ?>
            <tr>
                <td><?php echo $fetch_user['name'] ?></td>
                <td><?php echo $fetch_user['student_num'] ?></td>
                <td><?php echo $fetch_user['program'] ?></td>
                <td><?php echo $fetch_user['department'] ?></td>
                <td><?php echo $fetch_user['email'] ?></td>
                <td><?php echo $fetch_user['password'] ?></td>
              </tr>
            <?php 
              }
                  }else{
                      echo '
                      <div class="container text-center" style="padding: 100px;">
                          <h1>No Messages Available</h1>
                      </div>
                      ';  
                  }
              ?> 
              
            </tbody>
          </table>
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
