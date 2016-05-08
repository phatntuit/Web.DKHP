<div class="row"></div>
<section id="content">
    <div class="row" id="result">
<script type="text/javascript" scr="js/custom.js"></script>
<title><?php echo "$page_title" ?></title>
<div class="row"><p></p></div>
<div class="container">
	<div class="row">
        <div class="col-md-12">
        <div class="table-responsive">
              <table id="mytable" class="table table-bordred table-striped">
                   <thead>
                   <th><input type="checkbox" id="checkall" /></th>
                   <th>Tên giáo viên</th>
                    <th>Giới tính</th>
                     <th>Học vị</th>
                     <th>Ngày sinh</th>
                     <th>Địa chỉ</th>
                      <th>Điện thoại</th>
                      <th>Email</th>
                      <th>Edit</th>
                       <th>Delete</th>
                   </thead>
    <tbody>
      <?php foreach($giaovien as $gv){?>
      <tr>
        <td><input type="checkbox" class="checkthis" /></td>
        <td><?php echo $gv->Tengiaovien; ?> </td>
        <td><?php echo $gv->Gioitinh; ?> </td>
        <td><?php echo $gv->Mahocvi; ?> </td>
        <td><?php echo $gv->Ngaysinh; ?> </td>
        <td><?php echo $gv->Diachi; ?> </td>
        <td><?php echo $gv->Dienthoai; ?> </td>
        <td><?php echo $gv->Email; ?> </td>
        <td><p data-placement="top" data-toggle="tooltip" title="Edit"><button class="btn btn-primary btn-xs" data-title="Edit" data-toggle="modal" data-target="#edit" ><span class="glyphicon glyphicon-pencil"></span></button></p></td>
        <td><p data-placement="top" data-toggle="tooltip" title="Delete"><button class="btn btn-danger btn-xs" data-title="Delete" data-toggle="modal" data-target="#delete" ><span class="glyphicon glyphicon-trash"></span></button></p></td>
  </tr>
      <?php } ?>
    </tbody>
</table>

<div class="clearfix"></div>
<ul class="pagination pull-right">
  <li class="disabled"><a href="#"><span class="glyphicon glyphicon-chevron-left"></span></a></li>
  <li class="active"><a href="#">1</a></li>
  <li><a href="#">2</a></li>
  <li><a href="#">3</a></li>
  <li><a href="#">4</a></li>
  <li><a href="#">5</a></li>
  <li><a href="#"><span class="glyphicon glyphicon-chevron-right"></span></a></li>
</ul>
                
            </div>
            
        </div>
	</div>
</div>


<div class="modal fade" id="edit" tabindex="-1" role="dialog" aria-labelledby="edit" aria-hidden="true">
      <div class="modal-dialog">
    <div class="modal-content">
          <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>
        <h4 class="modal-title custom_align" id="Heading">Edit Your Detail</h4>
      </div>
          <div class="modal-body">
          <div class="form-group">
        <input name="Magiaovien" class="form-control " type="text">
        </div>
        <div class="form-group">
        
        <input name="Tengiaovien" class="form-control " type="text">
        </div>
        <div class="form-group">
        <textarea rows="2" class="form-control" placeholder="CB 106/107 Street # 11 Wah Cantt Islamabad Pakistan"></textarea>
    
        
        </div>
      </div>
          <div class="modal-footer ">
        <button type="button" class="btn btn-warning btn-lg" style="width: 100%;"><span class="glyphicon glyphicon-ok-sign"></span> Update</button>
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
        <h4 class="modal-title custom_align" id="Heading">Delete this entry</h4>
      </div>
          <div class="modal-body">
       
       <div class="alert alert-danger"><span class="glyphicon glyphicon-warning-sign"></span> Are you sure you want to delete this Record?</div>
       
      </div>
        <div class="modal-footer ">
        <button type="button" class="btn btn-success" ><span class="glyphicon glyphicon-ok-sign"></span> Yes</button>
        <button type="button" class="btn btn-default" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> No</button>
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

<script type="text/javascript">
function edit_person(id)
{
    save_method = 'update';
   // $('#form')[0].reset(); // reset form on modals
   // $('.form-group').removeClass('has-error'); // clear error class
   // $('.help-block').empty(); // clear error string

    //Ajax Load data from ajax
    $.ajax({
        url : "<?php echo site_url('giaovien/ajax_edit/')?>/" + id,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {

            $('[name="Magiaovien"]').val(data.id);
            $('[name="Tengiaovien"]').val(data.Tengiaovien);
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error get data from ajax');
        }
    });
}
</script>
