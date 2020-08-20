<?php
if(isset($_POST['delete_json_submit'])) {
    $json_title = $_POST['delete_json'];
    $json_data = file_get_contents('product.json');
    $decoded_data = json_decode($json_data, true);

    $arr_index = array();
    foreach($decoded_data as $key=> $value) {
        if($value['Title']==$key){
            $arr_index[]=$key;
        }
    }
    foreach($arr_index as $i){
        unset($decoded_data[$i]);
        ?>
            <script>window.alert("Object Deleted successfully..!!");</script>
<?php       header("Location: /json/display_json.php"); 
   
    }
    $decoded_data = array_values($decoded_data);
    file_put_contents('product.json',json_encode($decoded_data));

}
?>