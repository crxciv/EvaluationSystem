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
    if(isset($_GET['delete'])){
        $delete_id = $_GET['delete'];
        mysqli_query($conn, "DELETE FROM `user` WHERE id = '$delete_id'") or die ('query failed');
        $message[] = 'Professor removed successfuly';
        header('location:admin_participant_display.php');
    }
    if(isset($_POST['edit'])){
        $update_id = $_POST['update-id'];
        $update_name = $_POST['update-name'];
        $update_sid = $_POST['update-sid'];
        $update_program = $_POST['update-program'];
        $update_dept = $_POST['update-dept'];
        $update_email = $_POST['update-email'];
        $update_password = $_POST['update-password'];
        $update_user =  $_POST['update-user'];
        $update_query = mysqli_query($conn, "UPDATE `user` SET `id` = '$update_id',  `name` = '$update_name', `student_num`= '$update_sid', `program`= '$update_program', `department` = '$update_dept', `email` = '$update_email', `password` = '$update_password', `user_type` = '$update_user'  WHERE id = '$update_id' ") or die ('query failed');
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
          <h3>All Professor Info</h3>
        </div>
        <?php
        if(isset($_GET['edit'])){
            $edit_id = $_GET['edit'];
            $edit_query = mysqli_query($conn, "SELECT * FROM `user` WHERE id = '$edit_id'") or die ('query failed');

            if(mysqli_num_rows($edit_query)>0){
                while($fetch_edit = mysqli_fetch_assoc($edit_query)){
        ?>
            <div class="div-container add-student-div">
            <form method="post">
                <div class="row">
                    <input type="hidden" name="update-id" value="<?php echo $fetch_edit['id']; ?>">
                    <input type="hidden" name="update-user" value="<?php echo $fetch_edit['user_type']; ?>">
                    <input type="hidden" name="update-sid" value="<?php echo $fetch_edit['student_num']; ?>">
                    <input type="hidden" name="update-dept" value="<?php echo $fetch_edit['department']; ?>">
                    <input type="hidden" name="update-program" value="<?php echo $fetch_edit['program']; ?>">
                    <div class="col-lg-12 col-md-12 col-sm-12">
                        <label for="fname">Full Name: </label>
                        <input
                        class="form-control"
                        type="text"
                        name="update-name"
                        id="name"
                        value="<?php echo $fetch_edit['name'] ?>"
                        required
                        />
                    </div>
                    <div class="col-lg-12 col-md-12 col-sm-12">
                        <label for="email">Email: </label>
                        <input
                        class="form-control"
                        type="text"
                        name="update-email"
                        id="email"
                        value="<?php echo $fetch_edit['email'] ?>"
                        required
                        />
                    </div>
                    <div class="col-lg-12 col-md-12 col-sm-12">
                        <label for="pass">Password: </label>
                        <input
                        class="form-control"
                        type="text"
                        name="update-password"
                        id="pass"
                        value="<?php echo $fetch_edit['password'] ?>"
                        required
                        />
                    </div>
                    <div class="col-lg-12 col-md-12 col-sm-12">
                        <label for="dept">Department: </label>
                        <select name="update-dept" id="dept" class="form-control" required>
                            <option value="<?php echo $fetch_edit['department'] ?>" selected ><?php echo $fetch_edit['department'] ?></option>
                            <option value="SCS">SCS</option>
                            <option value="SABM">SABM</option>
                            <option value="SEA">SEA</option>
                            <option value="SAS">SAS</option>
                        </select>
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
                        <button class="btn btn-outline-success" name="edit">SUBMIT EDIT</button>
                    </div>
                </div>
            </form>
            </div>
        <?php
            }
                }
                echo "<script>document.querySelector('.update-container').style.display='block'</script>";
            }
        ?>

        <div class="div-container view-student-div">
          <table class="student-view-table table-bordered table">
            <thead >
              <tr >
                <th>Name</th>
                <th>Department</th>
                <th>Email</th>
                <th>Password</th>
                <th>Delete</th>
                <th>Edit</th>
              </tr>
            </thead>
            <tbody>
            <?php 
              $select_user = mysqli_query($conn, "SELECT * FROM `user` WHERE user_type = 'professor'") or die ('query failed');
              if(mysqli_num_rows($select_user)>0){
                while($fetch_user = mysqli_fetch_assoc($select_user)){
            ?>
            <tr>
                <td><?php echo $fetch_user['name'] ?></td>
                <td><?php echo $fetch_user['department'] ?></td>
                <td><?php echo $fetch_user['email'] ?></td>
                <td><?php echo $fetch_user['password'] ?></td>
                <td><a class="btn btn-outline-danger" href="admin_participant_display.php?delete=<?php echo $fetch_user ['id']; ?>;" name="delete" onclick="return confirm('Delete this message?');" >Delete</a></td>
                <td><a href="admin_participant_display.php?edit=<?php echo $fetch_user['id']; ?>" name="edit" class="btn btn-outline-success edit">Edit</a></td>
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
