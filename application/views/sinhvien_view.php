<?php 
$this->load->view('template/header');?>
<!-- write content -->
<div class="row"><p></p></div>
<section id="sinhvien">
	<div class="row">
		<!-- table sinhvien -->
		<div class="container">
			<div class="col-xs-8 col-sm-8 col-md-8 col-lg-8">
			<div class="row">
				<button class="btn btn-primary" data-toggle="modal" href='#modal-id'>Thêm</button>
				<button class="btn btn-default">Reload</button>
			</div>
			</br>
			<table class="table table-hover table-responsive table-striped">
				<thead>
					<tr>
						<th>Tên</th>
						<th>Tuổi</th>
						<th>Giới tính</th>
						<th>Năm sinh</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td>Phát</td>
						<td>21</td>
						<td>Nam</td>
						<td>1995</td>
					</tr>
					<tr>
						<td>Phát</td>
						<td>21</td>
						<td>Nam</td>
						<td>1995</td>
					</tr>
				</tbody>
			</table>
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
						<form action="#" method="POST" role="form">
							<legend>Form title</legend>
						
							<div class="form-group">
								<label for="">label</label>
								<input type="text" class="form-control" id="" placeholder="Input field">
							</div>
						
							
						
							<button type="submit" class="btn btn-primary">Submit</button>
						</form>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
						<button type="button" class="btn btn-primary">Save changes</button>
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