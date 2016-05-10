
<div class="row"></div>
<section id="content">
	<div class="row" id="result">
		<div class="row"><p></p></div>
		<div class="container">
			<div class="row">
				<button class="btn btn-primary btn-success" id="addhocphan" data-toggle="modal" ><span class="glyphicon glyphicon-plus">Thêm</button></br></br>
				<?php if (empty($hocphan)) echo "<h3>Hiện chưa có học phần</h3>";
					else{
				?>
				<div class="table-responsive">
					<table id="mytable" class="table table-bordred table-striped">
						<thead>      
							<th><input type="checkbox" id="checkall" /></th>
							<th>Mã Lớp</th>
							<th>Môn Học</th>
							<th>Khoa</th>
							<th>Giáo Viên</th>
							<th>Phòng</th>
							<th>Học kỳ</th>   
							<th>Năm Học</th>
							<th>Thứ</th>
							<th>Tiết Học</th>
							<th>Cách Tuần</th>
							<th>Tín Chỉ</th>
							<th>Hình Thức</th>
							<th>Sĩ số</th>
							<th>Ngày bắt đầu</th>
							<th>Ngày kết thúc</th>
							<th>Chỉnh Sửa</th>
							<th>Xóa</th>
						</thead>
						<tbody>
							<?php foreach ($hocphan as $hp) {}?>
							<tr>
								<td><input type="checkbox" class="checkthis" /></td>
								<td><?php ?></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td><p data-placement="top" data-toggle="tooltip" title="Edit"><button class="btn btn-primary btn-xs" data-title="Edit" data-toggle="modal" data-target="#edit" ><span class="glyphicon glyphicon-pencil"></span></button></p></td>
								<td><p data-placement="top" data-toggle="tooltip" title="Delete"><button class="btn btn-danger btn-xs" data-title="Delete" data-toggle="modal" data-target="#delete" ><span class="glyphicon glyphicon-trash"></span></button></p></td>
							</tr>
						</tbody>
					</table>
				</div>
				<?php } ?>
			</div>
		</div>

		<div class="modal fade" id="add" tabindex="-1" role="dialog" aria-labelledby="edit" aria-hidden="true">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>
						<h4 class="modal-title custom_align" id="Heading"></h4>
					</div>
					<div class="modal-body">
						<div class="modal-body form">
						<form id="formadd" action="#">
							<div class="form-body">
								<div class="form-group">
									Môn Học
									<select class="selectpicker  " id="monhoc" data-width="100%" title="--Chọn môn học--">
										<?php foreach ($monhoc as $mh) {?>
											<option value="<?php echo $mh->Mamonhoc?>"><?php echo $mh->Tenmonhoc;?></option>
										<?php } ?>
									</select>
								</div>
								<div class="form-group">
									Khoa
									<select class="selectpicker  " id="khoa" data-width="100%" title="--Chọn khoa--">
										<?php foreach ($khoa as $kh) {?>
											<option value="<?php echo $kh->Makhoa?>"><?php echo $kh->Tenkhoa;?></option>
										<?php } ?>
									</select>
								</div>
								<div class="form-group">
									Giáo Viên
									<select class="selectpicker  " id="giaovien" data-width="100%" title="--Chọn giáo viên--">
										<?php foreach ($giaovien as $gv) {?>
											<option value="<?php echo $gv->Magiaovien?>"><?php echo $gv->Tengiaovien;?></option>
										<?php } ?>
									</select>
								</div>
								<div class="form-group">
									Phòng
									<select class="selectpicker  " id="phong" data-width="100%" title="--Chọn phòng học">
										<?php foreach ($phong as $ph) {?>
											<option value="<?php echo $ph->Maphong?>"><?php echo $ph->Maphong;?></option>
										<?php } ?>
									</select>
								</div>
								<div class="form-group">
									Năm Học
									<select class="selectpicker  " id="namhoc" data-width="100%" title="--Chọn năm học--">
										<?php foreach ($namhoc as $nh) {?>
											<option value="<?php echo $nh->Manamhoc?>"><?php echo $nh->Tennamhoc;?></option>
										<?php } ?>
									</select>
								</div>
								<div class="form-group">
									Học Kỳ
									<select class="selectpicker  " id="hocky" data-width="100%" title="--Chọn học kỳ">
										<?php foreach ($hocky as $hk) {?>
											<option value="<?php echo $hk->Mahocky?>"><?php echo $hk->Tenhocky;?></option>
										<?php } ?>
									</select>
								</div>
								
								<div class="form-group">
									Tiết Bắt Đầu
									<select class="selectpicker " id="tietbatdau" data-width="100px" data-size="5" >
										<option value="1" selected>1</option>
										<option value="2">2</option>
										<option value="3">3</option>
										<option value="4">4</option>
										<option value="5">5</option>
										<option value="6,">6</option>
										<option value="7">7</option>
										<option value="8">8</option>
										<option value="9">9</option>
										<option value="10">10</option>
									</select>
									Tiết Kết Thúc
									<select class="selectpicker" data-width="100px" data-size="5" id="tietketthuc" >
										<option value="1">1</option>
										<option value="2">2</option>
										<option value="3">3</option>
										<option value="4">4</option>
										<option value="5">5</option>
										<option value="6,">6</option>
										<option value="7">7</option>
										<option value="8">8</option>
										<option value="9">9</option>
										<option value="10">10</option>
									</select>
								</div>
								<div class="form-group">
									Thứ
									<select class="selectpicker " id="thu" data-width="100px" >
										<option value="2">2</option>
										<option value="3">3</option>
										<option value="4">4</option>
										<option value="5">5</option>
										<option value="6">6</option>
										<option value="7">7</option>
									</select>
								
									Cách Tuần
									<select class="selectpicker" data-width="100px" id="cachtuan" >
										<option value="1">1</option>
										<option value="2">2</option>
									</select>
									Hình Thức
									<select class="selectpicker " data-width="25%" id="hinhthuc" >
										<option value="LT" selected>Lý Thuyết</option>
										<option value="TH">Thực Hành</option>
									</select>
									
								</div>
								<div class="form-group">
									Sĩ Số
									<input class="form-control " type="number" id="siso" >
								</div>
								<div class="form-group">
									Ngày Bắt Đầu
									<input id="ngaybatdau" placeholder="yyyy-mm-dd" class="form-control datepicker" type="text">
								</div>
								<div class="form-group">
									Ngày Kết Thúc
									<input id="ngayketthuc" placeholder="yyyy-mm-dd" class="form-control datepicker" type="text">
								</div>
							</div>
						</form>
					</div>
					</div>
					<div class="modal-footer ">
						<button type="button" class="btn btn-warning btn-lg" style="width: 100%;" id="btthemhocphan"><span class="glyphicon glyphicon-ok-sign"></span> Thêm</button>
					</div>
				</div>
				<!-- /.modal-content --> 
			</div>
			<!-- /.modal-dialog --> 
		</div>


		<div class="modal fade" id="edit" tabindex="-1" role="dialog" aria-labelledby="edit" aria-hidden="true">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>
						<h4 class="modal-title custom_align" id="Heading">Chỉnh Sửa Chi Tiết</h4>
					</div>
					<div class="modal-body">
						<div class="form-group">
							<input class="form-control " type="text" placeholder="Mohsin">
						</div>
						<div class="form-group">

							<input class="form-control " type="text" placeholder="Irshad">
						</div>
						<div class="form-group">
							<textarea rows="2" class="form-control" placeholder="CB 106/107 Street # 11 Wah Cantt Islamabad Pakistan"></textarea>


						</div>
					</div>
					<div class="modal-footer ">
						<button type="button" class="btn btn-warning btn-lg" style="width: 100%;"><span class="glyphicon glyphicon-ok-sign"></span> Chỉnh Sửa</button>
					</div>
				</div>
				<!-- /.modal-content --> 
			</div>
			<!-- /.modal-dialog --> 
		</div>



		<div class="modal fade" id="delete" tabindex="-1" role="dialog" aria-labelledby="edit" aria-hidden="true">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>
						<h4 class="modal-title custom_align" id="Heading">Xóa Học Phần</h4>
					</div>
					<div class="modal-body">

						<div class="alert alert-danger"><span class="glyphicon glyphicon-warning-sign"></span> Bạn có muốn xóa học phần này không?</div>

					</div>
					<div class="modal-footer ">
						<button type="button" class="btn btn-success" ><span class="glyphicon glyphicon-ok-sign"></span> Có</button>
						<button type="button" class="btn btn-default" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Không</button>
					</div>
				</div>
				<!-- /.modal-content --> 
			</div>
			<!-- /.modal-dialog --> 
		</div>
	</div>
</section>
<?php $this->load->view('template/about.php'); ?>
<?php $this->load->view('template/footer.php'); ?>
