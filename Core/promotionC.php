<?php
require_once(__DIR__ . '/../config.php');
include(__DIR__ . '/../model/promotion.php');

 class promo {


    
    
	function ajouterpromotion($promotion){
		$sql="insert into promotion (id,nom_produit,date_d,date_f,prix_old,pourcentage,prix_new) values (:id,:nom_produit,:date_d,:date_f,:prix_old,:pourcentage,:prix_new)";
		$db = config::getConnexion();
		try{
        $req=$db->prepare($sql);
        $id=$promotion->getid();
		$nom_produit=$promotion->getnom_produit();
		$date_d=$promotion->getdate_d();
        $date_f=$promotion->getdate_f();
        $prix_old=$promotion->getprix_old();
        $pourcentage=$promotion->getpourcentage();
        $prix_new=$promotion->getprix_new();
       
		$req->bindValue(':id',$id);
		$req->bindValue(':nom_produit',$nom_produit);
		$req->bindValue(':date_d',$date_d);
		$req->bindValue(':date_f',$date_f);
        $req->bindValue(':prix_old',$prix_old);
        $req->bindValue(':pourcentage',$pourcentage);
        $req->bindValue(':prix_new',$prix_new);

		
            $req->execute();
           
        }
        catch (Exception $e){
            echo 'Erreur: '.$e->getMessage();
        }
		
    }
    
 

    function afficherpromotion(){
	
		$sql="SElECT * From promotion";
		$db = config::getConnexion();
		try{
		$liste=$db->query($sql);
		return $liste;
		}
        catch (Exception $e){
            die('Erreur: '.$e->getMessage());
        }	
    }
    


    function supprimerpromotion($id){
		$sql="DELETE FROM promotion where id= :id";
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
    

	function modifierpromotion($promotion,$id){
		$sql="UPDATE promotion SET nom_produit=:nom_produit,date_d=:date_d , date_f=:date_f, prix_old=:prix_old, pourcentage=:pourcentage, prix_new=:prix_new  WHERE id=:id";
		
		$db = config::getConnexion();
		//$db->setAttribute(PDO::ATTR_EMULATE_PREPARES,false);
try{		
        $req=$db->prepare($sql);
	
		$nom_produit=$promotion->getnom_produit();
		$date_d=$promotion->getdate_d();
        $date_f=$promotion->getdate_f();
        $prix_old=$promotion->getprix_old();
        $pourcentage=$promotion->getpourcentage();
        $prix_new=$promotion->getprix_new();
	
		$datas = array(':id'=>$id,  ':nom_produit'=>$nom_produit, ':date_d'=> $date_d, ':date_f'=>$date_f, ':prix_old'=>$prix_old, ':pourcentage'=>$pourcentage, ':prix_new'=>$prix_new);

		$req->bindValue(':id',$id);
		$req->bindValue(':nom_produit',$nom_produit);
		$req->bindValue(':date_d',$date_d);
		$req->bindValue(':date_f',$date_f);
        $req->bindValue(':prix_old',$prix_old);
		$req->bindValue(':pourcentage',$pourcentage);
		$req->bindValue(':prix_new',$prix_new);


		
		
            $s=$req->execute();
			
           // header('Location: index.php');
        }
        catch (Exception $e){
            echo " Erreur ! ".$e->getMessage();
   echo " Les datas : " ;
  print_r($datas);
        }
		
	}

    public function recupererpromotion($id){
        $pdo = config::getConnexion();
        $sql = "SELECT * FROM promotion WHERE id = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':id',$id);
        $stmt->execute();
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $results;
    }

    function recupererpromotionNom($nom_produit){
        $sql = "SELECT * FROM promotion WHERE nom_produit = :nom_produit";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':nom_produit',$nom_produit);
        $stmt->execute();
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $results;
	}



 }



?>