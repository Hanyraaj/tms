<?php
   function phpAlert($msg) {
    echo '<script type="text/javascript">alert("' . $msg . '")</script>';
  }
  
  
  if(isset($_POST['insert'])){
  include('config.php');  
      $c_name  = $_POST['c_name'] ;
      $c_email  = $_POST['c_email'] ;
      $c_contact  = $_POST['c_contact'] ;     
      $c_address  = $_POST['c_address'] ;
      $c_height  = $_POST['c_height'] ;
      $c_chest  = $_POST['c_chest'] ;
      $c_weight  = $_POST['c_weight'] ;
      $c_hip  = $_POST['c_hip'] ;
      $c_inseam  = $_POST['c_inseam'] ;     
      
    $sqlx = "INSERT INTO frock (c_name,c_email,c_contact,c_address,c_height,c_chest,c_weight,c_hip,c_inseam) VALUES ('$c_name','$c_email','$c_contact','$c_address','$c_height','$c_chest','$c_weight','$c_hip','$c_inseam')";
        try{
            $update_Result = mysqli_query($conn, $sqlx);    
            if($update_Result)
            {
                if(mysqli_affected_rows($conn) > 0)
                {
          phpAlert("Thank you Sir, We will reply you very soon");
          }else{   
        }
      }
      else {  }
      } catch (Exception $ex) {
      
         
    }
  }
?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Tailorart</title>
        <!-- Main Stylesheet -->
        <link rel="stylesheet" href="style.css">

        <!-- Sidebar Stylesheet -->
        <link rel="stylesheet" href="assets/css/sidebar.css">

        <!-- Bootstrap css-->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.2/css/bootstrap.min.css" integrity="shc_contact84-Smlep5jCw/wG7hdkwQ/Z5nLIefveQRIY9nfy6xoR1uRYBtpZgI6339F5dgvm/e9B" crossorigin="anonymous">

        <!-- Bootstrap js -->
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="shc_contact84-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="shc_contact84-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="shc_contact84-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

        <!-- Font Awesome -->
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.1.1/css/all.css" integrity="shc_contact84-O8whS3fhG2Onc_heightKas0Y9l3cfpmYjapjI0E4theH4iuMD+pLhbf6JI0jIMfYcK3yZ" crossorigin="anonymous">

        <!-- Google Font -->
        <link href="https://fonts.googleapis.com/css?family=Merienda" rel="stylesheet">

        <!-- jQuery -->
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="shc_contact84-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>

        <!-- Chart.js -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart.min.js"></script>

        <style>
            .custom{
              margin-top: 80px;  
              margin-left: 450px;
            }
        </style>
    </head>


    <body>
        <!-- Container -->
        <!-- Navber -->
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
            <div class="container">
                <a class="navbar-brand" href="index.php">Tailorart</a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
            </button>
                <div class="btn-group">
                    <button type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-user-circle"></i>
              </button>
                    <ul class="dropdown-menu dropdown-menu-right">
                        <li class="dropdown-header">LOG IN AS</li>
                        <li><a class="dropdown-item">temp@temp.com</a></li>
                        <li class="dropdown-divider"></li>

                        <li class="dropdown-header">PROFILE</li>
                        <li><a href="Change_Password.html" class="dropdown-item"><i class="fas fa-lock"></i> Change Password</a></li>
                        <li><a href="sign_in.php" class="dropdown-item"><i class="fas fa-sign-out-alt"></i> Sign Out</a></li>
                    </ul>
                </div>
            </div>
        </nav>
        <!-- End Navbar -->

        <!-- Sidebar -->
        <div class="sidenav">
            <li class="dropdown-header">
                <h6><i class="fas fa-tachometer-alt"></i> Dashboard</h6>
            </li>
            <li class="dropdown-divider"></li>
            <li class="dropdown-header">ORDER AREA</li>
            <button class="dropdown-btn"><i class="far fa-list-alt"></i> CATEGORY 
          <i class="fa fa-caret-down"></i>
        </button>
            <div class="dropdown-container">
                <button class="dropdown-btn"><i class="fas fa-male"></i> Gents
              <i class="fa fa-caret-down"></i>
            </button>
                <div class="dropdown-container">
                    <a href="pant.php">Pant</a>
                    <a href="shirt.php">Shirt</a>
                </div>
                <button class="dropdown-btn"><i class="fas fa-female"></i> Ladies
              <i class="fa fa-caret-down"></i>
            </button>
                <div class="dropdown-container">
                    <a href="kameez.php">Kameez</a>
                    <a href="frock.php">Frock</a>
                </div>
            </div>
            <button class="dropdown-btn"><i class="fas fa-shopping-cart"></i> ORDER 
          <i class="fa fa-caret-down"></i>
        </button>
            <div class="dropdown-container">
                <a href="add_order.php"><i class="fas fa-cart-plus"></i> Add Order</a>
                <a href="order_list.php"><i class="far fa-list-alt"></i> Order List</a>
                <a href="invoice.php"><i class="far fa-file-alt"></i> INVOICE</a>
            </div>
            <li class="dropdown-header">CUSTOMER AREA</li>
            <a href="customer_list.php" class="dropdown-btn" style="text-decoration: none;"><i class="fas fa-users"></i> CUSTOMER LIST</a>
            <li class="dropdown-header">INCOME AREA</li>
            <button class="dropdown-btn"><i class="fas fa-chart-line"></i> INCOME GRAPH
          <i class="fa fa-caret-down"></i>
        </button>
            <div class="dropdown-container">
                <a href="daily_income.php"><i class="far fa-calendar-alt"></i> Daily Income</a>
                <a href="monthly_income.php"><i class="far fa-calendar-alt"></i> Monthly Income</a>
                <a href="lifetime_income.php"><i class="far fa-calendar-alt"></i> Lifetime Income</a>
            </div>
            <li class="dropdown-header">STUFF AREA</li>
            <button class="dropdown-btn"><i class="fas fa-user-friends"></i> STAFF 
          <i class="fa fa-caret-down"></i>
        </button>
            <div class="dropdown-container">
                <a href="add_staff.php">Add Staff</a>
                <a href="staff_list.php">Staff List</a>
            </div>
        </div>
        <!-- End Sidebar -->

        <!-- Form-->
        <div class="custom">
            <div class="main-container fadeIn animated">
                <div class="container">
                    <div class="row">
                        <div class="col-md-7 col-sm-12 col-form">
                            <h4 class="title-style-2">Ladies Frock Measurement Details</h4>
                            <hr>
                            <form action="frock.php" method="POST">
                                <div class="row" style="margin-top: 15px">
                                    <div class="form-group col-md-6 ">
                                        <label for="text">Full Name</label>
                                        <input type="text" name="c_name" class="form-control" placeholder="Sadia Islam">
                                    </Div>
                                    <div class="form-group col-md-6">
                                        <label for="email">E-mail</label>
                                        <input type="email" name="c_email" class="form-control" placeholder="sadia@mail.com">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="text">Contact Number</label>
                                        <input type="text" name="c_contact" class="form-control" placeholder="01xxx - xxx xxx">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="text">Address</label>
                                        <input type="text" name="c_address" class="form-control" placeholder="Your address">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="text">Height</label>
                                        <input type="text" name="c_height" class="form-control" placeholder="Your height">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="text">Chest</label>
                                        <input type="text" name="c_chest" class="form-control" placeholder="Your chest">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="text">Weight</label>
                                        <input type="text" name="c_weight" class="form-control" placeholder="Your weight">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="text">Hip</label>
                                        <input type="text" name="c_hip" class="form-control" placeholder="Your hip">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="text">Inseam</label>
                                        <input type="text" name="c_inseam" class="form-control" placeholder="Your inseam">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <button type="submit" name="insert" class="btn btn-dark" style="width: 100%">Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>

                    <script>
                        /* Loop through all dropdown buttons to toggle between hiding and showing its dropdown content - This allows the user to have multiple dropdowns without any conflict */
                        var dropdown = document.getElementsByClassName("dropdown-btn");
                        var i;
                        
                        for (i = 0; i < dropdown.length; i++) {
                            dropdown[i].addEventListener("click", function() {
                            this.classList.toggle("active");
                            var dropdownContent = this.nextElementSibling;
                            if (dropdownContent.style.display === "block") {
                                dropdownContent.style.display = "none";
                            } else {
                                dropdownContent.style.display = "block";
                            }
                            });
                        }
                    </script>
    </body>

    </html>