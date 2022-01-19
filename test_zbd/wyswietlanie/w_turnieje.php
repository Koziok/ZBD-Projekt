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
        <h1>WYŚWIETLANIE - TURNIEJE</h1>
        <div class="php-script">          
            <?php
                include '../db_connection.php';

                $conn = OpenCon(); 
                
                echo '
                <div class="custom-select">
                    <form method="post" action="">
                        <select name="choose" onchange="this.form.submit()">
                            <option>Wybierz turniej...</option>';        

                $query1="SELECT nazwa_turnieju from turnieje";
                $result1=mysqli_query($conn, $query1);
                while($row1=mysqli_fetch_assoc($result1))
				{		
					echo '<option value="'.$row1['nazwa_turnieju'].'">'.$row1['nazwa_turnieju'].'</option>';
				}
                
                echo '
                        </select>
                    </form>
                </div>';

                $choose = isset($_POST['choose']) ? $_POST['choose'] : '';

                $query="SELECT nazwa_turnieju, data_rozpoczecia, data_zakonczenia, pula_nagrod_pienieznych, tytul, nazwa_producenta FROM turnieje where nazwa_turnieju='$choose'";         
                $result=mysqli_query($conn,$query);
                $row=mysqli_fetch_assoc($result);

                echo '<table>';
                
                
                if ($choose != NULL)
                {
                    echo '<tr><td>'.'Nazwa'.'</td><td>'.'Data rozpoczęcia'.'</td><td>'.'Data zakończenia'.'</td><td>'.'Pula nagród'.'</td><td>'.'Gra'.'</td><td>'.'Producent'.'</td></tr>';
                    echo '<tr><td>'.$row['nazwa_turnieju'].'</td><td>'.$row['data_rozpoczecia'].'</td><td>'.$row['data_zakonczenia'].'</td><td>'.$row['pula_nagrod_pienieznych'].'</td><td>'.$row['tytul'].'</td><td>'.$row['nazwa_producenta'].'</td></tr>';
                }
                else
                {
                    echo '<h2>Nie wybrano żadnego turnieju...</h2>';
                }

                echo '</table><table>';

                $query2="SELECT nazwa_druzyny, zajete_miejsce, nagroda_pieniezna FROM udzialy WHERE nazwa_turnieju='$choose'";
                $result2=mysqli_query($conn,$query2);
                $check1=mysqli_num_rows($result2);

                if ($check1 != 0)
                {
                    echo '<h2>Drużyny biorące udział:</h2>';
                    echo '<tr><td>Drużyna'.'</td><td>'.'Miejsce'.'</td><td>'.'Nagroda</td></tr>';
                }
                while($row2=mysqli_fetch_assoc($result2))
				{		
					echo '<tr><td>'.$row2['nazwa_druzyny'].'</td><td>'.$row2['zajete_miejsce'].'</td><td>'.$row2['nagroda_pieniezna'].'</td></tr>';
				}

                echo '</table>';

                CloseCon($conn);
            ?> 
        </div>
    </content>
    <footer>
    </footer>
</body>
</html>