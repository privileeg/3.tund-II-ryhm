
<?php             //täpitähtede jaoks ülevalt Encoding ja convert to UTF-8

	//GET ja POSTi muutujad
	//var_dump ($_GET);
	//echo "<br>";
	//var_dump ($_POST);

	$signupEmailError = "";
	$signupPasswordError = "";

	// on üldse olemas selline muutuja
	if(isset($_POST["signupEmail"])){    
	
		//jah on olemas
		//kas on tühi
		if(empty($_POST["signupEmail"])){
			
			echo "email on tühi"; 
			// siia jõuab siis kas muutuja on üldse olemas ja kas tühi
			
				$signupEmailError = "E-post on kohustuslik";
			
		}

	}		
	
	
	
	if(isset($_POST["signupPassword"])){    
	
		
		if(empty($_POST["signupPassword"])){
			
			echo "parool on tühi";
			
			
				$signupPasswordError = "Parool on kohustuslik";
			
		}else{
			
			//siia jõuan siis kui parool oli olemas
			//parool ei olnud tühi
			
			if ( strlen($_POST["signupPassword"]) < 8 ) {
				$signupPasswordError = "Parooli pikkus peab olema vähemalt 8 tähemärki ";

			}
				
		}

	}		

?>

<?php

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







?>


<!DOCTYPE html>
<html>
<head>
<title>Logi sisse või loo kasutaja</title>
</head>
<body style="background-color:powderblue;">   <!--See on 1 viis kuidas tausta tooni lisada-->
	
	
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
	
		
		<input name="signupEmail" placeholder="E-post" type="text"> 
		
		<?php echo $signupEmailError;?>
		
		<br><br>
		
		<input type="password" placeholder="Parool" name="signupPassword"> 
		
			<?php echo $signupPasswordError; ?>
		<br><br>	
		
		
		
			<input name="signupEesnimi" placeholder="Eesnimi" type="text">
			
			<?php echo $signupEesnimiError;?>
			<br><br>
			
			<input name="signupPerekonnanimi" placeholder="Perekonnanimi" type="text">
			
			<?php echo $signupPerekonnanimiError;?>
			<br>
			
			<h4>Sugu</h4>
				<input type="radio" name="Sugu" value="Mees" checked> Mees<br>
				<input type="radio" name="Sugu" value="Naine"> Naine<br>
				<input type="radio" name="Sugu" value="Muu"> Muu
			
			<br><br>
			
			
			
			<select>
				<option value="Lääne-Virumaa">Lääne-Virumaa</option>
				<option value="Harjumaa">Harjumaa</option>
				<option value="Ida-Virumaa">Ida-Virumaa</option>
				<option value="Järvamaa">Järvamaa</option>
				<option value="Läänemaa">Läänemaa</option>
				<option value="Põlvamaa">Põlvamaa</option>
				<option value="Võrumaa">Võrumaa</option>
				<option value="Viljandimaa">Viljandimaa</option>
				<option value="Hiiumaa">Hiiumaa</option>
				<option value="Raplamaa">Raplamaa</option>
				<option value="Saaremaa">Saaremaa</option>
				<option value="Jõgevamaa">Jõgevamaa</option>
				<option value="Pärnumaa">Pärnumaa</option>
				<option value="Tartumaa">Tartumaa</option>
				<option value="Valgamaa">Valgamaa</option>
			
			</select>
			<br><br>
			
			
			
			<input name="signupLinn" placeholder="Linn" type="text">
			<br><br>
					
			<input name="signupTänav" placeholder="Tänav" type="text">
			<br><br>
			
			
			

		<input type="submit" value="Registreeru">
	
	
	</form>
	
	
</body>
</html>