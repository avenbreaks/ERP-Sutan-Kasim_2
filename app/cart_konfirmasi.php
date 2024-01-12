	<div class="span9">
        <ul class="breadcrumb">
        	<li><a href="?page=produk&kat=all">Home</a> <span class="divider">/</span></li>
        	<li class="active"> Konfirmasi Pembayaran</li>
        </ul>
    <!-- adsasdasd -------------------------------------------------------------------------------------->
    <div class="span6">
     <h3>Bukti Pembayaran</h3>
     <br>
     <?php
     if(isset($_POST['submit'])){
          $idtransf = NewKode("bukti_transfer","TRF");
          $bank 	= $_POST['inputbank'];
          $orderid 	= $_POST['inputorderid'];
          $transfer	= str_replace(".","",$_POST['inputtransfer']);
          $transfer	= str_replace(",","",$transfer);
          
          if (!empty($_FILES['file']['tmp_name'])) {
                $nama_file = $_FILES['file']['name'];
                $ekstensi_file = substr(strtolower(strrchr($nama_file, ".")), 1);
                $nama_file = date("d-m-Y")."_".$idtransf."_".$orderid.".".$ekstensi_file;
                
                copy($_FILES['file']['tmp_name'],"../images/konfirmasi/".$nama_file);
            }
            else {
                $nama_file = "";
            }
        $sql 	= "INSERT INTO bukti_transfer SET id_transfer='$idtransf', 
                                               id_order='$orderid',
                                               nama_bank='$bank',
                                               jumlah='$transfer',
                                               file='$nama_file',
                                               tgl=NOW()";
        $query 	= mysql_query($sql);
        $sql2	= "UPDATE orders SET id_transfer='$idtransf', tgl_bayar=NOW(), status='3' WHERE id_member='".$_SESSION['dunlop_id']."' AND id_order='$orderid'";
        $query2 = mysql_query($sql2);
        if($query && $query2){
			echo "<div class='alert alert-success alert-dismissible' role='alert'>
				<button type='button' class='close' data-dismiss='alert' aria-label='Close'>
					<span aria-hidden='true'>&times;</span></button>
				Berhasil mengirim bukti pembayaran
				</div>";
            echo "<meta http-equiv=Refresh content=0;url=?page=produk&kat=all>";
        }
        
     }
     ?>
     <form class="form-horizontal" name="formdd" method="post" enctype="multipart/form-data">
     <div class="control-group">
       <label class="control-label">Transfer ke Bank<sup>*</sup></label>
       <div class="controls">
         <select autofocus required name="inputbank" class="controls-row">
           <option value="">Pilih </option>
           <option value="bca">BCA </option>
           <option value="bni">BNI </option>
           <option value="bri">BRI </option>
         </select>
       </div>
     </div>
     <div class="control-group">
       <label class="control-label">Transaksi<sup>*</sup></label>
       <div class="controls">
         <select autofocus required name="inputorderid" class="controls-row">
           <option value="">Pilih </option>
           <?php 
            $sqltransaksi 	= "SELECT * FROM orders WHERE id_member='".$_SESSION['dunlop_id']."' AND status ='2' AND tipe_pembayaran !='cod'";
            $querytransaksi	= mysql_query($sqltransaksi);
            while($dtransaksi = mysql_fetch_array($querytransaksi)){
           ?>
           <option value="<?php echo $dtransaksi['id_order'];?>"><?php echo $dtransaksi['id_order'];?></option>
           <?php  }?>
         </select>
       </div>
     </div>
     <div class="control-group">
       <label class="control-label">Jumlah Transfer<sup>*</sup></label>
       <div class="controls">
         <input name="inputtransfer" type="text" autofocus required placeholder="Rp. " title="Jumlah Transfer" maxlength="30">
       </div>
     </div>
     <div class="control-group">
       <label class="control-label">Bukti Transfer <sup>*</sup></label>
       <div class="controls">
         <input name="file" type="file" autofocus required title="Bukti Transfer" >
       </div>
     </div>
     <br>
     <button class="btn btn-success controls" type="submit" name="submit">Kirim <span class="icon-upload-alt"></span></button>
    </form>
        
                   
      </div>
      <!-- adsasdasd -------------------------------------------------------------------------------------->
      <div class="span2">
         <h3>Pembayaran</h3><br>
         <div class="control-group">
         <p>
           <label class="radio">
             <img width="150" src="assets/img/cod.png" alt=""/>
           </label>
           <hr class="soften">
           <br>
           <label class="radio">
           <img width="150" src="assets/img/bca.png" alt=""/>
             <p><br>1563016616<br> 
             Cab. Padang a/n Asep</p>
           </label>
           <hr class="soften">
           <br>
           <label class="radio">
           <img width="170" src="assets/img/bri.png" alt=""/>
             <p><br>
               000501001641300<br> 
           Cab. Padang a/n Asep</p>
           </label>
           <hr class="soften">
           <br>
           <label class="radio">
            <img width="150" src="assets/img/bni.png" alt=""/>
           <p><br>0287171911<br> 
           Cab. Padang a/n Asep</p>
           </label>
           <br>
         </p>
       </div>
    </div>
	
</div>