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
        <h1>USUWANIE - GRY</h1>
        <div class="php-script">           
            <?php
                include '../db_connection.php';

                $conn = OpenCon(); 

                echo '
                <div class="custom-select">
                    <form method="post" action="">
                        <select name="choose">
                            <option>Wybierz grę...</option>';        

                $query1="SELECT tytul, nazwa_producenta from gry order by tytul, nazwa_producenta";
                $result1=mysqli_query($conn, $query1);
                while($row1=mysqli_fetch_assoc($result1))
				{		
					echo '<option value="'.$row1['tytul'].' | '.$row1['nazwa_producenta'].'">'.$row1['tytul'].' | '.$row1['nazwa_producenta'].'</option>';
				}
                
                echo '
                        </select>
                        <br>
                        <input type="submit" value="Usuń">
                    </form>
                </div>';

                $choose = isset($_POST['choose']) ? $_POST['choose'] : '';

                if ($choose != 'Wybierz grę...')
                {
                    $choose_array=explode(' | ', $choose);
                    if(!isset($choose_array[1]))
                    {
                        $choose_array[1] = null;
                    }
                    $title=$choose_array[0];
                    $producent=$choose_array[1];

                    $check_query1="SELECT tytul, nazwa_producenta FROM turnieje where tytul='$title' and nazwa_producenta='$producent'";
                    $check_result1=mysqli_query($conn, $check_query1);
                    $check1=mysqli_num_rows($check_result1);
                    $check_query2="SELECT tytul, nazwa_producenta FROM wspolprace where tytul='$title' and nazwa_producenta='$producent'";
                    $check_result2=mysqli_query($conn, $check_query2);
                    $check2=mysqli_num_rows($check_result2);
                }
                
                if ($check1 == 0 && $check2 == 0)
                {
                    if ($choose != 'Wybierz grę...' && strlen($choose) > 1) {
                        $query3="DELETE from gry where tytul='$title' and nazwa_producenta='$producent'";
                        if (mysqli_query($conn, $query3) == TRUE) {
                            echo "<meta http-equiv='refresh' content='0'>";
                        }                   
                    }
                }          
                else
                {
                    echo '<center>Nie udało się usunąć rekordu. Upewnij się, że nie jest on używany w innych tabelach!<center>';
                }

                $query2="SELECT tytul, nazwa_producenta, data_wydania, czy_turniejowe, nazwa_silnika from gry";
                $result2=mysqli_query($conn, $query2);
                
                echo '<table>';
                echo '<tr><td>'.'Tytuł'.'</td><td>'.'Producent'.'</td><td>'.'Data wydania'.'</td><td>'.'Czy turniejowa'.'</td><td>'.'Silnik'.'</td></tr>';
                while($row2=mysqli_fetch_assoc($result2))
				{		
					echo '<tr><td>'.$row2['tytul'].'</td><td>'.$row2['nazwa_producenta'].'</td><td>'.$row2['data_wydania'].'</td><td>'.$row2['czy_turniejowe'].'</td><td>'.$row2['nazwa_silnika'].'</td></tr>';
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