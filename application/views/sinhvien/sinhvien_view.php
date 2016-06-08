<?php 
$this->load->view('template/header');?>
<!-- write content -->
<div class="row"><p></p></div>
<?php 
	if(isset($_SESSION['id']))
	{ 
		if ($_SESSION['quyen']=='ADMIN')
		{
			$this->load->view('sinhvien/sinhvien_detail');
		} 	
		else
		{
			echo "<div class='container'>
					<div class='col-xs-3 col-sm-3 col-md-3 col-lg-3'></div>
					<div class='col-xs-4 col-sm-4 col-md-4 col-lg-4'>
					<p class='has-error'>Đăng nhập với quyền admin để truy cập.
					</p>";
			$this->load->view('template/login');
			echo "</div></div>";
		}
	}
	else
	{
		echo "<div class='container'>
		<div class='col-xs-3 col-sm-3 col-md-3 col-lg-3'></div>
		<div class='col-xs-4 col-sm-4 col-md-4 col-lg-4'><p class='has-error'>(*) Bạn vui lòng đăng nhập để sử dụng website.</p>";
		$this->load->view('template/login');
		echo "</div></div>";
	}
// <!-- end of content -->
$this->load->view('template/about');
?>
<script type="text/javascript">
	var save_method; //for save method string
	var table;
	$(document).ready(function() {
		$('.loading').addClass('hidden');
	    $("input").change(function(){
	        $(this).parent().removeClass('has-error');
	        $(this).next().empty();
	    });
	    $("textarea").change(function(){
	        $(this).parent().removeClass('has-error');
	        $(this).next().empty();
	    });
	    $("select").change(function(){
	        $(this).parent().removeClass('has-error');
	        $(this).next().empty();
	    });

	});
	function loading() {
		$('.loading').removeClass('hidden');
		$('#table-sv').hide();
	}
	function reload_table()
	{
		$('.loading').addClass('hidden');
		$('#table-sv').show();
	    $('#table-sv > table').load ('Sinhvien/Get_new_data', 'update=true', 'refresh'); 
	    //reload datatable ajax

	}
	function edit_sinhvien(Mssv)
	{
	    save_method='edit';
	    $('#modal-sv').modal('show'); // show bootstrap modal
	    $('.modal-title').text('Sửa Sinh Viên'); // Set Title to Bootstrap modal title
	    //$('#form')[0].reset(); // reset form on modals
	    $('.form-group').removeClass('has-error'); // clear error class
	    $('.help-block').empty(); // clear error string
	    url="<?php echo base_url('Sinhvien/ajax_edit')?>/"+Mssv;
	    $.ajax({
	        url:url,
	        type: "GET",
	        dataType: "JSON",
	        success:function(data)
	        {
	        	if(data.Gioitinh=='Nam')
	        		$('#gioitinh_sv').val('1');
	        	else
	        		$('#gioitinh_sv').val('0');
	            $('#ten_sv').val(data.Hoten);
	            $('#ngaysinh_sv').val(data.Ngaysinh);
	            $('#quequan_sv').val(data.Quequan);
	            $('#khoa_sv').val(data.Makhoahoc);
	            $('#nganh_sv').val(data.Manganh);
	        },
	        error:function(data)
	        {
	            alert('Error');
	        }
	    });
	            
	}
	function add_sinhvien()
	{
	    save_method = 'add';
	    $('#formsv')[0].reset(); // reset form on modals
	    $('.form-group').removeClass('has-error'); // clear error class
	    $('.help-block').empty(); // clear error string
	    $('.modal-title').text('Thêm Sinh Viên'); 
	    // Set Title to Bootstrap modal title
	    $('#modal-sv').modal('show'); 
	    // show bootstrap modal
	}
	function save()
	{
	        $('#btnSave').text('saving...'); 
	        $('#btnSave').attr('disabled',true);
	        if(save_method=='edit')
	            url="<?php echo base_url('Sinhvien/ajax_update')?>";
	        else
	             url="<?php echo base_url('Sinhvien/ajax_add') ?>";
	        $.ajax({
	            url : url,
	            type:"GET",
	            data:{
	            		'Tensinhvien':$('#ten_sv').val(),
	            		'Manganh':$('#nganh_sv').val(),
	            		'Gioitinh':$('#gioitinh_sv').val(),
	            		'Ngaysinh':$('#ngaysinh_sv').val(),
	            		'Quequan':$('#quequan_sv').val(),
	            		'Makhoahoc':$('#khoa_sv').val(),
	            	},
	            dataType: "JSON",
	            contentType:"application/json",
	            success: function(data)
	            {
	                if(data.status)
	                {
	                    $('#modal-sv').modal('hide');
	                    alert('Thành công');
	                    //reload_table();
	                    $('#table-sv>table').load ('Sinhvien/Get_new_data', 'update=true', 'refresh');
	                }
	                else
	                {
	                    for (var i = 0; i < data.inputerror.length; i++) 
	                    {
	                        $('[name="'+data.inputerror[i]+'"]').parent().addClass('has-error'); //select parent twice to select div form-group class and add has-error class
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
	function delete_sinhvien(id)
	{
	    if(confirm('Bạn có thật sự muốn xóa ?'))
	    {
	        // ajax delete data to database
	        $.ajax({
	            url : "<?php echo base_url('Sinvien/ajax_delete')?>/"+id,
	            type: "POST",
	            dataType: "JSON",
	            success: function(data)
	            {
	                //if success reload ajax table
	                $('#modal-sv').modal('hide');
	                alert('Xóa thành công');
	                $('#table-sv > table').load ('Sinhvien/Get_new_data', 'update=true', 'refresh');
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
<?php $this->load->view('template/footer'); ?>