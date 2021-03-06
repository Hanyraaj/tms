<?php
  //invoice.php  
  include('database_connection.php');

  $statement = $connect->prepare("
    SELECT * FROM tbl_order 
    ORDER BY order_id DESC
  ");

  $statement->execute();

  $all_result = $statement->fetchAll();

  $total_rows = $statement->rowCount();

  if(isset($_POST["create_invoice"]))
  { 
    $order_total_before_tax = 0;
    $order_total_tax1 = 0;
    $order_total_tax2 = 0;
   
    $order_total_tax = 0;
    $order_total_after_tax = 0;
    $statement = $connect->prepare("
      INSERT INTO tbl_order 
        (order_no, order_date, order_receiver_name, order_receiver_address, order_total_before_tax, order_total_tax1, order_total_tax2, order_total_tax, order_total_after_tax, order_datetime)
        VALUES (:order_no, :order_date, :order_receiver_name, :order_receiver_address, :order_total_before_tax, :order_total_tax1, :order_total_tax2, :order_total_tax, :order_total_after_tax, :order_datetime)
    ");
    $statement->execute(
      array(
          ':order_no'               =>  trim($_POST["order_no"]),
          ':order_date'             =>  trim($_POST["order_date"]),
          ':order_receiver_name'          =>  trim($_POST["order_receiver_name"]),
          ':order_receiver_address'       =>  trim($_POST["order_receiver_address"]),
          ':order_total_before_tax'       =>  $order_total_before_tax,
          ':order_total_tax1'           =>  $order_total_tax1,
          ':order_total_tax2'           =>  $order_total_tax2,
       
          ':order_total_tax'            =>  $order_total_tax,
          ':order_total_after_tax'        =>  $order_total_after_tax,
          ':order_datetime'           =>  date("Y-m-d")
      )
    );

      $statement = $connect->query("SELECT LAST_INSERT_ID()");
      $order_id = $statement->fetchColumn();

      for($count=0; $count<$_POST["total_item"]; $count++)
      {
        $order_total_before_tax = $order_total_before_tax + floatval(trim($_POST["order_item_actual_amount"][$count]));

        $order_total_tax1 = $order_total_tax1 + floatval(trim($_POST["order_item_tax1_amount"][$count]));

        $order_total_tax2 = $order_total_tax2 + floatval(trim($_POST["order_item_tax2_amount"][$count]));

       

        $order_total_after_tax = $order_total_after_tax + floatval(trim($_POST["order_item_final_amount"][$count]));

        $statement = $connect->prepare("
          INSERT INTO tbl_order_item 
          (order_id, item_name, order_item_quantity, order_item_price, order_item_actual_amount, order_item_tax1_rate, order_item_tax1_amount, order_item_tax2_rate, order_item_tax2_amount, order_item_final_amount)
          VALUES (:order_id, :item_name, :order_item_quantity, :order_item_price, :order_item_actual_amount, :order_item_tax1_rate, :order_item_tax1_amount, :order_item_tax2_rate, :order_item_tax2_amount, :order_item_final_amount)
        ");

        $statement->execute(
          array(
            ':order_id'               =>  $order_id,
            ':item_name'              =>  trim($_POST["item_name"][$count]),
            ':order_item_quantity'          =>  trim($_POST["order_item_quantity"][$count]),
            ':order_item_price'           =>  trim($_POST["order_item_price"][$count]),
            ':order_item_actual_amount'       =>  trim($_POST["order_item_actual_amount"][$count]),
            ':order_item_tax1_rate'         =>  trim($_POST["order_item_tax1_rate"][$count]),
            ':order_item_tax1_amount'       =>  trim($_POST["order_item_tax1_amount"][$count]),
            ':order_item_tax2_rate'         =>  trim($_POST["order_item_tax2_rate"][$count]),
            ':order_item_tax2_amount'       =>  trim($_POST["order_item_tax2_amount"][$count]),

            ':order_item_final_amount'        =>  trim($_POST["order_item_final_amount"][$count])
          )
        );
      }
      $order_total_tax = $order_total_tax1 + $order_total_tax2;

      $statement = $connect->prepare("
        UPDATE tbl_order 
        SET order_total_before_tax = :order_total_before_tax, 
        order_total_tax1 = :order_total_tax1, 
        order_total_tax2 = :order_total_tax2, 
     
        order_total_tax = :order_total_tax, 
        order_total_after_tax = :order_total_after_tax 
        WHERE order_id = :order_id 
      ");
      $statement->execute(
        array(
          ':order_total_before_tax'     =>  $order_total_before_tax,
          ':order_total_tax1'         =>  $order_total_tax1,
          ':order_total_tax2'         =>  $order_total_tax2,
    
          ':order_total_tax'          =>  $order_total_tax,
          ':order_total_after_tax'      =>  $order_total_after_tax,
          ':order_id'             =>  $order_id
        )
      );
      header("location:invoice.php");
  }

  if(isset($_POST["update_invoice"]))
  {
    $order_total_before_tax = 0;
      $order_total_tax1 = 0;
      $order_total_tax2 = 0;
  
      $order_total_tax = 0;
      $order_total_after_tax = 0;
      
      $order_id = $_POST["order_id"];
      
      
      
      $statement = $connect->prepare("
                DELETE FROM tbl_order_item WHERE order_id = :order_id
            ");
            $statement->execute(
                array(
                    ':order_id'       =>      $order_id
                )
            );
      
      for($count=0; $count<$_POST["total_item"]; $count++)
      {
        $order_total_before_tax = $order_total_before_tax + floatval(trim($_POST["order_item_actual_amount"][$count]));
        $order_total_tax1 = $order_total_tax1 + floatval(trim($_POST["order_item_tax1_amount"][$count]));
        $order_total_tax2 = $order_total_tax2 + floatval(trim($_POST["order_item_tax2_amount"][$count]));
      
        $order_total_after_tax = $order_total_after_tax + floatval(trim($_POST["order_item_final_amount"][$count]));
        $statement = $connect->prepare("
          INSERT INTO tbl_order_item 
          (order_id, item_name, order_item_quantity, order_item_price, order_item_actual_amount, order_item_tax1_rate, order_item_tax1_amount, order_item_tax2_rate, order_item_tax2_amount, order_item_final_amount) 
          VALUES (:order_id, :item_name, :order_item_quantity, :order_item_price, :order_item_actual_amount, :order_item_tax1_rate, :order_item_tax1_amount, :order_item_tax2_rate, :order_item_tax2_amount,:order_item_final_amount)
        ");
        $statement->execute(
          array(
            ':order_id'                 =>  $order_id,
            ':item_name'                =>  trim($_POST["item_name"][$count]),
            ':order_item_quantity'          =>  trim($_POST["order_item_quantity"][$count]),
            ':order_item_price'            =>  trim($_POST["order_item_price"][$count]),
            ':order_item_actual_amount'     =>  trim($_POST["order_item_actual_amount"][$count]),
            ':order_item_tax1_rate'         =>  trim($_POST["order_item_tax1_rate"][$count]),
            ':order_item_tax1_amount'       =>  trim($_POST["order_item_tax1_amount"][$count]),
            ':order_item_tax2_rate'         =>  trim($_POST["order_item_tax2_rate"][$count]),
            ':order_item_tax2_amount'       =>  trim($_POST["order_item_tax2_amount"][$count]),

            ':order_item_final_amount'      =>  trim($_POST["order_item_final_amount"][$count])
          )
        );
        $result = $statement->fetchAll();
      }
      $order_total_tax = $order_total_tax1 + $order_total_tax2;
      
      $statement = $connect->prepare("
        UPDATE tbl_order 
        SET order_no = :order_no, 
        order_date = :order_date, 
        order_receiver_name = :order_receiver_name, 
        order_receiver_address = :order_receiver_address, 
        order_total_before_tax = :order_total_before_tax, 
        order_total_tax1 = :order_total_tax1, 
        order_total_tax2 = :order_total_tax2, 
       
        order_total_tax = :order_total_tax, 
        order_total_after_tax = :order_total_after_tax 
        WHERE order_id = :order_id 
      ");
      
      $statement->execute(
        array(
          ':order_no'               =>  trim($_POST["order_no"]),
          ':order_date'             =>  trim($_POST["order_date"]),
          ':order_receiver_name'        =>  trim($_POST["order_receiver_name"]),
          ':order_receiver_address'     =>  trim($_POST["order_receiver_address"]),
          ':order_total_before_tax'     =>  $order_total_before_tax,
          ':order_total_tax1'          =>  $order_total_tax1,
          ':order_total_tax2'          =>  $order_total_tax2,
      
          ':order_total_tax'           =>  $order_total_tax,
          ':order_total_after_tax'      =>  $order_total_after_tax,
          ':order_id'               =>  $order_id
        )
      );
      
      $result = $statement->fetchAll();
            
      header("location:invoice.php");
  }

  if(isset($_GET["delete"]) && isset($_GET["id"]))
  {
    $statement = $connect->prepare("DELETE FROM tbl_order WHERE order_id = :id");
    $statement->execute(
      array(
        ':id'       =>      $_GET["id"]
      )
    );
    $statement = $connect->prepare(
      "DELETE FROM tbl_order_item WHERE order_id = :id");
    $statement->execute(
      array(
        ':id'       =>      $_GET["id"]
      )
    );
    header("location:invoice.php");
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
            /* Remove the navbar's default margin-bottom and rounded borders */ 
              .navbar {
              margin-bottom: 4px;
              border-radius: 0;
              }
              /* Add a gray background color and some padding to the footer */
              footer {
              background-color: #f2f2f2;
              padding: 25px;
              }
              .carousel-inner img {
              width: 100%; /* Set width to 100% */
              margin: auto;
              min-height:200px;
              }
              .navbar-brand
              {
              padding:5px 40px;
              }
              /* Hide the carousel text when the screen is less than 600 pixels wide */
              @media (max-width: 600px) {
              .carousel-caption {
              display: none; 
              }
              }
        </style>
    </head>

    <body>
        <style>
            .box
              {
              width: 100%;
              max-width: 1390px;
              border-radius: 5px;
              border:1px solid #ccc;
              padding: 15px;
              margin: 0 auto;                
              margin-top:50px;
              box-sizing:border-box;
              }
        </style>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.8.0/css/bootstrap-datepicker.css">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.8.0/js/bootstrap-datepicker.js"></script>
        <script>
            $(document).ready(function(){
                $('#order_date').datepicker({
                  format: "yyyy-mm-dd",
                  autoclose: true
                });
              });
        </script>
        <div class="container-fluid">
            <?php
      if(isset($_GET["add"]))
      {
      ?>
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

                <form method="post" id="invoice_form" style="width: 85%; margin: 5% 0 5% 15%">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <tr>
                                <td colspan="2" align="center">
                                <h3 style="font-family: 'Merienda', cursive; font-weight: bold">Tailorart Invoice</h3>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <div class="row">
                                        <div class="col-md-8">
                                            To,<br />
                                            <b>CUSTOMER BILL</b><br />
                                            <input type="text" name="order_receiver_name" id="order_receiver_name" class="form-control input-sm" placeholder="Enter Customer Name" />
                                            <textarea name="order_receiver_address" id="order_receiver_address" class="form-control" placeholder="Enter Customer Address"></textarea>
                                        </div>
                                        <div class="col-md-4">
                                            <br> <strong>#INVOICE NUMBER</strong> <br />
                                            <input type="text" name="order_no" id="order_no" class="form-control input-sm" placeholder="Enter Invoice No." />
                                            <input type="text" name="order_date" id="order_date" class="form-control input-sm" readonly placeholder="Delivery Date" />
                                        </div>
                                    </div>
                                    <br />
                                    <table id="invoice-item-table" class="table table-bordered">
                                        <tr>
                                            <th width="7%">Sr No.</th>
                                            <th width="20%">Item Name</th>
                                            <th width="5%">Quantity</th>
                                            <th width="5%">Price</th>
                                            <th width="10%">Total Amt.</th>
                                            <th width="12.5%" colspan="2">Price details</th>
                                            <th width="12.5%" colspan="2">Tax (%)</th>

                                            <th width="12.5%" rowspan="2">Total</th>
                                            <th width="3%" rowspan="2"></th>
                                        </tr>
                                        <tr>
                                            <th></th>
                                            <th></th>
                                            <th></th>
                                            <th></th>
                                            <th></th>
                                            <th>Paid</th>
                                            <th>Due</th>
                                            <th>Rate</th>
                                            <th>Amt.</th>

                                        </tr>
                                        <tr>
                                            <td><span id="sr_no">1</span></td>
                                            <td><input type="text" name="item_name[]" id="item_name1" class="form-control input-sm" /></td>
                                            <td><input type="text" name="order_item_quantity[]" id="order_item_quantity1" data-srno="1" class="form-control input-sm order_item_quantity" /></td>
                                            <td><input type="text" name="order_item_price[]" id="order_item_price1" data-srno="1" class="form-control input-sm number_only order_item_price" /></td>
                                            <td><input type="text" name="order_item_actual_amount[]" id="order_item_actual_amount1" data-srno="1" class="form-control input-sm order_item_actual_amount" readonly /></td>
                                            <td><input type="text" name="order_item_tax1_rate[]" id="order_item_tax1_rate1" data-srno="1" class="form-control input-sm number_only order_item_tax1_rate" /></td>
                                            <td><input type="text" name="order_item_tax1_amount[]" id="order_item_tax1_amount1" data-srno="1" readonly class="form-control input-sm order_item_tax1_amount" /></td>
                                            <td><input type="text" name="order_item_tax2_rate[]" id="order_item_tax2_rate1" data-srno="1" class="form-control input-sm number_only order_item_tax2_rate" /></td>
                                            <td><input type="text" name="order_item_tax2_amount[]" id="order_item_tax2_amount1" data-srno="1" readonly class="form-control input-sm order_item_tax2_amount" /></td>

                                            <td><input type="text" name="order_item_final_amount[]" id="order_item_final_amount1" data-srno="1" readonly class="form-control input-sm order_item_final_amount" /></td>
                                            <td></td>
                                        </tr>
                                    </table>
                                    <div align="right">
                                        <button type="button" name="add_row" id="add_row" class="btn btn-dark btn-xs">+</button>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td align="right"><b>Total</td>
                <td align="right"><b><span id="final_total_amt"></span></b></td>
                            </tr>
                            <tr>
                                <td colspan="2"></td>
                            </tr>
                            <tr>
                                <td colspan="2" align="center">
                                    <input type="hidden" name="total_item" id="total_item" value="1" />
                                    <input type="submit" name="create_invoice" id="create_invoice" class="btn btn-dark" value="Create" />
                                </td>
                            </tr>
                        </table>
                    </div>
                </form>
                <script>
                    $(document).ready(function(){
                        var final_total_amt = $('#final_total_amt').text();
                        var count = 1;
                        
                        $(document).on('click', '#add_row', function(){
                          count++;
                          $('#total_item').val(count);
                          var html_code = '';
                          html_code += '<tr id="row_id_'+count+'">';
                          html_code += '<td><span id="sr_no">'+count+'</span></td>';
                          
                          html_code += '<td><input type="text" name="item_name[]" id="item_name'+count+'" class="form-control input-sm" /></td>';
                          
                          html_code += '<td><input type="text" name="order_item_quantity[]" id="order_item_quantity'+count+'" data-srno="'+count+'" class="form-control input-sm number_only order_item_quantity" /></td>';
                          html_code += '<td><input type="text" name="order_item_price[]" id="order_item_price'+count+'" data-srno="'+count+'" class="form-control input-sm number_only order_item_price" /></td>';
                          html_code += '<td><input type="text" name="order_item_actual_amount[]" id="order_item_actual_amount'+count+'" data-srno="'+count+'" class="form-control input-sm order_item_actual_amount" readonly /></td>';
                          
                          html_code += '<td><input type="text" name="order_item_tax1_rate[]" id="order_item_tax1_rate'+count+'" data-srno="'+count+'" class="form-control input-sm number_only order_item_tax1_rate" /></td>';
                          html_code += '<td><input type="text" name="order_item_tax1_amount[]" id="order_item_tax1_amount'+count+'" data-srno="'+count+'" readonly class="form-control input-sm order_item_tax1_amount" /></td>';
                          html_code += '<td><input type="text" name="order_item_tax2_rate[]" id="order_item_tax2_rate'+count+'" data-srno="'+count+'" class="form-control input-sm number_only order_item_tax2_rate" /></td>';
                          html_code += '<td><input type="text" name="order_item_tax2_amount[]" id="order_item_tax2_amount'+count+'" data-srno="'+count+'" readonly class="form-control input-sm order_item_tax2_amount" /></td>';
                     
                          html_code += '<td><input type="text" name="order_item_final_amount[]" id="order_item_final_amount'+count+'" data-srno="'+count+'" readonly class="form-control input-sm order_item_final_amount" /></td>';
                          html_code += '<td><button type="button" name="remove_row" id="'+count+'" class="btn btn-danger btn-xs remove_row">X</button></td>';
                          html_code += '</tr>';
                          $('#invoice-item-table').append(html_code);
                        });
                        
                        $(document).on('click', '.remove_row', function(){
                          var row_id = $(this).attr("id");
                          var total_item_amount = $('#order_item_final_amount'+row_id).val();
                          var final_amount = $('#final_total_amt').text();
                          var result_amount = parseFloat(final_amount) - parseFloat(total_item_amount);
                          $('#final_total_amt').text(result_amount);
                          $('#row_id_'+row_id).remove();
                          count--;
                          $('#total_item').val(count);
                        });
                
                        function cal_final_total(count)
                        {
                          var final_item_total = 0;
                          for(j=1; j<=count; j++)
                          {
                            var quantity = 0;
                            var price = 0;
                            var actual_amount = 0;
                            var tax1_rate = 0;
                            var tax1_amount = 0;
                            var tax2_rate = 0;
                            var tax2_amount = 0;
                           
                            var item_total = 0;
                            quantity = $('#order_item_quantity'+j).val();
                            if(quantity > 0)
                            {
                             price = $('#order_item_price'+j).val();
                              if(price > 0)
                              {
                                actual_amount = parseFloat(quantity) * parseFloat(price);
                                $('#order_item_actual_amount'+j).val(actual_amount);
                                
                
                               tax1_rate = $('#order_item_tax1_rate'+j).val();
                                if(tax1_rate > 0)
                                {
                                  tax1_amount = parseFloat(actual_amount)-parseFloat(tax1_rate);
                                  $('#order_item_tax1_amount'+j).val(tax1_amount);
                                }
                                item_total = parseFloat(actual_amount) + parseFloat(tax1_amount) + parseFloat(tax2_amount);
                                final_item_total = parseFloat(final_item_total) + parseFloat(item_total);
                                $('#order_item_final_amount'+j).val(item_total);
                              }
                            }
                          }
                          $('#final_total_amt').text(final_item_total);
                        }
                
                        $(document).on('blur', '.order_item_price', function(){
                          cal_final_total(count);
                        });
                
                        $(document).on('blur', '.order_item_tax1_rate', function(){
                          cal_final_total(count);
                        });
                
                        $(document).on('blur', '.order_item_tax2_rate', function(){
                          cal_final_total(count);
                        });
                
                        
                
                        $('#create_invoice').click(function(){
                          if($.trim($('#order_receiver_name').val()).length == 0)
                          {
                            alert("Please Enter Reciever Name");
                            return false;
                          }
                
                          if($.trim($('#order_no').val()).length == 0)
                          {
                            alert("Please Enter Invoice Number");
                            return false;
                          }
                
                          if($.trim($('#order_date').val()).length == 0)
                          {
                            alert("Please Select Invoice Date");
                            return false;
                          }
                
                          for(var no=1; no<=count; no++)
                          {
                            if($.trim($('#item_name'+no).val()).length == 0)
                            {
                              alert("Please Enter Item Name");
                              $('#item_name'+no).focus();
                              return false;
                            }
                
                            if($.trim($('#order_item_quantity'+no).val()).length == 0)
                            {
                              alert("Please Enter Quantity");
                              $('#order_item_quantity'+no).focus();
                              return false;
                            }
                
                            if($.trim($('#order_item_price'+no).val()).length == 0)
                            {
                              alert("Please Enter Price");
                              $('#order_item_price'+no).focus();
                              return false;
                            }
                
                          }
                
                          $('#invoice_form').submit();
                
                        });
                
                      });
                </script>
                <?php
      }
      elseif(isset($_GET["update"]) && isset($_GET["id"]))
      {
        $statement = $connect->prepare("
          SELECT * FROM tbl_order 
            WHERE order_id = :order_id
            LIMIT 1
        ");
        $statement->execute(
          array(
            ':order_id'       =>  $_GET["id"]
            )
          );
        $result = $statement->fetchAll();
        foreach($result as $row)
        {
        ?>
                    <script>
                        $(document).ready(function(){
                          $('#order_no').val("<?php echo $row["order_no"]; ?>");
                          $('#order_date').val("<?php echo $row["order_date"]; ?>");
                          $('#order_receiver_name').val("<?php echo $row["order_receiver_name"]; ?>");
                          $('#order_receiver_address').val("<?php echo $row["order_receiver_address"]; ?>");
                        });
                    </script>
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
                            <a href="invoice.php"><i class="far fa-file-alt"></i> Invoice
                        </a>
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
                    <form method="post" id="invoice_form" style="width: 85%; margin: 5% 0 5% 15%">
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <tr>
                                    <td colspan="2" align="center">
                                        <h2 style="margin-top:10.5px">Edit Invoice</h2>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="2">
                                        <div class="row">
                                            <div class="col-md-8">
                                                To,<br />
                                                <b>CUSTOMER BILL</b><br />
                                                <input type="text" name="order_receiver_name" id="order_receiver_name" class="form-control input-sm" placeholder="Enter Receiver Name" />
                                                <textarea name="order_receiver_address" id="order_receiver_address" class="form-control" placeholder="Enter Billing Address"></textarea>
                                            </div>
                                            <div class="col-md-4"><br>
                                                <strong>#INVOICE NUMBER</strong><br />
                                                <input type="text" name="order_no" id="order_no" class="form-control input-sm" placeholder="Enter Invoice No." />
                                                <input type="text" name="order_date" id="order_date" class="form-control input-sm" readonly placeholder="Select Invoice Date" />
                                            </div>
                                        </div>
                                        <br />
                                        <table id="invoice-item-table" class="table table-bordered">
                                            <tr>
                                                <th width="7%">Sr No.</th>
                                                <th width="20%">Item Name</th>
                                                <th width="5%">Quantity</th>
                                                <th width="5%">Price</th>
                                                <th width="10%">Actual Price</th>
                                                <th width="12.5%" colspan="2">Price details</th>
                                                <th width="12.5%" colspan="2">Tax (%)</th>

                                                <th width="12.5%" rowspan="2">Total</th>
                                                <th width="3%" rowspan="2"></th>
                                            </tr>
                                            <tr>
                                                <th></th>
                                                <th></th>
                                                <th></th>
                                                <th></th>
                                                <th></th>
                                                <th>Paid</th>
                                                <th>Due</th>
                                                <th>Rate</th>
                                                <th>Amt.</th>

                                            </tr>
                                            <?php
                    $statement = $connect->prepare("
                      SELECT * FROM tbl_order_item 
                      WHERE order_id = :order_id
                    ");
                    $statement->execute(
                      array(
                        ':order_id'       =>  $_GET["id"]
                      )
                    );
                    $item_result = $statement->fetchAll();
                    $m = 0;
                    foreach($item_result as $sub_row)
                    {
                      $m = $m + 1;
                    ?>
                                                <tr>
                                                    <td><span id="sr_no"><?php echo $m; ?></span></td>
                                                    <td><input type="text" name="item_name[]" id="item_name<?php echo $m; ?>" class="form-control input-sm" value="<?php echo $sub_row[" item_name "]; ?>" /></td>
                                                    <td><input type="text" name="order_item_quantity[]" id="order_item_quantity<?php echo $m; ?>" data-srno="<?php echo $m; ?>" class="form-control input-sm order_item_quantity" value="{{{PHP14}}}" /></td>
                                                    <td><input type="text" name="order_item_price[]" id="order_item_price<?php echo $m; ?>" data-srno="<?php echo $m; ?>" class="form-control input-sm number_only order_item_price" value="<?php echo $sub_row["
                                                            order_item_price "]; ?>" /></td>
                                                    <td><input type="text" name="order_item_actual_amount[]" id="order_item_actual_amount<?php echo $m; ?>" data-srno="<?php echo $m; ?>" class="form-control input-sm order_item_actual_amount" value="<?php echo $sub_row["
                                                            order_item_actual_amount "];?>" readonly /></td>
                                                    <td><input type="text" name="order_item_tax1_rate[]" id="order_item_tax1_rate<?php echo $m; ?>" data-srno="<?php echo $m; ?>" class="form-control input-sm number_only order_item_tax1_rate" value="<?php echo $sub_row["
                                                            order_item_tax1_rate "]; ?>" /></td>
                                                    <td><input type="text" name="order_item_tax1_amount[]" id="order_item_tax1_amount<?php echo $m; ?>" data-srno="<?php echo $m; ?>" readonly class="form-control input-sm order_item_tax1_amount" value="<?php echo $sub_row["
                                                            order_item_tax1_amount "];?>" /></td>
                                                    <td><input type="text" name="order_item_tax2_rate[]" id="order_item_tax2_rate<?php echo $m; ?>" data-srno="<?php echo $m; ?>" class="form-control input-sm number_only order_item_tax2_rate" value="<?php echo $sub_row["
                                                            order_item_tax2_rate "];?>" /></td>
                                                    <td><input type="text" name="order_item_tax2_amount[]" id="order_item_tax2_amount<?php echo $m; ?>" data-srno="<?php echo $m; ?>" readonly class="form-control input-sm order_item_tax2_amount" value="<?php echo $sub_row["
                                                            order_item_tax2_amount "]; ?>" /></td>

                                                    <td><input type="text" name="order_item_final_amount[]" id="order_item_final_amount<?php echo $m; ?>" data-srno="<?php echo $m; ?>" readonly class="form-control input-sm order_item_final_amount" value="<?php echo $sub_row["
                                                            order_item_final_amount "]; ?>" /></td>
                                                    <td></td>
                                                </tr>
                                                <?php
                    }
                    ?>
                                        </table>
                                    </td>
                                </tr>
                                <tr>
                                    <td align="right"><b>Total</td>
                <td align="right"><b><span id="final_total_amt"><?php echo $row["order_total_after_tax"]; ?></span></b></td>
                                </tr>
                                <tr>
                                    <td colspan="2"></td>
                                </tr>
                                <tr>
                                    <td colspan="2" align="center">
                                        <input type="hidden" name="total_item" id="total_item" value="<?php echo $m; ?>" />
                                        <input type="hidden" name="order_id" id="order_id" value="<?php echo $row[" order_id "]; ?>" />
                                        <input type="submit" name="update_invoice" id="create_invoice" class="btn btn-dark" value="Edit" />
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </form>
                    <script>
                        $(document).ready(function(){
                            var final_total_amt = $('#final_total_amt').text();
                            var count = "<?php echo $m; ?>";
                            
                            $(document).on('click', '#add_row', function(){
                              count++;
                              $('#total_item').val(count);
                              var html_code = '';
                              html_code += '<tr id="row_id_'+count+'">';
                              html_code += '<td><span id="sr_no">'+count+'</span></td>';
                              
                              html_code += '<td><input type="text" name="item_name[]" id="item_name'+count+'" class="form-control input-sm" /></td>';
                              
                              html_code += '<td><input type="text" name="order_item_quantity[]" id="order_item_quantity'+count+'" data-srno="'+count+'" class="form-control input-sm number_only order_item_quantity" /></td>';
                              html_code += '<td><input type="text" name="order_item_price[]" id="order_item_price'+count+'" data-srno="'+count+'" class="form-control input-sm number_only order_item_price" /></td>';
                              html_code += '<td><input type="text" name="order_item_actual_amount[]" id="order_item_actual_amount'+count+'" data-srno="'+count+'" class="form-control input-sm order_item_actual_amount" readonly /></td>';
                              
                              html_code += '<td><input type="text" name="order_item_tax1_rate[]" id="order_item_tax1_rate'+count+'" data-srno="'+count+'" class="form-control input-sm number_only order_item_tax1_rate" /></td>';
                              html_code += '<td><input type="text" name="order_item_tax1_amount[]" id="order_item_tax1_amount'+count+'" data-srno="'+count+'" readonly class="form-control input-sm order_item_tax1_amount" /></td>';
                              html_code += '<td><input type="text" name="order_item_tax2_rate[]" id="order_item_tax2_rate'+count+'" data-srno="'+count+'" class="form-control input-sm number_only order_item_tax2_rate" /></td>';
                              html_code += '<td><input type="text" name="order_item_tax2_amount[]" id="order_item_tax2_amount'+count+'" data-srno="'+count+'" readonly class="form-control input-sm order_item_tax2_amount" /></td>';
                            
                              html_code += '<td><input type="text" name="order_item_final_amount[]" id="order_item_final_amount'+count+'" data-srno="'+count+'" readonly class="form-control input-sm order_item_final_amount" /></td>';
                              html_code += '<td><button type="button" name="remove_row" id="'+count+'" class="btn btn-danger btn-xs remove_row">X</button></td>';
                              html_code += '</tr>';
                              $('#invoice-item-table').append(html_code);
                            });
                            
                            $(document).on('click', '.remove_row', function(){
                              var row_id = $(this).attr("id");
                              var total_item_amount = $('#order_item_final_amount'+row_id).val();
                              var final_amount = $('#final_total_amt').text();
                              var result_amount = parseFloat(final_amount) - parseFloat(total_item_amount);
                              $('#final_total_amt').text(result_amount);
                              $('#row_id_'+row_id).remove();
                              count--;
                              $('#total_item').val(count);
                            });
                    
                            function cal_final_total(count)
                            {
                              var final_item_total = 0;
                              for(j=1; j<=count; j++)
                              {
                                var quantity = 0;
                                var price = 0;
                                var actual_amount = 0;
                                var tax1_rate = 0;
                                var tax1_amount = 0;
                                var tax2_rate = 0;
                                var tax2_amount = 0;
                                var tax3_rate = 0;
                                var tax3_amount = 0;
                                var item_total = 0;
                                quantity = $('#order_item_quantity'+j).val();
                                if(quantity > 0)
                                {
                                  price = $('#order_item_price'+j).val();
                                  if(price > 0)
                                  {
                                    actual_amount = parseFloat(quantity) * parseFloat(price);
                                    $('#order_item_actual_amount'+j).val(actual_amount);
                                    tax1_rate = $('#order_item_tax1_rate'+j).val();
                                    if(tax1_rate > 0)
                                    {
                                      tax1_amount = parseFloat(actual_amount)*parseFloat(tax1_rate)/100;
                                      $('#order_item_tax1_amount'+j).val(tax1_amount);
                                    }
                                    tax2_rate = $('#order_item_tax2_rate'+j).val();
                                    if(tax2_rate > 0)
                                    {
                                      tax2_amount = parseFloat(actual_amount)*parseFloat(tax2_rate)/100;
                                      $('#order_item_tax2_amount'+j).val(tax2_amount);
                                    }
                                   
                                    item_total = parseFloat(actual_amount) + parseFloat(tax1_amount) + parseFloat(tax2_amount);
                                    final_item_total = parseFloat(final_item_total) + parseFloat(item_total);
                                    $('#order_item_final_amount'+j).val(item_total);
                                  }
                                }
                              }
                              $('#final_total_amt').text(final_item_total);
                            }
                    
                            $(document).on('blur', '.order_item_price', function(){
                              cal_final_total(count);
                            });
                    
                            $(document).on('blur', '.order_item_tax1_rate', function(){
                              cal_final_total(count);
                            });
                    
                            $(document).on('blur', '.order_item_tax2_rate', function(){
                              cal_final_total(count);
                            });
                    
                            
                    
                            $('#create_invoice').click(function(){
                              if($.trim($('#order_receiver_name').val()).length == 0)
                              {
                                alert("Please Enter Reciever Name");
                                return false;
                              }
                    
                              if($.trim($('#order_no').val()).length == 0)
                              {
                                alert("Please Enter Invoice Number");
                                return false;
                              }
                    
                              if($.trim($('#order_date').val()).length == 0)
                              {
                                alert("Please Select Invoice Date");
                                return false;
                              }
                    
                              for(var no=1; no<=count; no++)
                              {
                                if($.trim($('#item_name'+no).val()).length == 0)
                                {
                                  alert("Please Enter Item Name");
                                  $('#item_name'+no).focus();
                                  return false;
                                }
                    
                                if($.trim($('#order_item_quantity'+no).val()).length == 0)
                                {
                                  alert("Please Enter Quantity");
                                  $('#order_item_quantity'+no).focus();
                                  return false;
                                }
                    
                                if($.trim($('#order_item_price'+no).val()).length == 0)
                                {
                                  alert("Please Enter Price");
                                  $('#order_item_price'+no).focus();
                                  return false;
                                }
                    
                              }
                    
                              $('#invoice_form').submit();
                    
                            });
                    
                          });
                    </script>
                    <?php 
        }
      }
      else
      {
      ?>
                    <br />
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
                    <div align="right" style="margin-top: 50px;">
                        <a href="invoice.php?add=1" class="btn btn-dark">Create</a>
                    </div>
                    <br />
                    <table id="data-table" class="table table-striped" style="width: 85%; margin: 0 0 5% 15%;">
                        <thead class="table-dark">
                            <tr>
                                <th>Invoice No.</th>
                                <th>Invoice Date</th>
                                <th>Receiver Name</th>
                                <th>Invoice Total</th>
                                <th>PDF</th>
                                <th>Edit</th>
                                <th>Delete</th>
                            </tr>
                        </thead>
                        <?php
        if($total_rows > 0)
        {
          foreach($all_result as $row)
          {
            echo '
              <tr>
                <td>'.$row["order_no"].'</td>
                <td>'.$row["order_date"].'</td>
                <td>'.$row["order_receiver_name"].'</td>
                <td>'.$row["order_total_after_tax"].'</td>
                <td><a href="print_invoice.php?pdf=1&id='.$row["order_id"].'"><i class="far fa-file-pdf" style="color: black"></i></a></td>
                <td><a href="invoice.php?update=1&id='.$row["order_id"].'"><i class="far fa-edit" style="color: black"></i></a></td>
                <td><a href="#" id="'.$row["order_id"].'" class="delete"><i class="far fa-trash-alt" style="color: black"></i></a></td>
              </tr>
            ';
          }
        }
        ?>
                    </table>
                    <?php
      }
      ?>
        </div>
    </body>

    </html>
    <script type="text/javascript">
        $(document).ready(function(){
            var table = $('#data-table').DataTable({
                  "order":[],
                  "columnDefs":[
                  {
                    "targets":[4, 5, 6],
                    "orderable":false,
                  },
                ],
                "pageLength": 25
                });
            $(document).on('click', '.delete', function(){
              var id = $(this).attr("id");
              if(confirm("Are you sure you want to remove this?"))
              {
                window.location.href="invoice.php?delete=1&id="+id;
              }
              else
              {
                return false;
              }
            });
          });
    </script>

    <script>
        $(document).ready(function(){
        $('.number_only').keypress(function(e){
        return isNumbers(e, this);      
        });
        function isNumbers(evt, element) 
        {
        var charCode = (evt.which) ? evt.which : event.keyCode;
        if (
        (charCode != 46 || $(element).val().indexOf('.') != -1) &&      // “.” CHECK DOT, AND ONLY ONE.
        (charCode < 48 || charCode > 57))
        return false;
        return true;
        }
        });
        
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