<link rel="stylesheet" href="asd.css">
<?php
include 'menu.php';


echo '<h1>áru mozgások</h1><br>'; // főcím kiíratása
echo menu();

// csatlakozás az adatbázishoz
$conn = mysqli_connect('localhost', 'root','','raktar') or die("Hibás csatlakozás!");

// a karakterek helyes megjelenítése miatt be kell állítani a karakterkódolást!
mysqli_query($conn, 'SET NAMES UTF-8');
mysqli_query($conn, "SET character_set_results=utf8");
mysqli_set_charset($conn, 'utf-8');


if($_SERVER['REQUEST_METHOD']=='POST'){

    //törlés
    if(isset($_POST["torles"])){
        $torles= $_POST["torles"];
        $stmt = mysqli_prepare($conn,"delete from mozgat  where mikor= ?;");
        mysqli_stmt_bind_param($stmt,"s", $torles);
        mysqli_stmt_execute($stmt);
    }



}

echo '<hr/>';
echo '<h2>torles</h2>';
echo '<form method="POST" action="mozgat.php">';
echo '<table>';
echo '<tr><td>dátum:</td> <td><input type="text" name="torles"/></td></tr>';
echo '<tr><td></td> <td><input type="submit" value="torol"/></td></tr>';
echo '</table>';
echo '</form>';

if ( mysqli_select_db($conn, 'raktar') ) {	// ha sikeres az adatbázis kiválasztása


    // lekérdezzük a városokat a "varosok" táblából

    $sql = "SELECT * FROM mozgat"; // ez csak egy string, még nem hajtódik végre
    $res = mysqli_query($conn, $sql) or die ('Hibás utasítás!'); // végrehajtjuk az SQL utasítást

    // html táblázatként íratjuk ki;
    echo '<table border=1>';
    echo '<tr>';			// táblázat fejléce
    echo '<th>áru ID</th>';
    echo '<th>targonca alvázszáma</th>';
    echo '<th>dátum</th>';
    echo '</tr>';

    // a táblázat sorai
    while ( ($current_row = mysqli_fetch_assoc($res))!= null) {	// most asszociatív tömbként kezeljük a sorokat
        echo '<tr>';
        echo '<td>' . $current_row["ID"] . '</td>';
        echo '<td>' . $current_row["alvázszám"] . '</td>';
        echo '<td>' . $current_row["mikor"] . '</td>';
        echo '</tr>';
    }
    echo '</table>';

    mysqli_free_result($res);	// felszabadítjuk a lefoglalt memóriát
} else {									// nem sikerült csatlakozni az adatbázishoz
    die('Nem sikerült csatlakozni az adatbázishoz.');
}

mysqli_close($conn);

?>