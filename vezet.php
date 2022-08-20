<link rel="stylesheet" href="asd.css">
<?php
include 'menu.php';


echo '<h1>Targoncák és használóik</h1><br>'; // főcím kiíratása
echo menu();

// csatlakozás az adatbázishoz
$conn = mysqli_connect('localhost', 'root','','raktar') or die("Hibás csatlakozás!");

// a karakterek helyes megjelenítése miatt be kell állítani a karakterkódolást!
mysqli_query($conn, 'SET NAMES UTF-8');
mysqli_query($conn, "SET character_set_results=utf8");
mysqli_set_charset($conn, 'utf-8');


if($_SERVER['REQUEST_METHOD']=='POST'){



}

echo '<hr/>';

if ( mysqli_select_db($conn, 'raktar') ) {	// ha sikeres az adatbázis kiválasztása


    // lekérdezzük a városokat a "varosok" táblából

    $sql = "SELECT * FROM vezet"; // ez csak egy string, még nem hajtódik végre
    $res = mysqli_query($conn, $sql) or die ('Hibás utasítás!'); // végrehajtjuk az SQL utasítást

    // html táblázatként íratjuk ki;
    echo '<table border=1>';
    echo '<tr>';			// táblázat fejléce
    echo '<th>alvázszám</th>';
    echo '<th>kártyaszám</th>';
    echo '</tr>';

    // a táblázat sorai
    while ( ($current_row = mysqli_fetch_assoc($res))!= null) {	// most asszociatív tömbként kezeljük a sorokat
        echo '<tr>';
        echo '<td>' . $current_row["alvázszám"] . '</td>';
        echo '<td>' . $current_row["Kártyaszám"] . '</td>';
        echo '</tr>';
    }
    echo '</table>';

    mysqli_free_result($res);	// felszabadítjuk a lefoglalt memóriát
} else {									// nem sikerült csatlakozni az adatbázishoz
    die('Nem sikerült csatlakozni az adatbázishoz.');
}

mysqli_close($conn);

?>