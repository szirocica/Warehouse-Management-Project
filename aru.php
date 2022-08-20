<link rel="stylesheet" href="asd.css">
<?php
include 'menu.php';


echo '<h1>áru tabla</h1><br>'; // főcím kiíratása
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
        $ID = $_POST["ID"];
        $nev = $_POST["név"];
        $tulajdonos = $_POST["tulajdonos"];
        $suly = $_POST["súly"];
        $kit=$_POST["kit"];
        $stmt = mysqli_prepare($conn,"update aru set ID=?,név=?, tulajdonos=?, súly=? WHERE ID= ?");
        mysqli_stmt_bind_param($stmt,"issii", $ID, $nev, $tulajdonos, $suly, $kit);
        mysqli_stmt_execute($stmt);


    }


    //beszúrás
    if(isset($_POST["uj"])){
        $ID = $_POST["ID"];
        $nev = $_POST["név"];
        $tulajdonos = $_POST["tulajdonos"];
        $suly = $_POST["súly"];

        if ($nev == "") { // <== ha nincs megadva név
            $nev = "nem ismert";
        }
        if ($tulajdonos == "") { // <== ha nincs megadva tulajdonos
            $tulajdonos = "nem ismert";
        }

        $stmt = mysqli_prepare($conn,"INSERT INTO aru (ID,név, tulajdonos, súly) VALUES (?, ?, ?, ?);");
        mysqli_stmt_bind_param($stmt,"issi", $ID, $nev, $tulajdonos, $suly);
        mysqli_stmt_execute($stmt);


    }
    //törlés
    if(isset($_POST["torles"])){
        $torles= $_POST["torles"];
        $stmt = mysqli_prepare($conn,"delete from aru  where ID= ?;");
        mysqli_stmt_bind_param($stmt,"i", $torles);
        mysqli_stmt_execute($stmt);
    }



}

echo '<hr/>';

echo '<h2>Új áru</h2>';
echo '<form method="POST" action="aru.php">';
echo '<table>';
echo '<tr><td></td> <td><input type="hidden" name="uj"/></td></tr>';
echo '<tr><td>ID:</td> <td><input type="text" name="ID"/></td></tr>';
echo '<tr><td>név:</td> <td><input type="text" name="név"/></td></tr>';
echo '<tr><td>tulajdonos:</td> <td><input type="text" name="tulajdonos"/></td></tr>';
echo '<tr><td>súly:</td> <td><input type="text" name="súly"/></td></tr>';
echo '<tr><td></td> <td><input type="submit" value="Hozzáad"/></td></tr>';
echo '</table>';
echo '</form>';

echo '<h2>torles</h2>';
echo '<form method="POST" action="aru.php">';
echo '<table>';
echo '<tr><td>ID:</td> <td><input type="text" name="torles"/></td></tr>';
echo '<tr><td></td> <td><input type="submit" value="torol"/></td></tr>';
echo '</table>';
echo '</form>';

echo '<h2>update</h2>';
echo '<form method="POST" action="aru.php">';
echo '<table>';
echo '<tr><td></td> <td><input type="hidden" name="update"/></td></tr>';
echo '<tr><td>ID:</td> <td><input type="text" name="ID"/></td></tr>';
echo '<tr><td>név:</td> <td><input type="text" name="név"/></td></tr>';
echo '<tr><td>tulajdonos:</td> <td><input type="text" name="tulajdonos"/></td></tr>';
echo '<tr><td>súly:</td> <td><input type="text" name="súly"/></td></tr>';
echo '<tr><td>kit:</td> <td><input type="text" name="kit"/></td></tr>';
echo '<tr><td></td> <td><input type="submit" value="update"/></td></tr>';
echo '</table>';
echo '</form>';

if ( mysqli_select_db($conn, 'raktar') ) {	// ha sikeres az adatbázis kiválasztása


    // lekérdezzük a városokat a "varosok" táblából

    $sql = "SELECT * FROM aru"; // ez csak egy string, még nem hajtódik végre
    $res = mysqli_query($conn, $sql) or die ('Hibás utasítás!'); // végrehajtjuk az SQL utasítást

    // html táblázatként íratjuk ki;
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