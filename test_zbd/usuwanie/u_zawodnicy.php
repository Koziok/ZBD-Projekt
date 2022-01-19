<!DOCTYPE html>
<html lang="pl-PL">
<head>
    <meta charset="UTF-8">
    <title>Projekt ZBD</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="author" content="Mateusz Kozłowicz">
    <link rel="stylesheet" href="../style.css?v=<?php echo time(); ?>">
</head>
<body>
    <header>
        <li>
            <a href="../index.html"><ul>Strona startowa</ul></a>
            <a href="u_gry.php"><ul>Gry</ul></a>
            <a href="u_wspolprace.php"><ul>Współprace</ul></a>
            <a href="u_wydawcy.php"><ul>Wydawcy</ul></a>
            <a href="u_producenci.php"><ul>Producenci</ul></a>
            <a href="u_deweloperzy.php"><ul>Deweloperzy</ul></a>
            <a href="u_silniki.php"><ul>Silniki</ul></a>
            <a href="u_wsparcia.php"><ul>Wsparcia</ul></a>
            <a href="u_jezyki.php"><ul>Języki</ul></a>
            <a href="u_turnieje.php"><ul>Turnieje</ul></a>
            <a href="u_udzialy.php"><ul>Udziały</ul></a>
            <a href="u_druzyny.php"><ul>Drużyny</ul></a>
            <a href="u_zawodnicy.php"><ul>Zawodnicy</ul></a>
        </li>
    </header>
    <content>
        <h1>USUWANIE - ZAWODNICY</h1>
        <div class="php-script">           
            <?php
                include '../db_connection.php';

                $conn = OpenCon(); 
                
                echo '
                <div class="custom-select">
                    <form method="post" action="">
                        <select name="choose">
                            <option>Wybierz zawodnika...</option>';        

                $query1="SELECT id_zawodnika from zawodnicy order by id_zawodnika";
                $result1=mysqli_query($conn, $query1);
                while($row1=mysqli_fetch_assoc($result1))
				{		
					echo '<option value="'.$row1['id_zawodnika'].'">'.$row1['id_zawodnika'].'</option>';
				}
                
                echo '
                        </select>
                        <br>
                        <input type="submit" value="Usuń">
                    </form>
                </div>';

                $choose = isset($_POST['choose']) ? $_POST['choose'] : '';

                if ($choose != 'Wybierz zawodnika...') {
                    $query3="DELETE from zawodnicy where id_zawodnika=$choose";
                    if (mysqli_query($conn, $query3) == TRUE) {
                        echo "<meta http-equiv='refresh' content='0'>";
                    }    
                }

                
                $query2="SELECT id_zawodnika, imie, nazwisko, data_urodzenia, kraj_pochodzenia, nazwa_druzyny from zawodnicy";
                $result2=mysqli_query($conn, $query2);
                
                echo '<table>';
                echo '<tr><td>'.'ID'.'</td><td>'.'Imie'.'</td><td>'.'Nazwisko'.'</td><td>'.'Data urodzenia'.'</td><td>'.'Kraj pochodzenia'.'</td><td>'.'Drużyna'.'</td></tr>';
                while($row2=mysqli_fetch_assoc($result2))
				{		
					echo '<tr><td>'.$row2['id_zawodnika'].'</td><td>'.$row2['imie'].'</td><td>'.$row2['nazwisko'].'</td><td>'.$row2['data_urodzenia'].'</td><td>'.$row2['kraj_pochodzenia'].'</td><td>'.$row2['nazwa_druzyny'].'</td></tr>';
				}
                echo '</table>';
                echo '<br><br><br>';

                CloseCon($conn);
            ?> 
        </div>             
    </content>
    <footer>
    </footer>
</body>
</html>