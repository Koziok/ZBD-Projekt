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
            <a href="w_gry.php"><ul>Gry</ul></a>
            <a href="w_turnieje.php"><ul>Turnieje</ul></a>
            <a href="w_druzyny.php"><ul>Drużyny</ul></a>
            <a href="w_silniki.php"><ul>Silniki</ul></a>
            <a href="w_producenci.php"><ul>Producenci</ul></a>
        </li>
    </header>
    <content>
        <h1>WYŚWIETLANIE - GRY</h1>
        <div class="php-script">
            <div class="custom-select">
                <form method="post" action="">
                    <select name="sort" onchange="this.form.submit()">
                        <option>Sortuj według...</option>
                        <option value="tytul_r">Tytuł rosnąco</option>
                        <option value="tytul_m">Tytuł malejąco</option>
                        <option value="data_wydania_r">Data wydania rosnąco</option>
                        <option value="data_wydania_m">Data wydania malejąco</option>
                    </select>
                </form>
            </div>            
            <?php
                include '../db_connection.php';

                $conn = OpenCon(); 

                $sort = isset($_POST['sort']) ? $_POST['sort'] : '';
                $sort = strval($sort);          
                $choice_query = "SELECT sortujGry('".$sort."')";
                $choice_result=mysqli_query($conn,$choice_query) or die("Problemy z odczytem danych!");
                $choice_row=mysqli_fetch_row($choice_result);
                $query="SELECT gry.tytul, gry.data_wydania, gry.nazwa_producenta, gry.nazwa_silnika, coalesce(GROUP_CONCAT(wspolprace.nazwa_wydawcy, ' od ', wspolprace.data_rozpoczecia SEPARATOR ', '), 'brak') as wydawcy 
                FROM gry left join wspolprace on gry.tytul = wspolprace.tytul and gry.nazwa_producenta = wspolprace.nazwa_producenta GROUP BY gry.tytul, gry.nazwa_producenta ORDER BY $choice_row[0]";

                $result=mysqli_query($conn,$query);

                echo '<table>';
                echo '<tr><td>'.'Lp.'.'</td><td>'.'Tytuł'.'</td><td>'.'Data wydania'.'</td><td>'.'Producent'.'</td><td>'.'Silnik'.'</td><td>'.'Wydawcy'.'</td></tr>';
                $i = 1;
                while($row=mysqli_fetch_assoc($result))
				{		
					echo '<tr><td>'.$i.'</td><td>'.$row['tytul'].'</td><td>'.$row['data_wydania'].'</td><td>'.$row['nazwa_producenta'].'</td><td>'.$row['nazwa_silnika'].'</td><td>'.$row['wydawcy'].'</td></tr>';
                    $i++;
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