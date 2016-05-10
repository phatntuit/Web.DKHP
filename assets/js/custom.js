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
	$("#login").click(function(){
		var url="<?php echo site_url('User/Login'); ?>";
		$.ajax(
		{
			url:url,
			type:'POST',
			data:{username : $('#username'),pwd:$('#pwd')},
			sucess:function(data){
				$('#myModal').modal('hide');
			}
		});
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
});
//teacher form
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
//change tiết bắt đầu
//$(document).ready(function(){
	//$("#tietbatdau").change(function(){
	//	a= $("#tietbatdau").val()
	//	b=$("#tietketthuc").val()
	//	if(a>b) alert("test")
	//})
//})
//change tiết kết thúc
$(document).ready(function(){
	$("#tietketthuc").change(function(){
		tietbd=$("#tietbatdau").val()
		tietkt=$("#tietketthuc").val()
		tietkt=parseInt(tietkt)
		tietbd=parseInt(tietbd)
		if(tietkt<tietbd){
			alert("Tiết bắt đầu phải nhỏ hơn tiết kết thúc")
			$("#tietketthuc").val()=tietkt
		}
	})
})
//add học phần. show form
$(document).ready(function(){
	$("#addhocphan").click(function(){
		//$('#formadd')[0].reset(); // reset form on modals
	    $('#add').modal('show'); // show bootstrap modal
	    $('.modal-title').text('Thêm Học Phần'); // Set Title to Bootstrap modal title
	})
})
//add học phần
$(document).ready(function(){
	$("#them").click(function(){
		
	})
})
