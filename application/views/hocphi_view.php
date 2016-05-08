<div class="row"></div>
<section id="content">
    <div class="row" id="result">
  <p id="tt" class="text-center">THÔNG TIN HỌC PHÍ</p>
  <?php $query =  $this->db->get('sinhvien');
        $query_result = $query->result_object();
   ?>
  <div class="container">
  <p class="text-PRIMARY">THÔNG TIN SINH VIÊN</p>
	<table class="table table-bordered">
      <tr>
        <th>Họ và tên</th>
        <th><?php foreach($query_result as $tr){ echo $tr->Hoten;} ?></th>
      </tr>
      <tr>
        <td>MSSV</td>
        <td>13520686</td>
      </tr>
      <tr>
        <td>Ngày Sinh</td>
        <td>05/10/1995</td>
      </tr>
      <tr>
      	<td>Giới tính</td>
      	<td>Nam</td>
      </tr>
      <tr>
      	<td>Ngành học</td>
      	<td>HTTT</td>
      </tr>
  </table>
    <p class="text-PRIMARY">THÔNG TIN HỌC PHÍ</p>
    <table class="table table-bordered">
      <tr>
        <th>Năm học</th>
        <th>Học kì</th>
        <th>Học phí</th>
      </tr>
      <?php foreach($hocphi as $tr){
       echo "<tr>";
       echo "<td>".$tr->hocki."</td>";
       echo "<td>".$tr->namhoc."</td>";
       echo "<td".$tr->hocphi."</td>";
       echo "</tr>" ; } ?>
  </table>
  </div>
</div>
</section>
<?php $this->load->view('template/about.php'); ?>
<?php $this->load->view('template/footer.php'); ?>


