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
        <h1>WYŚWIETLANIE - DRUŻYNY</h1>
        <div class="php-script">           
            <?php
                include '../db_connection.php';

                $conn = OpenCon(); 

                echo '
                <div class="custom-select">
                    <form method="post" action="">
                        <select name="choose" onchange="this.form.submit()">
                            <option>Wybierz drużynę...</option>';        

                $query1="SELECT nazwa_druzyny from druzyny";
                $result1=mysqli_query($conn, $query1);
                while($row1=mysqli_fetch_assoc($result1))
				{		
					echo '<option value="'.$row1['nazwa_druzyny'].'">'.$row1['nazwa_druzyny'].'</option>';
				}
                
                echo '
                        </select>
                    </form>
                </div>';

                $choose = isset($_POST['choose']) ? $_POST['choose'] : '';


                $query2="SELECT nazwa_druzyny, data_zalozenia, kraj_zalozenia FROM druzyny WHERE nazwa_druzyny='$choose'";
                $result2=mysqli_query($conn,$query2);
                $row2=mysqli_fetch_assoc($result2);
                
                echo '<table>';
                
                if ($choose != NULL)
                {
                    echo '<tr><td>Nazwa</td><td>Data założenia</td><td>Kraj założenia</td></tr><br>';
                    echo '<tr><td>'.$row2['nazwa_druzyny'].'</td><td>'.$row2['data_zalozenia'].'</td><td>'.$row2['kraj_zalozenia'].'</td></tr>';
                }
                else
                {
                    echo '<h2>Nie wybrano żadnej drużyny...</h2>';
                }

                echo '</table><table>';

                $query3="SELECT nazwa_turnieju, zajete_miejsce, nagroda_pieniezna FROM udzialy WHERE nazwa_druzyny='$choose'";

                $result3=mysqli_query($conn,$query3);
                $check1=mysqli_num_rows($result3);

                if ($check1 != 0)
                {
                    echo '<h2>Turnieje:</h2>';
                    echo '<tr><td>Turniej'.'</td><td>'.'Miejsce'.'</td><td>'.'Nagroda</td></tr>';
                }

                while($row3=mysqli_fetch_assoc($result3))
				{		
					echo '<tr><td>'.$row3['nazwa_turnieju'].'</td><td>'.$row3['zajete_miejsce'].'</td><td>'.$row3['nagroda_pieniezna'].'</td></tr>';
				}
                
                echo '</table><table>';
               
                $query4="call wezZawodnikow('$choose')";

                $result4=mysqli_query($conn,$query4);
                $check2=mysqli_num_rows($result4);

                if ($check2 != 0)
                {
                    echo '<h2>Zawodnicy:</h2>';
                    echo '<tr><td>'.'Imię'.'</td><td>'.'Nazwisko'.'</td><td>'.'Data_urodzenia'.'</td><td>'.'Kraj pochodzenia'.'</td></tr>';
                }

                while($row4=mysqli_fetch_assoc($result4))
				{		
					echo '<tr><td>'.$row4['imie'].'</td><td>'.$row4['nazwisko'].'</td><td>'.$row4['data_urodzenia'].'</td><td>'.$row4['kraj_pochodzenia'].'</td></tr>';
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