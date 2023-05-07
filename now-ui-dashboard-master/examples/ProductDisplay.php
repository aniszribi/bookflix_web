<?php
include("../../Model/Product.php");
$product=new CrudProduct();
$liste=$product->Display_All_Products();
?>
<?php
if(isset($_POST['try']))
{
    $type=$_POST['Type'];
    $categories=$_POST['Categories'];
    $order="ASC";
    $liste=$product->SearchWithCheckBox($categories,$type,$order);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="styleCardProduct.css">
</head>
<body>
<div class="smallContainer">
        <h2 class="title">--Featured Products--</h2>
        <div class="row"><?php foreach($liste as $row) {?>
            <div class="col-4">
                <img src="images/product-1.jpg" alt="">
                <p><?php echo $row['categories'];?></p>
                <p><?php echo $row['id'];?></p>
                <p><?php echo $row['name'];?></p>
                <div class="rating">

                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star-o"></i>
                </div>
                <p>$<?php echo $row['price'];?></p>
            </div><?php };?>
        </div>
</div>
<!-- try.1 -->
<div>
<form action="" method="post">
    <div>
<section>
<input type="radio" name="Categories" value="homme" id="option-1">
<label for="option-1">Homme</label>
<input type="radio" name="Categories" value="femme" id="option-2">
<label for="option-2">femme</label>
</div>
<div>
<input type="radio" name="Type" value="accesoire" id="option-1">
<label for="option-2">assecoire</label>
<input type="radio" name="Type" value="vetement" id="option-1">
<label for="option-2">vetement</label>

</div>
<button type="submit" name="try">TRY</button>
</form>
</section>

</div>
</body>
</html>