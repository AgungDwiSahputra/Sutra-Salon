<?php
$user = $_SESSION['username'];
$ambil = mysqli_query($konek, "SELECT * FROM user WHERE username = '$user'");
$data = mysqli_fetch_array($ambil);
$jml_data = mysqli_num_rows($ambil);
?>
<nav class="navbar navbar-expand-lg sticky-top navbar-dark" style="background-color:#9b59b6">
  <div class="container">
    <a class="navbar-brand" href="">
      <img src="<?= $link?>img/logo.png" alt="Logo Sutra Salon" width="100" class="d-inline-block align-text-top">
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
      <div class="navbar-nav ms-auto my-lg-0 mt-4">
        <a class="nav-link" href="<?= $link?>dashboard">Dashboard</a>
        <a class="nav-link" href="<?= $link?>dashboard/reservation">Reservation</a>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Our Team
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
            <li><a class="dropdown-item" href="<?= $link?>dashboard/ourTeam">All Team</a></li>
            <li><a class="dropdown-item" href="<?= $link?>dashboard/ourTeam/bio">Biodata Team</a></li>
          </ul>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle ms-5" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Hello, <?= $data['nama_depan']." ".$data['nama_belakang']; ?>
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
            <li><a class="dropdown-item" href="<?= $link?>dashboard/profile">Profile</a></li>
            <li><a class="dropdown-item" href="<?= $link?>dashboard/reservation">Reservation Status</a></li>
            <li><a class="dropdown-item" href="<?= $link?>dashboard/exit.php">Exit</a></li>
          </ul>
        </li>
      </div>
    </div>
  </div>
</nav>