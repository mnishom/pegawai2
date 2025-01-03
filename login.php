<?php
session_start();
if (isset($_SESSION['username'])) {
    header("Location: index.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <link rel="icon" type="image/png" href="images/logo.png">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" rel="stylesheet">
    <style>
        body {
            margin: 0;
            padding: 0;
            background-image: url('images/phb.png');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            height: 100vh;
            width: 100vw;
        }

        .login-container {
            max-width: 400px;
            margin: 5% auto;
            padding: 20px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            border-radius: 8px;
        }
    </style>
</head>

<body>

    <div class="container">
        <div class="login-container bg-light p-4">
            <h3 class="text-center mb-4">LOGIN</h3>
            <form id="form-login">
                <div class="form-group mb-3">
                    <label for="username" class="form-label">Username</label>
                    <input type="text" class="form-control" id="username" name="username" placeholder="Enter Username" autocomplete="off" required>
                </div>

                <div class="form-group mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control" name="password" id="password" placeholder="Enter Password" autocomplete="off" required>
                </div>

                <!-- <div class="form-check mb-3">
                    <input type="checkbox" class="form-check-input" id="rememberMe">
                    <label class="form-check-label" for="rememberMe">Remember me</label>
                </div> -->

                <div class="form-group mb-3">
                    &nbsp;
                </div>

                <div class="text-center mb-4">
                    <button type="submit" id="loginBTN" class="btn btn-primary w-50">
                        Login Now <i class="fa-solid fa-right-to-bracket"></i></button>
                </div>
            </form>
            <div id="response" class="text-center alert alert-danger"></div>

            <!-- Optional: link to register or reset password -->
            <!-- <div class="text-center mt-3">
                <p class="mb-1"><a href="#">Forgot Password?</a></p>
                <p><a href="#">Create an Account</a></p>
            </div> -->
        </div>
    </div>

    <!-- Bootstrap JS (optional, for features like tooltips) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>

    <script>
        // window.addEventListener('load', function() {
        //     document.getElementById('username').focus();
        // });

        // document.addEventListener('DOMContentLoaded', function() {
        //     document.getElementById('username').focus();
        // });
        $(document).ready(function() {
            document.getElementById('username').focus();
            $('#response').hide();

            $('#form-login').on('submit', function(e) {
                e.preventDefault();
                //var formData = $(this).serialize();
                $.ajax({
                    url: 'AppActions.php',
                    type: 'POST',
                    data: $('#form-login').serialize() + "&action=login",
                    success: function(response) {
                        //console.log(response);
                        if (response.status === "success") {
                            window.location.href = "index.php";
                        } else {
                            $('#response').show();
                            $('#response').html('<p>' + response.message + '</p>');
                            setTimeout(function() {
                                $('#response').hide();
                            }, 3000);
                        }
                    }
                });
            });
        });
    </script>
</body>

</html>