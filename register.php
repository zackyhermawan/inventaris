<?php
require "function.php";
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Login - SB Admin</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
        <link href="css/styles.css" rel="stylesheet" />
        <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
        <style>
            body{
                background: linear-gradient(to right, #17a2b8, #00c6ff, #0987c5);
            }
        </style>
    </head>
    <body class="bg-primary">
        <div id="layoutAuthentication">
            <div id="layoutAuthentication_content">
                <main>
                    <div class="container-fluid ">
                        <div class="row align-items-center justify-content-center vh-100">
                            <div class="col-lg-4 mb-5">
                                <div class="card shadow-lg border-0 rounded-lg mt-5">
                                    <div class="card-header"><h3 class="text-center font-weight-light">Register Inventaris</h3></div>
                                        <div class="card-body">
                                            <form method="post">
                                                <div class="mb-3">
                                                    <label for="username" class="form-label">Email</label>
                                                    <input type="text" class="form-control " id="username" name="email" placeholder="Masukan Email" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="password" class="form-label">Password</label>
                                                    <input type="password" class="form-control " id="password" name="password" placeholder="Masukan Password" required>
                                                </div>
                                                <span class="mb-3 d-block">Sudah punya akun? <a href="index.php">Login</a></span>
                                                <div class="d-grid">
                                                    <button type="submit" name="register" class="btn btn-info text-white">Register</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>
    </body>
</html>
