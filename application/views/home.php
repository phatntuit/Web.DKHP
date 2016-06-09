<div class="row">
	<div class="container">
		<div class="row">
			<div class="col-xs-3 col-sm-3 col-md-3 col-lg-3"></div>
			<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
				<?php 
					if(!isset($_SESSION['id']))
					{
						echo "<p class='has-error'>(*) Bạn vui lòng đăng nhập để sử dụng website.</p>";
						$this->load->view('template/login');
					}
					else
					{
						echo "<p>Hello ,"."<a href='javascript:void(0)'>".$_SESSION['id']."</a>!</p>
						<p>Chào mừng bạn đến với website "."<a href='".site_url('')."'>
						Quản lý đăng ký học phần.</p></a>";
					}
				?>
			</div>
		</div>
	</div>
</div>
<?php 
$this->load->view('template/about.php');
$this->load->view('template/footer.php'); 
?>
