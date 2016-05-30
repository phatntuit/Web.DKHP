<form action="javascipt:void(0)" method="POST" role="form" id="form_login" >
  <div class="row"></br>
 </div>
 <legend>Login</legend>
 <div class="form-group">
  <div class="form-group">
    <label for="usrname"><span class="glyphicon glyphicon-user"></span> Username</label>
    <input type="text" class="form-control" id="usrname" name="id" placeholder="User name">
  </div>
  <div class="form-group">
    <label for="pwd"><span class="glyphicon glyphicon-eye-open"></span> Passwords</label>
    <input type="password" class="form-control" id="pwd" name="pwd" placeholder="Passwords">
  </div>
  <?php $url=site_url('User/Login'); ?>
  <button type="submit" class="btn btn-success" id="login" style=" border-radius : 5px 5px 5px 5px"><span class="fa fa-arrow-right"></span>Login</button>
</div>
</form>
<p id='error_login' style="color:red" ></p>
<script type="text/javascript">
  $(document).ready(function()
  {
    $("#login").click(function (e)
    {
      e.preventDefault();
      var url="<?php echo site_url('User/Login'); ?>";
      $('#login').text('....');
      $.ajax({
        url: url,
        type: "POST",
        data: {
          id : $('#usrname').val(),
          pwd : $('#pwd').val()
        },
        dataType: 'JSON',
        success:function(data){
          $('#login').text('Login');
          if( data.check=='Success')
          {
            window.location.assign("<?php echo current_url(); ?>")
          }
          else
          {
            $('#error_login').text(data.error)
          }
          
        },
        error:function(error)
        {
          $('#login').text('Login');
          alert(error.error);
        }
      });
    });
  });
</script>