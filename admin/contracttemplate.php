<?php
include '../include/connectdb.php';
  include 'include/check_login.php';
if (!isset($_SESSION["manager"])) {
    header("location: login.php"); 
    exit();
  
  
  
}?>

<?php
    
    $username="";
      if (loggedin())
      {
        $query = mysql_query("SELECT * FROM admin WHERE username ='$_SESSION[manager]' ");
          while ($row = mysql_fetch_assoc($query))
          {
            $userid = $row ['id'];
            $username = $row ['username'];

            
          
          }
        
        }
      else
      { 
      //header("Location:login.php");
    //  exit();
      }


      if (isset($_POST['submit'])) {

        $type = $_POST['type'];        

        $file_name = $_FILES['file']['name'];
        $file_size = $_FILES['file']['size'];
        $file_temp = $_FILES['file']['tmp_name'];

        $file_ext = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));

        $fileName = "$type-contract.pdf";

        mysql_query("INSERT INTO uploaded_contract_template_file (file_name, type, ext) VALUES ('$fileName', '$type', '$file_ext')");

        move_uploaded_file($file_temp, 'contracttemplate/' . $fileName);

      }
      
      function isContractTemplatesExisting() {

        $sql = mysql_query("SELECT * FROM uploaded_contract_template_file");
        $requestCount = mysql_num_rows($sql);

        return $requestCount > 1;

      }

      ?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Administrator</title>

    <link href="css/bootstrap.css" rel="stylesheet">

    <link href="css/sb-admin.css" rel="stylesheet">

    <link rel="stylesheet" href="css/morris-0.4.3.min.css">

    <style>
  .cell2 {
    width: 97% !important;
  }
  .row2 {
    width: 70% !important;
  }
</style>

  </head>

  <body>

    <div id="wrapper">
  <!-- Sidebar -->
      <nav class="navbar navbar-inverse  navbar-fixed-top" role="navigation">
      <?php include 'template/sidebar.php';?>
    <?php include 'template/top.php';?>
    </nav>

    <?php 

      if (!isContractTemplatesExisting()) {
        
        ?>



        <form action="contracttemplate.php" method="post" enctype="multipart/form-data" style="margin-top: 69px;">

    <fieldset>
       <div class="row row2">
        <div class="cell cell2">
    
          <h4>Upload / Update Contract Template</h4>
           <hr class="bg-magenta">
               <br/>
          
          <div class="form-group">
            <div class="input-control">
              <label for="product-name">Contract File:</label>
              <input type="file" class="form-control" name="file" required="required">
            </div>
          </div>
          <div class="form-group">
            <div class="input-control">
              <label for="product-name">Contract Type:</label>
              <select name="type" class="form-control">
                <option value="author">Author</option>
                <option value="supplier">Supplier</option>
              </select>
            </div>
          </div>
          <br/>
          <div class="form-group">
            <input type="submit" name="submit" class="btn btn-primary" value="Submit">
          </div>

          
        </div>
      </div>
    </fieldset>
    </form>


        <?php

      }

     ?>

    

    
    </div>
    </body>
    </html>


