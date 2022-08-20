<link rel="stylesheet" href="asd.css">
<?php
include 'menu.php';


echo '<h1>Lekérdezések</h1><br>'; // főcím kiíratása
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


    //1.

    $sql = "SELECT * FROM `aru` ORDER BY súly DESC LIMIT 1;"; // ez csak egy string, még nem hajtódik végre
    $res = mysqli_query($conn, $sql) or die ('Hibás utasítás!'); // végrehajtjuk az SQL utasítást

    // html táblázatként íratjuk ki;
    echo '<p>A raktárban tárolt legnehezebb áru adatai:</p><br>'; // lekérdezés kiíratása
    echo '<table border=1>';
    echo '<tr>';			// táblázat fejléce
    echo '<th>ID</th>';
    echo '<th>név</th>';
    echo '<th>tulajdonos</th>';
    echo '<th>súly</th>';
    echo '</tr>';

    // a táblázat sorai
    while ( ($current_row = mysqli_fetch_assoc($res))!= null) {	// most asszociatív tömbként kezeljük a sorokat
        echo '<tr>';
        echo '<td>' . $current_row["ID"] . '</td>';
        echo '<td>' . $current_row["név"] . '</td>';
        echo '<td>' . $current_row["tulajdonos"] . '</td>';
        echo '<td>' . $current_row["súly"] . '</td>';
        echo '</tr>';
    }
    echo '</table>';

    //2.
    $sql = "SELECT dolgozó.név, vezet.alvázszám FROM `dolgozó`, vezet WHERE dolgozó.Kártyaszám=vezet.kártyaszám GROUP BY név LIMIT 10;"; // ez csak egy string, még nem hajtódik végre
    $res = mysqli_query($conn, $sql) or die ('Hibás utasítás!'); // végrehajtjuk az SQL utasítást

    // html táblázatként íratjuk ki;
    echo '<p>Az első tíz dolgozó neve abc-sorrendben és az általuk vezetett targoncák:</p><br>'; // lekérdezés kiíratása
    echo '<table border=1>';
    echo '<tr>';			// táblázat fejléce
    echo '<th>név</th>';
    echo '<th>alvázszám</th>';
    echo '</tr>';

    // a táblázat sorai
    while ( ($current_row = mysqli_fetch_assoc($res))!= null) {	// most asszociatív tömbként kezeljük a sorokat
        echo '<tr>';
        echo '<td>' . $current_row["név"] . '</td>';
        echo '<td>' . $current_row["alvázszám"] . '</td>';
        echo '</tr>';
    }
    echo '</table>';

    //3.
    $sql = "SELECT DISTINCT targonca.alvázszám, aru.név FROM `targonca`, aru, mozgat WHERE targonca.alvázszám=mozgat.alvázszám AND mozgat.ID=aru.ID LIMIT 3
;"; // ez csak egy string, még nem hajtódik végre
    $res = mysqli_query($conn, $sql) or die ('Hibás utasítás!'); // végrehajtjuk az SQL utasítást

    // html táblázatként íratjuk ki;
    echo '<p>Targoncák (első 3) alvázszáma a targonca táblából és az általuk mozgatott áruk neve az áruk táblából a mozgat sémán keresztül:</p><br>'; // lekérdezés kiíratása
    echo '<table border=1>';
    echo '<tr>';			// táblázat fejléce
    echo '<th>targonca alvázszáma</th>';
    echo '<th>mozgatott áru neve</th>';
    echo '</tr>';

    // a táblázat sorai
    while ( ($current_row = mysqli_fetch_assoc($res))!= null) {	// most asszociatív tömbként kezeljük a sorokat
        echo '<tr>';
        echo '<td>' . $current_row["alvázszám"] . '</td>';
        echo '<td>' . $current_row["név"] . '</td>';
        echo '</tr>';
    }
    echo '</table>';

    //4
    $sql = "SELECT AVG(súly) AS átlag, SUM(súly) AS összes_áru_súlya, COUNT(ID) AS 'összesáru',  MIN(súly) AS legkönnyebb FROM `aru` WHERE 1
;"; // ez csak egy string, még nem hajtódik végre
    $res = mysqli_query($conn, $sql) or die ('Hibás utasítás!'); // végrehajtjuk az SQL utasítást

    // html táblázatként íratjuk ki;
    echo '<p>A raktárban tárolt áruk súly adatai:</p><br>'; // lekérdezés kiíratása
    echo '<table border=1>';
    echo '<tr>';			// táblázat fejléce
    echo '<th>átlag súly</th>';
    echo '<th>összsúly</th>';
    echo '<th>összes tárolt áru db</th>';
    echo '<th>minimumsúly</th>';
    echo '</tr>';

    // a táblázat sorai
    while ( ($current_row = mysqli_fetch_assoc($res))!= null) {	// most asszociatív tömbként kezeljük a sorokat
        echo '<tr>';
        echo '<td>' . $current_row["átlag"] . '</td>';
        echo '<td>' . $current_row["összes_áru_súlya"] . '</td>';
        echo '<td>' . $current_row["összesáru"] . '</td>';
        echo '<td>' . $current_row["legkönnyebb"] . '</td>';
        echo '</tr>';
    }
    echo '</table>';

    //5
    //allekérdezéses
    $sql = "SELECT * FROM `aru` WHERE súly > (SELECT AVG(súly) FROM aru)
;"; // ez csak egy string, még nem hajtódik végre
    $res = mysqli_query($conn, $sql) or die ('Hibás utasítás!'); // végrehajtjuk az SQL utasítást

    // html táblázatként íratjuk ki;
    echo '<p>A raktárban tárolt átlagánál nehezebb áruk adatai:</p><br>'; // lekérdezés kiíratása
    echo '<table border=1>';
    echo '<tr>';			// táblázat fejléce
    echo '<th>ID</th>';
    echo '<th>név</th>';
    echo '<th>tulajdonos</th>';
    echo '<th>súly</th>';
    echo '</tr>';

    // a táblázat sorai
    while ( ($current_row = mysqli_fetch_assoc($res))!= null) {	// most asszociatív tömbként kezeljük a sorokat
        echo '<tr>';
        echo '<td>' . $current_row["ID"] . '</td>';
        echo '<td>' . $current_row["név"] . '</td>';
        echo '<td>' . $current_row["tulajdonos"] . '</td>';
        echo '<td>' . $current_row["súly"] . '</td>';
        echo '</tr>';
    }
    echo '</table>';

    mysqli_free_result($res);	// felszabadítjuk a lefoglalt memóriát
} else {									// nem sikerült csatlakozni az adatbázishoz
    die('Nem sikerült csatlakozni az adatbázishoz.');
}

mysqli_close($conn);

?>