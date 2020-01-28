<!DOCTYPE html>
<html>
<head>
<style>
table, th, td {
    border: 1px solid black;
    border-collapse: collapse;
}
th, td {
    padding: 5px;
    text-align: left;
}
</style>
</head>
<body>


<h2>Vertical Headings:</h2>

<table style="width:100%">
  <tr>
    <th>ID:</th>
    <?php   echo '<tr>  
       <td>'.$row['id'].'</td>
       ?>
  </tr>
  <tr>
    <th>Telephone:</th>
    <td>555 77 854</td>
  </tr>
  <tr>
    <th>Telephone:</th>
    <td>555 77 855</td>
  </tr>
</table>

</body>
</html>


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
                            <td>'.$row['a1'].'</td>
                            <td>'.$row['a2'].'</td>
                            <td>'.$row['a3'].'</td>
                            <td>'.$row['a4'].'</td>
                            <td>'.$row['a5'].'</td>
                            <td>'.$row['a6'].'</td>
                            <td>'.$row['a7'].'</td>
                            <td>'.$row['a8'].'</td>
                            <td>'.$row['a9'].'</td>
                            <td>'.$row['a10'].'</td>
                            <td>'.$row['a11'].'</td>
                            </tr>'; 
                          }
                        }else{}
                        }else{     
                      }
                        
                      
                    ?>

