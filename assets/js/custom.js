(function ($) {

	new WOW().init();

	jQuery(window).load(function() { 
		jQuery("#preloader").delay(100).fadeOut("slow");
		jQuery("#load").delay(100).fadeOut("slow");
	});


	//jQuery to collapse the navbar on scroll
	$(window).scroll(function() {
		if ($(".navbar").offset().top > 50) {
			$(".navbar-fixed-top").addClass("top-nav-collapse");
		} else {
			$(".navbar-fixed-top").removeClass("top-nav-collapse");
		}
	});

	//jQuery for page scrolling feature - requires jQuery Easing plugin
	$(function() {
		$('.navbar-nav li a').bind('click', function(event) {
			var $anchor = $(this);
			$('html, body').stop().animate({
				scrollTop: $($anchor.attr('href')).offset().top
			}, 1500, 'easeInOutExpo');
			event.preventDefault();
		});
		$('.page-scroll a').bind('click', function(event) {
			var $anchor = $(this);
			$('html, body').stop().animate({
				scrollTop: $($anchor.attr('href')).offset().top
			}, 1500, 'easeInOutExpo');
			event.preventDefault();
		});
	});

})(jQuery);
// sinhvien form
$(document).ready(function(){
	$('.ngaysv').datepicker({
		autoclose: true,
		format: "yyyy-mm-dd",
		todayHighlight: true,
		orientation: "bottom auto",
		todayBtn: true,
		todayHighlight: true,  
	});
});
//checked table
$(document).ready(function(){
	$("#mytable #checkall").click(function () {
		if ($("#mytable #checkall").is(':checked')) {
			$("#mytable input[type=checkbox]").each(function () {
				$(this).prop("checked", true);
			});

		} else {
			$("#mytable input[type=checkbox]").each(function () {
				$(this).prop("checked", false);
			});
		}
	});

	$("[data-toggle=tooltip]").tooltip();
	$('#check-malop').click(function(){
		if($('#check-malop').is(':checked')){
			var malop=$('#ds-malop-huy').val();
			malop=malop.replace(/-/g,"");
			var output2='';
			malop=malop+ $('#check-malop').val();
			malop=malop.replace("-","");
			for (i=0; i<malop.length; i++) 
			{
			    if (i>0 && i%11 == 0)
			      output2 += '-';
			    output2 += malop.charAt(i);
			}
			malop=output2;
			$('#ds-malop-huy').val(malop);
		}
	})
});

//datetime picker
//change class below
$(document).ready(function(){
	$('.datepicker').datepicker({
		autoclose: true,
		format: "yyyy-mm-dd",
		todayHighlight: true,
		orientation: "top auto",
		todayBtn: true,
		todayHighlight: true,  
	});
	$('#ngaysinh_sv').datepicker({
		autoclose: true,
		format: "yyyy-mm-dd",
		todayHighlight: true,
		orientation: "bottom auto",
		todayBtn: true,
		todayHighlight: true,  
	});
});
//bootstrap-select
$('.selectpicker').selectpicker({
	style: 'btn-info',
	size: 2,
});
var method_save
//add học phần. show form
$(document).ready(function(){
	$("#addhocphan").click(function(){
		method_save="add"
		$('#formhocphan')[0].reset(); // reset form on modals
		$('.form-group').removeClass('has-error'); // clear error class
    	$('.help-block').empty(); // clear error string
	    $('#modal-hocphan').modal('show'); // show bootstrap modal
	    $('.modal-title').text('Thêm Học Phần'); // Set Title to Bootstrap modal title
	})
})
function edithocphan(malop)
{
	method_save="edit"
	$('#formhocphan')[0].reset(); // reset form on modals
	$('.form-group').removeClass('has-error'); // clear error class
	$('.help-block').empty(); // clear error string
    $('#modal-hocphan').modal('show'); // show bootstrap modal
    $('.modal-title').text('Chỉnh Sửa Học Phần'); // Set Title to Bootstrap modal title
}
function deletehocphan(malop)
{
	$('#deletehocphan').modal('show'); // show bootstrap modal
    $('.modal-title').text('Xóa Học Phần'); // Set Title to Bootstrap modal title
}
//add học phần
$(document).ready(function(){
	$("#btluu").click(function(){
		$("#btluu").text("Đang lưu....")
		$("#btluu").attr('disabled',true)
		url="Hocphan/addhocphan"
		$.ajax({
			url: url,
			type: "GET",
			data: $('#formhocphan').serialize(),
			dataType: 'JSON',
			contentType: "application/json; charset=utf-8",
			success: function(data)
			{
				if(data.status)
				{
					$('#modal-hocphan').modal('hide')
					$('div#table-hp').load ('Hocphan/get_new_data', 'update=true', 'refresh');
				}
				else{
					for (var i = 0; i < data.inputerror.length; i++) 
					{
                    	$('[id="'+data.inputerror[i]+'"]').parent().parent().addClass('has-error'); //select parent twice to select div form-group class and add has-error class
                    	$('[id="'+data.inputerror[i]+'"]').next().text(data.error_string[i]); //select span help-block class set text error string
                    }
                }
                $("#btluu").text("Lưu")
                $("#btluu").attr('disabled',false)
            },
            error: function (jqXHR, textStatus, errorThrown)
            {

            	$("#btluu").text("Lưu")
            	$("#btluu").attr('disabled',false)
            }
        })
	})
})
//remove thông báo lỗi
$(document).ready(function(){
	$("input").change(function(){
		$(this).parent().parent().removeClass('has-error');
		$(this).next().empty();
	});
	$("select").change(function(){
		$(this).parent().parent().removeClass('has-error');
		$(this).next().empty();
	});
    //$('#tablehocphan').DataTable()
});
$(document).ready(function(){
	$('#dangky').click(function(){
		url="Dangky/dangkynhanh"
		$.ajax({
			url: url,
			type: "GET",
			data: $('#edit-dsmh').serialize(),
			dataType: 'JSON',
			contentType: "application/json; charset=utf-8",
			success: function(data)
			{
				//alert(data)
				
				if(data.success.length!=0){
					thanhcong='Đăng ký thành công:<br>'
					for (var i = 0; i < data.success.length; i++) 
	            	{
	                	thanhcong+=data.success[i]+'<br>'
	            	}
	            	$('#success').html("<div class='alert alert-info alert-dismissible' role='alert'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>"+thanhcong+"</div>")
	            }
	            if(data.malopkhongtontai.length!=0 || data.lopday.length!=0 || data.require.length!=0 || data.dadk.length!=0 || data.trunglich.length!=0 || data.ltvsth.length!=0 || data.tienquyet.length!=0){
	            	loi=''
	            	if(data.malopkhongtontai.length!=0){
	            		loi+='Mã lớp không tồn tại: '
	            		if(data.malopkhongtontai.length==1){
	            			loi+=data.malopkhongtontai[0]
	            		}
	            		else{
		            		for (var i = 0; i < data.malopkhongtontai.length; i++) 
		            		{
		            			if(i==(data.malopkhongtontai.length-1))
		            				loi+=data.malopkhongtontai[i]
		            			else
		                			loi+=data.malopkhongtontai[i]+','
		            		}
		            	}
	            	}
	            	if(data.lopday.length!=0){
	            		if(loi.length!=0)
	            			loi+='<br>Lớp đầy: '
	            		else loi+='Lớp đầy: '
	            		if(data.lopday.length==1){
	            			loi+=data.lopday[0]
	            		}
	            		else{
		            		for (var i = 0; i < data.lopday.length; i++) 
		            		{
		            			if(i==(data.lopday.length-1))
		            				loi+=data.lopday[i]
		            			else
		                			loi+=data.lopday[i]+','
		            		}
		            	}
	            	}
	            	if(data.require.length!=0) loi+=data.require
	            	if(data.dadk.length!=0){
	            		if(loi.length!=0)
	            			loi+='<br>Môn học đã đăng ký cho học kỳ này: '
	            		else loi+='Môn học đã đăng ký cho học kỳ này: '
	            		if(data.dadk.length==1){
	            			loi+=data.dadk[0]
	            		}
	            		else{
		            		for (var i = 0; i < data.dadk.length; i++) 
		            		{
		            			if(i==(data.dadk.length-1))
		            				loi+=data.dadk[i]
		            			else
		                			loi+=data.dadk[i]+','
		            		}
		            	}
	            	}
	            	if(data.ltvsth.length!=0){
	            		if(loi.length!=0)
	            			loi+='<br>Lớp thực hành phải cùng mã lớp lý thuyết: '
	            		else loi+='Lớp thực hành phải cùng mã lớp lý thuyết: '
	            		if(data.ltvsth.length==1){
	            			loi+=data.ltvsth[0]
	            		}
	            		else{
		            		for (var i = 0; i < data.ltvsth.length; i++) 
		            		{
		            			if(i==(data.ltvsth.length-1))
		            				loi+=data.ltvsth[i]
		            			else
		                			loi+=data.ltvsth[i]+','
		            		}
		            	}
	            	}
	            	if(data.trunglich.length!=0){
	            		if(loi.length!=0)
	            			loi+='<br>Lớp học đã trùng lịch với lớp khác: '
	            		else loi+='Lớp học đã trùng lịch với lớp khác: '
	            		if(data.trunglich.length==1){
	            			loi+=data.trunglich[0]
	            		}
	            		else{
		            		for (var i = 0; i < data.trunglich.length; i++) 
		            		{
		            			if(i==(data.trunglich.length-1))
		            				loi+=data.trunglich[i]
		            			else
		                			loi+=data.trunglich[i]+','
		            		}
		            	}
	            	}
	            	if(data.tienquyet.length!=0){
	            		if(loi.length!=0)
	            			loi+='<br>Môn học phải hoàn thành môn tiên quyết: '
	            		else loi+='Môn học phải hoàn thành môn tiên quyết: '
	            		if(data.tienquyet.length==1){
	            			loi+=data.tienquyet[0]
	            		}
	            		else{
		            		for (var i = 0; i < data.tienquyet.length; i++) 
		            		{
		            			if(i==(data.tienquyet.length-1))
		            				loi+=data.tienquyet[i]
		            			else
		                			loi+=data.tienquyet[i]+','
		            		}
		            	}
	            	}
	            	$('#error').html("<div class='alert alert-danger alert-dismissible' role='alert'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>"+loi+"</div>")
	            }
	            $('#edit-dsmh').val('')
			},
			error: function (jqXHR, textStatus, errorThrown)
			{

			}
		})
	})
	$('#dkn').click(function(){
		$('#edit-dsmh').val('')
	})
	$('#huydk').click(function(){
		url="Dangky/huyhocphan"
		$.ajax({
			url:url,
			type:"GET",
			data: $('#ds-malop-huy').serialize(),
			dataType: 'JSON',
			contentType: "application/json; charset=utf-8",
			success: function(data)
			{
				for (var i = 0; i < data.length; i++) 
				{
					alert(data[i])
				}
			},
			error: function(err)
			{

			}
		})
	})
})
