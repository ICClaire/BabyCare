

<?php
    session_start();
    require('db.php');

    $fail = "";

    if (isset($_POST['username']) && isset($_POST['password'])) {
        $username = mysqli_real_escape_string($babycon, $_POST['username']);
        $password = $_POST['password'];

        $query = "SELECT username, password FROM `auth` WHERE username='$username'";
        $result = mysqli_query($babycon, $query);
    
        if (!$result) {
            die("Query failed: " . mysqli_error($babycon));
        } else if (mysqli_num_rows($result) === 1) {
            $row = mysqli_fetch_assoc($result);
            if (password_verify($password, $row['password'])) {
                $_SESSION['username'] = $row['username'];
                header("Location: home.php");
                exit;
            } else {
                $fail = "*Incorrect Password*";
            }
        } else {
            $fail = "*Incorrect Username or Password*";
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BabyCare | Sign Up</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/5c228b99f3.js" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="./styles/login.css">
</head>
<body>
    <main>
        <div class="top">
            <i class="arrow fa-solid fa-arrow-left-long fa-2xl" onClick="window.location='./index.php'"></i>
            <h1>BabyCare</h1>
            <img src="./assets/Home.png" alt="Bottle Illustration" id="bottle" >
        </div>
        <div class="form-container">
            <h2> Login </h2>
            <p><?php echo $fail?></p>
            <form class="sign-up" method="POST" action="login.php">
                <input type="text" name="username" id="inputUser" placeholder="User Name">
                <input type="password" name="password" id="inputPassword" placeholder="Password">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                    <label class="form-check-label" for="flexCheckDefault">
                        Remember Me
                    </label>
                </div>

                <button id="log-in" type="submit">OK</button>

            </form>
            <a href="./register.php">Don't have an account? Sign Up</a>
        </div>
    </main>
    <footer>

    </footer>

</body>
</html>