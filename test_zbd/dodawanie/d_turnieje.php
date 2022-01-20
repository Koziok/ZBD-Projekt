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
            <a href="d_gry.php"><ul>Gry</ul></a>
            <a href="d_wspolprace.php"><ul>Współprace</ul></a>
            <a href="d_wydawcy.php"><ul>Wydawcy</ul></a>
            <a href="d_producenci.php"><ul>Producenci</ul></a>
            <a href="d_deweloperzy.php"><ul>Deweloperzy</ul></a>
            <a href="d_silniki.php"><ul>Silniki</ul></a>
            <a href="d_wsparcia.php"><ul>Wsparcia</ul></a>
            <a href="d_jezyki.php"><ul>Języki</ul></a>
            <a href="d_turnieje.php"><ul>Turnieje</ul></a>
            <a href="d_udzialy.php"><ul>Udziały</ul></a>
            <a href="d_druzyny.php"><ul>Drużyny</ul></a>
            <a href="d_zawodnicy.php"><ul>Zawodnicy</ul></a>
        </li>
    </header>
    <content>
        <h1>DODAWANIE - TURNIEJE</h1>
        <div class="php-script">           
            <?php
                include '../db_connection.php';

                $conn = OpenCon(); 
                
                echo '
                <div class="custom-select">
                    <form method="post" action="">
                        <label for="turniej">Turniej:</label><br>
                        <input type="text" id="turniej" name="turniej" value="Turniej"><br>

                        <label for="date_r">Data rozpoczęcia:</label><br>
                        <input type="date" id="date_r" name="date_r" value="2022-01-01"><br>

                        <label for="date_z">Data zakończenia:</label><br>
                        <input type="date" id="date_z" name="date_z" value="2022-01-01"><br>

                        <label for="nagrody">Pula nagród pieniężnych:</label><br>
                        <input type="text" id="nagrody" name="nagrody" value="1.000.000 USD"><br>

                        <label for="game">Gra:</label><br>
                        <select name="game">
                            <option>Wybierz grę...</option>';        
                $query1="SELECT tytul, nazwa_producenta from gry where czy_turniejowe = 1 order by tytul, nazwa_producenta";
                $result1=mysqli_query($conn, $query1);
                while($row=mysqli_fetch_assoc($result1))
				{		
					echo '<option value="'.$row['tytul'].' | '.$row['nazwa_producenta'].'">'.$row['tytul'].' | '.$row['nazwa_producenta'].'</option>';
				}                
                echo '
                        </select><br>

                        <input type="submit" value="Dodaj">
                    </form>
                </div>';

                $turniej = isset($_POST['turniej']) ? $_POST['turniej'] : '';
                $date_r = isset($_POST['date_r']) ? $_POST['date_r'] : '';
                $date_z = isset($_POST['date_z']) ? $_POST['date_z'] : '';
                $nagrody = isset($_POST['nagrody']) ? $_POST['nagrody'] : '';
                $game = isset($_POST['game']) ? $_POST['game'] : '';
                $game_array=array('a','b');

                if($game != 'Wybierz grę...')
                {
                    $game_array=explode(' | ', $game);
                    if(!isset($game_array[1]))
                    {
                        $game_array[1] = null;
                    }
                    $title=$game_array[0];
                    $producent=$game_array[1];
                }
                
                $check_query="SELECT nazwa_turnieju FROM turnieje where nazwa_turnieju='$turniej'";
                $check_result=mysqli_query($conn, $check_query);
                $check=mysqli_num_rows($check_result);
                if($check == 0)
                {
                    echo "<center>";

                    if ($game != 'Wybierz grę...' && !empty($turniej) && !empty($nagrody) && ($date_r <= $date_z)) 
                    {
                        $query3="INSERT INTO turnieje(`nazwa_turnieju`, `data_rozpoczecia`, `data_zakonczenia`, `pula_nagrod_pienieznych`, `tytul`, `nazwa_producenta`) 
                        values ('$turniej', '$date_r', '$date_z', '$nagrody', '$title', '$producent')";
                        if (mysqli_query($conn, $query3) == TRUE) {
                            echo "Dodano turniej";
                        }
                    }

                    echo "</center>";
                }
                else
                {
                    echo '<center>Dodanie zakończyło się niepowodzeniem! <br> Taki turniej już istnieje w bazie danych!</center><br>';
                }

                CloseCon($conn);
            ?> 
        </div>             
    </content>
    <footer>
    </footer>
</body>
</html>