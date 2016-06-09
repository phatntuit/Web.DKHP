<div class="row">
	<div class="container">
		<div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
			
		</div>
		<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
			<table class="table table-responsive table-hover">
				<thead>
					<tr>
					<th colspan="4" style="text-align:center">THÔNG TINH SINH VIÊN <a herf='javascript:void(0)'><?php echo $sinhvien->Mssv; ?></a></th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<th>Ngày sinh:</th>
						<td><?php echo $sinhvien->Ngaysinh; ?></td>
						<th>Quê quán:</th>
						<td><?php echo $sinhvien->Quequan; ?></td>
					</tr>
					<tr>
						<th>Mã ngành:</th>
						<td><?php echo $nganh->Tennganh; ?></td>
						<th>Mã khóa học:</th>
						<td><?php echo $sinhvien->Makhoahoc; ?></td>
					</tr>
				</tbody>
			</table>
		</div>
	</div>
</div>