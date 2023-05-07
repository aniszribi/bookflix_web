<?php
class publicite{
    private $id ;
    private  $nom;
    private  $date1;
    private  $date2;
    private  $imagee;
    private  $descriptions;

function __construct($id,$nom,$date1,$date2,$imagee,$descriptions){
   $this->id=$id;
   $this->nom=$nom; 
   $this->date1=$date1; 
   $this->date2=$date2;
   $this->imagee=$imagee;
   $this->descriptions=$descriptions;

}
function getid(){
return$this->id;
}
function getnom(){
    return$this->nom;
    }
    function getdate1(){
        return$this->date1;
        }
        function getdate2(){
            return$this->date2;
            }
            function getimagee(){
                return$this->imagee;
                }
                function getdescriptions(){
                    return$this->descriptions;
                    }

            function setid($id){
                $this->id=$id;
            }
            function setnom($nom){
                $this->nom=$nom;

              }
              function setdate1($date1){
                $this->date1=$date1;
              } 
            
            function setdate2($date2){
              $this->date2=$date2;
            }    
        
        function setimagee($imagee){
          $this->imagee=$imagee;
        }    
    
    function setdescriptions($descriptions){
      $this->descriptions=$descriptions;
    }    
            
}
?>