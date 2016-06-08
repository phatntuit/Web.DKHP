<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="">
  <meta name="author" content="">

  <title><?php echo $page_title;?></title>

  <!-- Bootstrap Core CSS -->
  <link href="<?php echo base_url('assets/css/bootstrap.min.css'); ?>" rel="stylesheet" type="text/css">
  <link href="<?php echo base_url('assets/css/bootstrap-select.css'); ?>" rel="stylesheet" type="text/css">
  <!-- Fonts -->
  <link href="<?php echo base_url();?>assets/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
  <link href="<?php echo base_url();?>assets/css/animate.css" rel="stylesheet" />
  <!-- Default theme CSS -->
  <link href="<?php echo base_url();?>assets/css/style.css" rel="stylesheet">
  <link href="<?php echo base_url();?>assets/color/default.css" rel="stylesheet">
  <!-- Core JavaScript Files -->
  <script type="text/javascript" src="<?php echo base_url();?>assets/js/jquery.min.js"></script>
  <script type="text/javascript" src="<?php echo base_url();?>assets/js/bootstrap-select.js"></script>
  <script type="text/javascript" src="<?php echo base_url();?>assets/js/bootstrap.min.js"></script>
  <script type="text/javascript" src="<?php echo base_url();?>assets/js/jquery.easing.min.js"></script>  
  <script type="text/javascript" src="<?php echo base_url();?>assets/js/jquery.scrollTo.js"></script>
  <script type="text/javascript" src="<?php echo base_url();?>assets/js/wow.min.js"></script>
  <!-- data time -->
  <link href="<?php echo base_url('assets/css/bootstrap-datepicker.min.css'); ?>" rel="stylesheet" type="text/css">
  <script type="text/javascript" src="<?php echo base_url();?>assets/js/bootstrap-datepicker.min.js"></script>
  <!--data table-->
  <link href="<?php echo base_url();?>assets/css/dataTables.bootstrap.css" rel="stylesheet">
  <script type="text/javascript" src="<?php echo base_url();?>assets/js/jquery.dataTables.min.js"></script>
  <script type="text/javascript" src="<?php echo base_url();?>assets/js/jquery.dataTables.min.js"></script>
  <script type="text/javascript" src="<?php echo base_url();?>assets/datatables/js/dataTables.bootstrap.js"></script>
  <!-- Custom Theme JavaScript -->
  <script type="text/javascript" src="<?php echo base_url();?>assets/js/custom.js"></script>
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
      <a class="navbar-brand" href="<?php echo site_url(''); ?>">
        <h1>University of Information Technology</h1>
      </a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse navbar-right navbar-main-collapse">
      <ul class="nav navbar-nav">
        <li class="active"><a href="<?php echo base_url();?>">Trang chủ</a></li>
        <!-- xử lý đăng nhập -->
        <?php 
        if(isset($_SESSION['quyen']))
        {
          if($_SESSION['quyen']=='SV')
          {
           ?>
           <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">Sinh viên
              <b class="caret"></b>
            </a>
            <ul class="dropdown-menu" id="dropmenu">
              <li><a href="#">Thông tin sinh viên</a></li>
              <li><a href="#">Thông tin học phí</a></li>
              <li><a href="#">Kết quả học tập</a></li>
              <li><a href="#">Thời khóa biểu</a></li>
              <li><a href="#">Thông tin đăng ký học phần</a></li>
              <li><a href="<?php echo base_url('dangky')?>" >Đăng ký học phần</a></li>
            </ul>
          </li>
          <?php 
        }
        else{
          ?>
          <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">Quản trị
              <b class="caret"></b>
            </a>
            <ul class="dropdown-menu" id="dropmenu">
              <li><a href="<?php echo site_url('Sinhvien')?>">Quản trị sinh viên</a></li>
              <li><a href="#">Học phí</a></li>
              <li><a href="<?php echo site_url('Hocphan')?>">Học phần</a></li>
              <li><a href="#">Quản lý tài khoản</a></li>
              <li><a href="#">Quản lý giáo viên</a></li>
              <li class="disabled"><a href="#" >Quản lý phòng học</a></li>
            </ul>
          </li>
          <?php }}?>
          <!-- kết thúc xử lý đăng nhập -->
          <li><a href="#">Trợ giúp</a></li>
          <li><a href="#lienhe">Liên hệ</a></li>
          <li><a href="#about">Về chúng tôi</a></li>
          <?php 
          if(isset($_SESSION['id']) )
          {
            ?>
            <li id="user" class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                <?php echo $_SESSION['id']; ?>
                <b class="caret"></b>
              </a>
              <ul class="dropdown-menu">
                <li><a href="#">Đổi mật khẩu</a></li>
                <li><a href="<?php echo site_url('User/logout') ?>">Đăng xuất</a></li>
              </ul>
            </li>
            <?php } ?>
          </ul>
        </div>
        <!-- /.navbar-collapse -->
      </div>
      <!-- /.container -->
    </nav>
    <!-- Section: intro -->
    <section id="intro" class="intro">

      <div class="slogan">
       <h3>Trường ĐH Công Nghệ Thông Tin-<span class="text_color">ĐHQG TP.HCM</span></h3>
       <h4><?php if(isset($header)) echo $header; else echo "Trang chủ"; ?></h4>
     </div>
     <div class="page-scroll">
       <a href="#content" class="btn btn-circle">
        <i class="fa fa-angle-double-down animated"></i>
      </a>
    </div>
  </section>
  <!-- /Section: intro -->
  <div class="row">
  </br>
</div>
<section id="content">