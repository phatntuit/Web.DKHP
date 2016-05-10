
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
										<label class="control-label col-md-3">Môn Học</label>
										<div class="col-md-9">
											<select class="form-control  " id="monhoc" >
												<option value="">--Chọn môn học--</option>
												<?php foreach ($monhoc as $mh) {?>
													<option value="<?php echo $mh->Mamonhoc?>"><?php echo $mh->Tenmonhoc;?></option>
												<?php } ?>
											</select>
											<span class="help-block"></span>
										</div>
									</div>
									<div class="form-group">
										<label class="control-label col-md-3">Khoa</label>
										<div class="cold-md-9">
											<select class="form-control  " id="khoa">
												<option value="">--Chọn khoa--</option>
												<?php foreach ($khoa as $kh) {?>
													<option value="<?php echo $kh->Makhoa?>"><?php echo $kh->Tenkhoa;?></option>
												<?php } ?>
											</select>
											<span class="help-block"></span>
										</div>
									</div>
									<div class="form-group">
										<label class="control-label cold-md-3">Giáo Viên</label>
										<div class="cold-md-9">
											<select class="form-control  " id="giaovien">
												<option value="">--Chọn giáo viên--</option>
												<?php foreach ($giaovien as $gv) {?>
													<option value="<?php echo $gv->Magiaovien?>"><?php echo $gv->Tengiaovien;?></option>
												<?php } ?>
											</select>
											<span class="help-block"></span>
										</div>
									</div>
									<div class="form-group">
										<label class="control-label cold-md-3">Phòng</label>
										<div class="cold-md-9">
											<select class="form-control  " id="phong">
												<option value="">--Chọn phòng--</option>
												<?php foreach ($phong as $ph) {?>
													<option value="<?php echo $ph->Maphong?>"><?php echo $ph->Maphong;?></option>
												<?php } ?>
											</select>
											<span class="help-block"></span>
										</div>
									</div>
									<div class="form-group">
										<label class="control-label cold-md-3">Năm Học</label>
										<div class="cold-md-9">
											<select class="form-control  " id="namhoc">
												<option value="">--Chọn năm học--</option>
												<?php foreach ($namhoc as $nh) {?>
													<option value="<?php echo $nh->Manamhoc?>"><?php echo $nh->Tennamhoc;?></option>
												<?php } ?>
											</select>
											<span class="help-block"></span>
										</div>
									</div>
									<div class="form-group">
										<label class="control-label cold-md-3">Học Kỳ</label>
										<div class="cold-md-9">
											<select class="form-control  " id="hocky">
												<option value="">--Chọn học kỳ--</option>
												<?php foreach ($hocky as $hk) {?>
													<option value="<?php echo $hk->Mahocky?>"><?php echo $hk->Tenhocky;?></option>
												<?php } ?>
											</select>
											<span class="help-block"></span>
										</div>
									</div>
									<div class="form-group">
										<label class="control-label cold-md-3">Tiết Bắt Đầu</label>
										<div class="cold-md-9">
											<select class="form-control " id="tietbatdau" >
												<option value="">--Chọn tiết bắt đầu--</option>
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
											<span class="help-block"></span>
										</div>
									</div>
									<div class="form-group">
										<label class="control-label cold-md-3">Tiết Kết Thúc</label>
										<div class="cold-md-9">
											<select class="form-control" id="tietketthuc" >
												<option value="">--Chọn tiết kết thúc--</option>
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
											<span class="help-block"></span>
										</div>
									</div>
									<div class="form-group">
										<label class="control-label cold-md-3">Thứ</label>
										<div class="cold-md-9">
											<select class="form-control " id="thu" >
												<option value="">--Chọn thứ--</option>
												<option value="2">2</option>
												<option value="3">3</option>
												<option value="4">4</option>
												<option value="5">5</option>
												<option value="6">6</option>
												<option value="7">7</option>
											</select>
											<span class="help-block"></span>
										</div>
									</div>
									<div class="form-group">
										<label class="control-label cold-md-3">Cách Tuần</label>
										<div class="cold-md-9">
											<select class="form-control" id="cachtuan" >
												<option value="">--Cách tuần--</option>
												<option value="1">1</option>
												<option value="2">2</option>
											</select>
											<span class="help-block"></span>
										</div>
									</div>
									<div class="form-group">
										<label class="control-label cold-md-3">Hình Thức</label>
										<div class="cold-md-9">
											<select class="form-control " id="hinhthuc" >
												<option value="">--Chọn hình thức--</option>
												<option value="LT">Lý Thuyết</option>
												<option value="TH">Thực Hành</option>
											</select>
											<span class="help-block"></span>
										</div>
									</div>
									<div class="form-group">
										<label class="control-label cold-md-3">Sĩ Số</label>
										<div class="cold-md-9">
											<input class="form-control " type="number" id="siso" >
											<span class="help-block"></span>
										</div>
									</div>
									<div class="form-group">
										<label class="control-label cold-md-3">Ngày Bắt Đầu</label>
										<div class="cold-md-9">
											<input id="ngaybatdau" placeholder="yyyy-mm-dd" class="form-control datepicker" type="text">
											<span class="help-block"></span>
										</div>
									</div>
									<div class="form-group">
										<label class="control-label cold-md-3">Ngày Kết Thúc</label>
										<div class="cold-md-9">
											<input id="ngayketthuc" placeholder="yyyy-mm-dd" class="form-control datepicker" type="text">
											<span class="help-block"></span>
										</div>
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
