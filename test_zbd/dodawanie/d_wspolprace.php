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
        <h1>DODAWANIE - WSPÓŁPRACE</h1>
        <div class="php-script">           
            <?php
                include '../db_connection.php';

                $conn = OpenCon(); 
                
                echo '
                <div class="custom-select">
                    <form method="post" action="">
                        <label for="game">Gra:</label><br>
                        <select name="game">
                            <option>Wybierz grę...</option>';        
                $query1="SELECT tytul, nazwa_producenta from gry order by tytul, nazwa_producenta";
                $result1=mysqli_query($conn, $query1);
                while($row=mysqli_fetch_assoc($result1))
				{		
					echo '<option value="'.$row['tytul'].' | '.$row['nazwa_producenta'].'">'.$row['tytul'].' | '.$row['nazwa_producenta'].'</option>';
				}                
                echo '
                        </select><br>

                        <label for="date">Wydawca:</label><br>
                        <select name="wydawca">
                            <option>Wybierz wydawcę...</option>';        
                $query2="SELECT nazwa_wydawcy from wydawcy order by nazwa_wydawcy";
                $result2=mysqli_query($conn, $query2);
                while($row=mysqli_fetch_assoc($result2))
				{		
					echo '<option value="'.$row['nazwa_wydawcy'].'">'.$row['nazwa_wydawcy'].'</option>';
				}                
                echo '
                        </select><br>

                        <label for="date">Data rozpoczęcia współpracy:</label><br>
                        <input type="date" id="date" name="date" value="2022-01-01"><br>

                        <input type="submit" value="Dodaj">
                    </form>
                </div>';

                $game = isset($_POST['game']) ? $_POST['game'] : '';
                $wydawca = isset($_POST['wydawca']) ? $_POST['wydawca'] : '';
                $date = isset($_POST['date']) ? $_POST['date'] : '';
                $game_array=array('a','b');
                $check1=1;

                if($game != 'Wybierz grę...')
                {
                    $game_array=explode(' | ', $game);
                    if(!isset($game_array[1]))
                    {
                        $game_array[1] = null;
                    }
                    $title=$game_array[0];
                    $producent=$game_array[1];

                    $check_query="SELECT tytul, nazwa_producenta, nazwa_wydawcy FROM wspolprace where tytul='$title' and nazwa_producenta='$producent' and nazwa_wydawcy='$wydawca'";
                    $check_result=mysqli_query($conn, $check_query);
                    $check=mysqli_num_rows($check_result);
                    $check1=0;
                }

                if ($check1 == 0)
                {
                    if($check == 0)
                    {
                        echo "<center>";

                        if ($game != 'Wybierz grę...' && $wydawca != 'Wybierz wydawcę...') 
                        {
                            $query3="INSERT INTO wspolprace(`data_rozpoczecia`, `tytul`, `nazwa_producenta`, `nazwa_wydawcy`) values ('$date', '$title', '$producent', '$wydawca')";
                            if (mysqli_query($conn, $query3) == TRUE) {
                                echo "Dodano współpracę";
                            }
                        }

                        echo "</center>";
                    }
                    else
                    {
                        echo '<center>Dodanie zakończyło się niepowodzeniem! <br> Taka współpraca już istnieje w bazie danych!</center><br>';
                    }
                }
                
                CloseCon($conn);
            ?> 
        </div>             
    </content>
    <footer>
    </footer>
</body>
</html>