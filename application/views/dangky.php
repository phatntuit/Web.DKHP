
		<div class="row" id="result">
			<div class="container"><br><br><br>
				<div align="center"><h4 style="color:blue">ĐĂNG KÝ HỌC PHẦN HỌC KỲ <?php if(isset($_SESSION['hocky'])) echo $_SESSION['hocky']?> NĂM HỌC <?php if(isset($_SESSION['namhoc'])) echo $_SESSION['namhoc']?></h3></div>
				<div id="success"></div>
				<div id="error"></div>
				<div class="row">
					<?php if(!empty($test)){?>
					<div id="thongtindk">
					<div class="form-wrapper"><span><a style="color:blue" data-toggle="collapse" data-target="#dadk" href="javascript:void(0)">Lớp đã đăng ký</a><hr></span></div><br>
					<div id="dadk" class="collapse table-responsive">
						<table class="table table-bordred table-striped" id="chonmalop">
							<thead>
								<th></th>
								<th>Mã lớp</th>
								<th>Tên môn học</th>
								<th>Tên giáo viên</th>
								<th>Phòng</th>
								<th>Thứ</th>
								<th>Tiết học</th>
							</thead>
							<tbody>
								<?php foreach ($test as $key) { ?>
								<tr>
									<td><input id="check-malop"  onchange="testchange(this);" type="checkbox" value='<?php echo $key["Malop"] ?>'></td>
									<td><?php echo $key['Malop']?></td>
									<td><?php echo $key['Tenmonhoc']?></td>
									<td><?php echo $key['Tengiaovien']?></td>
									<td><?php echo $key['Maphong']?></td>
									<td><?php echo $key['Thu']?></td>
									<td><?php for($i=$key['Tietbatdau'];$i<=$key['Tietketthuc'];$i++) echo $i.',';?></td>
								</tr>
								<?php }?>
							</tbody>
						</table>
						<textarea id='ds-malop-huy' name="ds-malop-huy" class="hidden"></textarea>
						<button id="huydk" class="btn-danger btn">Hủy học phần</button>
						<p>Tổng số tín chỉ:<?php echo $test[0]['Tongsotinchi']?></p>
						<p>Học phí tạm tính:<?php echo $test[0]['Hocphitamtinh']?></p>
					</div>
					</div>
					<?php } ?>
				</div>
				<div class="row">
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
				<div class="row">
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
				<div align="center"><h4 style="color:blue">LỚP HỌC ĐANG MỞ</h3>
				</div>
				<div class="table-responsive">
					<table id="mytable" class="table table-bordred table-striped">
                   <thead>
                   	<th>Chọn</th>
                   <th>Mã lớp</th>
                   <th>Tên môn học</th>
                   <th>Tên giáo viên</th>
                   <th>Thứ</th>
                   <th>Tiết bắt đầu</th>
                   <th>Tiết kết thúc</th>
                   <th>Sỉ số dự kiến</th>
                   <th>Sỉ số hiện tại</th>
                   </thead>
    				<tbody>
				      <?php foreach($hocphan as $hp){?>

				      <tr>
				      	<td><input type="checkbox" onchange="chondk(this);" value='<?php echo $hp->Malop; ?>'></td>
				        <td><?php echo $hp->Malop; ?> </td>
				        <td><?php echo $hp->Tenmonhoc; ?> </td>
				        <td><?php echo $hp->Tengiaovien; ?> </td>
				        <td><?php echo $hp->Thu; ?> </td>
				        <td><?php echo $hp->Tietbatdau; ?> </td>
				        <td><?php echo $hp->Tietketthuc; ?> </td>
				        <td><?php echo $hp->Sisodukien; ?> </td>
				        <td><?php echo $hp->Sisohientai; ?> </td>
  						</tr>
  						<?php } ?>
    					</tbody>
					</table>
					<textarea id='ds-malop-dk' name="ds-malop-dk" class="hidden"></textarea>
					<div><button id="chondangky" class="btn-success btn">Đăng ký</button></div>
				</div>
		</div>
	</div>
	<?php $this->load->view('template/about.php'); ?>
	<?php $this->load->view('template/footer.php'); ?>