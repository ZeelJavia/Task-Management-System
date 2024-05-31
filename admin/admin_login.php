<?php
session_start();
include('../includes/connection.php');

const EMAIL_REQUIRED = 'Please enter your email';
const EMAIL_INVALID = 'Please enter a valid email';
const PASSWORD_REQUIRED = 'Please enter your password';
const PASSWORD_INVALID = 'Password must be at least 6 characters long';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Validate email
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    $inputs['email'] = $email;

    if ($email) {
        $email = filter_var($email, FILTER_VALIDATE_EMAIL);
        if ($email === false) {
            $errors['email'] = EMAIL_INVALID;
        }
    } else {
        $errors['email'] = EMAIL_REQUIRED;
    }

    // Validate password
    $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);
    if (empty($password)) {
        $errors['password'] = PASSWORD_REQUIRED;
    } elseif (strlen($password) < 6) {
        $errors['password'] = PASSWORD_INVALID;
    }

    if (empty($errors)) {
        if (isset($_POST['adminlogin'])) {
            $sql = "SELECT * FROM admins WHERE email = '$email' AND  password = '$password'";

            $result = mysqli_query($connection, $sql);
            if (mysqli_num_rows($result)) {
                while ($row = mysqli_fetch_assoc($result)) {
                    $_SESSION['name'] = $row['name'];
                    $_SESSION['email'] = $row['email'];
                }
                echo '<script> 
                    window.location.href = "index.php";
                </script>';
            } else {
                echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
                    <strong>Error!</strong> Please enter correct data.
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>';
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Admin Login</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" />
    <link rel="stylesheet" href="css/style1.css" />
</head>

<body>
    <section class="ftco-section">
        <center style="font-size: 30px;" > <b>Task Management System</b> </center>
        <div class="container">
            <div class="row justify-content-center"></div>
            <div class="row justify-content-center">
                <div class="col-md-6 col-lg-5">
                    <div class="login-wrap p-4 p-md-5">
                        <div class="icon d-flex align-items-center justify-content-center">
                            <span class="fa fa-user-o"></span>
                        </div>
                        <h3 class="text-center mb-4">Admin Login</h3>
                        <form method="POST" class="login-form">
                            <div class="form-group">
                                <!-- <label for="email">Email address</label> -->
                                <input type="email" class="form-control" aria-describedby="emailHelp" name="email" placeholder="Enter email" value="<?php echo htmlspecialchars($inputs['email'] ?? '', ENT_QUOTES); ?>" />
                                <small><?php echo htmlspecialchars($errors['email'] ?? '', ENT_QUOTES); ?></small>
                            </div>
                            <div class="form-group d-flex">
                                <!-- <label for="password">Password</label> -->
                                <input type="password" class="form-control" name="password" placeholder="Password" required>
                                <small><?php echo htmlspecialchars($errors['password'] ?? '', ENT_QUOTES); ?></small>
                            </div>
                            <div class="form-group d-md-flex"></div>
                            <div class="form-group">
                                <input type="submit" class="btn btn-primary rounded submit p-3 px-5" name="adminlogin" id="" value="login" style="font-size: large;" required>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script src="js/jquery.min.js"></script>
    <script src="js/popper.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/main.js"></script>
</body>

</html>