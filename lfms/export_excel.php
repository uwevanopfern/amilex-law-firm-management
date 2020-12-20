<?php include 'include/connection.php'; ?>
<?php

  $output = '';
  $initial_number = NULL;

  if (isset($_POST['export_excel'])) {
      
      $select_case_excel = "SELECT * FROM case_infos ORDER BY id DESC";

      $result_by_excel = mysqli_query($db,$select_case_excel);
      if (mysqli_num_rows($result_by_excel) > 0) {

         $output .= '
          <table border="1" cellspacing="0" cellpadding="3">
              <tr>
                  <th>#</th>
                  <th>CASE NUMBER</th>
                  <th>FILE NUMBER</th>
                  <th>INSTITUTION</th>
                  <th>CLIENT</th>
                  <th>CATEGORY</th>
                  <th>CASE DATE</th>
                  <th>CASE STATUS</th>
                  <th>LEAD COUNSEL</th>
              </tr>
         ';

         $initial = 1;

         while ($row_by_excel = mysqli_fetch_array($result_by_excel)) {

                $case_no = $row_by_excel['case_no'];
                $urega = $row_by_excel['urega'];
                $file_number = $row_by_excel['file_number'];
                $institution = $row_by_excel['instutition'];
                $category = $row_by_excel['category'];
                $case_date = $row_by_excel['case_date'];
                $status = $row_by_excel['status'];
                $leader = $row_by_excel['leader'];

                $initial = 1;
                $initial_number ++;

                $select_name = "SELECT * FROM status WHERE id = '".$status."'";
                $result_by_name = mysqli_query($db,$select_name);

                 while ($row_by_name = mysqli_fetch_array($result_by_name)) {

                  $status_name = $row_by_name['name'];
                }
             
             $output .= '
                  <tr>
                      <td>'.$initial_number.'</td>
                      <td>'.$case_no.'</td>
                      <td>'.$file_number.'</td>
                      <td>'.$institution.'</td>
                      <td>'.$urega.'</td>
                      <td>'.$category.'</td>
                      <td>'.$case_date.'</td>
                      <td>'.$status_name.'</td>
                      <td>'.$leader.'</td>
                  </tr>
             ';
         }

         $output .='</table>';
          header("Content-Type: application/xls");
          header("Content-Disposition: attachment; filename=case_report.xls");   
        
         echo $output;
          
      }
  }
?>