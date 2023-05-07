<?PHP
include('../../../controller/pub.php');
$publicite=new pub();
if (isset($_POST["id"])){
	$publicite->supprimerpublicite($_POST["id"]);
	header('Location: page-publicite.php');
}

?>