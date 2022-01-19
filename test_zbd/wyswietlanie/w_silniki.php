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
        <h1>WYŚWIETLANIE - SILNIKI</h1>
        <div class="php-script">    
            <?php
                include '../db_connection.php';

                $conn = OpenCon(); 

                $query="SELECT silniki.nazwa_silnika, silniki.data_powstania, GROUP_CONCAT(wsparcia.nazwa_jezyka, ' do wersji ', coalesce(wsparcia.maks_wersja_silnika, 'aktualnej') SEPARATOR ', ') as jezyki FROM silniki inner join wsparcia on silniki.nazwa_silnika = wsparcia.nazwa_silnika GROUP BY silniki.nazwa_silnika";
          
                $result=mysqli_query($conn,$query);

                echo '<table>';
                echo '<tr><td>'.'Lp.'.'</td><td>'.'Nazwa'.'</td><td>'.'Data powstania'.'</td><td>'.'Obsługiwane języki'.'</td></tr>';
                $i = 1;
                while($row=mysqli_fetch_assoc($result))
				{		
					echo '<tr><td>'.$i.'</td><td>'.$row['nazwa_silnika'].'</td><td>'.$row['data_powstania'].'</td><td>'.$row['jezyki'].'</td></tr>';
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