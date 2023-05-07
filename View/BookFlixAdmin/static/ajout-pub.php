<?PHP

include('../../../core/pub.php');


if (isset($_POST['nom']) and isset($_POST['date1']) and isset($_POST['date2'])and isset($_POST['imagee'])and isset($_POST['descriptions'])){


	
$publicite1=new publicite($_POST['id'],$_POST['nom'],$_POST['date1'],$_POST['date2'],$_POST['imagee'],$_POST['descriptions']);


$targetDir = "./src/";
$fileName = basename($_FILES['imagee']['nom']);
$targetFilePath = $targetDir . $fileName;
$fileType = pathinfo($targetFilePath,PATHINFO_EXTENSION);
//   echo $fileName."--";
//  echo $targetFilePath;
move_uploaded_file($_FILES['imagee']['nom'],$targetFilePath);

$pub1=new pub();

$today=date("Y-m-d");

if($today > $_POST['date1'] )
{
	echo("<script> alert(\"verifier date debut\")</script>");
	echo("<script> window.location.replace(\"page-publicite.php\")</script>");

}
else if($_POST['date2']< $_POST['date1'] )
{
	echo("<script> alert(\"il faut que la date fin soit superieur a la date debut\")</script>");
	echo("<script> window.location.replace(\"page-publicite.php\")</script>");

}
else if($_POST['date2']> $_POST['date1'] ){
$pub1-> ajouterpublicite($publicite1);
echo("<script> window.location.replace(\"page-publicite.php\")</script>");
//header('Location: page_promotion.php');
}
}else{
	echo "vérifier les champs";
}
//*/

?>
