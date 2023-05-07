<?php

require_once 'dompdf/autoload.inc.php';

use Dompdf\Dompdf;

include('../../../Core/panier.php');

$panierC = new panierC();

$id = $_GET['imprimer'];

$resultat = $panierC->getCommande($id);

$html = '<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Facture </title>
<style>
/* Style for the table */
table {
    border-collapse: collapse;
    width: 100%;
    margin-bottom: 20px;
}
th, td {
    text-align: left;
    padding: 8px;
    border: 1px solid #ddd;
}
th {
    background-color: #4CAF50;
    color: white;
}
tr:hover {
    background-color: #f5f5f5;
}

/* Style for the page */
body {
    font-family: Arial, sans-serif;
    background-color: #f2f2f2;
}
h2 {
    margin-top: 30px;
    margin-bottom: 20px;
    text-align: center;
}
</style>
</head>
    <body>
        <h2>Commande :</h2>
        <table>
            <thead>
                <tr>
                    <th>Client</th>
                    <th>Total</th>
                    <th>Date</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>' . $resultat[0]["iduser"] . '</td>
                    <td>' . $resultat[0]["total"] . '</td>
                    <td>' . $resultat[0]["date_creation"] . '</td>
                </tr>';

// Check if the user-id parameter is set in the URL
if(isset($_GET['user-id'])){
    // Define the details table HTML
    $html .= '<tr>
                <td colspan="3">
                <h2>Les produits :</h2>
                    <table>
                        <thead>
                            <tr>
                                <th>Product Name</th>
                                <th>Reference</th>
                                <th>Quantite</th>
                                <th>Price</th>
                            </tr>
                        </thead>
                        <tbody>';

    // Get the details of the products in the order
    $list = $panierC->getProductsByCommandeIdUser($_GET['user-id']);
    foreach ($list as $row) {
        $html .= '<tr>
                    <td class=""name="product-name">' . $row['name'] . '</td>
                    <td>' . $row['reference'] . '</td>
                    <td><span class="badge bg-danger">' . $row['quantite'] . '</span></td>
                    <td><span class="badge bg-success">' . $row['price'] . ' TND</span></td>
                  </tr>';
    }

    // Close the details table HTML
    $html .= '</tbody>
            </table>
        </td>
    </tr>';
}

// Close the order table HTML and the HTML page
$html .= '</tbody>
        </table>
    </body>
</html>';

// Generate the PDF document using Dompdf
$dompdf = new Dompdf();
$dompdf->loadHtml($html);
$dompdf->setPaper('A4', 'landscape');
$dompdf->render();
$dompdf->stream('facture.pdf');