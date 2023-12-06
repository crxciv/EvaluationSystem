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
        
        mysqli_query($conn, "DELETE FROM `evaluation` WHERE id = '$delete_id'") or die ('query failed');
        $message[] = 'user removed successfuly';
        header('location:admin_question_display.php');
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
          <h3>Questions</h3>
        </div>

        <div class="view-student-div div-containers ">
        <h3>Professor Evalutaion</h3>
          <table class="table-bordered table">
            <thead >
              <tr >
                <th >Teaching Techniques</th>
                <th>VGE</th>
                <th>GE</th>
                <th>SE</th>
                <th>SME</th>
                <th>NA</th>
                <th>DELTE</th>
              </tr>
            </thead>
            <tbody>
            <?php 
              $select_professor = mysqli_query($conn, "SELECT * FROM `evaluation` WHERE type = 'professor' AND criteria = ' technique'") or die ('query failed');
              if(mysqli_num_rows($select_professor)>0){
                while($fetch_professor = mysqli_fetch_assoc($select_professor)){
            ?>
            <tr>
                <td><?php echo $fetch_professor['question'] ?></td>
                <td><?php echo $fetch_professor['rate1'] ?></td>
                <td><?php echo $fetch_professor['rate2'] ?></td>
                <td><?php echo $fetch_professor['rate3'] ?></td>
                <td><?php echo $fetch_professor['rate4'] ?></td>
                <td><?php echo $fetch_professor['rate5'] ?></td>
                <td><a class="btn btn-outline-danger" href="admin_question_display..php?delete=<?php echo $fetch_professor['id']; ?>;" name="delete" onclick="return confirm('Delete this message?');" >Delete</a></td>
              </tr>
            <?php 
              }
                  }else{
                      echo '
                          <td colspan="7">No Question Added</td>
                      ';  
                  }
              ?> 
            </tbody>
            <thead>
                <tr>
                    <th colspan="7">Effective Planning</th>
                </tr>
            </thead>
            <tbody>
            <?php 
              $select_professor = mysqli_query($conn, "SELECT * FROM `evaluation` WHERE type = 'professor' AND criteria = ' planning'") or die ('query failed');
              if(mysqli_num_rows($select_professor)>0){
                while($fetch_professor = mysqli_fetch_assoc($select_professor)){
            ?>
            <tr>
                <td><?php echo $fetch_professor['question'] ?></td>
                <td><?php echo $fetch_professor['rate1'] ?></td>
                <td><?php echo $fetch_professor['rate2'] ?></td>
                <td><?php echo $fetch_professor['rate3'] ?></td>
                <td><?php echo $fetch_professor['rate4'] ?></td>
                <td><?php echo $fetch_professor['rate5'] ?></td>
                <td><a class="btn btn-outline-danger" href="admin_question_display.php?delete=<?php echo $fetch_professor['id']; ?>;" name="delete" onclick="return confirm('Delete this message?');" >Delete</a></td>
              </tr>
            <?php 
              }
                  }else{
                      echo '
                          <td colspan="7">No Question Added</td>
                      ';  
                  }
              ?> 
            </tbody>
            <thead>
                <tr>
                    <th colspan="7">Classroom Environment</th>
                </tr>
            </thead>
            <tbody>
            <?php 
              $select_professor = mysqli_query($conn, "SELECT * FROM `evaluation` WHERE type = 'professor' AND criteria = ' environment'") or die ('query failed');
              if(mysqli_num_rows($select_professor)>0){
                while($fetch_professor = mysqli_fetch_assoc($select_professor)){
            ?>
            <tr>
                <td><?php echo $fetch_professor['question'] ?></td>
                <td><?php echo $fetch_professor['rate1'] ?></td>
                <td><?php echo $fetch_professor['rate2'] ?></td>
                <td><?php echo $fetch_professor['rate3'] ?></td>
                <td><?php echo $fetch_professor['rate4'] ?></td>
                <td><?php echo $fetch_professor['rate5'] ?></td>
                <td><a class="btn btn-outline-danger" href="admin_question_display.php?delete=<?php echo $fetch_professor['id']; ?>;" name="delete" onclick="return confirm('Delete this message?');" >Delete</a></td>
                
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

        <div class="view-student-div div-containers ">
            <h3>Program Evaluation</h3>
          <table class=" table-bordered table">
            <thead >
              <tr >
                <th>Satisfaction:</th>
                <th>VGE</th>
                <th>GE</th>
                <th>SE</th>
                <th>SME</th>
                <th>NA</th>
                <th>DELETE</th>
              </tr>
            </thead>
            <tbody>
            <?php 
              $select_program = mysqli_query($conn, "SELECT * FROM `evaluation` WHERE type = 'program' AND criteria = ' satisfaction'") or die ('query failed');
              if(mysqli_num_rows($select_program)>0){
                while($fetch_program = mysqli_fetch_assoc($select_program)){
            ?>
            <tr>
                <td><?php echo $fetch_program['question'] ?></td>
                <td><?php echo $fetch_program['rate1'] ?></td>
                <td><?php echo $fetch_program['rate2'] ?></td>
                <td><?php echo $fetch_program['rate3'] ?></td>
                <td><?php echo $fetch_program['rate4'] ?></td>
                <td><?php echo $fetch_program['rate5'] ?></td>
                <td><a class="btn btn-outline-danger" href="admin_question_display.php?delete=<?php echo $fetch_program['id']; ?>;" name="delete" onclick="return confirm('Delete this message?');" >Delete</a></td>
              </tr>
            <?php 
              }
                  }else{
                      echo '
                          <td colspan="7">No Question Added</td>
                      ';  
                  }
              ?> 
            </tbody>
            <thead>
                <tr>
                    <th colspan="7">Impact</th>
                </tr>
            </thead>
            <tbody>
            <?php 
              $select_program = mysqli_query($conn, "SELECT * FROM `evaluation` WHERE type = 'program' AND criteria = ' impact'") or die ('query failed');
              if(mysqli_num_rows($select_program)>0){
                while($fetch_program = mysqli_fetch_assoc($select_program)){
            ?>
            <tr>
                <td><?php echo $fetch_program['question'] ?></td>
                <td><?php echo $fetch_program['rate1'] ?></td>
                <td><?php echo $fetch_program['rate2'] ?></td>
                <td><?php echo $fetch_program['rate3'] ?></td>
                <td><?php echo $fetch_program['rate4'] ?></td>
                <td><?php echo $fetch_program['rate5'] ?></td>
                <td><a class="btn btn-outline-danger" href="admin_question_display.php?delete=<?php echo $fetch_program['id']; ?>;" name="delete" onclick="return confirm('Delete this message?');" >Delete</a></td>
              </tr>
            <?php 
              }
                  }else{
                      echo '
                          <td colspan="7">No Question Added</td>
                      ';  
                  }
              ?> 
            </tbody>
            <thead>
                <tr>
                    <th class="table-category" colspan="7">Implementations</th>
                </tr>
            </thead>
            <tbody>
            <?php 
              $select_program= mysqli_query($conn, "SELECT * FROM `evaluation` WHERE type = 'program' AND criteria = ' implementation'") or die ('query failed');
              if(mysqli_num_rows($select_program)>0){
                while($fetch_program = mysqli_fetch_assoc($select_program)){
            ?>
            <tr>
                <td><?php echo $fetch_program['question'] ?></td>
                <td><?php echo $fetch_program['rate1'] ?></td>
                <td><?php echo $fetch_program['rate2'] ?></td>
                <td><?php echo $fetch_program['rate3'] ?></td>
                <td><?php echo $fetch_program['rate4'] ?></td>
                <td><?php echo $fetch_program['rate5'] ?></td>
                <td><a class="btn btn-outline-danger" href="admin_question_display.php?delete=<?php echo $fetch_program['id']; ?>;" name="delete" onclick="return confirm('Delete this message?');" >Delete</a></td>
              </tr>
            <?php 
              }
                  }else{
                      echo '
                          <td colspan="7">No Question Added</td>
                      ';  
                  }
              ?> 
            </tbody>
          </table>
        </div>
        <div class="view-student-div div-containers ">
            <h3>Student Evalutaion</h3>
          <table class="table-bordered table">
            <thead >
              <tr >
                <th>Knowledge Mastery:</th>
                <th>VGE</th>
                <th>GE</th>
                <th>SE</th>
                <th>SME</th>
                <th>NA</th>
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
                <td><?php echo $fetch_student['rate1'] ?></td>
                <td><?php echo $fetch_student['rate2'] ?></td>
                <td><?php echo $fetch_student['rate3'] ?></td>
                <td><?php echo $fetch_student['rate4'] ?></td>
                <td><?php echo $fetch_student['rate5'] ?></td>
                <td><a class="btn btn-outline-danger" href="admin_question_display.php?delete=<?php echo $fetch_student['id']; ?>;" name="delete" onclick="return confirm('Delete this message?');" >Delete</a></td>
            </tr>
            <?php 
              }
                  }else{
                      echo '
                          <td colspan="7">No Question Added</td>
                      ';  
                  }
              ?> 
            </tbody>
            <thead>
                <tr>
                    <th colspan="7">Critical Thinking:</th>
                </tr>
            </thead>
            <tbody>
            <?php 
              $select_student= mysqli_query($conn, "SELECT * FROM `evaluation` WHERE type = 'student' AND criteria = ' thinking'") or die ('query failed');
              if(mysqli_num_rows($select_student)>0){
                while($fetch_student = mysqli_fetch_assoc($select_student)){
            ?>
            <tr>
                <td><?php echo $fetch_student['question'] ?></td>
                <td><?php echo $fetch_student['rate1'] ?></td>
                <td><?php echo $fetch_student['rate2'] ?></td>
                <td><?php echo $fetch_student['rate3'] ?></td>
                <td><?php echo $fetch_student['rate4'] ?></td>
                <td><?php echo $fetch_student['rate5'] ?></td>
                <td><a class="btn btn-outline-danger" href="admin_question_display.php?delete=<?php echo $fetch_student['id']; ?>;" name="delete" onclick="return confirm('Delete this message?');" >Delete</a></td>
              </tr>
            <?php 
              }
                  }else{
                      echo '
                          <td colspan="7">No Question Added</td>
                      ';  
                  }
              ?> 
            </tbody>
            <thead>
                <tr>
                    <th colspan="7">Collaboration:</th>
                </tr>
            </thead>
            <tbody>
            <?php 
              $select_student= mysqli_query($conn, "SELECT * FROM `evaluation` WHERE type = 'student' AND criteria = ' collab'") or die ('query failed');
              if(mysqli_num_rows($select_student)>0){
                while($fetch_student = mysqli_fetch_assoc($select_student)){
            ?>
            <tr>
                <td><?php echo $fetch_student['question'] ?></td>
                <td><?php echo $fetch_student['rate1'] ?></td>
                <td><?php echo $fetch_student['rate2'] ?></td>
                <td><?php echo $fetch_student['rate3'] ?></td>
                <td><?php echo $fetch_student['rate4'] ?></td>
                <td><?php echo $fetch_student['rate5'] ?></td>
                <td><a class="btn btn-outline-danger" href="admin_question_display.php?delete=<?php echo $fetch_student['id']; ?>;" name="delete" onclick="return confirm('Delete this message?');" >Delete</a></td>
              </tr>
            <?php 
              }
                  }else{
                      echo '
                          <td colspan="7">No Question Added</td>
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
