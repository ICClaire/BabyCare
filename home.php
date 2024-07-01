<?php
    session_start();
    $divAlert = "popup alert alert-success";
    $success = "User Created Successfully.";

    // header("Location: home.php");
    // exit();
    // declaring success variables for user when they are successfully logged in
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BabyCare Homepage</title>

    <script src="https://kit.fontawesome.com/5c228b99f3.js" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="./styles/home.css" rel="stylesheet"/>
</head>
<body>
    <main>
        <div class="top-container">
        <i class="fa-solid fa-right-from-bracket" style="color: #6b95ff;" onClick="window.location='logout.php';"></i>

            <div class="container-1">
            </div>
        </div>
        <div class="content-container">
            <?php 
                echo "<div class='$divAlert' role='alert'>";
                    echo $success;
                echo "</div>";
                // called the variable so it is displayed on top 
            ?>
            <!-- displays the user's name on the homepage -->
            <!-- This uses a ternary operator to check if the session variable is set. If it is, it will display the username, if not, it will display 'Guest'. -->
            <!-- If it is set, it uses the htmlspecialchars() function to turn any special characters into safe text to prevent security issues  -->
            <h2>Welcome <?php echo isset($_SESSION['username']) ? htmlspecialchars($_SESSION['username']) : 'Guest'; ?></h2>
            <img class="mom" src="./assets/mom.png" alt="Mom Illustration with child">
            <div class="switch">
                <h3>Reminders</h3>
                <div class="form-check form-switch">
                    <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckChecked" checked>
                </div>
            </div>
            <h1>
                Tuesday May 1, 2024
            </h1>
            <button class=options> Sleep Schedule <img src="./assets/moon.png" alt=""></button>
            <button class=options> Feeding Schedule <img src="./assets/Home.png" alt=""></button>
            <button class=options> Diaper Logs <img src="./assets/diaper 1.png" alt=""></button>
        </div>  
    </main>
    <footer>
    </footer>
</body>
</html>