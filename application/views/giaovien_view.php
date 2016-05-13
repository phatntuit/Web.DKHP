<div class="row"></div>
<section id="content">
    <div class="row" id="result">
<title><?php echo "$page_title" ?></title>
<div class="row"><p></p></div>
<div class="container">
	<div class="row">
    <button class="btn btn-success" onclick="add_person()"><i class="glyphicon glyphicon-plus"></i>Thêm giáo viên</button>
        <div class="col-md-12">
        <div class="table-responsive">
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
        <td><a class="btn btn-sm btn-primary" href="javascript:void(0)" title="Edit" onclick="edit_person()"><i class="glyphicon glyphicon-pencil"></i> Edit</a></td>
        <td><a class="btn btn-sm btn-danger" href="javascript:void(0)" title="Hapus" onclick="delete_person('.$giaovien->Magiaovien.')"><i class="glyphicon glyphicon-trash"></i> Delete</a></td>

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

function add_person()
{
    save_method = 'add';
    $('#form')[0].reset(); // reset form on modals
    $('.form-group').removeClass('has-error'); // clear error class
    $('.help-block').empty(); // clear error string
    $('#modal_form').modal('show'); // show bootstrap modal
    $('.modal-title').text('Thêm Giáo Viên'); // Set Title to Bootstrap modal title
}
function click_person()
{
   
        url="<?php echo base_url('giaovien/ajax_add') ?>"
        $.ajax({
            url : url,
            type:"GET",
            data:$('#form').serialize(),
            dataType: "JSON",
            contentType:"application/json",
            success: function(data)
            {
                $('#modal_form').modal('hide');
                reload_table();
            },
            error: function(err)
            {

            },
        });

}

function save()
{
    $('#btnSave').text('saving...'); //change button text
    $('#btnSave').attr('disabled',true); //set button disable 
    var url;

    if(save_method == 'add') {
        url = "<?php echo base_url('giaovien/ajax_add')?>";
    } else {
        url = "<?php echo base_url('giaovien/ajax_update')?>";
    }

    // ajax adding data to database
    $.ajax({
        url : url,
        type: "POST",
        data: $('#form').serialize(),
        dataType: "JSON",
        success: function(data)
        {

            if(data.status) //if success close modal and reload ajax table
            {
                $('#modal_form').modal('hide');
                reload_table();
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
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error adding / update data');
            $('#btnSave').text('save'); //change button text
            $('#btnSave').attr('disabled',false); //set button enable 

        }
    });
}

function delete_person(id)
{
    if(confirm('Are you sure delete this data?'))
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
                reload_table();
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
                    
                    <div class="form-body">
                        <div class="form-group">
                            <input type="hidden" name="Magiaovien" /> 
                        <div class="form-group">
                            <label class="control-label col-md-3">Tên giáo viên</label>
                            <div class="col-md-9">
                                <input name="Tengiaovien" id="demo" placeholder="Nguyễn nghĩa" class="form-control" type="text">
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
                                    <option value="male">Nam</option>
                                    <option value="female">Nữ</option>
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
                                <input name="Dienthoai" placeholder="0967076900" class="form-control" type="text">
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Email</label>
                            <div class="col-md-9">
                                <input name="Email" placeholder="vonganhquyen@gmail.com" class="form-control" type="text">
                                <span class="help-block"></span>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" id="btnSave" onclick="click_person()" class="btn btn-primary">Save</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
  </div>
</section>
<?php $this->load->view('template/about.php'); ?>
<?php $this->load->view('template/footer.php'); ?>


