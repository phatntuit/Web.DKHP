<div class="row">
	<!-- table sinhvien -->
	<div class="container">
		<div class="col-xs-11 col-sm-11 col-md-11 col-lg-11">
			<div class="row">
				<button class="btn btn-primary" data-toggle="modal" href='#modal-sv'>
					<span class="glyphicon glyphicon-plus"></span>Thêm</button>
					<button class="btn btn-default"><span class="glyphicon glyphicon-refresh"></span>Tải lại
					</button>
				</div>
			</br>
			<div class="row" id="table-sv">
				<table class="table table-hover table-responsive table-striped">
					<thead>
						<tr>
							<th>Mã số sinh viên</th>
							<th>Họ tên</th>
							<th>Giới tính</th>
							<th>Ngày sinh</th>
							<th>Quê quán</th>
							<th>Ngành</th>
							<th>Khóa</th>
							<th>Chức năng</th>
						</tr>
					</thead>
					<tbody>
						<?php foreach ($sinhvien as $sv) { ?>
							<tr>
								<?php 
								$edit="Edit_sv('".$sv['Mssv']."')";
								$delete="Delete_sv('".$sv['Mssv']."')";
								?>
								<td><?php echo $sv['Mssv']; ?></td>
								<td><?php echo $sv['Hoten']; ?></td>
								<td><?php echo $sv['Gioitinh']; ?></td>
								<td><?php echo $sv['Ngaysinh']; ?></td>
								<td><?php echo $sv['Quequan']; ?></td>
								<td><?php echo $sv['Tennganh']; ?></td>
								<td><?php echo $sv['Makhoahoc']; ?></td>
								<td>
									<a class="btn btn-sm btn-primary" href="javascript:void(0)" title="Sửa" onclick="<?php echo $edit; ?>">
										<i class="glyphicon glyphicon-pencil"></i>Sửa
									</a>
									<a class="btn btn-sm btn-danger" href="javascript:void(0)" title="Xóa" onclick="<?php echo $delete; ?>">
										<i class="glyphicon glyphicon-trash"></i>Xóa
									</a>
								</td>
							</tr>
							<?php } ?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="modal fade" id="modal-sv">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
						<h4 class="modal-title">Thêm sinh viên</h4>
					</div>
					<div class="modal-body">
						<form action="javascipt:void(0)" method="POST" role="form" id="formsv">     
							<div class="form-group">
								<table class="table table-responsive">
									<tr>
										<td class="sv">
											<label for="id_tensv">Họ tên</label>
										</td>
										<td class="sv">
											<input type="text" class="form-control" id="ten_sv" placeholder="Nguyễn Tấn Phát">
										</td>
										<td class="sv">
											<label for="gioitinh_sv">Giới tính</label>
										</td>
										<td class="sv">
											<select class="form-control" id="ngaysinh_sv">
												<option value="-1">-Chọn giới tính-</option>
												<option value="1">Nam</option>
												<option value="0">Nữ</option>
											</select>
										</td>
									</tr>
									<tr>
										<td class="sv">
											<label for="ngaysinh_sv">Ngày sinh</label>
										</td>
										<td class="sv">
											<input type="text" class="form-control ngaysv" id="ngaysinh_sv" placeholder="28-06-1995">
										</td>
										<td class="sv">
											<label for="quequan_sv">Quê quán</label>
										</td>
										<td class="sv">
											<input type="text" class="form-control" id="quequan_sv" placeholder="Tây Ninh">
										</td>
									</tr>
									<tr>
										<td class="sv"><label for="nganh_sv">Ngành</label></td>
										<td class="sv">
											<select class="form-control" id="nganh_sv">
												<option value="-1">-Chọn ngành-</option>
												<?php foreach ($nganh as $ng) { ?>
													<option value="<?php  echo $ng->Manganh; ?>"><?php echo $ng->Tennganh; ?></option>
													<?php } ?>
												</select>
											</td>
											<td class="sv"><label for="quequan_sv">Khóa</label></td>
											<td class="sv">
												<select class="form-control" id="ngaysinh_sv">
													<option value="-1">-Chọn khóa-</option>
													<?php foreach ($khoahoc as $kh) { ?>
														<option value="<?php  echo $kh->Makhoahoc; ?>"><?php echo $kh->Makhoahoc; ?></option>
														<?php } ?>
													</select>
												</td>
											</tr>
										</table>
									</div>
								</form>
							</div>
							<div class="modal-footer">
								<button type="submit" class="btn btn-primary" id="btluu">Lưu</button>
								<button type="button" class="btn btn-danger" data-dismiss="modal">Đóng</button>
							</div>
						</div>
					</div>
				</div>
			</div>