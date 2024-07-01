<?php
ob_start();
session_start();
require('db.php');
// connects to the db.php file
// essential, this is required in order to connect to the database and add data

$nameErr = $emailErr = $passErr = $passErr2 = $success = "";
// Declaring variables to pass error messages later

//checks if the server was retrieved through POST method 
// Chose POST because the server contains form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $valid = true;
    // declared a boolean to check for errors

    if (empty($_POST["userName"])) {
        $nameErr = "*Username is required";
        $valid = false;
        // since $valid is declared true, declaring it false when the username is empty
        // the boolean false will then be checked later for true to ensure that all fields contain value
    } else {
        $username = mysqli_real_escape_string($babycon, $_POST['userName']);
        // the mysqli_real_escape string ensures that there are no special characters to prevent user from adding codes to access database
        // connects to the database by passing it in the parameter
        // takes the value in the username field and stored it in the $username variable
    }

    if (empty($_POST["emailForm"])) {
        //checks if the email field is empty, if empty:
        $emailErr = "*Email is required";
        $valid = false;
    } else {
        $email = mysqli_real_escape_string($babycon, $_POST['emailForm']);
        //!filter_var  will check to see if the email format is right, if not it will return be stored as false in the valid variable
        if (!filter_var($_POST["emailForm"], FILTER_VALIDATE_EMAIL)){
            $emailErr = "*Invalid email format";
            $valid = false;
            
        }
    } 

    //checks to see if the password field is empty
    if (empty($_POST["passwordForm"])) {
        $passErr = "*Password is required";
        $valid = false;
    } else {
        // the input password is stored in the password variable using password_hash
        // password_hash() is used to help secure the password before storing it to the database
        //used the PASSWORD_BCRYPT constant to use the Bcrypt algorithmith which uses 60charac and salt
        $password = password_hash($_POST['passwordForm'], PASSWORD_BCRYPT);
    }

    //This checks if the password verification field is empty
    //If its empty, the valid becomes false and returns an error message
    if (empty($_POST["rePass"])) {
        $passErr2 = "*Password confirmation is required";
        $valid = false;
        // If the password field is not empty, it checks if the password and repassword are the same
        // If it is not, the valid becomes false and returns an error message
    } else if ($_POST["passwordForm"] != $_POST["rePass"]) {
        $passErr2 = "*Passwords do not match";
        $valid = false;
        // If the password and repassword are the same, the password is stored in the repassword variable
    } else {
        // if its not, the input value is stored in the repassword variable
        // before storing, hash is used to provide security
        $repassword = password_hash($_POST['passwordForm'], PASSWORD_BCRYPT);
    }
    
    // This helps check if both conditions are true to ensure
    // that all fields are filled in and the password and repassword are the same
    // password_verify helps ensure that the password is correct by comparing the plain text password from the hashed password. 
    //$_POST['rePass'] being the plain text and $password the hashed password
    if ($valid && password_verify($_POST['rePass'], $password)) {

        // inserts the data in the table named `auth`
        // name of the column username, password, email, and repassword
        // and the values of $username, $password, $email, $repassword to the corresponding coloumns
        $query = "INSERT INTO `auth` (username, password, email, repassword) VALUES ('$username', '$password', '$email', '$repassword')";
        // connects the query into the babycon database
        if (mysqli_query($babycon, $query)) {
            //if success, relocate to home.php
            $_SESSION['username'] = $username;
            $success = "Registration successful!";
            header("Location:home.php");
            //terminate the script
            exit();
        } else {
            // if the connection fails, it returns the error associated with the database connection which is babycon
            $fail = "Error: " . $query . mysqli_error($babycon);
        }
    } else {
        // if the password word is invalid OR $valid has a false stored in the variable, the error message shows:
        $fail = "Fix all errors";
        
    }
    // } else {
    //     $fail = "Passwords do not match.";
    // }

}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BabyCare | Sign Up</title>

    <script src="https://kit.fontawesome.com/5c228b99f3.js" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="./styles/register.css">
</head>
<body>
    <main>
        <!-- header -->
        <div class="top">
            <i class="arrow fa-solid fa-arrow-left-long fa-2xl" onClick="window.location='index.php'"></i>
            <h1 onclick="window.location='index.php'">BabyCare</h1>
            <img id="moon-pic" src="./assets/moon.png" alt="Moon Illustration"/>
        </div>

        <!-- form -->
        <div class="register-container">
            <h2> Sign Up </h2>

            <form class="sign-up" method="POST">
            
                <div class="feedback-container">
                    <?php
                        if(isset($fail)){ ?>
                        <div class="alert alert-danger" role="alert">
                                <div id="fail-message"><?php echo $fail; ?></div>
                        </div>
                    <?php } ?>
                </div>
                <input type="text" name="userName" id="inputUser" placeholder="User Name">
                <span class="error"><?php echo $nameErr;?></span>
                <input type="text" name="emailForm" id="inputEmail" placeholder="Email">
                <span class="error"><?php echo $emailErr;?></span>
                <input type="password" name="passwordForm" id="inputPassword" placeholder="Password" required>
                <span class="error"><?php echo $passErr;?></span>
                <input type="password" name="rePass" id="inputrePass" placeholder="Re-enter Password">
                <span class="error"><?php echo $passErr2;?></span>
                <button id="log-in" type="submit">OK</button>

            </form>
            <a id="sign-in" href="./login.php">Have an account? Sign In</a>
        </div>
    </main>
    <footer>

    </footer>  


</body>
</html>