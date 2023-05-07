<?PHP
include('../../../Core/promotionC.php');
$promotion=new promo();
if (isset($_POST["id"])){
	$promotion->supprimerpromotion($_POST["id"]);
	header('Location: page_promotion.php');
}

?>