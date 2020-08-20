<html>
<title>
    Add JSON Data
</title>
<head>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <style>
      red {
          color:red;
      }
      .container {
          margin:100px auto;
      }
      .message {
          margin:20px 40px;
      }
      .error_message {
          color:red;
      }
  </style>
</head>

<?php
if($_SERVER['REQUEST_METHOD']== 'POST') {
    $error = '';
    if(empty($_POST['pr_name'])) { 
        $error ="<h6 class='error_message'>Enter product name </h6>";
    }
    else if(empty($_POST['pr_quant'])) { 
        $error ="<h6 class='error_message'>Enter quantity of product </h6>";
    }
    else if(empty($_POST['pr_price'])) { 
        $error ="<h6 class='error_message'>Enter price of product </h6>";
    }
    else {
    if(file_exists('product.json')) {
        $filename="product.json";
        $alldata = file_get_contents('product.json');
        $decoded_data = json_decode($alldata,TRUE);
        $decoded_data[] = array(
            'Title' => $_POST['pr_name'],
            'Quantity' => $_POST['pr_quant'],
            'Price' => $_POST['pr_price']
        );
        $encoded_data = json_encode($decoded_data);
        if(file_put_contents('product.json',$encoded_data)) {  ?>
            <h6 class="message">
                 Product added successfully..!!
            <h6>
<?php   }
    else { ?>
        <h6 class="message">
                ERROR....!!
        <h6>
<?php }
    }
   else { ?>
            <h6 class="message">
                 file not exist..!!
            <h6>
<?php    }
}
}
?>
<body>
    <div class="container">
        <h2>Product Details :</h2>
        <form method="POST">
            <div class="form-group">
                <label>Title <red>*</red></label>
                <input type="text" name="pr_name" class="form-control" >
            </div>
            <div class="form-group">
                <label>Quantity <red>*</red></label>
                <input type="text" name="pr_quant" class="form-control">
            </div>
            <div class="form-group">
                <label>Price <red>*</red></label>
                <input type="text" name="pr_price" class="form-control">
            </div>
            <button type="submit" class="btn btn-md btn-primary">Submit</button>
        </form>
        <?php 
            if(isset($error)) {
                echo $error;
            }
        ?>
    </div>
</body>
</html>