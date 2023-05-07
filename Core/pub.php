<?php
require_once(__DIR__ . '/../config.php');
include(__DIR__ . '/../model/publicite.php');

 class pub {



	function ajouterpublicite($publicite){
		$query="insert into publicitee (id,nom,date1,date2,imagee,descriptions) values (:id,:nom,:date1,:date2,:imagee,:descriptions)";
		$db = config::getConnexion();
		try{
        $req=$db->prepare($query);
        $id=$publicite->getid();
		$nom=$publicite->getnom();
		$date1=$publicite->getdate1();
        $date2=$publicite->getdate2();
        $imagee=$publicite->getimagee();
        $descriptions=$publicite->getdescriptions();

		$req->bindValue(':id',$id);
		$req->bindValue(':nom',$nom);
		$req->bindValue(':date1',$date1);
		$req->bindValue(':date2',$date2);
        $req->bindValue(':imagee',$imagee);
        $req->bindValue(':descriptions',$descriptions);



            $req->execute();
           
        }
        catch (Exception $e){
            echo 'Erreur: '.$e->getMessage();
        }
		
    }
    
 

    function afficherpublicite(){
	
		$sql="SElECT * From publicitee";
		$db = config::getConnexion();
		try{
		$liste=$db->query($sql);
		return $liste;
		}
        catch (Exception $e){
            die('Erreur: '.$e->getMessage());
        }	
    }
    


    function supprimerpublicite($id){
		$sql="DELETE FROM publicitee where id= :id";
		$db = config::getConnexion();
        $req=$db->prepare($sql);
		$req->bindValue(':id',$id);
		try{
            $req->execute();
           // header('Location: index.php');
        }
        catch (Exception $e){
            die('Erreur: '.$e->getMessage());
        }
    }
    

	function modifierpublicite($publicite,$id){
		$sql="UPDATE publicitee SET nom=:nom , date1=:date1 , date2=:date2, imagee=:imagee, descriptions=:descriptions  WHERE id=:id";
		
		$db = config::getConnexion();
		//$db->setAttribute(PDO::ATTR_EMULATE_PREPARES,false);
 try{		
        $req=$db->prepare($sql);
	
		$nom=$publicite->getnom();
		$date1=$publicite->getdate1();
        $date2=$publicite->getdate2();
        $imagee=$publicite->getimagee();
        $descriptions=$publicite->getdescriptions();
	
		$datas = array(':id'=>$id,  ':nom'=>$nom, ':date1'=> $date1, ':date2'=>$date2, ':imagee'=>$imagee, ':descriptions'=>$descriptions);

		$req->bindValue(':id',$id);
		$req->bindValue(':nom',$nom);
		$req->bindValue(':date1',$date1);
		$req->bindValue(':date2',$date2);
		$req->bindValue(':imagee',$imagee);
		$req->bindValue(':descriptions',$descriptions);


		
		
            $s=$req->execute();
			
           // header('Location: index.php');
        }
        catch (Exception $e){
            echo " Erreur ! ".$e->getMessage();
   echo " Les datas : " ;
  print_r($datas);
        }
		
	}

    function recupererpublicite($id){
		$sql="SELECT * from publicitee where id=$id";
		$db = config::getConnexion();
		try{
		$liste=$db->query($sql);
		return $liste;
		}
        catch (Exception $e){
            die('Erreur: '.$e->getMessage());
        }
	}

    function readpublicite() {
        $sql = "SELECT * FROM publicitee WHERE id = :id";
        $db = config::getConnexion();
        $stmt = $db->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $results;
    }

    public function selectpathimage($id) {
        $sql = "SELECT imagee FROM publicitee WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':id', $id);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result;
      }

      function get_random_image() {
        // Sélectionner une image aléatoire à partir de la base de données
        $sql = "SELECT imagee FROM publicitee ORDER BY RAND() LIMIT 1";
        $db = config::getConnexion();
        $result = $db->query($sql); // exécuter la requête SQL
        
        // Vérifier si la requête a renvoyé des résultats
        if ($result->rowCount() > 0) {
            // Retourner les données de l'image
            return $result->fetchColumn();
        } else {
            // Retourner null si aucune image trouvée
            return null;
        }
    }
    
 
}

 




?>
