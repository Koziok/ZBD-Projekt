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
            <a href="u_turnieji.php"><ul>Silniki</ul></a>
            <a href="u_wsparcia.php"><ul>Wsparcia</ul></a>
            <a href="u_druzynai.php"><ul>Języki</ul></a>
            <a href="u_turnieje.php"><ul>Turnieje</ul></a>
            <a href="u_udzialy.php"><ul>Udziały</ul></a>
            <a href="u_druzyny.php"><ul>Drużyny</ul></a>
            <a href="u_zawodnicy.php"><ul>Zawodnicy</ul></a>
        </li>
    </header>
    <content>
        <h1>USUWANIE - UDZIAŁY</h1>
        <div class="php-script">           
            <?php
                include '../db_connection.php';

                $conn = OpenCon(); 

                echo '
                <div class="custom-select">
                    <form method="post" action="">
                        <select name="choose">
                            <option>Wybierz udział...</option>';        

                $query1="SELECT nazwa_turnieju, nazwa_druzyny from udzialy order by nazwa_turnieju, nazwa_druzyny";
                $result1=mysqli_query($conn, $query1);
                while($row1=mysqli_fetch_assoc($result1))
				{		
					echo '<option value="'.$row1['nazwa_turnieju'].' | '.$row1['nazwa_druzyny'].'">'.$row1['nazwa_turnieju'].' | '.$row1['nazwa_druzyny'].'</option>';
				}
                
                echo '
                        </select>
                        <br>
                        <input type="submit" value="Usuń">
                    </form>
                </div>';

                $choose = isset($_POST['choose']) ? $_POST['choose'] : '';

                if ($choose != 'Wybierz udział...' && strlen($choose) > 1)
                {
                    $choose_array=explode(' | ', $choose);
                    if(!isset($choose_array[1]))
                    {
                        $choose_array[1] = null;
                    }
                    $turniej=$choose_array[0];
                    $druzyna=$choose_array[1];

                    $query3="DELETE from udzialy where nazwa_turnieju='$turniej' and nazwa_druzyny='$druzyna'";
                        if (mysqli_query($conn, $query3) == TRUE) {
                            echo "<meta http-equiv='refresh' content='0'>";
                        }   
                }      

                $query2="SELECT nazwa_turnieju, nazwa_druzyny, nagroda_pieniezna, zajete_miejsce from udzialy order by nazwa_turnieju, nazwa_druzyny";
                $result2=mysqli_query($conn, $query2);
                
                echo '<table>';
                echo '<tr><td>'.'Turniej'.'</td><td>'.'Drużyna'.'</td><td>'.'Nagroda'.'</td><td>'.'Miejsce'.'</td></tr>';
                while($row2=mysqli_fetch_assoc($result2))
				{		
					echo '<tr><td>'.$row2['nazwa_turnieju'].'</td><td>'.$row2['nazwa_druzyny'].'</td><td>'.$row2['nagroda_pieniezna'].'</td><td>'.$row2['zajete_miejsce'].'</td></tr>';
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