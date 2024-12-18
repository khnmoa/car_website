
<?php
include 'db.php'; // الاتصال بقاعدة البيانات

// استرجاع جميع السيارات من قاعدة البيانات
$query = "SELECT * FROM cars";
$result = $conn->query($query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Available Cars</title>

    
    <link rel="stylesheet" href="./car-main/all.min.css">
    <link rel="stylesheet" href="./car-main/mdb.min.css">
    <link rel="stylesheet" href="./car-main/bootstrap css.min.css">
    <link rel="stylesheet" href="./car-main/style.css">

<style>
    .card-deck {
    display: flex;
    flex-wrap: wrap;
    gap: 20px;
    justify-content: space-between;
}
.card {
    width: 45%;
    margin-bottom: 20px;
}

</style>
     
     
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-light bg-body-tertiary ">
    <div class="container-fluid justify-content-between">
      <!-- Left elements -->
      <div class="d-flex">
        <!-- Brand -->
        <a class="navbar-brand me-2 mb-1 d-flex align-items-center" href="./car-main/ImgeBrand.html">
          <img
            src="./car-main/3rabeitk logo.png"
            height="20"
            width="50px"
            alt=" 3rabeitk Logo"
            loading="lazy"
            style="margin-top: 2px;"
          />
        </a>
  
        <!-- Search form -->
        <form class="input-group w-auto my-auto d-none d-sm-flex">
          <input
            autocomplete="off"
            type="search"
            class="form-control rounded"
            placeholder="Search"
            style="min-width: 125px;"
          />
          <span class="input-group-text border-0 d-none d-lg-flex"
            ><i class="fas fa-search"></i
          ></span>
        </form>
      </div>
      <!-- Left elements -->
  
      <!-- Center elements -->
      <ul class="navbar-nav flex-row d-none d-md-flex">
          <!-- home -->
        <li class="nav-item me-3 me-lg-1 active">
          <a class="nav-link" href="index.html">
            <span><i class="fas fa-home fa-lg"></i></span>
          </a>
        </li>
        <!--  سلة المشتريات   -->
        <li class="nav-item me-3 me-lg-1 active ">
            <a class="nav-link" href="index.html">
              <span><i class="fa-solid fa-cart-shopping" style="color: #cd6348;"></i></span>
              
            </a>
          </li>
       
          <!-- about us -->

          <li class="nav-item me-3 me-lg-1 active">
            <a class="nav-link" href="./car-main/about.html">
              <span><i class="fa-solid fa-address-card"></i></span>
              
            </a>
          </li>
      </ul>
      <!-- Center elements -->
  
      <!-- Right elements -->
      <ul class="navbar-nav flex-row">
        <!-- log in -->
        <li class="nav-item me-3 me-lg-1">
          <a class="nav-link d-sm-flex align-items-sm-center" href="login.php">
            <img
              src="https://mdbcdn.b-cdn.net/img/new/avatars/1.webp"
              class="rounded-circle"
              height="22"
              alt="Black and White Portrait of a Man"
              loading="lazy"
            />
            <strong class="d-none d-sm-block ms-1"> Login</strong>
          </a>
        </li>
           <li class="nav-item me-3 me-lg-1">
          <a class="nav-link d-sm-flex align-items-sm-center" href="register.php">
           
          
            <strong class="d-none d-sm-block ms-1"> Register</strong>
          </a>
        </li>
       

        <!-- اشعارات -->
        <li class="nav-item dropdown me-3 me-lg-1">
          <a
            data-mdb-dropdown-init
            class="nav-link dropdown-toggle hidden-arrow"
            href="#"
            id="navbarDropdownMenuLink"
            role="button"
            aria-expanded="false" >
            <i class="fas fa-bell fa-lg"></i>
            <span class="badge rounded-pill badge-notification bg-danger">1</span>
          </a>
          <ul
            class="dropdown-menu dropdown-menu-end"
            aria-labelledby="navbarDropdownMenuLink"
          >
            <li>
              <a class="dropdown-item" href="#">Some news</a>
            </li>
            <li>
              <a class="dropdown-item" href="#">Another news</a>
            </li>
            <li>
              <a class="dropdown-item" href="#">Something else here</a>
            </li>
          </ul>
        </li>
       
      </ul>
      <!-- Right elements -->
    </div>
  </nav>
  <br>
    <h1 style="text-align: center;">Available Cars for Sale</h1>

    <br>
    <br>
    
<div>
    <div style="display: flex; flex-wrap: wrap; gap: 100px; padding-left:50px" class="container" class="card my-5 w-50 mx-4">
     <?php
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<div class='card my-3'>";
                    echo "<img src='" . htmlspecialchars($row['car_image']) . "' class='card-img-top' alt='Car Image'>";
                    echo "<div class='card-body'>";
                    echo "<h5 class='card-title'>" . htmlspecialchars($row['car_name']) . "</h5>";
                    echo "<p class='card-text'>Description: " . htmlspecialchars($row['car_description']) . "</p>";
                    echo "<p class='card-text'>Price: $" . htmlspecialchars($row['price']) . "</p>";
                    echo "<p class='card-text'>Category: " . htmlspecialchars($row['category_id']) . "</p>";
                    echo "<a href='#!' class='btn btn-outline-danger d-block'>Buy</a>";
                    echo "</div>";
                    echo "</div>";
                }
            } else {
                echo "<p class='text-center'>No cars available at the moment.</p>";
            }
            ?>
    </div>
</div>

          
          
         
         <!-- home page -->



<!-- show more -->
<div class="container">
  <div class="row">
      <div class="col-md-12">

          <a href="" class="btn btn-info d-block rounded-circle my-4"> Show More</a>

      </div>
  </div>
</div>


<!-- home page -->

         
       
    
   




    <!-- Footer -->



<footer class="text-center text-lg-start bg-body-tertiary text-muted">
  <!-- Section: Social media -->
  <section class="d-flex justify-content-center justify-content-lg-between p-4 border-bottom">
    <!-- Left -->
    <div class="me-5 d-none d-lg-block">
      <span>Get connected with us on social networks:</span>
    </div>
    <!-- Left -->

    <!-- Right -->
    <div>
      <a href="" class="me-4 text-reset">
        <i class="fab fa-facebook-f"></i>
      </a>
      <a href="" class="me-4 text-reset">
        <i class="fab fa-twitter"></i>
      </a>
      <a href="" class="me-4 text-reset">
        <i class="fab fa-google"></i>
      </a>
      <a href="" class="me-4 text-reset">
        <i class="fab fa-instagram"></i>
      </a>
      <a href="" class="me-4 text-reset">
        <i class="fab fa-linkedin"></i>
      </a>
      <a href="" class="me-4 text-reset">
        <i class="fab fa-github"></i>
      </a>
    </div>
    <!-- Right -->
  </section>
  <!-- Section: Social media -->

  <!-- Section: Links  -->
  <section class="">
    <div class="container text-center text-md-start mt-5">
      <!-- Grid row -->
      <div class="row mt-3">
  

        <!-- Grid column -->
        <div class="col-md-2 col-lg-2 col-xl-2 mx-auto mb-4">
          <!-- Links -->
          <h6 class="text-uppercase fw-bold mb-4">
            Products
          </h6>
          <p>
            <a href="#!" class="text-reset">TOYOTA</a>
          </p>
          <p>
            <a href="#!" class="text-reset">Nissan</a>
          </p>
          <p>
            <a href="#!" class="text-reset">Honda</a>
          </p>
          <p>
            <a href="#!" class="text-reset">Subaru</a>
          </p>
        </div>
        <!-- Grid column -->

        <!-- Grid column -->
        <div class="col-md-3 col-lg-2 col-xl-2 mx-auto mb-4">
          <!-- Links -->
          <h6 class="text-uppercase fw-bold mb-4">
            Useful links
          </h6>
          <p>
            <a href="#!" class="text-reset">Pricing</a>
          </p>
          <p>
            <a href="#!" class="text-reset">Settings</a>
          </p>
          <p>
            <a href="#!" class="text-reset">Orders</a>
          </p>
          <p>
            <a href="#!" class="text-reset">Help</a>
          </p>
        </div>
        <!-- Grid column -->

        <!-- Grid column -->
        <div class="col-md-4 col-lg-3 col-xl-3 mx-auto mb-md-0 mb-4">
          <!-- Links -->
          <h6 class="text-uppercase fw-bold mb-4">Contact</h6>
          <p><i class="fas fa-home me-3"></i> Giza, NY 10012, Egypt</p>
          <p>
            <i class="fas fa-envelope me-3"></i>
            3rabeitk.com
          </p>
          <p><i class="fas fa-phone me-3"></i> + 01 234 567 88</p>
          <p><i class="fas fa-print me-3"></i> + 01 234 567 89</p>
        </div>
        <!-- Grid column -->
      </div>
      <!-- Grid row -->
    </div>
  </section>
  <!-- Section: Links  -->

  <!-- Copyright -->
  <div class="text-center p-4" style="background-color: rgba(0, 0, 0, 0.05);">
    © 2023 Copyright:
    <a class="text-reset fw-bold" href="https://mdbootstrap.com/">3rabeitk.com</a>
  </div>
  <!-- Copyright -->
</footer>


<!-- Footer -->




<!-- JS Section -->

<script>
    // الحصول على جميع العناصر التي تحمل الصف dropdown-toggle
        const dropdownToggles = document.querySelectorAll('.dropdown-toggle');
        
        // إضافة حدث النقر إلى كل عنصر
        dropdownToggles.forEach(toggle => {
          toggle.addEventListener('click', () => {
            alert('Welcome to the 3rabeitk Showroom');
          });
        });
 </script>


    <script src="./car-main/mdb.umd.min.js"></script>
    <script src="./car-main/all.min.js"></script>
    <script src="./car-main/jquery.slim.min.js"></script>
    <script src="./car-main/popper.min.js"></script>
    <script src="./car-main/bootstrap.min.js"></script>
    
</body>
</html>
