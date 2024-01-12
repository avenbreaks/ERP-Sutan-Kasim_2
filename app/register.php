<div class="span9">
  <ul class="breadcrumb">
    <li><a href="?page=home">Home</a> <span class="divider">/</span></li>
    <li class="active">Daftar</li>
  </ul>
  <h3> REGISTRASI</h3>
  <hr class="soft"/>
  <?php
  $username = "";
  $namatoko = "";
  $telp		= "";
  $alamat	= "";
  $kota		= "";
  $pos		= "";
  $pemilik	= "";
  $email 	= "";
  if (isset($_POST['btndaftar'])){
  $id		= NewKode("member", "U_M");
  $username = htmlspecialchars(strtolower($_POST['inputUsername']));
  $pass		= htmlspecialchars($_POST['inputPassword1']);
  $pass2	= htmlspecialchars($_POST['inputPassword2']);
  $namatoko = htmlspecialchars($_POST['inputtoko']);
  $telp		= htmlspecialchars($_POST['inputtelp']);
  $alamat	= htmlspecialchars($_POST['inputalamat']);
  $kota		= htmlspecialchars($_POST['inputkota']);
  $pos		= htmlspecialchars($_POST['inputpos']);
  $pemilik	= htmlspecialchars($_POST['inputpemilik']);
  $email 	= htmlspecialchars($_POST['inputemail']);
  
  
  	$sql = "SELECT username FROM login WHERE username = '$username'";
	$query = mysql_query($sql, $server);
	$cek = mysql_num_rows($query);
		if ($cek > 0){
			echo "<div class='alert alert-danger alert-dismissible' role='alert'>
			<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
			<strong>Username sudah digunakan</strong>.
			</div>";
			$username		= "";
		}else{
			if (trim($pass) != trim($pass2)){
				echo "<div class='alert alert-danger alert-dismissible' role='alert'>
				<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
				<strong>Password tidak sama</strong>.
				</div>";
			}else{
				$addsql = "INSERT INTO member(id_member, nama_toko, no_telp, alamat, kota, pos, pemilik, email, foto_member, tgl_daftar)
							VALUES
							('" . $id . "',
							 '" . strip_tags(addslashes($namatoko)) . "',
							 '" . strip_tags(addslashes($telp)) . "',
							 '" . strip_tags(addslashes($alamat)) . "',
							 '" . strip_tags(addslashes($kota)) . "', 
							 '" . strip_tags(addslashes($pos)) . "', 
							 '" . strip_tags(addslashes($pemilik)) . "', 
							 '" . strip_tags(addslashes($email)) . "',
							 '', NOW())";
				$sukses = mysql_query($addsql, $server);
				$setaddsql = "INSERT INTO login VALUES ('$id', '$username', '".md5($pass)."','2','0')";
				$sukses2 = mysql_query($setaddsql, $server);
				
				if ($sukses && $sukses2){
					echo "<div class='alert alert-success alert-dismissible' role='alert'>
					<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
					<strong>Berhasil Mendaftar</strong>.
					</div>";
					  	$_SESSION['telah-login'] 		= true;
						$_SESSION['dunlop_username'] 	= $username;
						$_SESSION['dunlop_password']	= md5($pass);
						$_SESSION['dunlop_id'] 			= $id;
						$_SESSION['dunlop_level'] 		= '2';
					
					echo "<meta http-equiv=Refresh content=0;url=?page=produk>";
					
					  $username = "";
					  $namatoko = "";
					  $telp		= "";
					  $alamat	= "";
					  $kota		= "";
					  $pos		= "";
					  $pemilik	= "";
					  $email 	= "";
				}
			}
		}
	}
	?>
  <div class="row">
   <form role="form" name="forminput" method="post" enctype="multipart/form-data">
    <div class="span4">
      <div class="well">
        <h5>DATA LOGIN</h5>
        
          <div class="control-group">
            <label class="control-label" for="inputUsername">Username</label>
            <div class="controls">
              <input  type="text" autofocus required class="span3" name="inputUsername" id="inputUsername" placeholder="Username" title="Username" value="<?php echo $username;?>" maxlength="32">
            </div>
          </div>
          <div class="control-group">
            <label class="control-label" for="inputPassword1">Password</label>
            <div class="controls">
              <input  name="inputPassword1" type="password" autofocus required class="span3" id="inputPassword1" placeholder="Password" title="Password" maxlength="32">
            </div>
          </div>
          <div class="control-group">
            <label class="control-label" for="inputPassword2">Ulangi Password</label>
            <div class="controls">
              <input  name="inputPassword2" type="password" autofocus required class="span3" id="inputPassword2" placeholder="Ulangi Password" title="Ulangi Password" maxlength="32">
            </div>
          </div>
          
        </div>
      </div>
      
      <div class="span5">
      <div class="well">
        <h5>DATA PERSONAL</h5>
        
          <div class="control-group">
            <label class="control-label" for="inputtoko">Nama Toko</label>
            <div class="controls">
              <input name="inputtoko"  type="text" autofocus required class="span3" id="inputtoko" placeholder="Nama Toko" title="Nama Toko" value="<?php echo $namatoko;?>" maxlength="100">
            </div>
          </div>
          <div class="control-group">
            <label class="control-label" for="inputtelp">No. Telp</label>
            <div class="controls">
              <input name="inputtelp"  type="text" autofocus required class="span3" id="inputtelp" placeholder="No. Telp" title="No. Telp" value="<?php echo $telp;?>" maxlength="15">
            </div>
          </div>
          <div class="control-group">
            <label class="control-label" for="inputalamat">Alamat</label>
            <div class="controls">
              <textarea name="inputalamat" rows="4" autofocus required class="span3" id="inputalamat" placeholder="Alamat" title="Alamat"><?php echo $alamat;?></textarea>
            </div>
          </div>
          <div class="control-group">
            <label class="control-label" for="inputkota">Kota / Kabupaten</label>
            <div class="controls">
              <input name="inputkota"  type="text" autofocus class="span3" id="inputkota" placeholder="Kota / Kabupaten" title="Kota / Kabupaten" autocomplete="on" value="<?php echo $kota;?>" maxlength="50">
            </div>
          </div>
          <div class="control-group">
            <label class="control-label" for="inputpos">Kode Pos</label>
            <div class="controls">
              <input  type="text" autofocus required class="span3" id="inputpos" placeholder="Kode Pos" title="Kode Pos" value="<?php echo $pos;?>" maxlength="6" name="inputpos">
            </div>
          </div>
          <div class="control-group">
            <label class="control-label" for="inputpemilik">Nama Pemilik</label>
            <div class="controls">
              <input name="inputpemilik"  type="text" autofocus required class="span3" id="inputpemilik" placeholder="Nama Pemilik" title="Nama Pemilik" value="<?php echo $pemilik;?>" maxlength="50">
            </div>
          </div>
          
          <div class="control-group">
            <label class="control-label" for="inputemail">Email</label>
            <div class="controls">
              <input  name="inputemail" type="email" autofocus required class="span3" id="inputemail" placeholder="Email" title="Email" autocomplete="off" value="<?php echo $email;?>" maxlength="32">
            </div>
          </div>
          <div class="control-group">
            <div class="controls">
              <button type="submit" name="btndaftar" class="btn btn-md btn-warning">DAFTAR</button>
            </div>
          </div>
        </div>
      </div>
    </form>
    
  </div>
</div>
