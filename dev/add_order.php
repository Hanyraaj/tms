<?php
   function phpAlert($msg) {
    echo '<script type="text/javascript">alert("' . $msg . '")</script>';
  }
    if(isset($_POST['c_name'])){
    include('config.php');  
      $c_name  = $_POST['c_name'];
      $c_contact  = $_POST['c_contact'];
      $s_name  = $_POST['s_name'];     
      $d_date  = $_POST['d_date'];
      $amount_of_order  = $_POST['amount_of_order'];
      $amount  = $_POST['amount'];
      $paid  = $_POST['paid'];
      $due  = $_POST['due'];
      $order_details = $_POST['order_details'];
      $a10  = $_POST['a10'];     

    $sqlx = "INSERT INTO `order` (c_name,c_contact,s_name,d_date,amount_of_order,amount,paid,due,a10,order_details) VALUES ('$c_name','$c_contact','$s_name','$d_date','$amount_of_order','$amount','$paid','$due','$a10','$order_details')";
        try{
            $update_Result = mysqli_query($conn, $sqlx);    
            if($update_Result)
            {
                if(mysqli_affected_rows($conn) > 0)
                {
          phpAlert("Thank you Sir, We will reply you very soon");
          }else{
          phpAlert("Something Went wrong.");   
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
        <title>Raymond</title>
        <!-- Main Stylesheet -->
        <link rel="stylesheet" href="style.css">

        <!-- Sidebar Stylesheet -->
        <link rel="stylesheet" href="assets/css/sidebar.css">

        <!-- Bootstrap css-->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.2/css/bootstrap.min.css" integrity="shs_name84-Smlep5jCw/wG7hdkwQ/Z5nLIefveQRIY9nfy6xoR1uRYBtpZgI6339F5dgvm/e9B" crossorigin="anonymous">

        <!-- Bootstrap js -->
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="shs_name84-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="shs_name84-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="shs_name84-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

        <!-- Font Awesome -->
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.1.1/css/all.css" integrity="shs_name84-O8whS3fhG2Onamount_of_orderKas0Y9l3cfpmYjapjI0E4theH4iuMD+pLhbf6JI0jIMfYcK3yZ" crossorigin="anonymous">

        <!-- Google Font -->
        <link href="https://fonts.googleapis.com/css?family=Merienda" rel="stylesheet">

        <!-- jQuery -->
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="shs_name84-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>

        <!-- Date Picker -->
        <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="shs_name84-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/gijgo@1.9.10/js/gijgo.min.js" type="text/javascript"></script>
        <link href="https://cdn.jsdelivr.net/npm/gijgo@1.9.10/css/gijgo.min.css" rel="stylesheet" type="text/css" />


        <!-- Chart.js -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart.min.js"></script>

        <style>
            .custom{
              position: relative;
              margin-top: 5%;
              margin-left: 35%;
            }
    
            input{
                border: 1px solid #333333;
            }
            ::-webkit-input-placeholder{
                color: black;
                font-size: 14px;
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
                            <h4 class="title-style-2">Customer Order Details</h4>
                            <hr>
                            <form action="add_order.php" method="POST">
                                <div class="row" style="margin-top: 15px">
                                    <div class="form-group col-md-6 ">
                                        <label for="text">Full Name</label>
                                        <input type="text" name="c_name" class="form-control" placeholder="John Doe">
                                    </Div>
                                    <div class="form-group col-md-6 ">
                                        <label for="text">Contact</label>
                                        <input type="text" name="c_contact" class="form-control" placeholder="01xxx - xxx xxx">
                                    </Div>
                                    <div class="form-group col-md-6">
                                        <label for="text">Staff Name</label>
                                        <input type="text" name="s_name" class="form-control" placeholder="Enter Staff Name">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="text">Delivery Date</label>
                                        <input type="text" name="d_date" class="form-control" placeholder="dd-mm-yyyy" id="datepicker">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="text">Amount of order</label>
                                        <input type="text" name="amount_of_order" class="form-control" placeholder="Enter Total Amount of order">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="text">Amount</label>
                                        <input type="text" name="amount" class="form-control" placeholder="Enter Total Amount">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="text">Paid</label>
                                        <input type="text" name="paid" class="form-control" placeholder="Enter Paid Amount">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="text">Due</label>
                                        <input type="text" name="due" class="form-control" placeholder="Enter Due Amount">
                                    </div>
                                    <div class="form-group col-md-12">
                                        <label for="example-password-input">Order Details</label>
                                        <!-- <textarea class="form-control" placeholder="Enter Order Details" required="required" name="a10" id="customer_customer_address"></textarea> -->
                                        <input type="text" name="a10" class="form-control">
                                    </div>
                                    <div class="form-group col-md-12">
                                        <label for="a10">Status</label>
                                        <select id="a10" class="form-control" name="order_details">
                                    <option value="1">Confirm</option>
                                    <option value="2">Processing</option>
                                    <option value="3">Ready</option>
                                    <option value="4">Deliverd</option>
                                  </select>
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
                
                    /* Date Picker */
                        $('#datepicker').datepicker({
                            uiLibrary: 'bootstrap4'
                        });
                    </script>
    </body>

    </html>