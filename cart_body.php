<?php

session_start();

include("includes/db.php");
include("includes/header.php");
include("functions/functions.php");
include("includes/main.php");
?>

  <main>
    <!-- HERO -->
    <div class="nero">
      <div class="nero__heading">
        <span class="nero__bold">SHOP</span> Cart
      </div>
      <p class="nero__text">
      </p>
    </div>
  </main>


<div id="content" >
<div class="container" >



<div class="col-md-9" id="cart" >

<div class="box" >

<form action="cart.php" method="post" enctype="multipart-form-data" >

<h1> Shopping Cart </h1>

<?php

$ip_add = getRealUserIp();

$select_cart = "select * from cart where ip_add='$ip_add'";

$run_cart = mysqli_query($con,$select_cart);

$count = mysqli_num_rows($run_cart);

?>

<p class="text-muted" > You currently have <?php echo $count; ?> item(s) in your cart. </p>

<div class="table-responsive" >

<table class="table" >

<thead>

<tr>

<th colspan="2" >Product</th>

<th>Quantity</th>

<th>Unit Price</th>

<th>Size</th>

<th colspan="1">Delete</th>

<th colspan="2"> Sub Total </th>


</tr>

</thead>

<tbody>

<?php

$total = 0;

while($row_cart = mysqli_fetch_array($run_cart)){

$pro_id = $row_cart['p_id'];

$pro_size = $row_cart['size'];

$pro_qty = $row_cart['qty'];

$only_price = $row_cart['p_price'];

$get_products = "select * from products where product_id='$pro_id'";

$run_products = mysqli_query($con,$get_products);

while($row_products = mysqli_fetch_array($run_products)){

$product_title = $row_products['product_title'];

$product_img1 = $row_products['product_img1'];

$sub_total = $only_price*$pro_qty;

$_SESSION['pro_qty'] = $pro_qty;

$total += $sub_total;

?>

<tr>

<td>

<img src="admin_area/product_images/<?php echo $product_img1; ?>" >

</td>

<td>

<a href="#" > <?php echo $product_title; ?> </a>

</td>

<td>
<input type="text" name="quantity" value="<?php echo $_SESSION['pro_qty']; ?>" data-product_id="<?php echo $pro_id; ?>" class="quantity form-control">
</td>

<td>

$<?php echo $only_price; ?>.00

</td>

<td>

<?php echo $pro_size; ?>

</td>

<td>
<input type="checkbox" name="remove[]" value="<?php echo $pro_id; ?>">
</td>

<td>

$<?php echo $sub_total; ?>.00

</td>

</tr>

<?php } } ?>

</tbody>

<tfoot>

<tr>

<th colspan="5"> Total </th>

<th colspan="2"> $<?php echo $total; ?>.00 </th>

</tr>

</tfoot>

</table>




<div class="box-footer">

<div class="pull-left">

<a href="index.php" class="btn btn-default">

<i class="fa fa-chevron-left"></i> Continue Shopping

</a>

</div>

<div class="pull-right">

<button class="btn btn-default" type="submit" name="update" value="Update Cart">

<i class="fa fa-refresh"></i> Update Cart

</button>

<a href="checkout.php" class="btn btn-primary">

Proceed to checkout <i class="fa fa-chevron-right"></i>

</a>

</div>

</div>

</form>


</div>




?>

<?php

function update_cart(){

global $con;

if(isset($_POST['update'])){

foreach($_POST['remove'] as $remove_id){


$delete_product = "delete from cart where p_id='$remove_id'";

$run_delete = mysqli_query($con,$delete_product);

if($run_delete){
echo "<script>window.open('cart.php','_self')</script>";
}



}




}



}

echo @$up_cart = update_cart();



?>



<div id="row same-height-row">

<div class="col-md-3 col-sm-6">

<div class="box same-height headline">

<h3 class="text-center"> You also like these Products </h3>

</div>

</div>

<?php

$get_products = "select * from products order by rand() LIMIT 0,3";

$run_products = mysqli_query($con,$get_products);

while($row_products=mysqli_fetch_array($run_products)){

$pro_id = $row_products['product_id'];

$pro_title = $row_products['product_title'];

$pro_price = $row_products['product_price'];

$pro_img1 = $row_products['product_img1'];

$pro_label = $row_products['product_label'];



$pro_psp_price = $row_products['product_psp_price'];

$pro_url = $row_products['product_url'];


if($pro_label == "Sale" or $pro_label == "Gift"){

$product_price = "<del> $$pro_price </del>";

$product_psp_price = "| $$pro_psp_price";

}
else{

$product_psp_price = "";

$product_price = "$$pro_price";

}


if($pro_label == ""){


}
else{

$product_label = "

<a class='label sale' href='#' style='color:black;'>

<div class='thelabel'>$pro_label</div>

<div class='label-background'> </div>

</a>

";

}


echo "

<div class='col-md-3 col-sm-6 center-responsive' >

<div class='product' >

<a href='$pro_url' >

<img src='admin_area/product_images/$pro_img1' class='img-responsive' >

</a>

<div class='text' >



<hr>

<h3><a href='$pro_url' >$pro_title</a></h3>

<p class='price' > $product_price $product_psp_price </p>

<p class='buttons' >

<a href='$pro_url' class='btn btn-default' >View details</a>

<a href='$pro_url' class='btn btn-primary'>

<i class='fa fa-shopping-cart'></i> Add To Cart

</a>


</p>

</div>

$product_label


</div>

</div>

";


}




?>


</div>


</div>

<div class="col-md-3">

<div class="box" id="order-summary">

<div class="box-header">

<h3>Order Summary</h3>

</div>

<p class="text-muted">
Shipping and additional costs are calculated based on the values you have entered.
</p>

<div class="table-responsive">
<table class="table">

<tbody>

<tr>

<td> Order Subtotal </td>

<th> $<?php echo $total; ?>.00 </th>

</tr>

<tr>

<td> Shipping and handling </td>

<th>$0.00</th>

</tr>

<tr>

<td>Tax</td>

<th>$0.00</th>

</tr>

<tr class="total">

<td>Total</td>

<th>$<?php echo $total; ?>.00</th>

</tr>

</tbody>

</table>

</div>

</div>

</div>

</div>
</div>



<?php

include("includes/footer.php");

?>

<script src="js/jquery.min.js"> </script>

<script src="js/bootstrap.min.js"></script>

<script>

$(document).ready(function(data){

$(document).on('keyup', '.quantity', function(){

var id = $(this).data("product_id");

var quantity = $(this).val();

if(quantity  != ''){

$.ajax({

url:"change.php",

method:"POST",

data:{id:id, quantity:quantity},

success:function(data){

$("body").load('cart_body.php');

}




});


}




});




});

</script>

</body>
