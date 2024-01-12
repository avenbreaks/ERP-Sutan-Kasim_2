<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>LOGIN</title>

    <!-- Bootstrap -->
    <link href="vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="vendors/nprogress/nprogress.css" rel="stylesheet">
    <!-- Animate.css -->
    <link href="vendors/animate.css/animate.min.css" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="build/css/custom.min.css" rel="stylesheet">
  </head>

  <body class="login">
    <div>
      <a class="hiddenanchor" id="signup"></a>
      <a class="hiddenanchor" id="signin"></a>

      <div class="login_wrapper">
        <div class="animate form login_form">
          <section class="login_content">
            <h1>Login</h1>
            <?php
				include "lib/koneksi.php";
				if(isset($_POST["btnlogin"])){
						$nama  	= $_POST['inputUsername']; 
						$pass 	= md5($_POST['inputPassword']);
						$level 	= $_POST['inputLevel'];
						
						$sql   	= "SELECT * FROM login WHERE 
									username = '".mysql_real_escape_string($nama)."' AND 
									password = '".$pass."' AND 
									level	 = '".$level."' AND 
									bLokir	 = '0' ";
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
						
						echo "<meta http-equiv=Refresh content=0;url=sistem/?page=home>";
						
					}else{
						echo "<div class='alert alert-warning alert-dismissible' role='alert'>
								<button type='button' class='close' data-dismiss='alert' aria-label='Close'>
									<span aria-hidden='true'>&times;</span></button>
								Username atau Password Salah!!
								</div>";
					}
				}
				?>
              <form role="form" name="forminput" method="post" enctype="multipart/form-data">
                  <div>
                    <input type="text" class="form-control" name="inputUsername" placeholder="Username" required autofocus />
                  </div>
                  <div>
                    <input type="password" class="form-control" name="inputPassword" placeholder="Password" required autofocus />
                  </div>
                  <div>
                    <select name="inputLevel" autofocus required class="form-control">
                      <option>Pilih Level</option>
                      <option value="1">Administrator</option>
                      <option value="3">Karyawan [Sales]</option>
                      <option value="4">Karyawan [Managemen]</option>
                      <option value="5">Karyawan [Gudang]</option>
                    </select>
                  </div>
                  <br>
                  <div class="pull-right">
                    <button class="btn btn-success" name="btnlogin">Log in</button>
                  </div>
                  <div class="pull-left">
                    <h4><a href="app/?page=home"><i class="fa fa-arrow-left"></i> Kembali</a></h4>
                  </div>
			  </form>
              <div class="clearfix"></div>

              <div class="separator">
                <div class="clearfix"></div>
                <br />

                <div>
                  <h1><i class="fa fa-paw"></i> DUNLOP!</h1>
                  <p>Halaman Login ini hanya untuk Admin dan Karyawan</p>
                </div>
              </div>
          </section>
        </div>

        <div id="register" class="animate form registration_form">
          <section class="login_content">
            <form>
              <h1>Create Account</h1>
              <div>
                <input type="text" class="form-control" placeholder="Username" required />
              </div>
              <div>
                <input type="email" class="form-control" placeholder="Email" required />
              </div>
              <div>
                <input type="password" class="form-control" placeholder="Password" required />
              </div>
              <div>
                <a class="btn btn-default submit" href="index.html">Submit</a>
              </div>

              <div class="clearfix"></div>

              <div class="separator">
                <p class="change_link">Already a member ?
                  <a href="#signin" class="to_register"> Log in </a>
                </p>

                <div class="clearfix"></div>
                <br />

                <div>
                  <h1><i class="fa fa-paw"></i> Gentelella Alela!</h1>
                  <p>©2016 All Rights Reserved. Gentelella Alela! is a Bootstrap 3 template. Privacy and Terms</p>
                </div>
              </div>
            </form>
          </section>
        </div>
      </div>
    </div>
  </body>
</html>
