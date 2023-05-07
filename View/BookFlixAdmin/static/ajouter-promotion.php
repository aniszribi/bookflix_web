<?PHP

include('../../../core/promotionC.php');


if (isset($_POST['produit']) and isset($_POST['date_d']) and isset($_POST['date_f']) and isset($_POST['prix_old']) and isset($_POST['pourcentage']) and isset($_POST['prix_new'])){


$promotion1=new promotion($_POST['id'],$_POST['produit'],$_POST['date_d'],$_POST['date_f'],$_POST['prix_old'],$_POST['pourcentage'],$_POST['prix_new']);




$promo1=new promo();

$today=date("Y-m-d");

if($today > $_POST['date_d'] )
{
	echo("<script> alert(\"verifier date debut\")</script>");
	echo("<script> window.location.replace(\"page_promotion.php\")</script>");

}
else if($_POST['date_f']< $_POST['date_d'] )
{
	echo("<script> alert(\"il faut que la date fin soit superieur a la date debut\")</script>");
	echo("<script> window.location.replace(\"page_promotion.php\")</script>");

}
else if($_POST['date_f']> $_POST['date_d'] ){

$promo1-> ajouterpromotion($promotion1);
echo("<script> window.location.replace(\"page_promotion.php\")</script>");
//header('Location: page_promotion.php');
}
}else{
	echo "vérifier les champs";
}
//*/

?>
