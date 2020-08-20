<html>
<title>
    Display JSON Data
</title>
<head>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<style>
.container {
    margin:60px auto;
}
</style>
</head>
<body>

<?php
    $all_data = file_get_contents("product.json");
    $pr_data = json_decode($all_data,true);
?>
<div class="container">
    <h2>All Products</h2>
    <table class="table table-bordered">
        <tr>
            <th>Product Name</th>
            <th>Quantity</th>
            <th>Price&nbsp;<small>(per product)</small></th>
            <th>Total Price</th>
            <th>Action</th>
        </tr>
        <?php
         $grand_total = 0;
         if(sizeof($pr_data) >= 1) {
        for($i=0;$i<sizeof($pr_data);$i++) {           
            $total = $pr_data[$i]['Quantity']*$pr_data[$i]['Price'];
         ?>
        <tr>
            <td><?php echo $pr_data[$i]['Title']; ?></td>
            <td><?php echo $pr_data[$i]['Quantity']; ?></td>
            <td><?php echo $pr_data[$i]['Price']; ?></td>
            <td><?php echo $total; ?></td>
            <?php $grand_total = $grand_total+$total;  ?>
            <td><a href="" class="btn btn-sm btn-warning">Edit</a> <br>
                <form method="POST" action="delete_json.php">
                    <input type="hidden" value="<?php echo $pr_data[$i]['Title']; ?>" name="delete_json">
                    <button type="submit" name="delete_json_submit" class="btn btn-sm btn-danger">Delete</button></td>
                </form>
        </tr>
<?php    } ?>
            <tr >
                <td colspan=3><b>Grand Total</b>
                <td><b><?php echo $grand_total; ?></b></td>
            </tr>
        <?php } else { ?>
            <tr><td colspan="5">NO Product found..!!!</td></tr>
        <?php } ?>
    </table>
</div>
</body>