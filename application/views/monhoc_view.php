<div class="row"></div>
<section id="content">
    <div class="row" id="result">
<title><?php echo "$page_title" ?></title>
<div class="row"><p></p></div>
<div class="container">
	<div class="row">
    <button class="btn btn-success" onclick="add_person()"><i class="glyphicon glyphicon-plus"></i>Thêm môn học</button>
        <div class="col-md-12">
        <div class="table-responsive" id="newtable">
              <table id="mytable" class="table table-bordred table-striped">
                   <thead>
                   <th>Mã môn học</th>
                    <th>Tên môn học</th>
                     <th>Số tín chỉ lt</th>
                     <th>Số tín chỉ th</th>
                     <th>Tổng tín chỉ</th>
                     <th>Action</th>
                   </thead>
    <tbody>
      <?php foreach($monhoc as $mh){?>
      <tr>
        <td><?php echo $mh->Mamonhoc; ?> </td>
        <td><?php echo $mh->Tenmonhoc; ?> </td>
        <td><?php echo $mh->Sotinchi_lt; ?> </td>
        <td><?php echo $mh->Sotinchi_th; ?> </td>
        <td><?php echo $mh->Sotinchi; ?> </td>
        <td><a class="btn btn-sm btn-primary" data-toggle="modal"  title="Edit" onclick="edit_monhoc('<?php echo $mh->Mamonhoc; ?>')"><i class="glyphicon glyphicon-pencil"></i> Sửa</a></td>
        <td><a class="btn btn-sm btn-danger" title="Hapus" onclick="delete_monhoc('<?php echo $mh->Mamonhoc ?>')"><i class="glyphicon glyphicon-trash"></i> Xóa</a></td>

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
function edit_monhoc(Mamonhoc)
{
    save_method='edit';
    $('#modal_form').modal('show'); // show bootstrap modal
    $('.modal-title').text('Sửa Môn Học'); // Set Title to Bootstrap modal title
    $('#form')[0].reset(); // reset form on modals
    $('.form-group').removeClass('has-error'); // clear error class
    $('.help-block').empty(); // clear error string
    url="<?php echo base_url('monhoc/ajax_edit')?>/" + Mamonhoc;
    $.ajax({
        url:url,
        type: "GET",
        dataType: "JSON",
        success:function(data)
        {
            $('[name="Mamonhoc"]').val(data.Mamonhoc);
            $('[name="Tenmonhoc"]').val(data.Tenmonhoc);
            $('[name="Sotinchi_lt"]').val(data.Sotinchi_lt);
            $('[name="Sotinchi_th"]').val(data.Sotinchi_th);
            $('[name="Sotinchi"]').val(data.Sotinchi);
        },
        error:function(data)
        {
            alert('Error');
        }
    });
            
}
var save_method; 
function add_person()
{
    save_method = 'add';
    $('#form')[0].reset(); // reset form on modals
    $('.form-group').removeClass('has-error'); // clear error class
    $('.help-block').empty(); // clear error string
    $('#modal_form').modal('show'); // show bootstrap modal
    $('.modal-title').text('Thêm Môn học'); // Set Title to Bootstrap modal title
}
function save()
{
        $('#btnSave').text('saving...'); 
        $('#btnSave').attr('disabled',true);
        if(save_method=='edit')
            url="<?php echo base_url('monhoc/ajax_update')?>";
        else
             url="<?php echo base_url('monhoc/ajax_add') ?>";
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
                   // $('div#newtable').load ('Giaovien/Get_new_data', 'update=true', 'refresh');
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
function delete_monhoc(id)
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
<div class="modal fade" id="modal_form" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h3 class="modal-title">Thêm Môn học</h3>
            </div>
            <div class="modal-body form">
                <form action="#" id="form" class="form-horizontal">
                    <input type="hidden" name="Magiaovien" />
                    <div class="form-body">
                        <div class="form-group">
                            <label class="control-label col-md-3">Mã môn học</label>
                            <div class="col-md-9">
                                <input name="Mamonhoc" placeholder="IS307" class="form-control" type="text">
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Tên môn học</label>
                            <div class="col-md-9">
                                <input name="Tenmonhoc" placeholder="Lập trình hướng đối tượng" class="form-control" type="text">
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Số tín chỉ lt</label>
                            <div class="col-md-9">
                                <select name="Sotinchilt" class="form-control">
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                    <option value="10">10</option>
                                </select>
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Số tín chỉ th</label>
                            <div class="col-md-9">
                                <select name="Sotinchith" class="form-control">
                                    <option value="0">0</option>
                                    <option value="1">1</option>
                                </select>
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Số tín chỉ</label>
                            <div class="col-md-9">
                                <input name="Sotinchi" placeholder="4" class="form-control" type="text">
                                <span class="help-block"></span>
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



