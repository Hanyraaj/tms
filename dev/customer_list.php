<?php
  function phpAlert($msg) {
    echo '<script type="text/javascript">alert("' . $msg . '")</script>';
  }
  
  //contact
  if(isset($_POST['insert'])){
    include('config.php');  
    $a1= $_POST['email'] ;
    $a2= $_POST['name'] ;
    $a3 =  $_POST['message'] ;
    
    $sqlx = "INSERT INTO contact (a1,a2,a3) VALUES ('$a1','$a2','$a3')";
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
  
  if(isset($_POST['delete'])){
    include('config.php');  
    $id= $_POST['id'] ;
    
    $query = "DELETE FROM contact WHERE id='$id'";
    if (mysqli_query($conn, $query)) {
      phpAlert("Data Deleted Successfully...") ;
      } else {
      echo 'Failed';
    }
    
  }
  
  if(isset($_POST['send'])){
    
    
    $contact=$_POST['email'];
    $subject="Reply From Welfare";
    $message=$_POST['message'];
    
    
    require_once('mailer/class.phpmailer.php');
    $mail = new PHPMailer();
    $mail->IsSMTP(); 
    $mail->SMTPDebug  = 0;                     
    $mail->SMTPAuth   = true;                  
    $mail->SMTPSecure = "ssl";                 
    $mail->Host       = "smtp.gmail.com";      
    $mail->Port       = 465;             
    $mail->AddAddress($contact);
    $mail->Username="matsolutionsinc4@gmail.com";  
    $mail->Password="I Love Crypto Fiat Money";            
    $mail->SetFrom('matsolutionsinc4@gmail.com','Welfare');
    $mail->AddReplyTo("matsolutionsinc4@gmail.com","Welfare");
    $mail->Subject    = $subject;
    $mail->MsgHTML($message);
    $mail->Send();
    phpAlert("Success  ");
  }
  
  //donate
  
  
  if(isset($_POST['delete2'])){
    include('config.php');  
    $id= $_POST['id'] ;
    
    $query = "DELETE FROM donate WHERE id='$id'";
    if (mysqli_query($conn, $query)) {
      phpAlert("Data Deleted Successfully...") ;
      } else {
      echo 'Failed';
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

        <!--Pant List Table-->
        <h2 class="title-style-2" style="margin: 5% 0 0 16%">Pant List <span class="title-under"></span></h2>
        <div class="custom" style="width: 83%; margin-left: 16%">
            <table id="tablePreview" class="table">
                <!--Table head-->
                <table class="table table-striped">
                    <thead class="table-dark">
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Date</th>
                            <th scope="col">Name</th>
                            <th scope="col">Email</th>
                            <th scope="col">Phone</th>
                            <th scope="col">Address</th>
                            <th scope="col">W</th>
                            <th scope="col">L</th>
                            <th scope="col">H</th>
                            <th scope="col">O</th>
                            <th scope="col">U</th>
                            <th scope="col">BP</th>
                        </tr>
                    </thead>

                    <!--Table head-->
                    <?php         
                      
                      
                      include('config.php');
                      $search_Query = "select * from pant ";   
                      $search_Result = mysqli_query($connect, $search_Query); 
                      if($search_Result)
                      {
                        if(mysqli_num_rows($search_Result))
                        {
                          while($row = mysqli_fetch_array($search_Result))
                          {
                            //$amount  = $row['amount'] == 0 ? '' : number_format($row['amount']);
                            echo '<tr>  
                            <td>'.$row['c_id'].'</td>
                            <td>'.$row['order_date'].'</td>
                            <td>'.$row['c_name'].'</td>
                            <td>'.$row['c_email'].'</td>
                            <td>'.$row['c_contact'].'</td>
                            <td>'.$row['c_address'].'</td>
                            <td>'.$row['c_waist'].'</td>
                            <td>'.$row['c_length'].'</td>
                            <td>'.$row['c_hight'].'</td>
                            <td>'.$row['c_open'].'</td>
                            <td>'.$row['c_under'].'</td>
                            <td>'.$row['c_back_pocket'].'</td>
                            </tr>'; 

  //c_id  order_date  c_name  c_email c_contact c_address c_waist c_length  c_hight c_open  c_under c_back_pocket a11
 


                          }
                        }else{}
                        }else{     
                      }
                        
                      
                    ?>
                </table>
                <!--Table-->
        </div>

        <!-- Shirt List Table -->
        <h2 class="title-style-2" style="margin: 5% 0 0 16%">Shirt List <span class="title-under"></span></h2>
        <div class="custom" style="width: 83%; margin-left: 16%">
            <table id="tablePreview" class="table">
                <!--Table head-->
                <table class="table table-striped">
                    <thead class="table-dark">
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Date</th>
                            <th scope="col">Name</th>
                            <th scope="col">Email</th>
                            <th scope="col">Phone</th>
                            <th scope="col">Address</th>
                            <th scope="col">H</th>
                            <th scope="col">W</th>
                            <th scope="col">S</th>
                            <th scope="col">H.C</th>
                            <th scope="col">H.W</th>
                            <th scope="col">SLV</th>
                            <th scope="col">C.P</th>
                        </tr>
                    </thead>

                    <!--Table head-->
                    <?php         
                      
                      
                      include('config.php');
                      $search_Query = "select * from shirt ";   
                      $search_Result = mysqli_query($connect, $search_Query); 
                      if($search_Result)
                      {
                        if(mysqli_num_rows($search_Result))
                        {
                          while($row = mysqli_fetch_array($search_Result))
                          {
                            //$amount  = $row['amount'] == 0 ? '' : number_format($row['amount']);
                            echo '<tr>  
                            <td>'.$row['c_id'].'</td>
                            <td>'.$row['order_date'].'</td>
                            <td>'.$row['c_name'].'</td>
                            <td>'.$row['c_email'].'</td>
                            <td>'.$row['c_contact'].'</td>
                            <td>'.$row['c_address'].'</td>
                            <td>'.$row['c_higth'].'</td>
                            <td>'.$row['c_weigth'].'</td>
                            <td>'.$row['c_shoulder'].'</td>
                            <td>'.$row['c_half_chest'].'</td>
                            <td>'.$row['c_halp_weight'].'</td>
                            <td>'.$row['c_sleeve'].'</td>
                            <td>'.$row['c_chest_pocket'].'</td>
                            </tr>'; 

  
//c_id order_date c_name
//c_email c_contact c_address c_higth c_weigth c_shoulder
//c_half_chest c_halp_weight c_sleeve c_chest_pocket


                          }
                        }else{}
                        }else{     
                      }
                        
                      
                    ?>
                </table>
        </div>


        <!-- Kameez List Table -->
        <h2 class="title-style-2" style="margin: 5% 0 0 16%">Kameez List <span class="title-under"></span></h2>
        <div class="custom" style="width: 83%; margin-left: 16%">
            <table id="tablePreview" class="table">
                <!--Table head-->
                <table class="table table-striped">
                    <thead class="table-dark">
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Date</th>
                            <th scope="col">Name</th>
                            <th scope="col">Email</th>
                            <th scope="col">Phone</th>
                            <th scope="col">Address</th>
                            <th scope="col">BL</th>
                            <th scope="col">S</th>
                            <th scope="col">C</th>
                            <th scope="col">W</th>
                        </tr>
                    </thead>

                    <!--Table head-->
                    <?php         
                      
                      
                      include('config.php');
                      $search_Query = "select * from kameez ";   
                      $search_Result = mysqli_query($connect, $search_Query); 
                      if($search_Result)
                      {
                        if(mysqli_num_rows($search_Result))
                        {
                          while($row = mysqli_fetch_array($search_Result))
                          {
                            //$amount  = $row['amount'] == 0 ? '' : number_format($row['amount']);
                            echo '<tr>  
                            <td>'.$row['c_id'].'</td>
                            <td>'.$row['order_date'].'</td>
                            <td>'.$row['c_name'].'</td>
                            <td>'.$row['c_email'].'</td>
                            <td>'.$row['c_contact'].'</td>
                            <td>'.$row['c_address'].'</td>
                            <td>'.$row['c_body_length'].'</td>
                            <td>'.$row['c_shoulder'].'</td>
                            <td>'.$row['c_chest'].'</td>
                            <td>'.$row['c_waist'].'</td>
                            </tr>'; 
                          }
                        }else{}
                        }else{     
                      }
                        
                      
                    ?>
                </table>
                <!--Table-->
        </div>

        <!--Frock List Table-->
        <h2 class="title-style-2" style="margin: 5% 0 0 16%">Frock List <span class="title-under"></span></h2>
        <div class="custom" style="width: 83%; margin-left: 16%">
            <table id="tablePreview" class="table">
                <!--Table head-->
                <table class="table table-striped">
                    <thead class="table-dark">
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Date</th>
                            <th scope="col">Name</th>
                            <th scope="col">Email</th>
                            <th scope="col">Phone</th>
                            <th scope="col">Address</th>
                            <th scope="col">H</th>
                            <th scope="col">C</th>
                            <th scope="col">W</th>
                            <th scope="col">HIP</th>
                            <th scope="col">ISM</th>
                        </tr>
                    </thead>

                    <!--Table head-->
                    <?php         
                      
                      
                      include('config.php');
                      $search_Query = "select * from frock ";   
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
                            <td>'.$row['order_date'].'</td>
                            <td>'.$row['c_name'].'</td>
                            <td>'.$row['c_email'].'</td>
                            <td>'.$row['c_contact'].'</td>
                            <td>'.$row['c_address'].'</td>
                            <td>'.$row['c_height'].'</td>
                            <td>'.$row['c_chest'].'</td>
                            <td>'.$row['c_weight'].'</td>
                            <td>'.$row['c_hip'].'</td>
                            <td>'.$row['c_inseam'].'</td>
                            </tr>'; 
                          }
                        }else{}
                        }else{     
                      }
                        
                      
                    ?>
                </table>
                <!--Table-->
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