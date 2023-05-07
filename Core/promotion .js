function Equation() {
    var Prix = document.getElementById("prix_old").value - (document.getElementById("prix_old").value * document.getElementById("pourcentage").value / 100);
    document.getElementById("prix_new").setAttribute("value", Prix);
}

