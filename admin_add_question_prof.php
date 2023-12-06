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
    if(isset($_POST['add_question'])){
        $type = mysqli_real_escape_string($conn, $_POST['type']);
        $criteria = mysqli_real_escape_string($conn, $_POST['criteria']);
        $question = mysqli_real_escape_string($conn, $_POST['question']);
        $insert_product = mysqli_query($conn, "INSERT INTO `evaluation` (`type`, `criteria`, `question`)
        VALUES ('$type', ' $criteria', '$question')") or die ('query failed');
       
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <title>Document</title>
    <link rel="stylesheet" href="Src/style.css" >
</head>
<body>
    .<?php include 'admin_header.php' ?>
    <br><br><br><br>
    <div class="add-question-div container shadow-lg">
        <br><br>
        <h1 class="text-center">ADD PROFESSOR QUESTION</h1>
        <a href="admin_add_eval.php" class="btn btn-outline-dark">BACK</a>
        <form method="post">
            <input type="text" name="type" value="professor" hidden>
            <label for="crit">Criteria:</label>
            <select class="form-control" name="criteria" id="crit" required >
                <option value="LEARNING PROCESS">LEARNING PROCESS</option>
                <option value="TEACHER QUALITIES">TEACHER QUALITIES</option>
                <option value="ASSESSMENT">ASSESSMENT</option>
            </select>
            <label for="">Question:</label>
            <textarea class="form-control" name="question" id="" cols="30" rows="5" placeholder="Question:" required></textarea>
           
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
            <div class="addq-submit text-center" >
                <button name="add_question" class="btn btn-outline-success w-50" style="margin-top: 30px ;">SUBMIT</button>
            </div>
            <br><br>
        </form>
    </div>
    


    <?php include 'footer.php' ?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>