<?php 

  if (loggedin())
      {
        $query = mysql_query("SELECT * FROM admin WHERE username ='$_SESSION[manager]' ");
          while ($row = mysql_fetch_assoc($query))
          {
            $userid = $row ['id'];
            $username = $row ['username'];
            $type = @$row['type'];
          
          }
        
        }
      else
      { 
      //header("Location:login.php");
    //  exit();
      }


  if ($type == 'admin') {

?>

<!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="index.php"><img src="../img/logo.png" /></a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse navbar-ex1-collapse">
          <ul class="nav navbar-nav side-nav">
            <li class="active"><a href="index.php"><i class="fa fa-dashboard"></i> DASHBOARD</a></li>
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-caret-square-o-down"></i>PRODUCTS<b class="caret"></b></a>
              <ul class="dropdown-menu">
                <li><a href="list.php">Listing</a></li>
                <li><a href="add.php">Add Products</a></li>
                <li><a href="update.php">Update Products</a></li>
              </ul>
            </li>
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-caret-square-o-down"></i>ACCOUNTING<b class="caret"></b></a>
              <ul class="dropdown-menu">
                <li><a href="../admin/sales.php">Sales and Income</a></li>
                <li><a href="../admin/expenses.php">Expenses</a></li>
                <li><a href="../admin/financialstatement.php">Financial Statement</a></li>
              </ul>
            </li>
           <li class="dropdown">
              <a href="orders.php" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-caret-square-o-down"></i>ORDERS<b class="caret"></b></a>
              <ul class="dropdown-menu">
               <li><a href="orders.php">Order List</a></li>
                   <li><a href="orders.php?status=Pending">Pending</a></li>
                  <li><a href="orders.php?status=Completed">Completed</a></li>                      
                  <li><a href="orders.php?status=Shipped">Shipping</a></li>
                    <li><a href="orders.php?status=Cancelled">Cancelled</a></li>
                    <li><a href="orders.php?status=Returned">Returned</a></li>
              </ul>
            </li>
             <li><a href="cancel.php"><i class="fa fa-edit"></i>REQUEST CANCEL ORDER</a></li>
            <li><a href="reports.php"><i class="fa fa-edit"></i> REPORTS</a></li>
            <li><a href="inventory.php"><i class="fa fa-font"></i>INVENTORY</a></li>
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-caret-square-o-down"></i>BID MONITORING<b class="caret"></b></a>
              <ul class="dropdown-menu">
                <li><a href="contracttemplate.php">Contract Template</a></li>
                <li><a href="supplierbidlist.php">Supplier Bid</a></li>
                <li><a href="authorbidlist.php">Author Bid</a></li>
              </ul>
            </li>
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-caret-square-o-down"></i>SUPPLIER<b class="caret"></b></a>
              <ul class="dropdown-menu">
                <li><a href="supplierlist.php">List</a></li>
                <li><a href="supplies.php">Supplies</a></li>
                <li><a href="suppliercontracts.php">Contract Monitoring</a></li>
              </ul>
            </li>
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-caret-square-o-down"></i>AUTHOR<b class="caret"></b></a>
              <ul class="dropdown-menu">
                <li><a href="supplierlist.php">List</a></li>
                <li><a href="authorcontracts.php">Contract Monitoring</a></li>
              </ul>
            </li>
            <li><a href="messaging.php"><i class="fa fa-font"></i>MESSAGE</a></li>
            <li><a href="backup.php"><i class="fa fa-font"></i>BACKUP DB (In progress)</a></li>
            
          </ul>

<?php
    # code...
  } else {


?>


  <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="index.php"><img src="../img/logo.png" /></a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse navbar-ex1-collapse">
          <ul class="nav navbar-nav side-nav">
            <li class="dropdown">
              <a href="#" class="active dropdown-toggle" data-toggle="dropdown"><i class="fa fa-caret-square-o-down"></i>ACCOUNTING<b class="caret"></b></a>
              <ul class="dropdown-menu">
                <li><a href="../admin/sales.php">Sales and Income</a></li>
                <li><a href="../admin/expenses.php">Expenses</a></li>
                <li><a href="../admin/financialstatement.php">Financial Statement</a></li>
              </ul>
            </li>
            
          </ul>

<?php

  }

 ?>
        