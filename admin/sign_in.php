<?php require 'components/authenticate.php' ?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <link rel="apple-touch-icon" sizes="180x180" href="../assets/favicon/apple-touch-icon.png">
        <link rel="icon" type="image/png" sizes="32x32" href="../assets/favicon/favicon-32x32.png">
        <link rel="icon" type="image/png" sizes="16x16" href="../assets/favicon/favicon-16x16.png">
        <title>Sign In | Admin - FABOTS</title>
        <!-- Bootstrap core CSS -->
        <link href="assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" />
        <link href="assets/plugins/animate/animate.css" rel="stylesheet" />
        <link href="assets/css/util.css" rel="stylesheet" />
        <link href="assets/css/login.css" rel="stylesheet" />

    </head>
    <body>
        <section class="limiter">
            <div class="container-login100">
                <div class="wrap-login100">
                    <div class="login100-pic js-tilt" data-tilt>
                        <img src="assets/img/img-01.png" alt="IMG">
                    </div>
                    <form class="login100-form" onsubmit="return sign_in(this);">
                        <div class="text-center p-b-40">
                            <img src="../assets/images/bots/logo-1.png" height="35" alt="" loading="lazy" />
                            <span class="login100-form-title m-tb-3">Member Login </span>
                        </div>

                        <div class="form-label-group">
                            <input type="text" id="user_name" name="user_name" class="form-control" placeholder="Email Or Username" required autofocus>
                            <label for="username">Email Or Username</label>
                        </div>

                        <div class="form-label-group">
                            <input type="password" id="password" name="password" class="form-control" placeholder="Password" required>
                            <label for="password">Password</label>
                        </div>

                        <div class="form-check mb-3">
                            <input type="checkbox" class="form-check-input" id="remember_me" name="remember_me">
                            <label class="form-check-label" for="remember_me">Remember Me</label>
                        </div>

                        <div class="mb-3">
                            <div class="processing"></div>
                            <div class="feedback"></div>
                        </div>
                        <button type="submit" class="btn btn-lg btn-primary btn-block">Sign in</button>
                        <p class="mt-5 mb-3 text-muted text-center"><strong>Copyright &copy; 2021 <a href="https://fabots.sntaks.me">FABOTS</a>.</strong> &nbsp;&nbsp;All rights reserved.</p>
                    </form>
                </div>
            </div>
        </section>
        <script src="assets/plugins/jquery/jquery.js"></script>
        <script src="assets/plugins/bootstrap/js/bootstrap.bundle.js"></script>
        <script src="assets/plugins/tilt/tilt.jquery.min.js"></script>
        <script>$('.js-tilt').tilt({scale: 1.1})</script>
        <script src="assets/js/data.js"></script>
        <script>
            let sign_in = (form) => {
                let form_data = new FormData(form)
                post_it('components/sign_in.php', form_data)
                return false
            }
        </script>
    </body>
</html>