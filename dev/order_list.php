<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Raymond</title>
    <!-- Main Stylesheet -->
    <link rel="stylesheet" href="style.css">

    <!-- Sidebar Stylesheet -->
    <link rel="stylesheet" href="assets/css/sidebar.css">

    <!-- Bootstrap css-->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.2/css/bootstrap.min.css" integrity="sha384-Smlep5jCw/wG7hdkwQ/Z5nLIefveQRIY9nfy6xoR1uRYBtpZgI6339F5dgvm/e9B" crossorigin="anonymous">

    <!-- Bootstrap js -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.1.1/css/all.css" integrity="sha384-O8whS3fhG2OnA5Kas0Y9l3cfpmYjapjI0E4theH4iuMD+pLhbf6JI0jIMfYcK3yZ" crossorigin="anonymous">

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css?family=Merienda" rel="stylesheet">

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>

    <!-- Chart.js -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart.min.js"></script>

    <style>
        .custom{
            margin-left: 15%;
      width: 85%;
    }
    td i{
      color: black;
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
            <a href="invoice.php"><i class="far fa-file-alt"></i> Invoice</a>
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

    <!-- Order List -->
    <h4 class="title-style-2" style="margin: 6% 0 0 16%;">Customer Order Details</h4>
    <!--Table-->
    <div class="custom" style="margin-left: 16%">
        <table id="tablePreview" class="table">
            <!--Table head-->
            <table class="table table-striped" style="width: 98%">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Order date</th>
                        <th scope="col">Fullname</th>
                        <th scope="col">Contact</th>
                        <th scope="col">Staff Name</th>
                        <th scope="col">Delivery</th>
                        <th scope="col">AOD</th>
                        <th scope="col">Price</th>
                        <th scope="col">Paid</th>
                        <th scope="col">Due</th>
                        <th scope="col">Details</th>
                        <th scope="col">Status</th>
                    </tr>
                </thead>

                <!--Table head-->
                <?php         
                      
                      
                      include('config.php');
                      $search_Query = "select * from `order`";   
                      $search_Result = mysqli_query($connect, $search_Query); 
                      if($search_Result)
                      {
                        if(mysqli_num_rows($search_Result))
                        {
                          while($row = mysqli_fetch_array($search_Result))
                          {
                            //$amount  = $row['amount'] == 0 ? '' : number_format($row['amount']);
                            echo '<tr>  
                            <td>'.$row['id'].'</td>
                            <td>'.$row['date'].'</td>
                            <td>'.$row['c_name'].'</td>
                            <td>'.$row['c_contact'].'</td>
                            <td>'.$row['s_name'].'</td>
                            <td>'.$row['d_date'].'</td>
                            <td>'.$row['amount_of_order'].'</td>
                            <td>'.$row['amount'].'</td>
                            <td>'.$row['paid'].'</td>
                            <td>'.$row['due'].'</td>
                            <td>'.$row['order_details'].'</td>
                            <td>'.$row['a10'].'</td>
                            </tr>';
                          }
                        }else{}
                        }else{     
                      }
                        
                      
                    ?>
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

    /* Print Table */
    function printPage(){
        window.print();
    }
    </script>
</body>

</html>