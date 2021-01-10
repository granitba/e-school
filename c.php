<?php
include "include/head.php";
include "include/navbar.php";
?>

<!DOCTYPE html>
<html>
<head>
	<title>Contat-Page</title>
	<link href="assets/css/s.css" rel="stylesheet">
	<link href="assets/css/main.css" rel="stylesheet">
	<script src="assets/js/contact.js"></script>
</head>
<body>
	<div class="c-container">
		<div class="row">
				<h1>NA KONTAKTONI</h1>
		</div>
		<div class="row">
				<h4 style="text-align:center">Nëse keni ndonjë pyetje ose keni nevojë për informata të mëtejshme, ju lutemi na kontaktoni!</h4>
		</div>
		<div class="row input-c-container">
			<div class="col-xs-12">
				<div class="styled-input wide">
					<input type="text" required />
					<label>Emri dhe Mbiemri</label> 
				</div>
			</div>
			<div class="col-md-6 col-sm-12">
				<div class="styled-input">
					<input type="email" required />
					<label>E-Mail-Adresa</label> 
				</div>
			</div>
			<div class="col-md-6 col-sm-12">
				<div class="styled-input" style="float:right;">
					<input type="number" required />
					<label>Numri i Telefonit</label>
				</div>
			</div>
			<div class="col-xs-12">
				<div class="styled-input wide">
					<textarea required></textarea>
					<label>Mesazhi</label>
				</div>
			</div>
			<div class="col-xs-12">
				<div class="btn-lrg submit-btn">Dergo Mesazhin</div>
			</div>
		</div>
	</div>
</body>
</html>