<?php
include '../include/connectdb.php';
  $stack = array();

  if(isset($_GET['orders']) && $_GET['orders'] == 'print'){
    $name_csv = "Orders_".strtotime("now").".csv";
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
    $name_csv = "Sales_".strtotime("now").".csv";
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
    $name_csv = "Users_".strtotime("now").".csv";
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
  }elseif(isset($_GET['inventory']) && $_GET['inventory'] == 'print'){
    $name_csv = "Inventory_".strtotime("now").".csv";
    $header_array = array("Product name","Sold","Stock Now","Stock Before","Status");
    $stack = content_array("INVENTORY REPORT","",$header_array);
    $sql = mysql_query("SELECT products.*, critical_level.product_id, critical_level.crit_level FROM products INNER JOIN critical_level ON products.id=critical_level.product_id ORDER BY product_name ASC");
    $productCount = mysql_num_rows($sql); // count the output amount
    $count = 0;

    $productid = "";
    $critLevel = "";

    if ($productCount > 0) {
      while($row = mysql_fetch_array($sql)){ 
        $id = $row['id'];
        $pname = $row["product_name"];

        $productid = $row['product_id'];
        $critLevel = $row['crit_level'];

        $stock_query = mysql_query("SELECT qty_added as stock, SUM(qty_added) as sold FROM product_history WHERE pid = $id ORDER BY Date asc limit 1");
        $stock_query_count = mysql_num_rows($stock_query); // count the output amount
        $previous_stock='empty';
        $lessted_value='empty';
        if ($stock_query_count > 0) {
        // output data of each row
          while($stock_row = mysql_fetch_array($stock_query)) {
            if(!empty($stock_row['stock'])){
              $previous_stock = $stock_row['stock'];
            }
            if(!empty($stock_row['sold'])){
              $lessted_value = $stock_row['sold'];
            }
          }
        } 
        $current_stock = $row["stock"];
        if($current_stock <= $critLevel){
         $status = 'Critical';
        }else if($current_stock == 0){
          $status = '0 Stock';
        }else{
          $status = 'Sufficient';
        }
        array_push($stack,
            array($pname, $lessted_value, $current_stock, $previous_stock, $status)
            );
      }
    }
  }elseif(isset($_GET['prod_rep']) && $_GET['prod_rep'] == 'print'){
    $name_csv = "Product_report_".strtotime("now").".csv";
    $header_array = array("Image","Product name","Price","Stock","Status");
    $stack = content_array("PRODUCT REPORT","",$header_array);
    $sql = mysql_query("SELECT * FROM products ORDER BY id DESC limit 5");
    $productCount = mysql_num_rows($sql); // count the output amount
    $count = 0;

    $productid = "";
    $critLevel = "";

    if ($productCount > 0) {
      while($row = mysql_fetch_array($sql)){ 
        $id = $row["id"];
        $prod_title = $row["product_name"];
        $price = $row["price"];
        $prod_desc  = $row["details"];
        $ext  = $row["ext"];
        $stock=$row['stock'];
        $category = $row["category"];
        $sub_category = $row["sub_category"];
        $display = $row["status"];

        if($stock <=10 && $stock > 0){
          $s_status = 'Critical';
        }else if($stock == 0){
          $s_status = '0 Stock';
        }else{
          $s_status= 'Sufficient';
        }
        array_push($stack,
            array($id.'.'.$ext, $prod_title, $stock, $display, $s_status)
            );
      }
    }
  }
  header('Content-type: application/csv; charset=UTF-8');
  header('Content-Disposition: attachment; filename='.$name_csv);
  $fp = fopen("php://output","w");

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