<?php
class promotion{
    private $id ;
    private  $nom_produit;
    private  $date_d;
    private  $date_f;
    private  $prix_old;
    private  $pourcentage;
    private  $prix_new;

function __construct($id,$nom_produit,$date_d,$date_f,$prix_old,$pourcentage,$prix_new){
   $this->id=$id;
   $this->nom_produit=$nom_produit; 
   $this->date_d=$date_d; 
   $this->date_f=$date_f;
   $this->prix_old=$prix_old;
   $this->pourcentage=$pourcentage;
   $this->prix_new=$prix_new;

}
function getid(){
return$this->id;
}
function getnom_produit(){
    return$this->nom_produit;
    }
    function getdate_d(){
        return$this->date_d;
        }
        function getdate_f(){
            return$this->date_f;
            }
            function getprix_old(){
              return$this->prix_old;
              }
            function getpourcentage(){
                return$this->pourcentage;
                }
                function getprix_new(){
                    return$this->prix_new;
                    }

            function setid($id){
                $this->id=$id;
            }
            function setnom_produit($nom_produit){
                $this->nom_produit=$nom_produit;

              }
              function setdate_d($date_d){
                $this->date_d=$date_d;
              } 
            
            function setdate_f($date_f){
              $this->date_f=$date_f;
            }  
            function setprix_old($prix_old){
              $this->prix_old=$prix_old;
            }    
        
        function setpourcentage($pourcentage){
          $this->pourcentage=$pourcentage;
        }    
    
    function setprix_new($prix_new){
      $this->prix_new=$prix_new;
    }    
            
}
?>