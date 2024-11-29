<?php
session_start();
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE email = '$email'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        if (password_verify($password, $user['password'])) {
            $_SESSION['user'] = $user;
            header('Location: dashboard.php');
        } else {
            echo "Invalid password.";
        }
    } else {
        echo "User not found.";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <style>
        .button {
            background-color: #4CAF50; 
            color: white; 
            padding: 10px 20px;
            text-align: center; 
            text-decoration: none; 
            display: inline-block; 
            border-radius: 5px; 
            margin: 10px; 
            font-size: 16px; 
        }

        .button:hover {
            background-color: #45a049; 
        }
    </style>
     <link rel="stylesheet" href="./car-main/animate.min.css">
    <link rel="stylesheet" href="./car-main/all.min.css">
    <link rel="stylesheet" href="./car-main/bootstrap css.min.css">
    <link rel="stylesheet" href="./car-main/style.css">
</head>
<body>

     
      <!-- Navbar-->
      <nav class="navbar navbar-expand-lg navbar-light bg-body-tertiary">
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
              <a class="nav-link" href="index.php">
                <span><i class="fas fa-home fa-lg"></i></span>
              </a>
            </li>
            <!--  سلة المشتريات   -->
            <li class="nav-item me-3 me-lg-1 ">
                <a class="nav-link" href="index.php">
                  <span><i class="fa-solid fa-cart-shopping" style="color: #e73d13;"></i></span>
                  
                </a>
              </li>
           
          </ul>
          <!-- Center elements -->
      
          <!-- Right elements -->
          <ul class="navbar-nav flex-row">
            <!-- log in -->
            <li class="nav-item me-3 me-lg-1">
              <a class="nav-link d-sm-flex align-items-sm-center" href="register.php">
                <img
                  src="https://mdbcdn.b-cdn.net/img/new/avatars/1.webp"
                  class="rounded-circle"
                  height="22"
                  alt="Black and White Portrait of a Man"
                  loading="lazy"
                />
                <strong class="d-none d-sm-block ms-1"> register</strong>
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
      <!-- Navbar -->
  
        
     


  <div class="container d-flex justify-content-center align-items-center min-vh-100 ">
      <div class=" animate animate__heartBeat login p-4 shadow-lg" style="width: 100%; max-width: 400px; ">
          <h3 class="text-center mb-4">Login</h3>
  <form method="POST">
              <div class="mb-3">
                        <label for="email" class="form-label">Email address</label>
                        <input type="email" class="form-control" id="email" placeholder="Enter your email" name="email" required>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control" id="password" name="password" placeholder="Enter your password" required>
                    </div>
                    <button type="submit" class="btn btn-primary w-100">Login</button>
                    <p class="text-center mt-3">
                        <small>Don't have an account? <a href="register.php">Sign up</a></small>
                    </p>
                </form>
            </div>
        </div>
  <!-- form -->
  
    
      <!-- JS Section -->
    <script src="./car-main/all.min.js"></script>
    <script src="./car-main/jquery.slim.min.js"></script>
    <script src="./car-main/popper.min.js"></script>
    <script src="./car-main/bootstrap.min.js"></script>
</body>
</html>

   




        

