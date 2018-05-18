<?php require 'server.php' ?>


<!--
		By
			Rahul Gautham Putcha		1PE15IS079
			Pawan Terdal			1PE15IS073


		To Be Completed
		---------------
		Content Wise Scripting		-	COMPLETED
		Layout				-	COMPLETED
		Optimized Coding		-	COMPLETED (But Yet to Improve)
		Website Effects			-	ALMOST COMPLETED
							//Navigation Remaining
  -->
<!DOCTYPE html>
<html lang = "en">
	<head>
		<meta charset = "UTF-8">

		<title>
			The Parking System
		</title>
		<!--Icons-->
		<link rel="shortcut icon" href="./resources/images/images.ico" type="image/x-icon">
		<!------------------------CSS Includes Files------------------------>
		<link rel = "stylesheet" type = "text/css" href = "./resources/css/style.css">
		<link rel = "stylesheet" type = "text/css" href = "./resources/css/grid.css">
		<link rel = "stylesheet" type = "text/css" href = "./resources/css/normalize.css">

		<!------------------------J-Query Includes Files------------------------>
		<script src = "./resources/scripts/jquery.min.js"></script>
	</head>
	<body>
		<!------------------------Page 1 : Home------------------------>
		<header id = "Home">
			<!------Navigation Tab- 	 	----->
			<nav class = "row">

					<div class = "logo" style = "position : absolute;">
						<a href ="http://pesitsouth.pes.edu/" style = "text-decoration : none">
							<img src = "./resources/images/logo.jpg" width = 104px height = 104px>
						</a>
					</div>
				<div class = "navigation-links">
					<ul>
						<li class = "home">Home</li>
						<li class = "layout">Layout</li>
						<li class = "detail">Book Slot</li>
						<li class = "slot-preview">Slot Preview</li>
						<li class = "about">About</li>
					</ul>
				</div>
			</nav>
			<div class = "row header-textbox">
				<div>
					<h1>The Parking System</h1>
					<h5>Done By Pesit-Students</h5>
				</div>
			</div>
		</header>

		<!------------------------Page 3 : Layout------------------------>
		<section id = "Layout">
			<div><h2>Parking Layout</h2></div>
			<div id = "sheet"></div>

		</section>
		<!------------------------Page 4 : Details------------------------>
			<section id = "Details">
				<div><h2>Details</h2></div>
				<form name = "detail_form" method = "post" action = "front_end.php" style = "padding-left : 5%;" autocomplete="off">
						<div></div>
						<br>
						<div class = "row">
							<input type = "text" name = "state" id = "state" placeholder = "State">
							<input type = "number" name = "region_code" id = "region_code" placeholder = "Region Code">
							<input type = "text" name = "region" id = "region" placeholder = "Region">
							<input type = "number" name = "vehicle_reg_number" id = "vehicle_reg_number" placeholder = "Registration ID" required>
						</div>
						<br>
						<div class = "row">
							<input type = "text" name = "driver_name" id = "driver_name" placeholder = "Owner Name" required>
							<input type = "text" name = "driver_number" id = "driver_number" placeholder = "Phone No" required>
						</div>
						<br>
						<div class = "row">
							<input type = "radio" name = "vehicle_type" id = "vehicle_type" value = "car" checked> Car
							<input type = "radio" name = "vehicle_type" id = "vehicle_type" value = "bike"> Bike
							<input type = "radio" name = "vehicle_type" id = "vehicle_type" value = "other"> Others
						</div>
						<br>
						<div class = "row">
							<input class = "button" onclick = "onClickSubmit();" type = "submit" value = "Book Slot" name="send">
							<input class = "button" type = "button" onclick = "onClickReset();" value = "Reset">
						</div>
						</form>

					<div>
						<ul class = "decor-images">
							<li><figure><img src = "./resources/images/1.jpg"></figure></li>
							<li><figure><img src = "./resources/images/2.jpg"></figure></li>
							<li><figure><img src = "./resources/images/3.jpg"></figure></li>
							<li><figure><img src = "./resources/images/4.jpg"></figure></li>
							<li><figure><img src = "./resources/images/5.jpg"></figure></li>
						</ul>
					</div>
				</section>
				<!------------------------Page 2 : Slot_Preview------------------------>
				<section  id = "Slot-Preview">
					<div style = "margin:20;position : absolute;">
							  <form name = "form1" action="front_end.php" method="post">
												<input name = "get_slot_info" type = "text" id = "search_slot"   placeholder = "Search Slot"><br>
												<button id = "slot_search" class = "button" type = "submit" onclick = "noRefresh();" name = "slot_info_button">Get Info</button>
												<!--<button type="submit" class = "button" onclick = "#">Remove</div>-->
								</form>
					</div>
					<div style = "margin : 20px;margin-left : 75%;position : absolute;">

					<form name = "form2" method = "post" action = "front_end.php" style = "padding-left : 5%;">
							<input type = "text" id = "search_reg" name = "delete_vehicle_reg_number" placeholder = "Search Registration Number"><br>
							<div class = "button" onclick = "#">Search</div>
							<button type="submit" class = "button" onclick = "#" name="delete">Remove</button>
					</form>
					</div>
					<div><h2>Slot Preview</h2></div>
					<div class = "col span-1-of-5" style = "margin : 30px 0 0 0;">
						<div class = "button back-button">Back</div>
					</div>
					<div id = "slot-box" class = "col span-4-of-5" style = "margin : 0;">
					   	<p>
							Note : Slot is not able to do Selected yet.<br>
							Please Select one Slot<br>
							-> Goto <u class = "layout-chase" style = "color : green">Parking Layout</u><br>
							-> Select Existing Slot <br>
							   <strong>To Get the slot previewed in here</strong>
						</p>
					</div>
					<div class = "row decor-images2"></div>
				</section>

		<!------------------------Page 6 : About------------------------>
		<footer id = "About">
			<div class = "row">
			<div><h4>About us</h4></div>
				<div class = "col span-1-of-2" style = "margin : 10px auto;">
					<div class = "row logo" style = "float: left">
						<img src = "./resources/images/rahul.jpg" width = "100px" height = "100px">
					</div>
					<div style = "float : left;padding: 30px;">
						Rahul Gautham Putcha<br>
						1PE15IS079<br>
						<u>rahulgautham95@gmail.com</u><br>
					</div>
				</div>
				<div class = "col span-1-of-2" style = "margin : 10px auto;">
					<div class = "row logo" style = "float: left">
						<img src = "./resources/images/pawan.jpg" width = "100px" height = "100px">
					</div>
					<div style = "float : left;padding: 30px;">
						Pawan Terdal<br>
						1PE15IS073<br>
						<u>pterdal@gmail.com</u><br>
					</div>
				</div>
			</div>
		</footer>

		<!------------------------JavaScript Files------------------------>
		<script src = "./resources/scripts/jquery.js"></script>
		<script src = "script.js"></script>
	</body>
</html>
