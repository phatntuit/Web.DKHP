<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="">
  <meta name="author" content="">

  <title><?php echo $page_title;?></title>

  <!-- Bootstrap Core CSS -->
  <link href="<?php echo base_url();?>assets/css/bootstrap.css" rel="stylesheet">

  <!-- Fonts -->
  <link href="<?php echo base_url();?>assets/font-awesome/css/font-awesome.min.css" rel="stylesheet">
  <link href="<?php echo base_url();?>assets/css/animate.css" rel="stylesheet" />
  <!-- Squad theme CSS -->
  <link href="<?php echo base_url();?>assets/css/style.css" rel="stylesheet">
  <link href="<?php echo base_url();?>assets/color/default.css" rel="stylesheet">
  <!-- Core JavaScript Files -->
  <script src="<?php echo base_url();?>assets/js/jquery.min.js"></script>
  <script src="<?php echo base_url();?>assets/js/bootstrap.min.js"></script>
  <script src="<?php echo base_url();?>assets/js/jquery.easing.min.js"></script>  
  <script src="<?php echo base_url();?>assets/js/jquery.scrollTo.js"></script>
  <script src="<?php echo base_url();?>assets/js/wow.min.js"></script>
  <!-- Custom Theme JavaScript -->
  <script src="<?php echo base_url();?>assets/js/custom.js"></script>
</head>
<body id="page-top" data-spy="scroll" data-target=".navbar-custom">
	<!-- Preloader -->
	<div id="preloader">
   <div id="load"></div>
 </div>
 <section id="home"></section>
 <nav class="navbar navbar-custom navbar-fixed-top" role="navigation" >
  <div class="container">
    <div class="navbar-header page-scroll">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-main-collapse">
        <i class="fa fa-bars"></i>
      </button>
      <a class="navbar-brand" href="#home">
        <h1>University of Information Technology</h1>
      </a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse navbar-right navbar-main-collapse">
      <ul class="nav navbar-nav">
        <li class="active"><a href="">Trang chủ</a></li>
        <!-- xử lý đăng nhập -->
        <li class="dropdown hidden">
          <a class="dropdown-toggle" data-toggle="dropdown">Quản trị<b class="caret"></b></a>
          <ul class="dropdown-menu">
            <li><a href="#">Thông tin sinh viên</a></li>
            <li><a href="#">Thông tin học phí</a></li>
            <li><a href="#">Kết quả học tập</a></li>
            <li><a href="#">Thời khóa biểu</a></li>
            <li><a href="#">Thông tin đăng ký học phần</a></li>
            <li class="disabled"><a href="#" >Đăng ký học phần</a></li>
          </ul>
        </li>
        <!-- kết thúc xử lý đăng nhập -->
        <li><a href="#">Trợ giúp</a></li>
        <li><a href="#">Liên hệ</a></li>
        <li><a href="#about">Về chúng tôi</a></li>
        <?php 
        if(isset($username))
        {
          ?>
          <li id="user"><a href="#"><?php echo $username; ?></a></li>
          <?php
        }
        else
        {
          ?>
          <li id="loginform"><a href="#">Đăng nhập</a></li>
          <?php } ?>
        </ul>
      </div>
      <!-- /.navbar-collapse -->
    </div>
    <!-- /.container -->
  </nav>
  <!-- login form -->
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">

      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header" style="padding:35px 50px;">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4><span class="glyphicon glyphicon-log-in"  style="font-size:1.3em;"></span> Login</h4>
        </div>
        <div class="modal-body" style="padding:40px 50px;">
          <form role="form" method="post" action="#" id="form">
            <div class="form-group">
              <label for="usrname"><span class="glyphicon glyphicon-user"></span> Username</label>
              <input type="text" class="form-control" id="username" name="username" placeholder="User name">
            </div>
            <div class="form-group">
              <label for="psw"><span class="glyphicon glyphicon-eye-open"></span> Passwords</label>
              <input type="password" class="form-control" id="psw" name="pwd" placeholder="Passwords">
            </div>
            <button type="button" class="btn btn-success btn-block" id="login" onclick="login()"><span class="glyphicon glyphicon-off"></span>Login</button>
          </form>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-danger btn-default pull-right" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Cancel</button>
          <!-- <p>Not a member? <a href="#">Sign Up</a></p>
          <p>Forgot <a href="#">Password?</a></p> -->
        </div>
      </div>
      
    </div>
  </div>
  <!-- end login form -->
  <!-- Section: intro -->
  <section id="intro" class="intro">

    <div class="slogan">
     <h3>Trường ĐH Công Nghệ Thông Tin-<span class="text_color">ĐHQG TP.HCM</span></h3>
     <h4>Trang quản lý đăng ký học phần</h4>
   </div>
   <div class="page-scroll">
     <a href="#content" class="btn btn-circle">
      <i class="fa fa-angle-double-down animated"></i>
    </a>
  </div>
</section>
	<!-- /Section: intro -->