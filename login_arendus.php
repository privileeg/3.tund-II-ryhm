
<?php             //täpitähtede jaoks ülevalt Encoding ja convert to UTF-8

	require("../../config.php");  //läheb sinna faili ja kopeerib sisu siia
	//echo hash("sha512", "Andres");

	
	
	
	
	
	
	
	
	
	//echo "<br>";
	//var_dump ($_POST);   var_dump näitab tüüpi 
	//GET ja POSTi muutujad .. GET - avalik url , POST - varjatud url
	//var_dump ($_GET);ja väärtust . NT 5.5 = float

	
	//MUUTUJAD
	$signupEmailError = "";
	$signupPasswordError = "";
	$signupEmail = ""; //annan mingi väärtuse
	$signupGender = "";
	
	// on üldse olemas selline muutuja
	if(isset($_POST["signupEmail"])){    
	
		//jah on olemas
		//kas on tühi
		if(empty($_POST["signupEmail"])){
			
			echo "email on tühi"; 
			// siia jõuab siis kas muutuja on üldse olemas ja kas tühi
			
				$signupEmailError = "E-post on kohustuslik";
			
		}else{	
			//email on olemas	
			$signupEmail = $_POST["signupEmail"];
			
			
	
		}

	}		
	
	
	if(isset($_POST["signupPassword"])){    
	
		
		if(empty($_POST["signupPassword"])){
			
			echo "parool on tühi";
			
			
				$signupPasswordError = "Parool on kohustuslik";
			
		}else{
			
			//siia jõuan siis kui parool oli olemas
			//parool ei olnud tühi
			
			if ( strlen($_POST["signupPassword"]) < 8 ) {                           //strlen tähendab stringi pikkust, antud juhul alla 8 on error
				$signupPasswordError = "Parooli pikkus peab olema vähemalt 8 tähemärki ";

			}
				
		}

	}		

	$signupEesnimiError = "";
	$signupPerekonnanimiError = "";
	
	if(isset($_POST["signupEesnimi"])){
		
		if(empty($_POST["signupEesnimi"])){
			
			echo "eesnimi on tühi"; 
		
			$signupEesnimiError = "Eesnimi on kohustuslik";
		
		
		
		}
	}

	if(isset($_POST["signupPerekonnanimi"])){
		
		if(empty($_POST["signupPerekonnanimi"])){
			
			echo "perekonnanimi on tühi"; 
		
			$signupPerekonnanimiError = "Perekonnanimi on kohustuslik";
		
		
		
		}
	}
	
	// GENDER
	if( isset( $_POST["signupGender"] ) ){
		
		if(!empty( $_POST["signupGender"] ) ){
		
			$signupGender = $_POST["signupGender"];
			
		}
		
	} 
	
	
	//et salvestada, peame siin teadma et pole olnud erroreid.peab olema email ja parool
	//kui kuskil on viga, siis edasi ei minda selle juurest
		if ( isset($_POST["signupEmail"]) && 
		 isset($_POST["signupPassword"]) && 
		 $signupEmailError == "" && 
		 empty($signupPasswordError)
		) {
		
			// salvestame andmebaasi
			echo "Salvestan... <br>";
			
			echo "email: ".$signupEmail."<br>";
			echo "password: ".$_POST["signupPassword"]."<br>";
			
			$password = hash("sha512", $_POST["signupPassword"]);
			
			echo "password hashed: ".$password."<br>";
			
			//echo $serverUsername;
			
			// ÜHENDUS
			$database = "if16_andralla";
			$mysqli = new mysqli($serverHost, $serverUsername, $serverPassword, $database);
			
			
			// meie serveris nagunii 
			if ($mysqli->connect_error) {
				die('Connect Error: ' . $mysqli->connect_error);
			}
			
			
			
			//sqli rida
			$stmt = $mysqli->prepare("INSERT INTO user_sample(email, password) VALUES (?, ?)");
			
			echo $mysqli->error;
			
			//stringina üks täht iga muutuja kohta, mis tüüp
			//string - s
			//integer - i
			//float (double) - d 
			//küsimärgid asendada muutajaga 
			
			$stmt->bind_param("ss", $signupEmail, $password);
			
			//täida käsku
			
			if($stmt->execute()){
				
				echo "salvestamine õnnestus";
				
			} else {
				echo "ERROR".$stmt->error;

				//panen ühenduse kinni		
				$stmt->close();	
				$mysqli->close();
				
					
			}
		}
	
	
	
	
	
	
	
	
	
?>




<!DOCTYPE html>
<html>
<head>
<title>Logi sisse või loo kasutaja</title>
</head>
<!--See on 1 viis kuidas tausta tooni lisada  <body //style="background-color:powderblue;">  -->
	
	
	<h1>Logi sisse</h1> 
	
	<form method="POST"> <!--POST ei kuva paroole ega asju URL'is-->               
	
		
		<input name="loginEmail" placeholder="E-post"	type="text">
		<br><br>
		<!-- "placeholder" kuvab teksti kasti sisse -->
		<input name="loginPassword" placeholder="Parool" type="password">
		<br><br>
		<input type="submit" value="Logi sisse">
	
	
	</form>

	
<h1>Loo kasutaja</h1>    
	<form method="POST"> <!--POST ei kuva paroole ega asju URL'is-->               
	
		
		<input name="signupEmail" placeholder="E-post" type="text" value="<?=$signupEmail;?>" > <?php echo $signupEmailError;?>
		
		<br><br>
		
		<input type="password" placeholder="Parool" name="signupPassword"> <?php echo $signupPasswordError; ?>
		<br><br>	
						
		<input name="signupEesnimi" placeholder="Eesnimi" type="text"> <?php echo $signupEesnimiError;?>
		<br><br>
			
		<input name="signupPerekonnanimi" placeholder="Perekonnanimi" type="text"> <?php echo $signupPerekonnanimiError;?>
		<br>
			
			
				<?php if($signupGender == "male") { ?>
			
					<input type="radio" name="signupGender" value="male" checked> Male<br>
				<?php }else{ ?>
					<input type="radio" name="signupGender" value="male"> Male<br>
				<?php } ?>
					
					
				<?php if($signupGender == "female") { ?>
			
					<input type="radio" name="signupGender" value="female" checked> Female<br>
				<?php }else{ ?>
					<input type="radio" name="signupGender" value="female"> Female<br>
				<?php } ?>
				
				
				<?php if($signupGender == "other") { ?>
			
					<input type="radio" name="signupGender" value="other" checked> Other<br>
				<?php }else{ ?>
					<input type="radio" name="signupGender" value="other"> Other<br>
				<?php } ?>
				
			
			
			
			
			
			<br><br>
					



					
			<input name="signupLinn" placeholder="Linn" type="text">
			<br><br>
					
			<input name="signupTänav" placeholder="Tänav" type="text">
			<br><br>
			
			
			

		<input type="submit" value="Registreeru">
	
	
	</form>
	
	
</body>
</html>