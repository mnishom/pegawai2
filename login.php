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
            <form method="post">
                <!-- Username input -->
                <div class="form-group mb-3">
                    <label for="username" class="form-label">Username</label>
                    <input type="text" class="form-control" id="username" name="username" placeholder="Enter Username" autocomplete="off" required>
                </div>

                <!-- Password input -->
                <div class="form-group mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control" name="password" id="password" placeholder="Enter Password" autocomplete="off" required>
                </div>

                <!-- Remember me checkbox -->
                <div class="form-check mb-3">
                    <input type="checkbox" class="form-check-input" id="rememberMe">
                    <label class="form-check-label" for="rememberMe">Remember me</label>
                </div>

                <!-- Login button -->
                <button type="button" id="loginBTN" class="btn btn-primary w-100">Login Now</button>
            </form>

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
            var usr = $('#username').val();
            var pwd = $('#password').val();


            $("#loginBTN").on("click", function() {
                $.ajax({
                    url: 'login-action.php',
                    type: 'POST',
                    data: {
                        key1: $('#username').val(),
                        key2: $('#password').val()
                    },
                    success: function(response) {
                        if (response.status === "success") {
                            alert(response.message);
                            window.location.replace("https://localhost/pegawai/index.php");
                        } else {
                            alert(response.message);
                        }

                        //console.log('Response from PHP:', response);
                    },
                    error: function(xhr, status, error) {
                        // Handle any errors
                        //console.error('Error:', error);
                    }
                });
            });




        });
    </script>



</body>

</html>