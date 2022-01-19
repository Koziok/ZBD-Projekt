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
        <h1>USUWANIE - WSPARCIA</h1>
        <div class="php-script">           
            <?php
                include '../db_connection.php';

                $conn = OpenCon(); 

                echo '
                <div class="custom-select">
                    <form method="post" action="">
                        <select name="choose">
                            <option>Wybierz wsparcie...</option>';        

                $query1="SELECT nazwa_silnika, nazwa_jezyka from wsparcia order by nazwa_silnika, nazwa_jezyka";
                $result1=mysqli_query($conn, $query1);
                while($row1=mysqli_fetch_assoc($result1))
				{		
					echo '<option value="'.$row1['nazwa_silnika'].' | '.$row1['nazwa_jezyka'].'">'.$row1['nazwa_silnika'].' | '.$row1['nazwa_jezyka'].'</option>';
				}
                
                echo '
                        </select>
                        <br>
                        <input type="submit" value="Usuń">
                    </form>
                </div>';

                $choose = isset($_POST['choose']) ? $_POST['choose'] : '';

                if ($choose != 'Wybierz wsparcie...' && strlen($choose) > 1)
                {
                    $choose_array=explode(' | ', $choose);
                    if(!isset($choose_array[1]))
                    {
                        $choose_array[1] = null;
                    }
                    $silnik=$choose_array[0];
                    $jezyk=$choose_array[1];

                    $query3="DELETE from wsparcia where nazwa_silnika='$silnik' and nazwa_jezyka='$jezyk'";
                        if (mysqli_query($conn, $query3) == TRUE) {
                            echo "<meta http-equiv='refresh' content='0'>";
                        }   
                }      

                $query2="SELECT nazwa_silnika, nazwa_jezyka, coalesce(maks_wersja_silnika, 'najnowsza') as wersja from wsparcia order by nazwa_silnika, nazwa_jezyka";
                $result2=mysqli_query($conn, $query2);
                
                echo '<table>';
                echo '<tr><td>'.'Silnik'.'</td><td>'.'Język programowania'.'</td><td>'.'Maksymalna wersja silnika'.'</td></tr>';
                while($row2=mysqli_fetch_assoc($result2))
				{		
					echo '<tr><td>'.$row2['nazwa_silnika'].'</td><td>'.$row2['nazwa_jezyka'].'</td><td>'.$row2['wersja'].'</td></tr>';
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