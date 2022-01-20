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
        <h1>DODAWANIE - GRY</h1>
        <div class="php-script">           
            <?php
                include '../db_connection.php';

                $conn = OpenCon(); 
                
                echo '
                <div class="custom-select">
                    <form method="post" action="">
                        <label for="title">Tytuł:</label><br>
                        <input type="text" id="title" name="title" value="Tytul"><br>

                        <label for="date">Data wydania:</label><br>
                        <input type="date" id="date" name="date" value="2022-01-01"><br>

                        <label for="tournament">Czy gra jest turniejowa:</label><br>
                        <select name="tournament" id=""tournament"">
                            <option value="0">Nie</option>
                            <option value="1">Tak</option>
                        </select><br>

                        <label for="producent">Producent:</label><br>
                        <select name="producent">
                            <option>Wybierz producenta...</option>';        
                $query1="SELECT nazwa_producenta from producenci ORDER BY nazwa_producenta";
                $result1=mysqli_query($conn, $query1);
                while($row=mysqli_fetch_assoc($result1))
				{		
					echo '<option value="'.$row['nazwa_producenta'].'">'.$row['nazwa_producenta'].'</option>';
				}                
                echo '
                        </select><br>

                        <label for="silnik">Silnik:</label><br>
                        <select name="silnik">
                            <option>Wybierz silnik...</option>';        
                $query2="SELECT nazwa_silnika from silniki ORDER BY nazwa_silnika";
                $result2=mysqli_query($conn, $query2);
                while($row=mysqli_fetch_assoc($result2))
				{		
					echo '<option value="'.$row['nazwa_silnika'].'">'.$row['nazwa_silnika'].'</option>';
				}            
                echo '
                        </select><br>

                        <input type="submit" value="Dodaj">
                    </form>
                </div>';

                $title = isset($_POST['title']) ? $_POST['title'] : '';
                $date = isset($_POST['date']) ? $_POST['date'] : '';
                $tournament = isset($_POST['tournament']) ? $_POST['tournament'] : '';
                $producent = isset($_POST['producent']) ? $_POST['producent'] : '';
                $silnik = isset($_POST['silnik']) ? $_POST['silnik'] : '';
                
                $check_query="SELECT tytul, nazwa_producenta FROM gry where tytul='$title' and nazwa_producenta='$producent'";
                $check_result=mysqli_query($conn, $check_query);
                $check=mysqli_num_rows($check_result);


                if($check == 0)
                {
                    echo "<center>";

                    if ($silnik != 'Wybierz silnik...' && $producent != 'Wybierz producenta...' && !empty($title)) 
                    {
                        $query3="INSERT INTO gry(`tytul`, `data_wydania`, `czy_turniejowe`, `nazwa_producenta`, `nazwa_silnika`) values ('$title', '$date', '$tournament', '$producent', '$silnik')";
                        if (mysqli_query($conn, $query3) == TRUE) {
                            echo "Dodano grę";
                        }
                    }

                    echo "</center>";
                }
                else
                {
                    echo '<center>Dodanie zakończyło się niepowodzeniem! <br> Taka gra już istnieje w bazie danych!</center><br>';
                }

                CloseCon($conn);
            ?> 
        </div>             
    </content>
    <footer>
    </footer>
</body>
</html>