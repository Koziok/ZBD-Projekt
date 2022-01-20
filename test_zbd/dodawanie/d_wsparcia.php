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
        <h1>DODAWANIE - WSPARCIA</h1>
        <div class="php-script">           
            <?php
                include '../db_connection.php';

                $conn = OpenCon(); 
                
                echo '
                <div class="custom-select">
                    <form method="post" action="">
                        <label for="wersja">Maksymalna wersja silnika:</label><br>
                        <input type="text" id="wersja" name="wersja" value=""><br>

                        <label for="silnik">Silnik:</label><br>
                        <select name="silnik">
                            <option>Wybierz silnik...</option>';        
                $query2="SELECT nazwa_silnika from silniki order by nazwa_silnika";
                $result2=mysqli_query($conn, $query2);
                while($row=mysqli_fetch_assoc($result2))
				{		
					echo '<option value="'.$row['nazwa_silnika'].'">'.$row['nazwa_silnika'].'</option>';
				}            
                echo '
                        </select><br>

                        <label for="jezyk">Język programowania:</label><br>
                        <select name="jezyk">
                            <option>Wybierz język...</option>';        
                $query1="SELECT nazwa_jezyka from jezyki_programowania order by nazwa_jezyka";
                $result1=mysqli_query($conn, $query1);
                while($row=mysqli_fetch_assoc($result1))
				{		
					echo '<option value="'.$row['nazwa_jezyka'].'">'.$row['nazwa_jezyka'].'</option>';
				}                
                echo '
                        </select><br>

                        <input type="submit" value="Dodaj">
                    </form>
                </div>';

                $wersja = isset($_POST['wersja']) ? $_POST['wersja'] : '';
                $silnik = isset($_POST['silnik']) ? $_POST['silnik'] : '';
                $jezyk = isset($_POST['jezyk']) ? $_POST['jezyk'] : '';
                $check1=1;

                if ($silnik != 'Wybierz silnik...' && $jezyk != 'Wybierz język...')
                {
                    $check_query="SELECT nazwa_silnika, nazwa_jezyka FROM wsparcia where nazwa_silnika='$silnik' and nazwa_jezyka='$jezyk'";
                    $check_result=mysqli_query($conn, $check_query);
                    $check=mysqli_num_rows($check_result);
                    $check1=0;
                }
                
                if ($check1 == 0)
                {
                    if($check == 0)
                    {
                        echo "<center>";

                        if ($silnik != 'Wybierz silnik...' && $jezyk != 'Wybierz jezyk...') 
                        {
                            if (empty($wersja))
                            {
                                $query3="INSERT INTO wsparcia(`nazwa_silnika`, `nazwa_jezyka`, `maks_wersja_silnika`) values ('$silnik', '$jezyk', NULL)";
                            }
                            else
                            {
                                $query3="INSERT INTO wsparcia(`nazwa_silnika`, `nazwa_jezyka`, `maks_wersja_silnika`) values ('$silnik', '$jezyk', '$wersja')";
                            }                  
                            if (mysqli_query($conn, $query3) == TRUE) {
                                echo "Dodano wsparcie języka";
                            }
                        }

                        echo "</center>";
                    }
                    else
                    {
                        echo '<center>Dodanie zakończyło się niepowodzeniem! <br> Takie wsparcie języka już istnieje w bazie danych!</center><br>';
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