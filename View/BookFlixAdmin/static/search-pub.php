<?php
include('../../../core/pub.php');
$pub1=new pub();
if(!empty($_GET)){
    $VAL=$_GET["ser"] ;
}
else{
    $VAL="";
};

$query="SELECT * FROM publicitee WHERE nom LIKE '".$VAL."%' ORDER BY nom ";
$db = config::getConnexion();
$stmt=$db->query($query) ;
$data=$stmt->fetchall() ;
?>

<table class="table table-hover my-0">
    <thead>
        <tr>

            <th>Nom</th>
            <th class="d-none d-xl-table-cell">date debut</th>
            <th>date fin</th>
            <th class="d-none d-md-table-cell">image</th>
            <th>descriptions</th>
            <th class="d-none d-md-table-cell">actions</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($data as $publicite): ?>
        <tr>
            <td>
                <?PHP echo $publicite['nom']; ?>
            </td>
            <td>
                <?PHP echo $publicite['date1']; ?>
            </td>
            <td>
                <?PHP echo $publicite['date2']; ?>
            </td>
            <td>
                <?PHP echo $publicite['imagee']; ?>
            </td>
            <td>
                <?PHP echo $publicite['descriptions']; ?>
            </td>
            <td style="width=" 70%>
                <form method="POST" action="supprimer-pub.php">
                    <input type="submit" name="delete" value="Delete" class="btn btn-danger btn-block">
                    <input type="hidden" value="<?php echo $publicite['id']; ?>" name="id">
                </form>
            </td>
            <td style="width=" 70%>
            <td><a class="btn btn-success btn-block" href="modifier-pub.php?id=<?PHP echo $publicite['id']; ?>">
                    Modifier</a></td>
            </td>




        </tr>
        <?php endforeach; ?>
    </tbody>
</table>