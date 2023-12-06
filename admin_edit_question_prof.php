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
      header('location:admin_edit_question_prof.php');
    }
    if(isset($_POST['edit'])){
      $update_id = $_POST['update_id'];
      $update_question = $_POST['update-question'];
      $update_criteria = $_POST['update-criteria'];
      $update_query = mysqli_query($conn, "UPDATE `evaluation` SET `id` = '$update_id',  `criteria` = '$update_criteria', `question` = '$update_question '  WHERE id = '$update_id' ") or die ('query failed');
    }

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN"
      crossorigin="anonymous"
    />
    <title>Document</title>
    <link rel="stylesheet" href="Src/style.css" />
  </head>
  <body>
    <?php include 'admin_header.php' ?>
    <br /><br /><br /><br />
    <div class="container shadow-lg">
      <table>
        <?php 
          $type = "professor";
          $select_questions = mysqli_query($conn, "SELECT * FROM `evaluation` WHERE type = '$type' ") or die ('query failed');
          if(mysqli_num_rows($select_questions)>0){
              while($fetch_questions = mysqli_fetch_assoc($select_questions)){
          ?>
          <tr>
            <td><?php echo $fetch_questions['question'] ?></td>
            <td></td>
            <td><a href="admin_edit_question_prof.php?delete=<?php echo $fetch_questions ['id']; ?>;" name="delete" onclick="return confirm('Delete this message?');">DELETE</a> </td>
            <td><a href="admin_edit_question_prof.php?edit=<?php echo $fetch_questions ['id']; ?>;" name="edit">edit</a> </td>
          </tr>
      <?php 
        }
          }else{
              echo '
              <div class="container text-center" style="padding: 100px;">
                  <h1>No Available questions yet</h1>
              </div>
              ';  
          }
        ?> 
        </table>
    </div>

    <br /><br /><br /><br />
    <div class="add-question-div container shadow-lg">
    <a href="admin_edit_eval.php" class="btn btn-outline-dark">BACK</a>
    <h1 class="text-center">EDIT FACILITY QUESTION</h1>
    <?php
        if(isset($_GET['edit'])){
            $edit_id = $_GET['edit'];
            $edit_query = mysqli_query($conn, "SELECT * FROM `evaluation` WHERE id = '$edit_id'") or die ('query failed');

            if(mysqli_num_rows($edit_query)>0){
                while($fetch_edit = mysqli_fetch_assoc($edit_query)){
        ?>
      <br /><br />
      <form method="post">
      <input type="hidden" name="update_id" value="<?php echo $fetch_edit['id']; ?>">
      
        <label for="crit">Criteria:</label>
        <select class="form-control" name="update-criteria" id="crit" required>
          <option value="<?php echo $fetch_edit['criteria']; ?>" selected disabled><?php echo $fetch_edit['criteria']; ?></option>
          <option value="LEARNING PROCESS">LEARNING PROCESS</option>
          <option value="TEACHER QUALITIES">TEACHER QUALITIES</option>
          <option value="ASSESSMENT">ASSESSMENT</option>
        </select>
        <label for="">Question:</label>
        <textarea
          class="form-control"
          name="update-question"
          id=""
          cols="30"
          rows="5"
          placeholder="Question:"
          required
        ><?php echo $fetch_edit['question']?></textarea>
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

        <div class="addq-submit text-center">
          <button
            type="submit"
            name="edit"
            class="btn btn-outline-success w-50"
            style="margin-top: 30px"
          >
            SUBMIT EDIT
          </button>
        </div>

        <br /><br />
      </form>
    <?php
        }
            }
        }
      ?>
    </div>

    <?php include 'footer.php' ?>
    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
      crossorigin="anonymous"
    ></script>
  </body>
</html>
