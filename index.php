<?php session_start();
require 'config/config.php';
?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description"
        content="Sutra Salon Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
        tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
        quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
        consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
        cillum dolore eu fugiat nulla pariatur.">
    <meta name="keywords" content="Sutra Salon, Salon">
    <meta name="author" content="Angker2020">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <!-- CSS SENDIRI -->
    <link rel="stylesheet" href="css/style.css">

    <!-- Shourcut Icon -->
    <link rel="shortcut icon" href="img/favicon.png">

    <title>Sutra Salon</title>
  </head>
  <body>
    <!-- NAVBAR -->
    <nav class="navbar navbar-expand-lg sticky-top navbar-dark" style="background-color:#9b59b6">
      <div class="container">
        <a class="navbar-brand scroll" href="">
          <img src="<?= $link?>img/logo.png" alt="Logo Sutra Salon" width="100" class="d-inline-block align-text-top">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
          <div class="navbar-nav ms-auto my-lg-0 mt-4">
            <a class="nav-link scroll" href="#home">Home</a>
            <a class="nav-link scroll" href="#reservation">Reservation</a>
            <a class="nav-link scroll" href="#about_us">About</a>
            <a class="nav-link scroll" href="#our_team">Our Team</a>
            <?php if (isset($_SESSION['username'])) {
              echo '<a href="dashboard/"><button class="btn btn-sm btn-Lpage ms-lg-4 me-lg-2 my-lg-0 mx-0 mb-2 mt-4 text-light p-2" style="background-color: #ff9ff3;">Dashboard</button></a>';
            }else{
              echo '<a href="login/"><button class="btn btn-sm btn-Lpage ms-lg-4 me-lg-2 my-lg-0 mx-0 mb-2 mt-4 text-light" style="background-color: #ff9ff3;">Login</button></a>
            <a href="register/"><button class="btn btn-sm btn-Lpage btn-danger">Register</button></a>';
            }?>
          </div>
        </div>
      </div>
    </nav>
    <!-- END NAVBAR -->

    <!-- JUMBOTRON -->
    <section id="home">
      <div class="container-fluid" style="background: url('img/watercolor.png');">
        <img src="<?=$link?>img/Logo[Text Bawah].png" alt="Logo Sutra Salon" class="mx-auto d-block" width="200px">
        <h2 class="text-center mt-3" style="color: #ff9ff3;"><strong>Upgrading Your Inner Beauty</strong></h2>
        <center>
          <a href="<?= $link?>dashboard/"><button class="btn btn-lg btn-opacity mt-4" style="background-color: #ff9ff3;color: white;"><strong>Booking</strong></button></a>
        </center>
      </div>
    </section>
    <!-- END JUMBOTRON -->

    <!-- RESERVATION -->
    <section id="reservation">
      <div class="container-fluid pb-5" style="background: url('img/sun-pattern.png');">
        <h2 class="text-center pt-5" style="color: #9b59b6;"><strong>We Serve</strong></h2>
        <center><hr width="150" size="5" color="black"></center>
        <div class="container mt-5">
          <div class="row">
            <div class="col-md-4 mb-md-0 mb-5">
              <img src="img/reservation/reservation1.jpg" alt="" class="rounded mx-auto d-block" width="200">
              <h4 class="text-center mt-3" style="color: #9b59b6;"><strong>Hair Treatment</strong></h4>
            </div>

            <div class="col-md-4 mb-md-0 mb-5">
              <img src="img/reservation/reservation2.jpg" alt="" class="rounded mx-auto d-block" width="200">
              <h4 class="text-center mt-3" style="color: #9b59b6;"><strong>Body Treatment</strong></h4>
            </div>

            <div class="col-md-4 mb-md-0 mb-5">
              <img src="img/reservation/reservation3.jpg" alt="" class="rounded mx-auto d-block" width="200">
              <h4 class="text-center mt-3" style="color: #9b59b6;"><strong>Make Up</strong></h4>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- END RESERVATION  -->

    <!-- ABOUT US -->
    <section id="about_us">
      <div class="container-fluid" style="background-color: #eaeaea;">
        <div class="container-fluid p-0">
          <div class="row">
            <div class="col-md-4 img-fluid p-0">
              <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-inner">
                  <div class="carousel-item active">
                    <img src="img/about_us/carousel/4.jpg" class="d-block" width="100%" alt="...">
                  </div>
                  <div class="carousel-item">
                    <img src="img/about_us/carousel/2.jpg" class="d-block" width="100%" alt="...">
                  </div>
                  <div class="carousel-item">
                    <img src="img/about_us/carousel/3.jpg" class="d-block" width="100%" alt="...">
                  </div>
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
                  <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                  <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
                  <span class="carousel-control-next-icon" aria-hidden="true"></span>
                  <span class="visually-hidden">Next</span>
                </button>
              </div>
            </div>

            <div class="col-md-8 mt-5 mt-md-0" style="background-color: white;">
              <h2 class="text-center pt-5" style="color: #9b59b6;"><strong>ABOUT US</strong></h2>
              <center><hr width="150" size="5" color="black"></center>
              <div class="container px-5 mt-3 mt-md-5">
                <div class="row">
                  <div class="col-md-6">
                    <p class="text-justify">Lorem ipsum dolor sit, amet consectetur adipisicing elit. Provident, fuga, voluptates voluptatem iste labore eum commodi aut ex reiciendis distinctio architecto sequi, quos possimus. Corrupti quisquam tempora, harum praesentium vel minima, culpa quibusdam facilis perspiciatis temporibus deserunt incidunt, animi eaque dolore, cum. Sint laboriosam non iusto nisi aliquam at architecto quos officiis sequi cumque nesciunt ea saepe hic, porro nobis nostrum debitis possimus dignissimos id doloribus obcaecati facilis omnis rerum laborum! Quibusdam rem, fugiat qui maxime saepe dolor voluptate illo ratione, cupiditate. </p>
                  </div>

                  <div class="col-md-6 mt-3 mt-md-0 mb-md-0 mb-5 ">
                    <img src="img/about_us/kanan.jpg" class="img-fluid rounded mx-auto d-block" width="100%">
                  </div>

                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- END ABOUT US  -->

    <!-- OUR TEAM -->
    <section id="our_team" style="background-color: #9b59b6;" class="p-5">
      <div class="container-fluid rounded" style="background-color: #ff9ff3;">
        <h2 class="text-center pt-5" style="color: white;"><strong>OUR TEAM</strong></h2>
        <center><hr width="150" size="5" color="white"></center>
        <div class="container mt-5">
          <div class="row">
            <div class="col-md-4 mb-5">
              <img src="img/team/shawn.jpg" alt="Shawn" class="circle mx-auto d-block" width="150">
              <h4 class="text-center mt-3 text-light"><strong>Shawn</strong></h4>
            </div>
            <div class="col-md-4 mb-5">
              <img src="img/team/selena.jpg" alt="Selena" class="circle mx-auto d-block" width="150">
              <h4 class="text-center mt-3 text-light"><strong>Selena</strong></h4>
            </div>
            <div class="col-md-4 mb-5">
              <img src="img/team/lee_jung.jpg" alt="Lee Jung" class="circle mx-auto d-block" width="150">
              <h4 class="text-center mt-3 text-light"><strong>Lee Jung</strong></h4>
            </div>
            <div class="col-md-6 mb-5">
              <img src="img/team/maria.jpg" alt="Maria" class="circle mx-auto d-block" width="150">
              <h4 class="text-center mt-3 text-light"><strong>Maria</strong></h4>
            </div>
            <div class="col-md-6 mb-5">
              <img src="img/team/melody.jpg" alt="Melody" class="circle mx-auto d-block" width="150">
              <h4 class="text-center mt-3 text-light"><strong>Melody</strong></h4>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- END OUR TEAM  -->

    <!-- ADDRESS -->
    <section id="our_team" style="background-color: #9b59b6;" class="px-5 pb-3">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-7">
            <h2 class="text-center pt-4 text-light"><strong>ADDRESS</strong></h2>
            <center><hr width="150" size="5" color="black">
            <iframe class="mt-3" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d997.4088627109879!2d117.08739382913578!3d-0.5485716589313803!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x3e89ed41d60ea579!2zMMKwMzInNTQuOSJTIDExN8KwMDUnMTYuNiJF!5e0!3m2!1sid!2sid!4v1637648832356!5m2!1sid!2sid" width="100%" height="200px" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
            </center>
            <h6 class="text-center text-light">Address : Sengkotek, Kec. Loa Janan Ilir, Kota Samarinda, Kalimantan Timur, Disamping Babe Tailor</h6>
          </div>

          <div class="col-md-5">
            <h2 class="text-center pt-4 text-light"><strong>WORKING HOURS</strong></h2>
            <center>
            <hr width="150" size="5" color="black">
            <table class="text-light mt-4" cellpadding="5">
              <tr>
                <td width="140px">MONDAY</td>
                <td>9AM - 9PM</td>
              </tr>
              <tr>
                <td width="140px">TUESDAY</td>
                <td>9AM - 9PM</td>
              </tr>
              <tr>
                <td width="140px">WEDNESDAY</td>
                <td>9AM - 9PM</td>
              </tr>
              <tr>
                <td width="140px">THURSDAY</td>
                <td>9AM - 9PM</td>
              </tr>
              <tr>
                <td width="140px">FRIDAY</td>
                <td>2PM - 9PM</td>
              </tr>
              <tr>
                <td width="140px">WEEKEND</td>
                <td>11AM - 8PM</td>
              </tr>
            </table>
            </center>
          </div>
        </div>
      </div>
      <hr width="100%" size="5" color="black">
      <div class="container my-4">
        <div class="row">
          <div class="col-md-6">
            <div class="text-center text-light mb-2">FEEL FREE TO ASK USE QUETIONS !<br>CONTACT PERSON :</div>
              <center>
                <a href="https://api.whatsapp.com/send?phone=+62895602578192" target="_blank"><img src="img/contact/telp.png" alt="Telepon" width="40" class="img-fluid mx-3"></a>
                <a href="mailto:sutra.salon123@gmail.com" target="_blank"><img src="img/contact/email.png" alt="Email" width="40" class="img-fluid mx-3"></a>
                <a href="https://api.whatsapp.com/send?phone=+62895602578192" target="_blank"><img src="img/contact/wa.png" alt="Whatsapp" width="40" class="img-fluid mx-3"></a>
              </center>
            </div>
            <div class="col-md-6 pt-md-0 pt-5">
              <div class="text-center text-light mb-4">FOLLOW US ON THESE PLATFORM</div>
              <center>
                <a href="https://facebook.com/sutra_salon/" target="_blank"><img src="img/contact/fb.png" alt="Facebook" width="40" class="img-fluid mx-3"></a>
                <a href="https://instagram.com/sutrasalon" target="_blank"><img src="img/contact/ig.png" alt="Instagram" width="40" class="img-fluid mx-3"></a>
                <a href="https://twitter.com/sutrasalon" target="_blank"><img src="img/contact/tw.png" alt="Twitter" width="40" class="img-fluid mx-3"></a>
              </center>
            </div>
          </div>
        </div>
      </div>
      <hr width="100%" size="5" color="black">
    </section>
    <!-- END ADDRESS  -->

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

    <!-- J_QUERY -->
    <script src="js/jquery-3.6.0.min.js"></script>

    <!-- BUAT SENDIRI -->
    <script src="js/scroll.js"></script>

  </body>
  <footer class="p-2" style="background-color: #ff9ff3;">
    <h6 class="text-center text-light">Copyright &copy Angker2020 | FASILKOM | Universitas Esa Unggul</h6> 
  </footer>
</html>