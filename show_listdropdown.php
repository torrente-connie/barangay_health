        
        <?php if(empty($_SESSION['patient_id'])) { ?>
        <a href="login.php" class="btn btn-primary btn-md" style="border:3px solid white">Login</a>
        
        <?php } else { ?>

         <li class="dropdown"><a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user">
            <img alt="image" src="assets/<?php echo $patient_image ?>" class="rounded-circle mr-1" style="width:30px;height:30px;">
            <div class="d-sm-none d-lg-inline-block text-capitalize">Hi, <?php echo $patient_fullname; ?></div></a>
            <div class="dropdown-menu dropdown-menu-right">
              <a class="dropdown-item has-icon" data-toggle="modal" data-target="#changePasswordModal" style="cursor: pointer">
                <i class="fas fa-unlock"></i> Change Password
              </a>
              <a class="dropdown-item has-icon" data-toggle="modal" data-target="#profileModal" style="cursor: pointer">
                <i class="far fa-user"></i> Profile
              </a>
              <div class="dropdown-divider"></div>
              <a href="logout.php" class="dropdown-item has-icon text-danger">
                <i class="fas fa-sign-out-alt"></i> Logout
              </a>
            </div>
          </li>

        <?php } ?>