<!DOCTYPE html>
<html>
<head>
	<title>test ajax</title>
	<script type="text/javascript" 
	src="<?php echo base_url();?>assets/js/jquery.min.js"></script>
	<script type="text/javascript">
		function test() 
		{
			var url="<?php echo site_url('Sinhvien/test'); ?>";
			$.ajax({
				url:url,
				type: 'POST',
				data:{},
				dataType:'json',
				success:function(data) {
					text=data.name+" & "+data.diem;
					$('#content').html(text);
				},
				error:function (e) {
					alert('Error get data from ajax');
				}
			});
		}
	</script>
</head>
<body>
	<div>
		<button onclick="test();">Click me!!!</button>
	</div>
	<div id="content"></div>
</body>
</html>