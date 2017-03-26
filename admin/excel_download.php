<?php
include '../include/connectdb.php';

  $name_csv = "Orders_".strtotime("now").".csv";
  header('Content-type: application/csv; charset=UTF-8');
  header('Content-Disposition: attachment; filename='.$name_csv);
  $fp = fopen("php://output","w");
  $stack = array();

  if(isset($_GET['orders']) && $_GET['orders'] == 'print'){
    $header_array = array("TXN : number","Customer","Status","Date Purchased","Payment");
    $stack = content_array("Transactions","Order List",$header_array);
    $sql = mysql_query("SELECT * FROM transactions ORDER BY id DESC");
    $productCount = mysql_num_rows($sql); // count the output amount
    if ($productCount > 0) {
    while($row = mysql_fetch_array($sql)){ 
      $txn_id = $row["txn_id"];
      $firstname = $row["first_name"];
      $lastname = $row["last_name"];
      $datepayment = strftime("%b %d, %Y", strtotime($row["payment_date"]));
      $stat= $row["payment_status"];
      $gross = $row["mc_gross"];
      array_push($stack,
            array($txn_id, $firstname.' '. $lastname, $stat, $datepayment, $gross)
            );
      }
    }
  }elseif(isset($_GET['sales_rep']) && $_GET['sales_rep'] == 'print'){
    $header_array = array("Date","Customer name","Email","Amount PAID");
    $stack = content_array("SALES REPORT","",$header_array);

    $sql = mysql_query("SELECT * FROM transactions ORDER BY id DESC");
    $productCount = mysql_num_rows($sql); // count the output amount
    if ($productCount > 0) {
    while($row = mysql_fetch_array($sql)){ 
      $firstname = $row['first_name'];
      $lastname = $row['last_name'];
      $day = $row['day'];
      $month = $row['month'];
      $year = $row['year'];
      $payer_email = $row['payer_email'];
      $mc_gross = $row['mc_gross'];
      array_push($stack,
            array($month.'/'.$day.'/'.$year, $firstname.' '. $lastname, $payer_email, $mc_gross)
            );
      }
    }
  }elseif(isset($_GET['users_rep']) && $_GET['users_rep'] == 'print'){
    $header_array = array("Customer","email","birthday","contact","Status");
    $stack = content_array("USERS REPORT","",$header_array);
    $sql = mysql_query("SELECT * FROM users ORDER BY id DESC");
    $productCount = mysql_num_rows($sql); // count the output amount
    if ($productCount > 0) {
      while($row = mysql_fetch_array($sql)){ 
        $fname =  $row["fname"];
        $lname= $row["lname"];
        $birthday = $row["birthday"];
        $email= $row["email"];
        $contact = $row["contact"];
        $activate=  $row["activate"];
        if ($activate == 1){
          $status = 'Confirmed';
        }else{
          $status = 'Unconfirm'; 
        }
        array_push($stack,
            array($fname.' '. $lname, $email, $birthday, $contact, $status)
            );
      }
    }
  }

  foreach ($stack as $field) {
    fputcsv($fp, $field);
  }

  function content_array($title, $header, $tableheader){
    $stack = array(
      array($title),
      array($header),
      $tableheader
    );
    return $stack;
  }


?>