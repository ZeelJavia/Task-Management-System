<?php
include('includes/connection.php');
session_start();
const EMAIL_REQUIRED = 'Please enter your email';
const EMAIL_INVALID = 'Please enter a valid email';
const PASSWORD_REQUIRED = 'Please enter your password';
const PASSWORD_INVALID = 'Password must be at least 6 characters ';
$errors2 = [];
$inputs2 = [];
if (isset($_POST['userlogin'])) {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

        $email1 = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
        $inputs2['email'] = $email1;
        if ($email1) {
            // validate email
            $email1 = filter_var($email1, FILTER_VALIDATE_EMAIL);
            if ($email1 === false) {
                $errors2['email'] = EMAIL_INVALID;
            }
        } else {
            $errors2['email'] = EMAIL_REQUIRED;
        }

        $password1 = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);
        $inputs2['password'] = $password1 ; 
        if (empty($password1)) {
            $errors2['password'] = PASSWORD_REQUIRED;
        } elseif (strlen($password1) < 6) {
            $errors2['password'] = PASSWORD_INVALID;
        }

        if (empty($errors2)) {
            $sql1 = "SELECT * FROM users WHERE email = '$email1' AND  password = '$password1'";

            $result1 = mysqli_query($connection, $sql1);
            if (mysqli_num_rows($result1)) {
                while ($row1 = mysqli_fetch_assoc($result1)) {
                    $_SESSION['name'] = $row1['name'];
                    $_SESSION['email'] = $row1['email'];
                    $_SESSION['uid'] = $row1['uid'];
                }
                echo '<script> 
                    window.location.href = "user_dashboard.php";
                </script>';
                exit; 
            } else {
                $errors2['login'] = 'Invalid email or password';
                echo "<script> 
                    alert('Error please try again later...');
                </script>";
            }
        }
    }
}
?>

<?php
include("includes/connection.php");


const NAME_REQUIRED = 'Please enter your name';
const MOBILE_REQUIRED = 'Please enter your mobile number';
const MOBILE_INVALID = 'Please enter a valid mobile number';

$errors = []; // Initialize errors array
$inputs = []; // Initialize inputs array

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    // Sanitize & validate email
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    $inputs['email'] = $email;
    if ($email) {
        // Validate email
        $email = filter_var($email, FILTER_VALIDATE_EMAIL);
        if ($email === false) {
            $errors['email'] = EMAIL_INVALID;
        }
    } else {
        $errors['email'] = EMAIL_REQUIRED;
    }

    // Sanitize & validate name
    $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);
    $inputs['name'] = $name;
    if (empty($name)) {
        $errors['name'] = NAME_REQUIRED;
    }

    // Sanitize & validate password
    $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);
    if (empty($password)) {
        $errors['password'] = PASSWORD_REQUIRED;
    } elseif (strlen($password) < 6) {
        $errors['password'] = PASSWORD_INVALID;
    }

    // Sanitize & validate mobile number
    $mobile = filter_input(INPUT_POST, 'mobile', FILTER_SANITIZE_NUMBER_INT);
    $inputs['mobile'] = $mobile;
    if (empty($mobile)) {
        $errors['mobile'] = MOBILE_REQUIRED;
    } elseif (!preg_match("/^[0-9]{10}$/", $mobile)) {
        $errors['mobile'] = MOBILE_INVALID;
    }

    if (empty($errors)) {
        if (isset($_POST['user_registration'])) {
            $sql = "INSERT INTO `users` (`uid`, `name`, `email`, `password`, `mobile`) VALUES (NULL,'$name' , '$email', '$password', '$mobile');";
            $result = mysqli_query($connection, $sql);
            if ($result) {
                echo '<script>
                    alert("Success");
                </script>';
            }
        }
    } else {
        // Count the errors only once
        static $count = 0;
        if ($count == 0) {
            echo '<script>
                alert("Your data not inserted successfully please try again");   
            </script>';
            $count++;
        }
        // Clear input values after showing the error
        $inputs = [];
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Employee Login</title>
    <!--  -->
    <!-- <link rel="stylesheet" href="style.css" /> -->
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const signUpButton = document.getElementById("signUp");
            const signInButton = document.getElementById("signIn");
            const container = document.getElementById("container");
            // const registration = document.getElementById("registration");

            signUpButton.addEventListener("click", () => {
                container.classList.add("right-panel-active");
            });


            signInButton.addEventListener("click", () => {
                container.classList.remove("right-panel-active");
            });
            // registration.addEventListener("click", () => {
            //     container.classList.remove("right-panel-active");
            // });
        });
    </script>

    <style>
        @import url("https://fonts.googleapis.com/css?family=Montserrat:400,800");

        * {
            box-sizing: border-box;
        }

        body {
            background: #f6f5f7;
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            font-family: "Montserrat", sans-serif;
            height: 90vh;
            margin: 0px 0 50px;
        }

        h1 {
            font-weight: bold;
            margin: 0;
        }

        h2 {
            text-align: center;
        }

        p {
            font-size: 14px;
            font-weight: 100;
            line-height: 20px;
            letter-spacing: 0.5px;
            margin: 20px 0 30px;
        }

        span {
            font-size: 12px;
        }

        a {
            color: #333;
            font-size: 14px;
            text-decoration: none;
            margin: 15px 0;
        }

        button,
        #registration,
        #login,
        #btn {
            border-radius: 20px;
            border: 1px solid #6471e5;
            background-color: #6471e5;
            color: #ffffff;
            font-size: 12px;
            font-weight: bold;
            padding: 12px 45px;
            letter-spacing: 1px;
            text-transform: uppercase;
            transition: transform 80ms ease-in;
        }

        button:active {
            transform: scale(0.95);
        }

        button:focus {
            outline: none;
        }

        button.ghost {
            background-color: transparent;
            border-color: #ffffff;
        }

        form {
            background-color: #ffffff;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
            padding: 0 50px;
            height: 100%;
            text-align: center;
        }

        input {
            background-color: #eee;
            border: none;
            padding: 12px 15px;
            margin: 8px 0;
            width: 100%;
        }

        .container {
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 14px 28px rgba(0, 0, 0, 0.25),
                0 10px 10px rgba(0, 0, 0, 0.22);
            position: relative;
            overflow: hidden;
            width: 768px;
            max-width: 100%;
            min-height: 480px;
        }

        .form-container {
            position: absolute;
            top: 0;
            height: 100%;
            transition: all 0.6s ease-in-out;
        }

        .sign-in-container {
            left: 0;
            width: 50%;
            z-index: 2;
        }

        .container.right-panel-active .sign-in-container {
            transform: translateX(100%);
        }

        .sign-up-container {
            left: 0;
            width: 50%;
            opacity: 0;
            z-index: 1;
        }

        .container.right-panel-active .sign-up-container {
            transform: translateX(100%);
            opacity: 1;
            z-index: 5;
            animation: show 0.6s;
        }

        @keyframes show {

            0%,
            49.99% {
                opacity: 0;
                z-index: 1;
            }

            50%,
            100% {
                opacity: 1;
                z-index: 5;
            }
        }

        .overlay-container {
            position: absolute;
            top: 0;
            left: 50%;
            width: 50%;
            height: 100%;
            overflow: hidden;
            transition: transform 0.6s ease-in-out;
            z-index: 100;
        }

        .container.right-panel-active .overlay-container {
            transform: translateX(-100%);
        }

        .overlay {
            background: rgb(195, 34, 189);
            background: linear-gradient(45deg, rgba(195, 34, 189, 1) 20%, rgba(45, 70, 253, 1) 100%);
            background-repeat: no-repeat;
            background-size: cover;
            background-position: 0 0;
            color: #ffffff;
            position: relative;
            left: -100%;
            height: 100%;
            width: 200%;
            transform: translateX(0);
            transition: transform 0.6s ease-in-out;
        }

        .container.right-panel-active .overlay {
            transform: translateX(50%);
        }

        .overlay-panel {
            position: absolute;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
            padding: 0 40px;
            text-align: center;
            top: 0;
            height: 100%;
            width: 50%;
            transform: translateX(0);
            transition: transform 0.6s ease-in-out;
        }

        .overlay-left {
            transform: translateX(-20%);
        }

        .container.right-panel-active .overlay-left {
            transform: translateX(0);
        }

        .overlay-right {
            right: 0;
            transform: translateX(0);
        }

        .container.right-panel-active .overlay-right {
            transform: translateX(20%);
        }

        .social-container {
            margin: 20px 0;
        }

        .social-container a {
            border: 1px solid #dddddd;
            border-radius: 50%;
            display: inline-flex;
            justify-content: center;
            align-items: center;
            margin: 0 5px;
            height: 40px;
            width: 40px;
        }

        footer {
            background-color: #222;
            color: #fff;
            font-size: 14px;
            bottom: 0;
            position: fixed;
            left: 0;
            right: 0;
            text-align: center;
            z-index: 999;
        }

        footer p {
            margin: 10px 0;
        }

        footer i {
            color: red;
        }

        footer a {
            color: #3c97bf;
            text-decoration: none;
        }
    </style>
</head>

<body>
    <center>
        <h1 style="margin-top: 15px;">Task Management System</h1>
    </center><br><br>
    <div class="container" id="container">
        <div class="form-container sign-up-container">
            <form action="" method="post">
                <h1>Create Account</h1>
                <div class="social-container">

                </div>
                <input type="text" class="form-control" name="name" id="" placeholder="Enter name" value="<?php echo $inputs['name'] ?? '' ?>" required>
                <small><?php echo $errors['name'] ?? '' ?></small>
                <input type="email" class="form-control" name="email" id="" placeholder="Enter email" value="<?php echo $inputs['email'] ?? '' ?>" required>
                <small><?php echo $errors['email'] ?? '' ?></small>
                <input type="password" class="form-control" name="password" placeholder="<?php echo $errors['password'] ?? 'Password' ?>" value="<?php echo $inputs['password'] ?? '' ?>" required>
                <!-- <small><?php echo $errors['password'] ?? '' ?></small> -->
                <input type="text" class="form-control" name="mobile" id="" placeholder="Enter Mobile Number" value="<?php echo $inputs['mobile'] ?? '' ?>" required>
                <small><?php echo $errors['mobile'] ?? '' ?></small>
                <br>
                <input type="submit" name="user_registration" id="registration" placeholder="" value="Sign Up">
            </form>
        </div>

        <div class="form-container sign-in-container">
            <form action="#" method="post">
                <h1>Sign in</h1>
                <div class="social-container">
                </div>
                <input type="email" class="form-control" aria-describedby="emailHelp" name="email" placeholder="Enter email" required>
                <small><?php echo $errors2['email'] ?? '' ?></small>
                <input type="password" class="form-control" name="password" placeholder=" Password" value="" required>
                <small><?php echo $errors2['password'] ?? '' ?></small>
                <input type="submit" name="userlogin" id="login" placeholder="" value="Sign In" required>
            </form>
        </div>

        <div class="overlay-container">
            <div class="overlay">
                <div class="overlay-panel overlay-left">
                    <h1>Welcome Back!</h1>
                    <p>
                        To keep connected with us please login with your personal info
                    </p>
                    <button class="ghost" id="signIn">Sign In</button>
                </div>
                <div class="overlay-panel overlay-right">
                    <h1>Hello, Friend!</h1>
                    <p>Enter your personal details and start journey with us</p>
                    <button class="ghost" id="signUp">Sign Up</button>
                </div>
            </div>
        </div>
    </div><br>
    


</body>

</html>