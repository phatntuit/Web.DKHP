<div class="row"></div>
<section id="content">
    <div class="row" id="result">
<title><?php echo "$page_title" ?></title>
<div class="row"><p></p></div>
<div class="container">
	<div class="row">
    <button class="btn btn-success" onclick="add_person()"><i class="glyphicon glyphicon-plus"></i>Thêm giáo viên</button>
        <div class="col-md-12">
        <div class="table-responsive" id="newtable">
              <table id="mytable" class="table table-bordred table-striped">
                   <thead>
                   <th>Tên giáo viên</th>
                    <th>Giới tính</th>
                     <th>Học vị</th>
                     <th>Ngày sinh</th>
                     <th>Địa chỉ</th>
                      <th>Điện thoại</th>
                      <th>Email</th>
                      <th stle="width:125px;">Action</th>
                   </thead>
    <tbody>
      <?php foreach($giaovien as $gv){?>
      <tr>
        <td><?php echo $gv->Tengiaovien; ?> </td>
        <td><?php echo $gv->Gioitinh; ?> </td>
        <td><?php echo $gv->Mahocvi; ?> </td>
        <td><?php echo $gv->Ngaysinh; ?> </td>
        <td><?php echo $gv->Diachi; ?> </td>
        <td><?php echo $gv->Dienthoai; ?> </td>
        <td><?php echo $gv->Email; ?> </td>
        <td><a class="btn btn-sm btn-primary" data-toggle="modal"  title="Edit" onclick="edit_giaovien('<?php echo $gv->Magiaovien; ?>')"><i class="glyphicon glyphicon-pencil"></i> Sửa</a></td>
        <td><a class="btn btn-sm btn-danger" title="Hapus" onclick="delete_giaovien('<?php echo $gv->Magiaovien ?>')"><i class="glyphicon glyphicon-trash"></i> Xóa</a></td>

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
<script type="text/javascript">

var save_method; //for save method string
var table;
$(document).ready(function() {
    $('.datepicker').datepicker({
        autoclose: true,
        format: "yyyy-mm-dd",
        todayHighlight: true,
        orientation: "top auto",
        todayBtn: true,
        todayHighlight: true,
    });

    //set input/textarea/select event when change value, remove class error and remove text help block 
    $("input").change(function(){
        $(this).parent().parent().removeClass('has-error');
        $(this).next().empty();
    });
    $("textarea").change(function(){
        $(this).parent().parent().removeClass('has-error');
        $(this).next().empty();
    });
    $("select").change(function(){
        $(this).parent().parent().removeClass('has-error');
        $(this).next().empty();
    });

});

function reload_table()
{
    table.ajax.reload(null,false); //reload datatable ajax 
}
function edit_giaovien(Magiaovien)
{
    save_method='edit';
    $('#modal_form').modal('show'); // show bootstrap modal
    $('.modal-title').text('Sửa Giáo Viên'); // Set Title to Bootstrap modal title
    $('#form')[0].reset(); // reset form on modals
    $('.form-group').removeClass('has-error'); // clear error class
    $('.help-block').empty(); // clear error string
    url="<?php echo base_url('giaovien/ajax_edit')?>/" + Magiaovien;
    $.ajax({
        url:url,
        type: "GET",
        dataType: "JSON",
        success:function(data)
        {
            $('[name="Magiaovien"]').val(data.Magiaovien);
            $('[name="Tengiaovien"]').val(data.Tengiaovien);
            $('[name="Mahocvi"]').val(data.Mahocvi);
            $('[name="Gioitinh"]').val(data.Gioitinh);
            $('[name="Ngaysinh"]').val(data.Ngaysinh);
            $('[name="Diachi"]').val(data.Diachi);
            $('[name="Dienthoai"]').val(data.Dienthoai);
            $('[name="Email"]').val(data.Email);
        },
        error:function(data)
        {
            alert('Error');
        }
    });
            
}
function add_person()
{
    save_method = 'add';
    $('#form')[0].reset(); // reset form on modals
    $('.form-group').removeClass('has-error'); // clear error class
    $('.help-block').empty(); // clear error string
    $('#modal_form').modal('show'); // show bootstrap modal
    $('.modal-title').text('Thêm Giáo Viên'); // Set Title to Bootstrap modal title
}
function save()
{
        $('#btnSave').text('saving...'); 
        $('#btnSave').attr('disabled',true);
        if(save_method=='edit')
            url="<?php echo base_url('giaovien/ajax_update')?>";
        else
             url="<?php echo base_url('giaovien/ajax_add') ?>";
        $.ajax({
            url : url,
            type:"GET",
            data:$('#form').serialize(),
            dataType: "JSON",
            contentType:"application/json",
            success: function(data)
            {
                if(data.status)
                {
                    $('#modal_form').modal('hide');
                    alert('Thành công');
                    //reload_table();
                    $('div#newtable').load ('Giaovien/Get_new_data', 'update=true', 'refresh');
                }
                else
                {
                    for (var i = 0; i < data.inputerror.length; i++) 
                    {
                        $('[name="'+data.inputerror[i]+'"]').parent().parent().addClass('has-error'); //select parent twice to select div form-group class and add has-error class
                        $('[name="'+data.inputerror[i]+'"]').next().text(data.error_string[i]); //select span help-block class set text error string
                    }
                }
                $('#btnSave').text('save'); //change button text
                $('#btnSave').attr('disabled',false); //set button enable 
            },
            error: function(err)
            {
                alert('Error adding / update data');
                $('#btnSave').text('save'); 
                $('#btnSave').attr('disabled',false);
            },
        });

}
function delete_giaovien(id)
{
    if(confirm('Bạn có thật sự muốn xóa ?'))
    {
        // ajax delete data to database
        $.ajax({
            url : "<?php echo base_url('giaovien/ajax_delete')?>/"+id,
            type: "POST",
            dataType: "JSON",
            success: function(data)
            {
                //if success reload ajax table
                $('#modal_form').modal('hide');
                alert('Xóa thành công');
                $('div#newtable').load ('Giaovien/Get_new_data', 'update=true', 'refresh');
                //reload_table();
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Error deleting data');
            }
        });

    }
}
</script>
  <?php $query = $this->db->get('hocvi');
        $hocvi = $query->result_object();
  ?>
<div class="modal fade" id="modal_form" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h3 class="modal-title">Thêm Giáo Viên</h3>
            </div>
            <div class="modal-body form">
                <form action="#" id="form" class="form-horizontal">
                    <input type="hidden" name="Magiaovien" />
                    <div class="form-body">
                        <div class="form-group">
                            <label class="control-label col-md-3">Tên giáo viên</label>
                            <div class="col-md-9">
                                <input name="Tengiaovien" placeholder="Trần Anh Dũng" class="form-control" type="text">
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Học vị</label>
                            <div class="col-md-9">
                                <select name="Mahocvi" class="form-control">
                                    <?php foreach($hocvi as $hv){?>
                                    <option value='<?php echo "$hv->Mahocvi" ?>'><?php echo "$hv->Tenhocvi" ?></option>
                                    <?php } ?>
                                </select>
                                
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Giới tính</label>
                            <div class="col-md-9">
                                <select name="Gioitinh" class="form-control">
                                    <option value="">--Chọn giới tính--</option>
                                    <option value="Nam">Nam</option>
                                    <option value="Nữ">Nữ</option>
                                </select>
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Địa chỉ</label>
                            <div class="col-md-9">
                                <textarea name="Diachi" placeholder="Address" class="form-control"></textarea>
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Ngày sinh</label>
                            <div class="col-md-9">
                                <input name="Ngaysinh" placeholder="yyyy-mm-dd" class="form-control datepicker" type="text">
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Điện thoại</label>
                            <div class="col-md-9">
                                <input name="Dienthoai" placeholder="0967076900" class="form-control phoneNumber_inputControl" type="text">
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Email</label>
                            <div class="col-md-9">
                                <input name="Email" id="email" placeholder="vonganhquyen@gmail.com" class="form-control required email" type="email">
                                <span id="ClasSpan" class="help-block"></span>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" id="btnSave" onclick="save()" class="btn btn-primary">Save</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
  </div>
</section>
<?php $this->load->view('template/about.php'); ?>
<?php $this->load->view('template/footer.php'); ?>



