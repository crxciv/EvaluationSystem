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
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN"
      crossorigin="anonymous"
    />
    <link rel="stylesheet" href="Src/style.css" />
    <title>Document</title>
  </head>
  <body class="test">
    <?php include 'admin_header.php' ?>
    <br /><br /><br /><br />
    <div class="container shadow-lg text-center" style="padding: 50px;">
        <h1>ADD QUESTION </h1>
      </div>
      <br><br>
    <div class="add-question-div container shadow-lg">
      <br /><br />
      <div class="row text-center addeval-div">
        <div class="col-lg-3 col-md-5 col-sm-12 eval-box">
          <a href="admin_add_question_prof.php">
            <div style="height: 300px">
              <h1>PROFESSOR</h1>
            </div>
          </a>
        </div>
        <div class="col-lg-3 col-md-5 col-sm-12 eval-box">
          <a href="admin_add_question_prog.php">
            <div style="height: 300px">
              <h1>PROGRAM</h1>
            </div>
          </a>
        </div>
        <div class="col-lg-3 col-md-5 col-sm-12 eval-box">
          <a href="admin_add_question_fac.php">
            <div style="height: 300px">
              <h1>FACILITY</h1>
            </div>
          </a>
        </div>
      </div>
      <!-- hello pareh -->
      <br /><br />
    </div>
    <?php include 'footer.php' ?>
    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
      crossorigin="anonymous"
    ></script>
  </body>
</html>
