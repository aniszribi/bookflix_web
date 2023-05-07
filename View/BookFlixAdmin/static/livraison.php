<?php

$pdo = new PDO("mysql:host=localhost;dbname=database", "root", "");

include('../../../Core/livraison.php');
include('../../../Core/Activities.php');
$LivraisonC = new LivraisonC();
session_start();
if (!isset($_SESSION['idAdmin'])) {
	header("Location: error404.html");
}

//add or update category
if (isset($_POST['submit'])) {
	if (!empty($_POST['idCommande']) && !empty($_POST['idlivreur']) && !empty($_POST['nomcomplet']) && !empty($_POST['adresse']) && !empty($_POST['ville']) && !empty($_POST['codepostal']) && !empty($_POST['pays'])) {
		$idCommande = $_POST['idCommande'];
		$idlivreur = $_POST['idlivreur'];
		$nomcomplet = $_POST['nomcomplet'];
		$adresse = $_POST['adresse'];
		$ville = $_POST['ville'];
		$codepostal = $_POST['codepostal'];
		$pays = $_POST['pays'];

		$livraison1 = new livraison($idCommande, 0, $idlivreur, $nomcomplet, $adresse, $ville, $codepostal, $pays);

		if (!empty($_POST['updating'])) {

			$id = $_POST['updating'];
			$livraison1->set_Idlivraison($id);
			$LivraisonC->update($livraison1);
			$currentDateTime = date('Y-m-d H:i:s');
			$description = "You have assign Mr ".$nomcomplet." to the Commande ".$idCommande;
			$newActivitie = new Activities('', $_SESSION['idAdmin'], $description, $currentDateTime, '');
			CrudActivities::insert($newActivitie);
		} else {
			$LivraisonC->ajouter($livraison1);
			$currentDateTime = date('Y-m-d H:i:s');
			echo $currentDateTime;
			$description = "You have assign Mr ".$nomcomplet."to the Commande ".$idCommande;
			$newActivitie = new Activities('', $_SESSION['idAdmin'], $description, $currentDateTime, '');
			CrudActivities::insert($newActivitie);

		}

	}
}


//delete category
if (isset($_GET['delete'])) {
	$id = $_GET['delete'];
	$LivraisonC->delete($id);
	header('location:livraison.php');
}


//display 
/*if (isset($_SESSION['Livraisons']) && !empty($_SESSION['Livraisons'])) {
	// If the session variable is set and not empty
	$liste = $_SESSION['Livraisons'];
	$_SESSION['Livraisons'] = null;
} else {
	// If the session variable is not set or empty
	$liste=$LivraisonC->Display_livraison();
	
}*/


$liste = $LivraisonC->Display_livraison();

if (isset($_POST['search'])) {
	$search_input = $_POST['search'];
	$Livraisons = $LivraisonC->search_livraison($search_input);
	$html = '';
	foreach ($Livraisons as $row) {
		$html .= '<tr>';
		$html .= ' <td><span class="badge bg-danger" >' . $row["idlivraison"] . '</span></td>';
		$html .= '<td>' . $row['idcommande'] . '</td>';
		$html .= '<td>' . $row['name'] . '</td>';
		$html .= '<td>' . $row['nomcomplet'] . '</td>';
		$html .= '<td>' . $row['adresse'] . '</td>';
		$html .= '<td>' . $row['ville'] . '</td>';
		$html .= '<td>' . $row['codepostal'] . '</td>';
		$html .= '<td>' . $row['pays'] . '</td>';
		$html .= '<td>' . $row['codepostal'] . '</td>';
		$html .= ' <td> <a href="livraison.php?update=' . $row["idlivraison"] . '" style="margin:10px;" class="btn btn-primary open-popup-ElseWhere" name="modify" id="update-button">Modify</a> <a href="livraison.php?delete=' . $row["idlivraison"] . '" style="margin: 10px;" class="btn btn-danger" name="delete">Delete</a></td> ';
		$html .= '</tr>';
	}

	// return the generated HTML
	echo $html;

	exit; // stop the script from further execution
}





?>







<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="Responsive Admin &amp; Dashboard Template based on Bootstrap 5">
	<meta name="author" content="AdminKit">
	<meta name="keywords"
		content="adminkit, bootstrap, bootstrap 5, admin, dashboard, template, responsive, css, sass, html, theme, front-end, ui kit, web">

	<link rel="preconnect" href="https://fonts.gstatic.com">
	<link rel="shortcut icon" href="img/icons/icon-48x48.png" />

	<link rel="canonical" href="https://demo-basic.adminkit.io/pages-blank.html" />

	<title>Product Managment</title>
	<link rel="stylesheet" href="popupstyle.css">
	<link href="css/app.css" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
	<link rel="stylesheet"
		href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0" />
	<link rel="stylesheet" href="css/style-popup-product.css">
	<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
	<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
	<link rel="stylesheet"
		href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
	<style>
		*{
			padding: 0px;
			margin: 0px;
		}

		body {
			font-family: sans-serif;
		}

		.navclass {
			display: flex;
			align-items: center;
			background: #00A9D4;
			height: 60px;
			position: relative;
		}

		.icon {
			cursor: pointer;
			margin-right: 50px;
			line-height: 60px;
		}

		.icon span {
			background: #f00;
			padding: 7px;
			border-radius: 50%;
			color: #fff;
			vertical-align: top;
			margin-left: -25px;
		}

		.icon img {
			display: inline-block;
			width: 40px;
			margin-top: 20px;
		}

		.icon:hover {
			opacity: .7;
		}

		.logo {
			flex: 1;
			margin-left: 50px;
			color: #eee;
			font-size: 20px;
			font-family: monospace;
		}

		.notifi-box {
			width: 300px;
			height: 0px;
			opacity: 0;
			position: absolute;
			top: 63px;
			right: 35px;
			transition: 1s opacity, 250ms height;
			box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
			background-color: #f1f4f9;
			overflow: auto;
		}

		.notifi-box h2 {
			font-size: 14px;
			padding: 10px;
			border-bottom: 1px solid #eee;
			color: #999;
		}

		.notifi-box h2 span {
			color: #f00;
		}

		.notifi-item {
			display: flex;
			border-bottom: 1px solid #eee;
			padding: 15px 5px;
			margin-bottom: 15px;
			cursor: pointer;
		}

		.notifi-item:hover {
			background-color: #eee;
		}

		.notifi-item img {
			display: block;
			width: 50px;
			margin-right: 10px;
			border-radius: 50%;
		}

		.notifi-item .text h4 {
			color: #777;
			font-size: 16px;
			margin-top: 10px;
		}

		.notifi-item .text p {
			color: #aaa;
			font-size: 12px;
		}
	</style>

</head>



<body>

	<div class="wrapper">
	<nav id="sidebar" class="sidebar js-sidebar">
			<div class="sidebar-content js-simplebar">
				<a class="sidebar-brand" href="index.html">
					<span class="align-middle"><img src="../src/img/logo/LOGOWEBSITE 4.png" alt=""></span>
				</a>

				<ul class="sidebar-nav">
					<li class="sidebar-header">
						Pages
					</li>
                     
					<li class="sidebar-item">
						<a class="sidebar-link" href="index.html">
							<i class="align-middle" data-feather="sliders"></i> <span class="align-middle">Dashboard</span>
						</a>
					</li>
					<li class="sidebar-header">
					 Admin Management
					</li>
					<li class="sidebar-item ">
						<a class="sidebar-link" href="AdminProfile.php">
							<i class="align-middle" data-feather="user"></i> <span class="align-middle">Profile</span>
						</a>
					</li>

					<li class="sidebar-item">
						<a class="sidebar-link" href="AdminDisplay.php">
							<i class="align-middle" data-feather="user-plus"></i> <span class="align-middle">Admin Management</span>
						</a>
					</li>

					<li class="sidebar-item">
						<a class="sidebar-link" href="AdminClientPage.php">
							<i class="align-middle" data-feather="book"></i> <span class="align-middle">Client Management</span>
						</a>
					</li>
					<li class="sidebar-header">
					Event Managment
					</li>
					<li class="sidebar-item ">
			  			<a class="sidebar-link" href="evennement-managment.php">
                          <i class="align-middle" data-feather="book"></i> 
						  <span class="align-middle">Evennement Managment</span>
                        </a>
						<ul class="sidebar-nav" style="padding-left:1.5em;font-size:0.9em;">
							<li class="sidebar-item ">
							   <a  class="sidebar-link" href="typeevent.php">
								 <span class="align-middle">Event Type</span>
							   </a>	
							</li>
						</ul>
					</li>
					<li class="sidebar-header">
					Product Managment
					</li>
					<li class="sidebar-item ">
			  			<a class="sidebar-link" href="Product-managment.php">
                          <i class="align-middle" data-feather="book"></i> 
						  <span class="align-middle">Product Managment</span>
                        </a>
						<ul class="sidebar-nav" style="padding-left:1.5em;font-size:0.9em;">
							<li class="sidebar-item ">
							   <a  class="sidebar-link" href="Product-Categories.php">
								 <span class="align-middle">Categories</span>
							   </a>	
							</li>
						</ul>
					</li>
					<li class="sidebar-header">
					Livraison Managment
					</li>
					<li class="sidebar-item active ">
			  			<a class="sidebar-link" href="livraison.php">
                          <i class="align-middle" data-feather="book"></i> 
						  <span class="align-middle">Livraison Managment</span>
                        </a>
						<ul class="sidebar-nav" style="padding-left:1.5em;font-size:0.9em;">
							<li class="sidebar-item ">
							   <a  class="sidebar-link" href="livreur.php">
								 <span class="align-middle">Livreur Managment</span>
							   </a>	
							</li>
						</ul>
					</li>
					<li class="sidebar-header">
					 Commandes Management
					</li>
					<li class="sidebar-item ">
						<a class="sidebar-link" href="commandes.php">
							<i class="align-middle" data-feather="user"></i> <span class="align-middle">Commandes Management</span>
						</a>
					</li>
					<li class="sidebar-header">
					Promotion Management
					</li>
					<li class="sidebar-item ">
						<a class="sidebar-link" href="page_promotion.php">
							<i class="align-middle" data-feather="book"></i> <span class="align-middle">Promotion Management</span>
						</a>
					</li>
                    <li class="sidebar-header">
					 Publicité Management
					</li>
					<li class="sidebar-item ">
						<a class="sidebar-link" href="page-publicite.php">
							<i class="align-middle" data-feather="book"></i> <span class="align-middle">Publicité Management</span>
						</a>
					</li>
				</ul>

				
 </nav>
		<div class="main">
			<nav class="navbar navbar-expand navbar-light navbar-bg">
				<a class="sidebar-toggle js-sidebar-toggle">
					<i class="hamburger align-self-center"></i>
				</a>

				<div class="navbar-collapse collapse">
					<ul class="navbar-nav navbar-align">

					<a href="#">
							<div class="notify-icon" onclick="toggleNotifi()">
								<span class="las la-bell"></span>
								<span class="notify"></span>
							</div>
						</a>
						
						<li class="nav-item dropdown">


							<div class="dropdown-menu dropdown-menu-lg dropdown-menu-end py-0"
								aria-labelledby="alertsDropdown">
								<div class="dropdown-menu-header">
									4 New Notifications
								</div>
								<div class="list-group">
									<a href="#" class="list-group-item">
										<div class="row g-0 align-items-center">
											<div class="col-2">
												<i class="text-danger" data-feather="alert-circle"></i>
											</div>
											<div class="col-10">
												<div class="text-dark">Update completed</div>
												<div class="text-muted small mt-1">Restart server 12 to complete the
													update.</div>
												<div class="text-muted small mt-1">30m ago</div>
											</div>
										</div>
									</a>
									<a href="#" class="list-group-item">
										<div class="row g-0 align-items-center">
											<div class="col-2">
												<i class="text-warning" data-feather="bell"></i>
											</div>
											<div class="col-10">
												<div class="text-dark">Lorem ipsum</div>
												<div class="text-muted small mt-1">Aliquam ex eros, imperdiet vulputate
													hendrerit et.</div>
												<div class="text-muted small mt-1">2h ago</div>
											</div>
										</div>
									</a>
									<a href="#" class="list-group-item">
										<div class="row g-0 align-items-center">
											<div class="col-2">
												<i class="text-primary" data-feather="home"></i>
											</div>
											<div class="col-10">
												<div class="text-dark">Login from 192.186.1.8</div>
												<div class="text-muted small mt-1">5h ago</div>
											</div>
										</div>
									</a>
									<a href="#" class="list-group-item">
										<div class="row g-0 align-items-center">
											<div class="col-2">
												<i class="text-success" data-feather="user-plus"></i>
											</div>
											<div class="col-10">
												<div class="text-dark">New connection</div>
												<div class="text-muted small mt-1">Christina accepted your request.
												</div>
												<div class="text-muted small mt-1">14h ago</div>
											</div>
										</div>
									</a>
								</div>
								<div class="dropdown-menu-footer">
									<a href="#" class="text-muted">Show all notifications</a>
								</div>
							</div>
						</li>
						<li class="nav-item dropdown">
							<a class="nav-icon dropdown-toggle" href="#" id="messagesDropdown"
								data-bs-toggle="dropdown">
								<div class="position-relative">
									<i class="align-middle" data-feather="message-square"></i>
								</div>
							</a>
							<div class="dropdown-menu dropdown-menu-lg dropdown-menu-end py-0"
								aria-labelledby="messagesDropdown">
								<div class="dropdown-menu-header">
									<div class="position-relative">
										4 New Messages
									</div>
								</div>
								<div class="list-group">
									<a href="#" class="list-group-item">
										<div class="row g-0 align-items-center">
											<div class="col-2">
												<img src="img/avatars/avatar-5.jpg"
													class="avatar img-fluid rounded-circle" alt="Vanessa Tucker">
											</div>
											<div class="col-10 ps-2">
												<div class="text-dark">Vanessa Tucker</div>
												<div class="text-muted small mt-1">Nam pretium turpis et arcu. Duis arcu
													tortor.</div>
												<div class="text-muted small mt-1">15m ago</div>
											</div>
										</div>
									</a>
									<a href="#" class="list-group-item">
										<div class="row g-0 align-items-center">
											<div class="col-2">
												<img src="img/avatars/avatar-2.jpg"
													class="avatar img-fluid rounded-circle" alt="William Harris">
											</div>
											<div class="col-10 ps-2">
												<div class="text-dark">William Harris</div>
												<div class="text-muted small mt-1">Curabitur ligula sapien euismod
													vitae.</div>
												<div class="text-muted small mt-1">2h ago</div>
											</div>
										</div>
									</a>
									<a href="#" class="list-group-item">
										<div class="row g-0 align-items-center">
											<div class="col-2">
												<img src="img/avatars/avatar-4.jpg"
													class="avatar img-fluid rounded-circle" alt="Christina Mason">
											</div>
											<div class="col-10 ps-2">
												<div class="text-dark">Christina Mason</div>
												<div class="text-muted small mt-1">Pellentesque auctor neque nec urna.
												</div>
												<div class="text-muted small mt-1">4h ago</div>
											</div>
										</div>
									</a>
									<a href="#" class="list-group-item">
										<div class="row g-0 align-items-center">
											<div class="col-2">
												<img src="img/avatars/avatar-3.jpg"
													class="avatar img-fluid rounded-circle" alt="Sharon Lessman">
											</div>
											<div class="col-10 ps-2">
												<div class="text-dark">Sharon Lessman</div>
												<div class="text-muted small mt-1">Aenean tellus metus, bibendum sed,
													posuere ac, mattis non.</div>
												<div class="text-muted small mt-1">5h ago</div>
											</div>
										</div>
									</a>
								</div>
								<div class="dropdown-menu-footer">
									<a href="#" class="text-muted">Show all messages</a>
								</div>
							</div>
						</li>
						<li class="nav-item dropdown">
							<a class="nav-icon dropdown-toggle d-inline-block d-sm-none" href="#"
								data-bs-toggle="dropdown">
								<i class="align-middle" data-feather="settings"></i>
							</a>

							<a class="nav-link dropdown-toggle d-none d-sm-inline-block" href="#"
								data-bs-toggle="dropdown">
								<img src="img/avatars/avatar.jpg" class="avatar img-fluid rounded me-1"
									alt="Charles Hall" /> <span class="text-dark">Charles Hall</span>
							</a>
							<div class="dropdown-menu dropdown-menu-end">
								<a class="dropdown-item" href="pages-profile.html"><i class="align-middle me-1"
										data-feather="user"></i> Profile</a>
								<a class="dropdown-item" href="#"><i class="align-middle me-1"
										data-feather="pie-chart"></i> Analytics</a>
								<div class="dropdown-divider"></div>
								<a class="dropdown-item" href="index.html"><i class="align-middle me-1"
										data-feather="settings"></i> Settings & Privacy</a>
								<a class="dropdown-item" href="#"><i class="align-middle me-1"
										data-feather="help-circle"></i> Help Center</a>
								<div class="dropdown-divider"></div>
								<a class="dropdown-item" href="AdminLogin.php">Log out</a>
							</div>
						</li>
					</ul>
				</div>
			</nav>

			<main class="content ">
				<div class="d-flex align-items-center justify-content-between mb-3">
					<script>
						$(document).ready(function () {
							$('#search_submit').on('click', function (e) {
								e.preventDefault(); // prevent the default link behavior
								var search = $('#search_input').val();
								$.ajax({
									url: 'livraison.php', // replace with the correct URL for handling the search request
									type: 'POST',
									data: { search: search },
									success: function (response) {
										var productList = $('.tbodyy');
										productList.empty(); // clear the existing products
										productList.append(response); // append the returned HTML string to the product list
									},
									error: function (xhr, status, error) {
										console.log(xhr.responseText);
									}
								});
							});
						});                   
					</script>


					<div class="input-group" style="width: 300px !important;">
						<input type="text" class="form-control" placeholder="Search" name="search_input"
							id="search_input">
						<div class="input-group-append">
							<button class="btn btn-outline-secondary" type="submit" name="search_submit"
								id="search_submit">
								<i class="fas fa-search"></i>
							</button>
						</div>

					</div>
					<button class="btn btn-primary rounded-circle" id="open-popup-Admin" class="" type="button" style="
						font-size: 1rem;
						padding: 3px !important;
						width: 33px;
						height: 33px;
						border-radius: 50%;
						">
						<i class="fas fa-plus"></i>
					</button>

					<div id="popup-container-Admin" class="popup-container-Admin" style="width: 28%;">
						<a href="livraison.php" id="close-popup-Admin"><i class="fas fa-times"></i></a>
						<div id="popup-content-Admin" class="" style="max-height: 570px;">
							<h4 class="model-titel">Add a new Livraison </h4>
							<form method="post" action="">
								<label for="idCommande">idCommande:</label>
								<input type="number" placeholder="" id="idCommande" name="idCommande" required>

								<label for="idlivreur">idlivreur:</label>
								<input type="number" placeholder="" id="idlivreur" name="idlivreur" required>

								<label for="nomcomplet">Nom Complet:</label>
								<input type="text" placeholder="" id="nomcomplet" name="nomcomplet" required>

								<label for="adresse">Adresse:</label>
								<input type="text" placeholder="" id="adresse" name="adresse" required>

								<label for="ville">Ville :</label>
								<input type="text" id="ville" name="ville" required>

								<label for="codepostal">Code postal:</label>
								<input type="number" placeholder="" id="codepostal" name="codepostal" required
									oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);"
									maxlength="4">

								<label for="pays">Pays:</label>
								<input type="text" placeholder="" id="pays" name="pays" required>

								<div class="d-flex align-items-center justify-content-between mb-3  ">
									<a href="livraison.php" class="btn btn-secondary btn-block mt-3"
										style="border-radius: 5px;">Cancel</a>
									<button type="submit" name="submit" id="submit"
										class="btn btn-primary btn-block mt-3" style="border-radius: 5px;">Add</button>
									<input type="hidden" id="updating" name="updating">
								</div>
							</form>
						</div>
					</div>
					<div id="popup-overlay-Admin" class="popup-overlay-Admin"></div>
				</div>
				<script src="js/script-popup-product.js"></script>

				<div class="container-fluid p-0">

					<div class="row">
						<div class="col-12 d-flex">
							<div class="card flex-fill">
								<div class="card-header">

									<h5 class="card-title mb-0">Latest Projects</h5>

								</div>
								<script src="script123.js"></script>
								<table class="table table-striped table-hover ">
									<thead>
										<tr>
											<th>id Livraison</th>
											<th>id commande </th>
											<th>livreur </th>
											<th>nom complet</th>
											<th>adresse </th>
											<th>ville</th>
											<th>codepostal </th>
											<th>pays</th>
											<th>Actions</th>
										</tr>
									</thead>
									<tbody class="tbodyy">
										<?php foreach ($liste as $row) { ?>
											<tr>
												<td>
													<span class="badge bg-danger">
														<?php echo $row["idlivraison"]; ?>
													</span>
												</td>
												<td>
													<?php echo $row['idcommande']; ?>
												</td>
												<td>
													<?php echo $row['name']; ?>
												</td>
												<td>
													<?php echo $row['nomcomplet']; ?>
												</td>
												<td>
													<?php echo $row['adresse']; ?>
												</td>
												<td>
													<?php echo $row['ville']; ?>
												</td>
												<td>
													<?php echo $row['codepostal']; ?>
												</td>
												<td>
													<?php echo $row['pays']; ?>
												</td>

												<td>
													<a href="livraison.php?update=<?= $row["idlivraison"]; ?>"
														style="margin:10px;" class="btn btn-primary open-popup-ElseWhere"
														name="modify" id="update-button">Modify</a>
													<a href="livraison.php?delete=<?= $row["idlivraison"]; ?>"
														style="margin: 10px;" class="btn btn-danger"
														name="delete">Delete</a>
												</td>
											</tr>
										<?php } ?>
									</tbody>
								</table>
							</div>

						</div>

			</main>


			<?php
			$select = $pdo->query("SELECT * FROM notif ORDER BY notif_id DESC");
			$count = $select->rowCount();
			?>

			<div class="notifi-box" id="box">
				<h2>Notifications <span>
						<?php echo $count; ?>
					</span></h2>
				<?php for ($i = 0; $i < $count; $i++) {
					$row = $select->fetch(PDO::FETCH_ASSOC);
					?>
					<div class="notifi-item">
						<img src="1.jpeg" alt="img">
						<div class="text">
							<h4>mehrez bassoumi</h4>
							<p>
								<?php echo $row['message']; ?>
							</p>
						</div>
					</div>
				<?php } ?>
			</div>









			<footer class="footer">
				<div class="container-fluid">
					<div class="row text-muted">
						<div class="col-6 text-start">
							<p class="mb-0">
								<a class="text-muted" href="https://adminkit.io/"
									target="_blank"><strong>AdminKit</strong></a> - <a class="text-muted"
									href="https://adminkit.io/" target="_blank"><strong><?php echo $_SESSION['idAdmin'];?></strong></a> &copy;
							</p>
						</div>
						<div class="col-6 text-end">
							<ul class="list-inline">
								<li class="list-inline-item">
									<a class="text-muted" href="https://adminkit.io/" target="_blank">Support</a>
								</li>
								<li class="list-inline-item">
									<a class="text-muted" href="https://adminkit.io/" target="_blank">Help Center</a>
								</li>
								<li class="list-inline-item">
									<a class="text-muted" href="https://adminkit.io/" target="_blank">Privacy</a>
								</li>
								<li class="list-inline-item">
									<a class="text-muted" href="https://adminkit.io/" target="_blank">Terms</a>
								</li>
							</ul>
						</div>
					</div>
				</div>
			</footer>
		</div>
	</div>
	<script src="js/app.js"></script>
	<script src="script123.js"></script>



</body>

</html>



<?php
if (isset($_GET['update'])) {
	$id = $_GET['update'];
	echo '<script>
    const updating = document.querySelector("#updating");
    updating.value = "' . $id . '";

	const modelTitel=document.querySelector(".model-titel");
	modelTitel.innerHTML="Update livraison";

	const updateSubmit=document.querySelector("#submit");
	updateSubmit.innerHTML="Update";



	setTimeout(() => {
        popupContainerAdmin.style.opacity = "0";
        popupContainerAdmin.style.transform="translate(-50%, -50%) scale(0)";
        popupContainerAdmin.style.display = "block";
        popupOverlayAdmin.style.display = "block";
        // Add an animation to the popup window using CSS transitions
        setTimeout(() => {
            popupContainerAdmin.style.opacity = "1";
            popupContainerAdmin.style.transform="translate(-50%, -50%) scale(1)";
        }, 200); // Wait for 50ms before starting the animation
    }, 200);
    
    </script>';

}
?>