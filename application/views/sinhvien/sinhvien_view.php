<?php 
$this->load->view('template/header');?>
<!-- write content -->
<div class="row"><p></p></div>
<?php 
	if(isset($_SESSION['id']))
	{ 
		if ($_SESSION['quyen']=='ADMIN')
		{
			$this->load->view('sinhvien/sinhvien_detail');
		} 	
		else
		{
			echo "<div class='container'>
					<div class='col-xs-3 col-sm-3 col-md-3 col-lg-3'></div>
					<div class='col-xs-4 col-sm-4 col-md-4 col-lg-4'>
					<p class='has-error'>Đăng nhập với quyền admin để truy cập.
					</p>";
			$this->load->view('template/login');
			echo "</div></div>";
		}
	}
	else
	{
		echo "<div class='container'>
		<div class='col-xs-3 col-sm-3 col-md-3 col-lg-3'></div>
		<div class='col-xs-4 col-sm-4 col-md-4 col-lg-4'><p class='has-error'>(*) Bạn vui lòng đăng nhập để sử dụng website.</p>";
		$this->load->view('template/login');
		echo "</div></div>";
	}
?>
<!-- end of content -->
<?php 
$this->load->view('template/about');
$this->load->view('template/footer');
?>