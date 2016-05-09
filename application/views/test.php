<!DOCTYPE html>
<html>
<head>
	<title>test_stored</title>
</head>
<body>
	<table>
		<thead>
			<th>Tên giáo viên</th>
			<th>Học vị</th>
			<th>Giới tính</th>
			<th>Ngày sinh</th>
			<th>Địa chỉ</th>
			<th>Điện thoại</th>
			<th>Email</th>
		</thead>
		<tbody>
		<?php 
			foreach ($giaovien as $key) {
		 ?>
		 <tr>
		 	<td><?php echo $key['Tengiaovien'] ?></td>
		 	<td><?php echo $key['Tenhocvi']; ?></td>
		 	<td><?php echo $key['Gioitinh']; ?></td>
		 	<td><?php echo $key['Ngaysinh']; ?></td>
		 	<td><?php echo $key['Diachi']; ?></td>
		 	<td><?php echo $key['Dienthoai']; ?></td>
		 	<td><?php echo $key['Email']; ?></td>
		 </tr>
		 <?php } ?>
	</table>
</body>
</html>