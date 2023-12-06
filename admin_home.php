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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <title>NU | Evaluation</title>
    <link rel="stylesheet" href="Src/style.css" />
  </head>
  <body>
    <div class="containers">
      <div class="navigation">
        <ul>
          <li>
            <a href="#" class="icon">
              <img
                src="Resources/NULOGO.webp"
                width="60px"
                style="padding-top: 10px"
              />
              <div class="admin-users-info">
                <span class="title"><?php echo $_SESSION['admin_name']; ?></span>
              </div>
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
        <div class="cardBox">
        <div class="cards">
            <div>
              <?php 
                    $select_user = mysqli_query($conn, "SELECT * FROM `user` WHERE user_type = 'admin'") or die ('query failed');
                    $num_of_user = mysqli_num_rows($select_user);
                ?>
              <div class="numbers"><?php echo $num_of_user; ?></div>
              <div class="cardName">Admin</div>
            </div>
            <div class="iconBx">
              <ion-icon name="person-outline"></ion-icon>
            </div>
          </div>
          <div class="cards">
            <div>
              <?php 
                  $select_admin = mysqli_query($conn, "SELECT * FROM `user` WHERE user_type = 'user'") or die ('query failed');
                  $num_of_admin = mysqli_num_rows($select_admin);
                ?>
              <div class="numbers"><?php echo $num_of_admin; ?></div>
              <div class="cardName">Students</div>
            </div>
            <div class="iconBx">
              <ion-icon name="people-outline"></ion-icon>
            </div>
          </div>

          <div class="cards">
            <div>
              <?php 
                  $select_prof = mysqli_query($conn, "SELECT * FROM `user` WHERE user_type = 'professor'") or die ('query failed');
                  $num_of_prof = mysqli_num_rows($select_prof);
                ?>
              <div class="numbers"><?php echo $num_of_prof; ?></div>
              <div class="cardName">Professor</div>
            </div>
            <div class="iconBx">
              <ion-icon name="book-outline"></ion-icon>
            </div>
          </div>

          <div class="cards">
            <div>
                <?php 
                  $select_question = mysqli_query($conn, "SELECT * FROM `evaluation`") or die ('query failed');
                  $num_of_question = mysqli_num_rows($select_question);
                ?> 
              <div class="numbers"><?php echo $num_of_question; ?></div>
              <div class="cardName">Questions</div>
            </div>

            <div class="iconBx">
              <ion-icon name="chatbubbles-outline"></ion-icon>
            </div>
          </div>

          <div class="cards">
            <div>
              <div class="numbers">0</div>
              <div class="cardName">SCS</div>
            </div>

            <div class="iconBx">
              <ion-icon name="receipt-outline"></ion-icon>
            </div>
          </div>
          <div class="cards">
            <div>
              <div class="numbers">0</div>
              <div class="cardName">SABM</div>
            </div>

            <div class="iconBx">
              <ion-icon name="receipt-outline"></ion-icon>
            </div>
          </div>
          <div class="cards">
            <div>
              <div class="numbers">0</div>
              <div class="cardName">SAS</div>
            </div>

            <div class="iconBx">
              <ion-icon name="receipt-outline"></ion-icon>
            </div>
          </div>
          <div class="cards">
            <div>
              <div class="numbers">0</div>
              <div class="cardName">SEA</div>
            </div>

            <div class="iconBx">
              <ion-icon name="receipt-outline"></ion-icon>
            </div>
          </div>
        </div>
        <div class="details">
          <div class="recentOrders">
            <div class="cardHeader">
              <h2>Accounts</h2>
            </div>
            <table>
              <thead>
                <tr>
                  <td>Name</td>
                  <td>Email</td>
                  <td>Password</td>
                  <td>User Type</td>
                </tr>
              </thead>
              <tbody>
              <?php 
                  $select_user = mysqli_query($conn, "SELECT * FROM `user` ORDER BY user_type ASC") or die ('query failed');
                  if(mysqli_num_rows($select_user)>0){
                    while($fetch_user = mysqli_fetch_assoc($select_user)){
              ?>
                <tr>
                  <td><?php echo $fetch_user['name']; ?></td>
                  <td><?php echo $fetch_user['email']; ?></td>
                  <td><?php echo $fetch_user['password']; ?></td>
                  <td><?php echo $fetch_user['user_type']; ?></td>
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
    </div>
    <script src="Src/main.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
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
