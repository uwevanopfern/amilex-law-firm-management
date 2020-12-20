<?php include 'include/connection.php'; ?>
<?php

  $output = '';
  $initial_number = NULL;

  if (isset($_POST['export_excel'])) {
      
      $select = "SELECT * FROM cashflow ORDER BY id DESC";

      $result = mysqli_query($db,$select);
      if (mysqli_num_rows($result) > 0) {

         $output .= '
          <table border="1" cellspacing="0" cellpadding="3">
              <tr>
                  <th>#</th>
                  <th>DATE</th>
                  <th>PAID BY</th>
                  <th>PAID TO</th>
                  <th>TRANSACTION</th>
                  <th>REFERENCE</th>
                  <th>CREDITED RWF</th>
                  <th>DEBITED RWF</th>
                  <th>CREDITED USD</th>
                  <th>DEBITED USD</th>
              </tr>
         ';

         $initial = 1;

         while ($row = mysqli_fetch_array($result)) {

                $paid_by_date       = $row['paid_by'];
                $paid_to_date   = $row['paid_to'];
                $transaction_date   = $row['transaction'];
                $date_date      = $row['date'];
                $reference_date     = $row['reference'];
                $credited_rwf_date    = $row['credited_rwf'];
                $debited_rwf_date       = $row['debited_rwf'];
                $credited_usd_date       = $row['credited_usd'];
                $debited_usd_date      = $row['debited_usd'];

                $initial = 1;
                $initial_number ++;

             
             $output .= '
                  <tr>
                      <td>'.$initial_number.'</td>
                      <td>'.$date_date.'</td>
                      <td>'.$paid_by_date.'</td>
                      <td>'.$paid_to_date.'</td>
                      <td>'.$transaction_date.'</td>
                      <td>'.$reference_date.'</td>
                      <td>'.$credited_rwf_date.'</td>
                      <td>'.$debited_rwf_date.'</td>
                      <td>'.$credited_usd_date.'</td>
                      <td>'.$debited_usd_date.'</td>
                  </tr>
             ';
         }

         $output .='</table>';
          header("Content-Type: application/xls");
          header("Content-Disposition: attachment; filename=cashflow_report.xls");   
        
         echo $output;
          
      }
  }
?>