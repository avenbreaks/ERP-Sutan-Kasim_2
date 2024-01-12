<div class="span9">
  <ul class="breadcrumb">
    <li><a href="?page=home">Home</a> <span class="divider">/</span></li>
    <li><a href="?page=profil">Profil</a> <span class="divider">/</span></li>
    <li class="active">Update Profil</li>
  </ul>
  <h3> PROFIL UPDATE</h3>
  <hr class="soft"/>
  <?php
  $a = mysql_query("SELECT * FROM member WHERE id_member='".$_SESSION['dunlop_id']."'",$server);
  $b = mysql_fetch_array($a);
  $id		= $b['id_member'];
  $namatoko = $b['nama_toko'];
  $telp		= $b['no_telp'];
  $alamat	= $b['alamat'];
  $kota		= $b['kota'];
  $pos		= $b['pos'];
  $pemilik	= $b['pemilik'];
  $email 	= $b['email'];
  if (isset($_POST['btnupdate'])){
  
  $namatoko = htmlspecialchars($_POST['inputtoko']);
  $telp		= htmlspecialchars($_POST['inputtelp']);
  $alamat	= htmlspecialchars($_POST['inputalamat']);
  $kota		= htmlspecialchars($_POST['inputkota']);
  $pos		= htmlspecialchars($_POST['inputpos']);
  $pemilik	= htmlspecialchars($_POST['inputpemilik']);
  $email 	= htmlspecialchars($_POST['inputemail']);
  
  		if (!empty($_FILES['inputfoto']['tmp_name'])) {
			$nama_file 		= $_FILES['inputfoto']['name'];
			$ekstensi_file 	= substr(strtolower(strrchr($nama_file, ".")), 1);
			$nama_file 		= $id.".".$ekstensi_file;
			
			copy($_FILES['inputfoto']['tmp_name'],"foto_member/".$nama_file);
		}
		else {
			$nama_file = "";
		}
		
		$addsql = "UPDATE member SET nama_toko 	= '" . strip_tags(addslashes($namatoko)) . "',
								 no_telp	= '" . strip_tags(addslashes($telp)) . "',
								 alamat		= '" . strip_tags(addslashes($alamat)) . "',
								 kota		= '" . strip_tags(addslashes($kota)) . "', 
								 pos		= '" . strip_tags(addslashes($pos)) . "',
								 pemilik	= '" . strip_tags(addslashes($pemilik)) . "',
								 email		= '" . strip_tags(addslashes($email)) . "',
								 foto_member= '$nama_file' 
								 WHERE id_member = '".$_SESSION['dunlop_id']."'";
		$sukses = mysql_query($addsql, $server);
		
		if ($sukses){
			echo "<div class='alert alert-success alert-dismissible' role='alert'>
			<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
			<strong>Berhasil Memperbaharui Profil</strong>.
			</div>";
			echo "<meta http-equiv=Refresh content=0;url=?page=profil>";
			
		}
	}
	?>
  <div class="row">
   <form role="form" name="forminput" method="post" enctype="multipart/form-data">
      <div class="span8">
      <div class="well">
        <h5 class="offset1">DATA PERSONAL</h5>
        
          <div class="control-group offset1">
            <label class="control-label" for="inputtoko">Nama Toko</label>
            <div class="controls">
              <input name="inputtoko"  type="text" autofocus required class="span3" id="inputtoko" placeholder="Nama Toko" title="Nama Toko" value="<?php echo $namatoko;?>" maxlength="100">
            </div>
          </div>
          <div class="control-group offset1">
            <label class="control-label" for="inputtelp">No. Telp</label>
            <div class="controls">
              <input name="inputtelp"  type="text" autofocus required class="span3" id="inputtelp" placeholder="No. Telp" title="No. Telp" value="<?php echo $telp;?>" maxlength="15">
            </div>
          </div>
          <div class="control-group offset1">
            <label class="control-label" for="inputalamat">Alamat</label>
            <div class="controls">
              <textarea name="inputalamat" rows="4" autofocus required class="span3" id="inputalamat" placeholder="Alamat" title="Alamat"><?php echo $alamat;?></textarea>
            </div>
          </div>
          <div class="control-group offset1">
            <label class="control-label" for="inputkota">Kota / Kabupaten</label>
            <div class="controls">
              <input name="inputkota"  type="text" autofocus class="span3" id="inputkota" placeholder="Kota / Kabupaten" title="Kota / Kabupaten" autocomplete="on" value="<?php echo $kota;?>" maxlength="50">
            </div>
          </div>
          <div class="control-group offset1">
            <label class="control-label" for="inputpos">Kode Pos</label>
            <div class="controls">
              <input  type="text" autofocus required class="span3" id="inputpos" placeholder="Kode Pos" title="Kode Pos" value="<?php echo $pos;?>" maxlength="6" name="inputpos">
            </div>
          </div>
          <div class="control-group offset1">
            <label class="control-label" for="inputpemilik">Nama Pemilik</label>
            <div class="controls">
              <input name="inputpemilik"  type="text" autofocus required class="span3" id="inputpemilik" placeholder="Nama Pemilik" title="Nama Pemilik" value="<?php echo $pemilik;?>" maxlength="50">
            </div>
          </div>
          
          <div class="control-group offset1">
            <label class="control-label" for="inputemail">Email</label>
            <div class="controls">
              <input  name="inputemail" type="email" autofocus required class="span3" id="inputemail" placeholder="Email" title="Email" autocomplete="off" value="<?php echo $email;?>" maxlength="32">
            </div>
          </div>
          <div class="control-group offset1">
            <label class="control-label" for="inputfoto">Foto</label>
            <div class="controls">
              <input  name="inputfoto" type="file" class="span3" id="inputfoto" placeholder="Foto" title="Foto">
            </div>
          </div>
          <br>
          <div class="control-group offset1">
            <div class="controls">
              <button type="submit" name="btnupdate" class="btn btn-md btn-success">Simpan</button>
            </div>
          </div>
        </div>
      </div>
    </form>
    
  </div>
</div>
