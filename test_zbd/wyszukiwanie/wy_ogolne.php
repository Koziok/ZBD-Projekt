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
        </li>
    </header>
    <content>
        <h1>WYSZUKIWARKA</h1>
        <div class="php-script">           
            <?php
                include '../db_connection.php';

                $conn = OpenCon(); 
                
                echo '
                <div class="custom-select">
                    <form method="post" action="">
                        <label for="search">Wpisz frazę do wyszukania:</label><br>
                        <input type="text" id="search" name="search" value="Fraza"><br>

                        <input type="submit" value="Wyszukaj">
                    </form>
                </div>';

                $search = isset($_POST['search']) ? $_POST['search'] : '';

                if($search) {
                    echo "<center>Wyniki wyszukiwanie dla frazy '$search'</center><br>";
                }

                if (empty($search))
                {
                }
                else
                {
                    $query1="SELECT gry.tytul, gry.data_wydania, gry.nazwa_producenta, gry.nazwa_silnika, 
                    coalesce(GROUP_CONCAT(wspolprace.nazwa_wydawcy, ' od ', wspolprace.data_rozpoczecia SEPARATOR ', '), 'brak') as wydawcy 
                    FROM gry left join wspolprace on gry.tytul = wspolprace.tytul and gry.nazwa_producenta = wspolprace.nazwa_producenta GROUP BY gry.tytul, gry.nazwa_producenta 
                    having gry.tytul like '%$search%' or gry.nazwa_producenta like '%$search%' or gry.nazwa_silnika like '%$search%' or 
                    gry.data_wydania like '%$search%' or wydawcy like '%$search%'";
                    $result1=mysqli_query($conn, $query1);
                    $check1=mysqli_num_rows($result1);
                    if ($check1 != 0)
                    {
                        echo '<h2>Gry</h2>';
                        echo '<table>';
                        echo '<tr><td>'.'Tytuł'.'</td><td>'.'Data wydania'.'</td><td>'.'Producent'.'</td><td>'.'Silnik'.'</td><td>'.'Wydawcy'.'</td></tr>';
                        while($row=mysqli_fetch_assoc($result1))
                        {		
                            echo '<tr><td>'.$row['tytul'].'</td><td>'.$row['data_wydania'].'</td><td>'.$row['nazwa_producenta'].'</td><td>'.$row['nazwa_silnika'].'</td><td>'.$row['wydawcy'].'</td></tr>';
                        }
                        echo '</table>';
                    }

                    $query2="SELECT producenci.nazwa_producenta, producenci.data_powstania, producenci.siedziba, 
                    GROUP_CONCAT(deweloperzy.imie, ' ', deweloperzy.nazwisko SEPARATOR ', ') as deweloperzy
                    FROM producenci inner join deweloperzy on producenci.nazwa_producenta = deweloperzy.nazwa_producenta GROUP BY producenci.nazwa_producenta
                    having producenci.nazwa_producenta like '%$search%' or producenci.data_powstania like '%$search%' or 
                    producenci.siedziba like '%$search%' or deweloperzy like '%$search%'";
                    $result2=mysqli_query($conn, $query2);
                    $check2=mysqli_num_rows($result2);
                    if ($check2 != 0)
                    {
                        echo '<h2>Producenci</h2>';
                        echo '<table>';
                        echo '<tr><td>'.'Producent'.'</td><td>'.'Data powstania'.'</td><td>'.'Siedziba'.'</td><td>'.'Deweloperzy'.'</td></tr>';
                        while($row=mysqli_fetch_assoc($result2))
                        {		
                            echo '<tr><td>'.$row['nazwa_producenta'].'</td><td>'.$row['data_powstania'].'</td><td>'.$row['siedziba'].'</td><td>'.$row['deweloperzy'].'</td></tr>';
                        }
                        echo '</table>';
                    }
                    
                    $query3="SELECT silniki.nazwa_silnika, silniki.data_powstania, GROUP_CONCAT(wsparcia.nazwa_jezyka, ' do wersji ', 
                    coalesce(wsparcia.maks_wersja_silnika, 'aktualnej') SEPARATOR ', ') as jezyki 
                    FROM silniki inner join wsparcia on silniki.nazwa_silnika = wsparcia.nazwa_silnika GROUP BY silniki.nazwa_silnika
                    having silniki.nazwa_silnika like '%$search%' or silniki.data_powstania like '%$search%' or jezyki like '%$search%'";
                    $result3=mysqli_query($conn, $query3);
                    $check3=mysqli_num_rows($result3);
                    if ($check3 != 0)
                    {
                        echo '<h2>Silniki</h2>';
                        echo '<table>';
                        echo '<tr><td>'.'Silnik'.'</td><td>'.'Data powstania'.'</td><td>'.'Języki'.'</td></tr>';
                        while($row=mysqli_fetch_assoc($result3))
                        {		
                            echo '<tr><td>'.$row['nazwa_silnika'].'</td><td>'.$row['data_powstania'].'</td><td>'.$row['jezyki'].'</td></tr>';
                        }
                        echo '</table>';
                    }

                    $query4="SELECT turnieje.nazwa_turnieju, turnieje.data_rozpoczecia, turnieje.data_zakonczenia, turnieje.pula_nagrod_pienieznych, 
                    turnieje.tytul, turnieje.nazwa_producenta, GROUP_CONCAT(udzialy.nazwa_druzyny SEPARATOR ', ') as druzyny
                    FROM turnieje inner join udzialy on turnieje.nazwa_turnieju = udzialy.nazwa_turnieju GROUP BY turnieje.nazwa_turnieju
                    having turnieje.nazwa_turnieju like '%$search%' or turnieje.data_rozpoczecia like '%$search%' or turnieje.data_zakonczenia like '%$search%' or 
                    turnieje.pula_nagrod_pienieznych like '%$search%' or turnieje.tytul like '%$search%' or turnieje.nazwa_producenta like '%$search%'";
                    $result4=mysqli_query($conn, $query4);
                    $check4=mysqli_num_rows($result4);
                    if ($check4 != 0)
                    {
                        echo '<h2>Turnieje</h2>';
                        echo '<table>';
                        echo '<tr><td>'.'Nazwa'.'</td><td>'.'Data rozpoczęcia'.'</td><td>'.'Data zakończenia'.'</td><td>'.'Pula nagród'.'</td><td>'.'Gra'.'</td><td>'.'Producent'.'</td><td>'.'Drużyny'.'</td></tr>';
                        while($row=mysqli_fetch_assoc($result4))
                        {		
                            echo '<tr><td>'.$row['nazwa_turnieju'].'</td><td>'.$row['data_rozpoczecia'].'</td><td>'.$row['data_zakonczenia'].'</td><td>'.$row['pula_nagrod_pienieznych'].'</td><td>'.$row['tytul'].'</td><td>'.$row['nazwa_producenta'].'</td><td>'.$row['druzyny'].'</td></tr>';
                        }
                        echo '</table>';
                    }

                    $query5="SELECT druzyny.nazwa_druzyny, druzyny.data_zalozenia, druzyny.kraj_zalozenia, 
                    GROUP_CONCAT(udzialy.nazwa_turnieju, ' (', udzialy.zajete_miejsce, ': ', udzialy.nagroda_pieniezna, ') ' SEPARATOR ', ') as udzialy
                    FROM druzyny inner join udzialy on druzyny.nazwa_druzyny = udzialy.nazwa_druzyny GROUP BY druzyny.nazwa_druzyny
                    having druzyny.nazwa_druzyny like '%$search%' or druzyny.data_zalozenia like '%$search%' or druzyny.kraj_zalozenia like '%$search%'";
                    $result5=mysqli_query($conn, $query5);
                    $check5=mysqli_num_rows($result5);
                    if ($check5 != 0)
                    {
                        echo '<h2>Drużyny</h2>';
                        echo '<table>';
                        echo '<tr><td>'.'Nazwa'.'</td><td>'.'Data założenia'.'</td><td>'.'Kraj założenia'.'</td><td>'.'Udziały'.'</td></tr>';
                        while($row=mysqli_fetch_assoc($result5))
                        {		
                            echo '<tr><td>'.$row['nazwa_druzyny'].'</td><td>'.$row['data_zalozenia'].'</td><td>'.$row['kraj_zalozenia'].'</td><td>'.$row['udzialy'].'</td></tr>';
                        }
                        echo '</table>';
                    }

                    $query6="SELECT imie, nazwisko, data_urodzenia, kraj_pochodzenia, nazwa_druzyny FROM zawodnicy
                    where imie like '%$search%' or nazwisko like '%$search%' or data_urodzenia like '%$search%' or kraj_pochodzenia like '%$search%' or nazwa_druzyny like '%$search%'";
                    $result6=mysqli_query($conn, $query6);
                    $check6=mysqli_num_rows($result6);
                    if ($check6 != 0)
                    {
                        echo '<h2>Zawodnicy</h2>';
                        echo '<table>';
                        echo '<tr><td>'.'Imię'.'</td><td>'.'Nazwisko'.'</td><td>'.'Data urodzenia'.'</td><td>'.'Kraj pochodzenia'.'</td><td>'.'Drużyna'.'</td></tr>';
                        while($row=mysqli_fetch_assoc($result6))
                        {		
                            echo '<tr><td>'.$row['imie'].'</td><td>'.$row['nazwisko'].'</td><td>'.$row['data_urodzenia'].'</td><td>'.$row['kraj_pochodzenia'].'</td><td>'.$row['nazwa_druzyny'].'</td></tr>';
                        }
                        echo '</table>';
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