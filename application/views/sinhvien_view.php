<?php 
$this->load->view('template/header');?>
<!-- write content -->
<div class="row"><p></p></div>
<section id="sinhvien">
	<div class="row">
		<!-- table sinhvien -->
		<div class="container">
			<div class="col-xs-11 col-sm-11 col-md-11 col-lg-11">
			<div class="row">
				<button class="btn btn-primary" data-toggle="modal" href='#modal-id'>Thêm</button>
				<button class="btn btn-default">Reload</button>
			</div>
			</br>
			<div class="row">
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
		<div class="modal fade" id="modal-id">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
						<h4 class="modal-title">Thêm sinh viên</h4>
					</div>
					<div class="modal-body">
						<form action="#" method="POST" role="form" onsubmit="Testajaxpost();">		
							<div class="form-group">
								<label>Input :</label>
								<input type="text" class="form-control" id="test" placeholder="Input field">
							</div>
						</form>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
						<button type="submit" class="btn btn-primary">Save</button>
						<div id="result"></div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>

<!-- end of content -->
<?php 
$this->load->view('template/about');
$this->load->view('template/footer');
?>