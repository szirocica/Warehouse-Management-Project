<link rel="stylesheet" href="asd.css">
<?php
	include 'menu.php';
		
	
	echo '<h1>targonca tabla</h1><br>'; // főcím kiíratása
	echo menu();
	
	// csatlakozás az adatbázishoz
	$conn = mysqli_connect('localhost', 'root','','raktar') or die("Hibás csatlakozás!");
	
	// a karakterek helyes megjelenítése miatt be kell állítani a karakterkódolást!
	mysqli_query($conn, 'SET NAMES UTF-8');
	mysqli_query($conn, "SET character_set_results=utf8");
	mysqli_set_charset($conn, 'utf-8');
	
	
	if($_SERVER['REQUEST_METHOD']=='POST'){
		//felülírás
		if(isset($_POST["kit"])){
			$kod = $_POST["alvázszám"];
			$uze = $_POST["üzemanyag"];
			$kit=$_POST["kit"];
			
			$stmt = mysqli_prepare($conn,"update targonca set alvázszám=?,üzemanyag=? WHERE alvázszám= ?");
			mysqli_stmt_bind_param($stmt,"isi", $kod, $uze, $kit);
			mysqli_stmt_execute($stmt);
			
			
		}
			
			
		//beszúrás
		if(isset($_POST["uj"])){
			$kod = $_POST["alvázszám"];
			$uze = $_POST["üzemanyag"];
			
			$stmt = mysqli_prepare($conn,"INSERT INTO targonca (alvázszám,üzemanyag) VALUES (? , ?);");
			if ($uze == "") { // <== ha nincs megadva üzemanyag
					$uze = "nem ismert";
				}
			mysqli_stmt_bind_param($stmt,"is", $kod, $uze);
			mysqli_stmt_execute($stmt);
			
			
		}
		//törlés
		if(isset($_POST["torles"])){
			$torles= $_POST["torles"];
			$stmt = mysqli_prepare($conn,"delete from targonca  where alvázszám= ?;");
			mysqli_stmt_bind_param($stmt,"i", $torles);
			mysqli_stmt_execute($stmt);
		}
		
		

	}
	
	echo '<hr/>';
		
		echo '<h2>Új targonca</h2>';
		echo '<form method="POST" action="targonca.php">'; 
		echo '<table>';
		echo '<tr><td></td> <td><input type="hidden" name="uj"/></td></tr>';
		echo '<tr><td>alvázszám:</td> <td><input type="text" name="alvázszám"/></td></tr>';
		echo '<tr><td>üzemanyag:</td> <td><input type="text" name="üzemanyag"/></td></tr>';
		echo '<tr><td></td> <td><input type="submit" value="Hozzáad"/></td></tr>';
		echo '</table>';
		echo '</form>';
		
		echo '<h2>torles</h2>';
		echo '<form method="POST" action="targonca.php">'; 
		echo '<table>';
		echo '<tr><td>alvázszám:</td> <td><input type="text" name="torles"/></td></tr>';
		echo '<tr><td></td> <td><input type="submit" value="torol"/></td></tr>';
		echo '</table>';
		echo '</form>';
	
		echo '<h2>update</h2>';
		echo '<form method="POST" action="targonca.php">'; 
		echo '<table>';
		echo '<tr><td></td> <td><input type="hidden" name="update"/></td></tr>';
		echo '<tr><td>alvázszám:</td> <td><input type="text" name="alvázszám"/></td></tr>';
		echo '<tr><td>üzemanyag:</td> <td><input type="text" name="üzemanyag"/></td></tr>';
		echo '<tr><td>kit:</td> <td><input type="text" name="kit"/></td></tr>';
		echo '<tr><td></td> <td><input type="submit" value="update"/></td></tr>';
		echo '</table>';
		echo '</form>';
	
	if ( mysqli_select_db($conn, 'raktar') ) {	// ha sikeres az adatbázis kiválasztása
	
		
		// lekérdezzük a városokat a "varosok" táblából
		
		$sql = "SELECT * FROM targonca"; // ez csak egy string, még nem hajtódik végre
		$res = mysqli_query($conn, $sql) or die ('Hibás utasítás!'); // végrehajtjuk az SQL utasítást
		 
		// html táblázatként íratjuk ki;
		echo '<table border=1>';
		echo '<tr>';			// táblázat fejléce
		echo '<th>alvázszám</th>';		
		echo '<th>üzemanyag</th>';
		echo '</tr>';
		
		// a táblázat sorai
		while ( ($current_row = mysqli_fetch_assoc($res))!= null) {	// most asszociatív tömbként kezeljük a sorokat
			echo '<tr>';
			echo '<td>' . $current_row["alvázszám"] . '</td>';
			echo '<td>' . $current_row["üzemanyag"] . '</td>';
			echo '</tr>';
		}
		echo '</table>';
		
		mysqli_free_result($res);	// felszabadítjuk a lefoglalt memóriát
	} else {									// nem sikerült csatlakozni az adatbázishoz
		die('Nem sikerült csatlakozni az adatbázishoz.');
	}

	mysqli_close($conn);

?>