<?php
//print_invoice.php
if(isset($_GET["pdf"]) && isset($_GET["id"]))
{
 require_once 'pdf.php';
 include('database_connection.php');
 $output = '';
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
  $output .= '
   <table width="100%" border="1" cellpadding="5" cellspacing="0">
    <tr>
     <td colspan="2" align="center" style="font-size:18px"><b>Tailorart Invoice</b></td>
    </tr>
    <tr>
     <td colspan="2">
      <table width="100%" cellpadding="5">
       <tr>
        <td width="35%">
         To,<br />
         <b>CUSTOMER BILL</b><br />
         Name : '.$row["order_receiver_name"].'<br /> 
         Billing Address : '.$row["order_receiver_address"].'<br />
        </td>
        <td width="35%">
         CUSTOMER INFORMATION<br />
         CUSTOMER ID: '.$row["order_no"].'<br />
         Delivery Date : '.$row["order_date"].'<br />
        </td>
       </tr>
      </table>
      <br />
      <table width="100%" border="1" cellpadding="5" cellspacing="0">
       <tr>
        <th>Sr No.</th>
        <th>Item Name</th>
        <th>Quantity</th>
        <th>Price</th>
        <th>Total Price</th>
        <th colspan="2">Price details</th>
        <th colspan="2">Tax(%)</th>
        <th rowspan="2">Total</th>
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

       </tr>';
  $statement = $connect->prepare(
   "SELECT * FROM tbl_order_item 
   WHERE order_id = :order_id"
  );
  $statement->execute(
   array(
    ':order_id'       =>  $_GET["id"]
   )
  );
  $item_result = $statement->fetchAll();
  $count = 0;
  foreach($item_result as $sub_row)
  {
   $count++;
   $output .= '
   <tr>
    <td>'.$count.'</td>
    <td>'.$sub_row["item_name"].'</td>
    <td>'.$sub_row["order_item_quantity"].'</td>
    <td>'.$sub_row["order_item_price"].'</td>
    <td>'.$sub_row["order_item_actual_amount"].'</td>
    <td>'.$sub_row["order_item_tax1_rate"].'</td>
    <td>'.$sub_row["order_item_tax1_amount"].'</td>
    <td>'.$sub_row["order_item_tax2_rate"].'</td>
    <td>'.$sub_row["order_item_tax2_amount"].'</td>
    <td>'.$sub_row["order_item_final_amount"].'</td>
   </tr>
   ';
  }
  $output .= '
  <tr>
   <td align="right" colspan="11"><b>Total</b></td>
   <td align="right"><b>'.$row["order_total_after_tax"].'</b></td>
  </tr>
  <tr>
   <td colspan="11"><b>Total Price :</b></td>
   <td align="right">'.$row["order_total_before_tax"].'</td>
  </tr>
  <tr>
   <td colspan="11">Due :</td>
   <td align="right">'.$row["order_total_tax1"].'</td>
  </tr>
  <tr>
   <td colspan="11">Add : Tax2 :</td>
   <td align="right">'.$row["order_total_tax2"].'</td>
  </tr>
  
  <tr>
   <td colspan="11"><b> Total :</b></td>
   <td align="right">'.$row["order_total_after_tax"].'</td>
  </tr>
  
  ';
  $output .= '
      </table>
     </td>
    </tr>
   </table>
  ';
 }
 $pdf = new Pdf();
 $file_name = 'Invoice-'.$row["order_no"].'.pdf';
 $pdf->loadHtml($output);
 $pdf->render();
 $pdf->stream($file_name, array("Attachment" => false));
}
?>