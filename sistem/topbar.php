 <!-- top navigation -->
<div class="top_nav">
  <div class="nav_menu">
    <nav>
      <div class="nav toggle">
        <a id="menu_toggle"><i class="fa fa-bars"></i></a>
      </div>

      <ul class="nav navbar-nav navbar-right">
        <li class="">
          <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
            <img src="images/img.jpg" alt=""><?php echo ucfirst($_SESSION['dunlop_username'])?>
            <span class=" fa fa-angle-down"></span>
          </a>
          <ul class="dropdown-menu dropdown-usermenu pull-right">
            <li><a href="?page=profil"> Profile</a></li>
            <li><a href="?page=password"><span>Ganti Password</span></a></li>
            <li><a href="?page=logout"><i class="fa fa-sign-out pull-right"></i> Log Out</a></li>
          </ul>
        </li>
			<?php include_once "topbar_alert.php";?>
      </ul>
    </nav>
  </div>
</div>
<!-- /top navigation -->