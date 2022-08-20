<link rel="stylesheet" href="asd.css">
<?php
	include 'menu.php';
		
	
	echo '<h1>dolgozók tabla</h1><br>'; // főcím kiíratása
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
            $kartyaszam = $_POST["Kártyaszám"];
            $nev = $_POST["név"];
            $irszam = $_POST["irányítószám"];
            $beosztas = $_POST["beosztás"];
            $kit=$_POST["kit"];
            if ($nev == "") { // <== ha nincs megadva név
                $nev = "nem ismert";
            }
            if ($beosztas == "") { // <== ha nincs megadva beosztas
                $beosztas = "nem ismert";
            }
			$stmt = mysqli_prepare($conn,"update dolgozó set Kártyaszám=?,név=?, beosztás=?, irányítószám=? WHERE Kártyaszám= ?");
			mysqli_stmt_bind_param($stmt,"issii", $kartyaszam, $nev, $beosztas, $irszam, $kit);
			mysqli_stmt_execute($stmt);
			
			
		}
			
			
		//beszúrás
		if(isset($_POST["uj"])){
			$kartyaszam = $_POST["Kártyaszám"];
			$nev = $_POST["név"];
            $irszam = $_POST["irányítószám"];
            $beosztas = $_POST["beosztás"];
			
			$stmt = mysqli_prepare($conn,"INSERT INTO dolgozó (Kártyaszám,név, irányítószám, beosztás) VALUES (?, ?, ?, ?);");
			if ($nev == "") { // <== ha nincs megadva név
					$nev = "nem ismert";
				}
            if ($beosztas == "") { // <== ha nincs megadva beosztas
                $beosztas = "nem ismert";
            }
			mysqli_stmt_bind_param($stmt,"isis", $kartyaszam, $nev, $irszam, $beosztas);
			mysqli_stmt_execute($stmt);
			
			
		}
		//törlés
		if(isset($_POST["torles"])){
			$torles= $_POST["torles"];
			$stmt = mysqli_prepare($conn,"delete from dolgozó  where Kártyaszám= ?;");
			mysqli_stmt_bind_param($stmt,"i", $torles);
			mysqli_stmt_execute($stmt);
		}
		
		

	}
	
	echo '<hr/>';
		
		echo '<h2>Új dolgozó</h2>';
		echo '<form method="POST" action="dolgozok.php">';
		echo '<table>';
		echo '<tr><td></td> <td><input type="hidden" name="uj"/></td></tr>';
		echo '<tr><td>Kártyaszám:</td> <td><input type="text" name="Kártyaszám"/></td></tr>';
		echo '<tr><td>név:</td> <td><input type="text" name="név"/></td></tr>';
        echo '<tr><td>beosztás:</td> <td><input type="text" name="beosztás"/></td></tr>';
        echo '<tr><td>irányítószám:</td> <td><input type="text" name="irányítószám"/></td></tr>';
		echo '<tr><td></td> <td><input type="submit" value="Hozzáad"/></td></tr>';
		echo '</table>';
		echo '</form>';
		
		echo '<h2>torles</h2>';
		echo '<form method="POST" action="dolgozok.php">';
		echo '<table>';
		echo '<tr><td>Kártyaszám:</td> <td><input type="text" name="torles"/></td></tr>';
		echo '<tr><td></td> <td><input type="submit" value="torol"/></td></tr>';
		echo '</table>';
		echo '</form>';
	
		echo '<h2>update</h2>';
		echo '<form method="POST" action="dolgozok.php">';
		echo '<table>';
		echo '<tr><td></td> <td><input type="hidden" name="update"/></td></tr>';
		echo '<tr><td>Kártyaszám:</td> <td><input type="text" name="Kártyaszám"/></td></tr>';
        echo '<tr><td>név:</td> <td><input type="text" name="név"/></td></tr>';
        echo '<tr><td>beosztás:</td> <td><input type="text" name="beosztás"/></td></tr>';
        echo '<tr><td>irányítószám:</td> <td><input type="text" name="irányítószám"/></td></tr>';
		echo '<tr><td>kit:</td> <td><input type="text" name="kit"/></td></tr>';
		echo '<tr><td></td> <td><input type="submit" value="update"/></td></tr>';
		echo '</table>';
		echo '</form>';
	
	if ( mysqli_select_db($conn, 'raktar') ) {	// ha sikeres az adatbázis kiválasztása
	
		
		// lekérdezzük a városokat a "varosok" táblából
		
		$sql = "SELECT * FROM dolgozó"; // ez csak egy string, még nem hajtódik végre
		$res = mysqli_query($conn, $sql) or die ('Hibás utasítás!'); // végrehajtjuk az SQL utasítást
		 
		// html táblázatként íratjuk ki;
		echo '<table border=1>';
		echo '<tr>';			// táblázat fejléce
		echo '<th>Kártyaszám</th>';
		echo '<th>név</th>';
        echo '<th>beosztás</th>';
        echo '<th>irányítószám</th>';
		echo '</tr>';
		
		// a táblázat sorai
		while ( ($current_row = mysqli_fetch_assoc($res))!= null) {	// most asszociatív tömbként kezeljük a sorokat
			echo '<tr>';
			echo '<td>' . $current_row["Kártyaszám"] . '</td>';
			echo '<td>' . $current_row["név"] . '</td>';
            echo '<td>' . $current_row["beosztás"] . '</td>';
            echo '<td>' . $current_row["irányítószám"] . '</td>';
			echo '</tr>';
		}
		echo '</table>';
		
		mysqli_free_result($res);	// felszabadítjuk a lefoglalt memóriát
	} else {									// nem sikerült csatlakozni az adatbázishoz
		die('Nem sikerült csatlakozni az adatbázishoz.');
	}

	mysqli_close($conn);

?>