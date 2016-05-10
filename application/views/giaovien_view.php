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
                   <th><input type="checkbox" id="checkall" /></th>
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
   <!--   <?php foreach($giaovien as $gv){?>
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
      <?php } ?>-->
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
<script src="<?php echo base_url();?>assets/datatables/js/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url();?>assets/js/bootstrap-datepicker.min.js"></script>
<script src="<?php echo base_url();?>assets/datatables/js/dataTables.bootstrap.js"></script>

<script type="text/javascript">

var save_method; //for save method string
var table;

$(document).ready(function() {

    //datatables
    // table = $('#table').dataTable({ 

    //     "processing": true, //Feature control the processing indicator.
    //     "serverSide": true, //Feature control DataTables' server-side processing mode.
    //     "order": [], //Initial no order.

    //     // Load data for the table's content from an Ajax source
    //     "ajax": {
    //         "url": "<?php echo base_url('giaovien/ajax_list')?>",
    //         "type": "POST"
    //     },

    //     //Set column definition initialisation properties.
    //     "columnDefs": [
    //     { 
    //         "targets": [ -1 ], //last column
    //         "orderable": false, //set not orderable
    //     },
    //     ],

    // });

    //datepicker
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

function edit_person(Magiaovien)
{
    save_method = 'update';
    $('#form')[0].reset(); // reset form on modals
    $('.form-group').removeClass('has-error'); // clear error class
    $('.help-block').empty(); // clear error string

    //Ajax Load data from ajax
    $.ajax({
        url : "<?php echo base_url('giaovien/ajax_edit/')?>/" + Magiaovien,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {

            $('[name="Magiaovien"]').val(data.Magiaovien);
            $('[name="Tengiaovien"]').val(data.Tengiaovien);
            $('[name="Mahocvi"]').val(data.Mahocvi);
            $('[name="Gioitinh"]').val(data.Gioitinh);
            $('[name="Ngaysinh"]').val(data.Ngaysinh);
            $('[name="Diachi"]').val(data.Diachi);
            $('[name="Dienthoai"]').val(data.Dienthoai);
            $('[name="Email"]').val(data.Email);
            $('#modal_form').modal('show'); // show bootstrap modal when complete loaded
            $('.modal-title').text('Edit Person'); // Set title to Bootstrap modal title

        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error get data from ajax');
        }
    });
}

function reload_table()
{
    table.ajax.reload(null,false); //reload datatable ajax 
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
            url : "<?php echo site_url('person/ajax_delete')?>/"+id,
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
<div class="modal fade" id="modal_form" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h3 class="modal-title">Thêm Giáo Viên</h3>
            </div>
            <div class="modal-body form">
                <form action="#" id="form" class="form-horizontal">
                    <input type="hidden" value="" name="Magiaovien"/> 
                    <div class="form-body">
                        <div class="form-group">
                            <label class="control-label col-md-3">Tên giáo viên</label>
                            <div class="col-md-9">
                                <input name="Tengiaovien" placeholder="Nguyễn nghĩa" class="form-control" type="text">
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Mã học vị</label>
                            <div class="col-md-9">
                                <input name="Mahocvi" placeholder="HV001" class="form-control" type="text">
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Giới tính</label>
                            <div class="col-md-9">
                                <select name="Gioitinh" class="form-control">
                                    <option value="">--Select Gender--</option>
                                    <option value="male">Male</option>
                                    <option value="female">Female</option>
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


