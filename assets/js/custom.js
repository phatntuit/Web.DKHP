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
// login form popup
$(document).ready(function(){
	$("#loginform").click(function(){
		$("#myModal").modal();
	});
	//login
	// $("#login").click(function(){
	// 	var url="<?php echo site_url('User/Login'); ?>";
	// 	$.ajax(
	// 	{
	// 		url:url,
	// 		type:'POST',
	// 		data:{username : $('#username'),pwd:$('#pwd')},
	// 		sucess:function(data){
	// 			$('#myModal').modal('hide');
	// 		}
	// 	});
	// });
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
var table
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
// Test ajax post
function Testajaxpost() {
	var url="<php echo site_url('Sinhvien/Testajax') ?>";
	$.ajax({
		url:url,
		type:'POST',
		dataType:'text',
		data :{'in' : $('#test')},
		success: function(data) {
			$('#result').html(data);
		},
		error: function() {
			$('#result').html(data);
		}
	});
}
//

