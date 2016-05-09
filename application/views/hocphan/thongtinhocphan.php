
<div class="row"></div>
<section id="content">
	<div class="row" id="result">
		<div class="row"><p></p></div>
		<div class="container">
			<div class="row">
				<button class="btn btn-primary btn-success" data-title="add" data-toggle="modal" data-target="#add" ><span class="glyphicon glyphicon-plus">Thêm</button></br></br>
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
						<h4 class="modal-title custom_align" id="Heading">Thêm Học Phần</h4>
					</div>
					<div class="modal-body">
						<div class="form-group">

						</div>
						<div class="form-group">

						</div>
						<div class="form-group">

						</div>
						<div class="form-group">

						</div>
						<div class="form-group">

						</div>
						<div class="form-group">

						</div>
						<div class="form-group">
							Sĩ Số
							<input class="form-control " type="text" id="siso" >
						</div>
						<div class="form-group">

							Thứ
							<select style="margin-right:10px;" id="thu">
								<option value="2">2</option>
								<option value="3">3</option>
								<option value="4">4</option>
								<option value="5">5</option>
								<option value="6">6</option>
								<option value="7">7</option>
							</select>
							
							Tiết Học
							<select style="margin-right:10px;" id="tiethoc">
								<option value="1,2,3">1,2,3</option>
								<option value="1,2,3,4">1,2,3,4</option>
								<option value="1,2,3,4,5">1,2,3,4,5</option>
								<option value="4,5">4,5</option>
								<option value="6,7,8">6,7,8</option>
								<option value="6,7,8,9">6,7,8,9</option>
								<option value="6,7,8,9,10">6,7,8,9,10</option>
								<option value="9,10">9,10</option>
							</select>
					
							Cách Tuần
							<select style="margin-right:10px;" id="cachtuan">
								<option value="1">1</option>
								<option value="2">2</option>
							</select>
							Hình Thức
							<select id="hinhthuc">
								<option value="LT">Lý Thuyết</option>
								<option value="TH">Thực Hành</option>
							</select>
							
						</div>
						<div class="form-group">
							Ngày Bắt Đầu
							<input id="ngaybatdau" placeholder="yyyy-mm-dd" class="form-control datepicker" type="text">
						</div>
						<div class="form-group">
							Ngày Kết thúc
							<input id="ngayketthuc" placeholder="yyyy-mm-dd" class="form-control datepicker" type="text">
						</div>
					</div>
					<div class="modal-footer ">
						<button type="button" class="btn btn-warning btn-lg" style="width: 100%;"><span class="glyphicon glyphicon-ok-sign"></span> Thêm</button>
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
