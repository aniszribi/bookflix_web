const inp=document.getElementById("inp")
const main=document.getElementById("main")
var httprequest 
inp.addEventListener("keyup",(e)=>{
    httprequest=new XMLHttpRequest() ;
    if(!httprequest){
        alert("la requtte n etait pas cree avec succes");
    }
    httprequest.onreadystatechange=alertcontent ;   
    httprequest.open("GET",`search-pub.php?ser=${inp.value}`) ;
    httprequest.send();
    function alertcontent(){
        if(httprequest.status===200){
            main.innerHTML=httprequest.responseText ;
        }
    }

}) 