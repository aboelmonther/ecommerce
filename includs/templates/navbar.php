<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#app-nav" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
          <a class="nav-link" href="dashbord.php">Home <span class="sr-only">(current)</span></a>


  <div class="collapse navbar-collapse" id="app-nav">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
      </li>
      <li class="nav-item">
        <a class="nav-link" href="categories.php"><?php echo lang('CATEGORIES') ?></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#"><?php echo lang('ITEMS') ?></a>
      </li>
<li class="nav-item">
        <a class="nav-link" href="members.php"><?php echo lang('MEMBERS') ?></a>
      </li>
<li class="nav-item">
        <a class="nav-link" href="#"><?php echo lang('STATISTICS') ?></a>
      </li>
<li class="nav-item">
        <a class="nav-link" href="#"><?php echo lang('LOGS') ?></a>
      </li>
</ul>
      <li class="nav-item dropdown" style="list-style-type: none;">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Dropdown
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="members.php?do=Edit&userid=<?php echo $_SESSION['ID'] ?>">Edit Profile</a>
          <a class="dropdown-item" href="#">Setting action</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="logout.php">Logout</a>
        </div>
      </li>
    </ul>
   
  </div>
</nav>