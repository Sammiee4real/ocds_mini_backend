<?php 
  session_start();
  require_once('config/database_functions.php');
  if(isset($_SESSION['uid'])){
        header('location: home.php');
      }

include('inc/header.php'); 

?>


<!-- <body class="bg-gradient-success"> -->
<body  style="background-image: linear-gradient(to right,#FCF6F5FF, #00A4CCFF);">

  <div class="container">

    <!-- Outer Row -->
    <div class="row justify-content-center">

      <div class="col-xl-10 col-lg-12 col-md-9">

        <div class="card o-hidden border-0 shadow-lg my-5">
          <div class="card-body p-0">
            <!-- Nested Row within Card Body -->
            <div class="row">
              <div class="col-lg-6 d-none d-lg-block bg-login-image"></div>
              <div class="col-lg-6">
                <div class="p-5">
                  <div class="text-center">
                    <h1 class="h4 text-gray-900 mb-4">OCDS Admin</h1>
                  </div>
                  <form class="user" method="POST" id="login_form">
                    <div class="form-group">
                      <input type="email" id="email" name="email" class="form-control form-control-user" id="exampleInputEmail" aria-describedby="emailHelp" placeholder="Enter Email Address...">
                    </div>
                    <div class="form-group">
                      <input type="password" id="password" name="password" class="form-control form-control-user" id="exampleInputPassword" placeholder="Password">
                    </div>
                    <div class="form-group">
                      <div class="custom-control custom-checkbox small">
                        <input type="checkbox" class="custom-control-input" id="customCheck">
                        <label class="custom-control-label" for="customCheck">Remember Me</label>
                      </div>
                    </div>
                    <a href="" class="btn btn-primary btn-user btn-block" id="cmd_login">
                      Login
                    </a>
                   <!--  <hr>
                    <a href="" class="btn btn-google btn-user btn-block">
                      <i class="fa fa-key"></i> Reset Password
                    </a> -->
                   <!--  <a href="" class="btn btn-facebook btn-user btn-block">
                      <i class="fab fa-facebook-f fa-fw"></i> Login with Facebook
                    </a> -->
                  </form>
                  <hr>
                 <!--  <div class="text-center">
                    <a class="small" href="#">Forgot Password?</a>
                  </div>
                  <div class="text-center">
                    <a class="small" href="#">Create an Account!</a>
                  </div> -->
                </div>
              </div>
            </div>
          </div>
        </div>

      </div>

    </div>

  </div>

 
 <?php include('inc/scripts.php'); ?>
