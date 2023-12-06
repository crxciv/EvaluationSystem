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

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
    <link rel="stylesheet" href="Src/style.css">
    <title>Document</title>
</head>
<body>
    <?php include 'header.php' ?>
    <div style="padding: 70px;"></div>
    <div class="prof-home-container">
        <div class="studenthomediv">
            <a href="professor_eval_form.php">
                <div class="homebox shadow-lg">
                    <img class="b3" src="Resources/program.svg" width="50%">
                    <div class="foot">
                        
                    </div>
                </div>
            </a>
            <a href="">
                <div class="homebox shadow-lg">
                    <img class="b2" src="Resources/student.svg" width="50%">
                    <div class="foot">
                        
                    </div>
                </div>
            </a>
            <a href="">
                <div class="homebox shadow-lg">
                    <img class="b1" src="Resources/teacher.svg" width="50%">
                   <div class="foot">
                   </div>
                </div>
            </a>
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