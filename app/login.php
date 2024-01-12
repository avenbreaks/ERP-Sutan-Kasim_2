<div class="span9">
  <ul class="breadcrumb">
    <li><a href="?page=home">Home</a> <span class="divider">/</span></li>
    <li class="active">Login</li>
  </ul>
  <h3> LOGIN</h3>
  <hr class="soft"/>
  <?php
	if(isset($_POST["submit"])){
			$nama  	= $_POST['inputUsername']; 
			$pass 	= md5($_POST['inputPassword1']);
			
			$sql   	= "SELECT * FROM login WHERE username='".mysql_real_escape_string($nama)."' AND password='$pass' AND level='2' AND bLokir='0' ";
			$hasil 	= mysql_query($sql, $server);
			$r	   	= mysql_fetch_array($hasil);
			
		if(mysql_num_rows($hasil) > 0){
			$_SESSION['telah-login'] = true;
			$_SESSION['dunlop_username'] 	= $r['username'];
			$_SESSION['dunlop_password']	= $r['password'];
			$_SESSION['dunlop_id'] 			= $r['id_user'];
			$_SESSION['dunlop_level'] 		= $r['level'];
			
			echo "<div class='alert alert-success alert-dismissible' role='alert'>
					<button type='button' class='close' data-dismiss='alert' aria-label='Close'>
						<span aria-hidden='true'>&times;</span></button>
					Login Berhasil
					</div>";
				
				echo "<meta http-equiv=Refresh content=0;url=?page=home>";
				
		}else{
			echo "<div class='alert alert-warning alert-dismissible' role='alert'>
					<button type='button' class='close' data-dismiss='alert' aria-label='Close'>
						<span aria-hidden='true'>&times;</span></button>
					Username atau Password Salah!!
					</div>";
		}
	}
	?>
  <div class="row">
    <div class="span6">
      <div class="well">
        <h5>LOGIN ?</h5>
        <form role="form" name="forminput" method="post" enctype="multipart/form-data">
          <div class="control-group offset1">
            <label class="control-label" for="inputUsername">Username</label>
            <div class="controls">
              <input class="span3"  type="text" name="inputUsername" id="inputUsername" placeholder="Username">
            </div>
          </div>
          <div class="control-group offset1">
            <label class="control-label" for="inputPassword1">Password</label>
            <div class="controls">
              <input type="password" class="span3" name="inputPassword1" id="inputPassword1" placeholder="Password">
            </div>
          </div>
          <div class="control-group offset1">
            <div class="controls">
              <button type="submit" name="submit" class="btn btn-primary">Log in</button>
            </div>
          </div>
        </form>
      </div>
    </div>
    
    <div class="span3">
        <h5>BELUM MEMILIKI AKUN ?</h5>
        <a class="btn btn-large btn-warning"  href="?page=daftar">DAFTAR ?</a>
    </div>
    
  </div>
</div>
