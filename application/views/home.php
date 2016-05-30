<div class="row">
	<div class="container">
		<div class="row">
			<div class="col-xs-3 col-sm-3 col-md-3 col-lg-3"></div>
			<div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
				<?php 
					if(!isset($_SESSION['id']))
					{
						echo "<p class='has-error'>(*) Bạn vui lòng đăng nhập để sử dụng website.</p>";
						$this->load->view('template/login');
					}
					else
					{
						echo "This is content!";
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
