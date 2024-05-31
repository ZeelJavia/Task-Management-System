<?php
include('includes/connection.php');
session_start();
if (isset($_SESSION['email'])) {
?>
    <!DOCTYPE html>
    <html lang="en">


    <head>
    <title>Apply leave</title>

        <style>
            body{
                color: black;
            }
            .form-control {
                background-color: #dedcdc;
    
            }
        </style>
    </head>

    <body>
        <h3>Apply leave</h3>
        <br>
        <div class="row">
            <div class="col-md-6">
                <form method="post">
                    <div class="form-group">
                        <label for="subject">Subject</label>
                        <input type="text" class="form-control" name="subject" placeholder="Enter Subject">
                    </div>
                    <div class="form-group">
                        <label for="message">Type Message</label><br>
                        <textarea name="message" class="form-control" rows="5" cols="60" placeholder="Enter message" ></textarea>
                    </div>
                    <div class="form-group">
                        <input type="submit" class="btn btn-warning" name="submit_leave">
                    </div>
                </form>
            </div>
        </div>
    </body>

    </html>
<?php
} else {
    header('location:index2.php');
}
?>

