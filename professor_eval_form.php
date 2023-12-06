<?php
    include 'connection.php';
    session_start();
    $prof_id = $_SESSION['prof_id'];

    if (!isset($prof_id)){
        header('location:index.php');
    }

    if (isset($_POST['logout'])){
        session_destroy();
        header('location:index.php');
    }
    if(isset($_POST['submit_eval'])){
      
      
      $eval = mysqli_real_escape_string($conn, $_POST['eval-id']);
      $subj = mysqli_real_escape_string($conn, $_POST['sujct-id']);
      $comment = mysqli_real_escape_string($conn, $_POST['comment']);
      $rates = $_POST["rate"];
      $insert_product = mysqli_query($conn, "INSERT INTO `result` (`eval_id`, `subject_id`, `average`, `comment`)
      VALUES ('$eval', '$subj','$rates', '$comment')") or die ('query failed');
      header('location:professor_eval_form.php');
    
  }

?>
<!DOCTYPE html>
<html lang="en">
  <head>
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
    <link rel="stylesheet" type="text/css" href="Src/style.css" />
    <script src="main.js"></script>
    <title>Admin</title>
  </head>
  <body>
    <div class="professor_student_table container">
      <form method="post">
        <input type="hidden" name="eval-id" value="<?php echo  $_SESSION['prof_id'] ?>" >
        <input type="hidden" name="sujct-id" value="1">
        <table class="table table-bordered">
          <thead>
            <tr>
              <th>Knowledge Mastery</th>
              <th>5</th>
              <th>4</th>
              <th>3</th>
              <th>2</th>
              <th>1</th>
            </tr>
          </thead>
          <tbody>
            <?php 
              $select_questions = mysqli_query($conn, "SELECT * FROM `questions` WHERE type = 'student'") or die ('query failed');
              if(mysqli_num_rows($select_questions)>0){
                while($fetch_questions = mysqli_fetch_assoc($select_questions)){
            ?>
            <tr>
              <td><?php echo $fetch_questions['question1'] ?></td>
            </tr>
            <tr>
              <td><?php echo $fetch_questions['question2'] ?></td>
            </tr>
            <tr>
              <td><?php echo $fetch_questions['question3'] ?></td>
            </tr>
            <?php 
              }
                  }else{
                      echo '
                          <td colspan="6">No Available Question</td>
                      ';  
                  }
              ?> 
          </tbody>
          <thead>
            <tr>
              <th>Critical Thinking</th>
              <th>5</th>
              <th>4</th>
              <th>3</th>
              <th>2</th>
              <th>1</th>
            </tr>
          </thead>
          <tbody>
          <?php 
              $select_question = mysqli_query($conn, "SELECT * FROM `evaluation` WHERE type = 'student' AND criteria = ' thinking'") or die ('query failed');
              if(mysqli_num_rows($select_question)>0){
                while($fetch_question = mysqli_fetch_assoc($select_question)){
            ?>
            <tr>
              <td><?php echo $fetch_question['question'] ?></td>
              <td>
                <input type="radio" name="rate[<?php echo $fetch_question['id'] ?>] rate" value="<?php echo $fetch_question['rate1'] ?>" class="radio-btn" />
              </td>
              <td>
                <input type="radio" name="rate[<?php echo $fetch_question['id'] ?>] rate" value="<?php echo $fetch_question['rate2'] ?>" class="radio-btn" />
              </td>
              <td>
                <input type="radio" name="rate[<?php echo $fetch_question['id'] ?>] rate" value="<?php echo $fetch_question['rate3'] ?>" class="radio-btn" />
              </td>
              <td>
                <input type="radio" name="rate[<?php echo $fetch_question['id'] ?>] rate" value="<?php echo $fetch_question['rate4'] ?>" class="radio-btn" />
              </td>
              <td>
                <input type="radio" name="rate[<?php echo $fetch_question['id'] ?>] rate" value="<?php echo $fetch_question['rate5'] ?>" class="radio-btn" />
              </td>

            </tr>
            <?php 
              }
                  }else{
                      echo '
                          <td colspan="6">No Available Question</td>
                      ';  
                  }
              ?> 
              <?php $rates = "";
                  if (isset($_POST["rate"]) && is_array($_POST["rate"]) && count($_POST["rate"]) > 0) {
                      foreach ($_POST["rate"] as $rates) {
                          // Concatenate the answers into the result variable
                          $rates .= htmlspecialchars($answer, ENT_QUOTES) . '<br />';
                      }
                  }
                  
              ?>
                              
          </tbody>
          <thead>
            <tr>
              <th>Collaboration</th>
              <th>5</th>
              <th>4</th>
              <th>3</th>
              <th>2</th>
              <th>1</th>
            </tr>
          </thead>
        </table>
        <label for="comment"><b>Comment & Recommmendations</b></label>
        <textarea
          class="form-control"
          name="comment"
          id="comment"
          cols="30"
          rows="6"
        ></textarea>
        <div class="eval-submit-button">
          <button type="submit" class="btn btn-outline-success w-50" name="submit_eval">
            Submit
          </button>
        </div>
      </form>
    </div>
    <script src="Src/main.js"></script>
    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe"
      crossorigin="anonymous"
    ></script>
  </body>
</html>
