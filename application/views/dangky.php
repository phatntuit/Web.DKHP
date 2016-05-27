	<div class="row"></div>
	<section id="content">
		<div class="row" id="result">
			<div class="container"><br><br><br>
				<div align="center"><h4 style="color:blue">ĐĂNG KÝ HỌC PHẦN HỌC KỲ <?php if(isset($_SESSION['hocky'])) echo $_SESSION['hocky']?> NĂM HỌC <?php if(isset($_SESSION['namhoc'])) echo $_SESSION['namhoc']?></h3></div>
				<div id="success"></div>
				<div id="error"></div>
				<div>
					<div class="form-wrapper"><span><a style="color:blue" data-toggle="collapse" data-target="#dangkynhanh" href="javascript:void(0)" id="dkn">Đăng ký nhanh</a><hr></span></div><br>
					<div id="dangkynhanh" class="collapse">
						<label>Đăng ký nhanh</label>
						<div class="form-textarea">
							<textarea row="5" cols="60" class="form-textarea" id="edit-dsmh" name="edit-dsmh"></textarea>
						</div>
						<div class="">Mỗi mã lớp nằm trên 1 dòng.</div>
						<button id="dangky" class="btn-success btn">Đăng ký</button>
					</div>
				</div>
				<div>
					<div class="form-wrapper"><span><a style="color:blue" data-toggle="collapse" data-target="#dieukienloc" href="javascript:void(0)">Chọn điều kiện lọc</a><hr></span></div><br>
					<div id="dieukienloc" class="collapse">
						<div class="form-group col-md-4">
							<label>Loại môn học</label>
							<select class="form-control">
								<option value="">Tất cả</option>
							</select>
						</div>
						<div class="form-group col-md-4">
							<label>Khoa/BM/TT quản lý</label>
							<select class="form-control">
								<option value="">Tất cả</option>
							</select>
						</div>
						<div class="form-group col-md-4">
							<label>Mã môn học</label>
							<select class="form-control">
								<option value="">Tất cả</option>
							</select>
						</div>
					</div>
				</div>
				<div align="center"><h4 style="color:blue">LỚP HỌC ĐANG MỞ</h3></div>
				<div>

				</div>
			</div>
		</div>
	</section>
	<?php $this->load->view('template/about.php'); ?>
	<?php $this->load->view('template/footer.php'); ?>
</body>

</html>