<?php include 'include/connection.php'; ?>
<?php

  $output = '';
  $initial_number = NULL;

  if (isset($_POST['export_excel'])) {
      
      $select = "SELECT * FROM case_history ORDER BY id DESC";

      $result = mysqli_query($db,$select);
      if (mysqli_num_rows($result) > 0) {

         $output .= '
          <table border="1" cellspacing="0" cellpadding="3">
              <tr>
                  <th>#</th>
                  <th>Client</th>
                  <th>Case No</th>
                  <th>Case subject</th>
                  <th>Category</th>
                  <th>File No</th>
                  <th>Lead Counsel</th>
                  <th>Institution</th>
                  <th>Opened Date</th>
                  <th>Closed Date</th>
                  <th>Time Spent</th>
              </tr>
         ';

         $initial = 1;

         while ($row = mysqli_fetch_array($result)) {

                $id         = $row['id'];
                $case_no       = $row['case_no'];
                $case_subject   = $row['case_subject'];
                $file_number   = $row['file_number'];
                $urega      = $row['urega'];
                $category      = $row['category'];
                $open_date      = $row['open_date'];
                $closed_date      = $row['closed_date'];
                $leader      = $row['leader'];
                $institution     = $row['institution'];

                $initial = 1;
                $initial_number ++;

                $date_one = date_create("$open_date");
                $date_two = date_create("$closed_date");
                $diff = date_diff($date_one,$date_two);

             
             $output .= '
                  <tr>
                      <td>'.$initial_number.'</td>
                      <td>'.$urega.'</td>
                      <td>'.$case_no.'</td>
                      <td>'.$case_subject.'</td>
                      <td>'.$category.'</td>
                      <td>'.$file_number.'</td>
                      <td>'.$leader.'</td>
                      <td>'.$institution.'</td>
                      <td>'.$open_date.'</td>
                      <td>'.$closed_date.'</td>
                      <td>'.$diff->format("%a days").'</td>
                  </tr>
             ';
         }

         $output .='</table>';
          header("Content-Type: application/xls");
          header("Content-Disposition: attachment; filename=closed_cases_report.xls");   
        
         echo $output;
          
      }
  }
?>