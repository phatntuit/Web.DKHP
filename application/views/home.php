	<div class="row">
		</br>
	</div>
	<section id="content">
		<div class="row" id="result">
			<div class="container">
				<?php if(isset($_SESSION['id'])==False ){ ?>
				<div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
					
				</div>
				<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6" id="login_area">
					<?php $this->load->view('template/login'); ?>
				</div>
				<?php } else { ?>
				<div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">
					
				</div>
				<div class="col-xs-8 col-sm-8 col-md-8 col-lg-8" id="home_content">
					
				</div>
				<?php } ?>
			</div>
		</div>
	</section>
	<?php $this->load->view('template/about.php'); ?>
	<?php $this->load->view('template/footer.php'); ?>
</body>

</html>
