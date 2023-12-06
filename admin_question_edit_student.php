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
    if(isset($_POST['edit'])){
        $update_id = $_POST['update-id'];
        $update_type = $_POST['update-type'];
        $update_criteria = $_POST['update-criteria'];
        $update_question = $_POST['update-question'];
        $update_dept = $_POST['update-dept'];
        $update_rate1 = $_POST['update-rate1'];
        $update_rate2 = $_POST['update-rate2'];
        $update_rate3 = $_POST['update-rate3'];
        $update_rate4 = $_POST['update-rate4'];
        $update_rate5 = $_POST['update-rate5'];
        $update_query = mysqli_query($conn, "UPDATE `evaluation` SET `id` = '$update_id', `type` = '$update_type',  `criteria` = '$update_criteria', `question` = '$update_question ', `department` = '$update_dept', 
        `rate1` = '$update_rate1', `rate2` = '$update_rate2', `rate3` = '$update_rate3', `rate4` = '$update_rate4', `rate5` = '$update_rate5' WHERE id = '$update_id' ") or die ('query failed');
        $message[]= 'Edit Submitted';
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
          <h3>Edit Student Evaluation </h3>
        </div>

        <?php
        if(isset($_GET['edit'])){
            $edit_id = $_GET['edit'];
            $edit_query = mysqli_query($conn, "SELECT * FROM `evaluation` WHERE id = '$edit_id'") or die ('query failed');
            if(mysqli_num_rows($edit_query)>0){
                while($fetch_edit = mysqli_fetch_assoc($edit_query)){
        ?>
            <div class="div-container add-user-div">
                <form method="post">
                    <input hidden name="update-id" value="<?php echo $fetch_edit['id']; ?>">
                    <input hidden name="update-type" value="<?php echo $fetch_edit['type']; ?>">
                    <div class="row">
                        <div class="col-lg-6 col-sm-12 ">
                            <label for="type">Department: </label>
                            <select class="form-control" name="update-dept" id="dept" required>
                                <option value="<?php echo $fetch_edit['department'] ?>" selected><?php echo $fetch_edit['department'] ?></option>
                                <option value="SCS">SCS</option>
                                <option value="SABM">SABM</option>
                                <option value="SCS">SCS</option>
                                <option value="SAS">SAS</option>
                            </select>
                        </div>
                        <div class="col-lg-6 col-sm-12 ">
                            <label for="criteria">Criteria:</label>
                            <select class="form-control" name="update-criteria" id="dept" required>
                                <option value="<?php echo $fetch_edit['criteria'] ?>" selected>Select</option>
                                <option value=" mastery">Knowledge Mastery</option>
                                <option value=" thinking">Critical Thinking</option>
                                <option value=" collab">Collaboration</option>
                            </select>
                        </div>
                        <div class="col-lg-12 col-sm-12">
                            <label for="question">Question: </label>
                            <textarea class="form-control" name="update-question" id="question" cols="30" rows="4" required><?php echo $fetch_edit['question'] ?></textarea>
                        </div>
                        <div class="col-lg-12 col-sm-12">
                            <br>
                            <h5 >Rating Scale</h5>
                        </div>
                        <div class="col-lg-12 col-sm-12">
                            <label for="pass">To a very great extent: </label>
                            <input
                            class="form-control"
                            type="number"
                            name="update-rate1"
                            id="rate1"
                            value="<?php echo $fetch_edit['rate1'] ?>"
                            required
                            />
                        </div>
                        <div class="col-lg-12 col-sm-12">
                            <label for="pass">To a great extent: </label>
                            <input
                            class="form-control"
                            type="number"
                            name="update-rate2"
                            id="rate2"
                            value="<?php echo $fetch_edit['rate2'] ?>"
                            required
                            />
                        </div>
                        <div class="col-lg-12 col-sm-12 ">
                            <label for="pass">To a satisfactory extent: </label>
                            <input
                            class="form-control"
                            type="number"
                            name="update-rate3"
                            id="rate3"
                            value="<?php echo $fetch_edit['rate3'] ?>"
                            required
                            />
                        </div>
                        <div class="col-lg-12 col-sm-12">
                            <label for="pass">To a small extent: </label>
                            <input
                            class="form-control"
                            type="number"
                            name="update-rate4"
                            id="rate4"
                            value="<?php echo $fetch_edit['rate4'] ?>"
                            required
                            />
                        </div>
                        <div class="col-lg-12 col-sm-12">
                            <label for="pass">Not at all: </label>
                            <input
                            class="form-control"
                            type="number"
                            name="update-rate5"
                            id="rate5"
                            value="<?php echo $fetch_edit['rate5'] ?>"
                            required
                            />
                        </div>
                            <?php
                                    if(isset($message)){
                                    foreach ($message as $message) {
                                    echo'
                                        <div class="col-12 alert alert-success" role="alert text-center  "  style=" margin-top: 20px" >
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

        <div class="view-student-div div-containers ">
        <h3>Student Evalutaion</h3>
          <table class="table-bordered table">
            <thead >
              <tr >
                <th >Knowledge Mastery</th>
                <th>EDIT</th>
              </tr>
            </thead>
            <tbody>
            <?php 
              $select_student = mysqli_query($conn, "SELECT * FROM `evaluation` WHERE type = 'student' AND criteria = ' mastery'") or die ('query failed');
              if(mysqli_num_rows($select_student)>0){
                while($fetch_student = mysqli_fetch_assoc($select_student)){
            ?>
            <tr>
                <td><?php echo $fetch_student['question'] ?></td>
                <td><a class="btn btn-outline-success" href="admin_question_edit_student.php?edit=<?php echo $fetch_student ['id']; ?>;" name="edit">EDIT</a></td>
              </tr>
            <?php 
              }
                  }else{
                      echo '
                          <td colspan="6">No Question Added</td>
                      ';  
                  }
              ?> 
            </tbody>
            <thead>
                <tr>
                    <th colspan="6">Critical Thinking</th>
                </tr>
            </thead>
            <tbody>
            <?php 
              $select_student = mysqli_query($conn, "SELECT * FROM `evaluation` WHERE type = 'student' AND criteria = ' thinking'") or die ('query failed');
              if(mysqli_num_rows($select_student)>0){
                while($fetch_student = mysqli_fetch_assoc($select_student)){
            ?>
            <tr>
                <td><?php echo $fetch_student['question'] ?></td>
                <td><a class="btn btn-outline-success" href="admin_question_edit_student.php?edit=<?php echo $fetch_student ['id']; ?>;" name="edit">EDIT</a></td>
              </tr>
            <?php 
              }
                  }else{
                      echo '
                          <td colspan="6">No Question Added</td>
                      ';  
                  }
              ?> 
            </tbody>
            <thead>
                <tr>
                    <th colspan="6">Collaboration</th>
                </tr>
            </thead>
            <tbody>
            <?php 
              $select_student = mysqli_query($conn, "SELECT * FROM `evaluation` WHERE type = 'student' AND criteria = ' collab'") or die ('query failed');
              if(mysqli_num_rows($select_student)>0){
                while($fetch_student = mysqli_fetch_assoc($select_student)){
            ?>
            <tr>
                <td><?php echo $fetch_student['question'] ?></td>
                <td><a class="btn btn-outline-success" href="admin_question_edit_student.php?edit=<?php echo $fetch_student ['id']; ?>;" name="edit">EDIT</a></td>
              </tr>
            <?php 
              }
                  }else{
                      echo '
                          <td colspan="6">No Question Added</td>
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
