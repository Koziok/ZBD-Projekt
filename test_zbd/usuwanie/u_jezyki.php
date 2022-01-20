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
        <h1>USUWANIE - JĘZYKI</h1>
        <div class="php-script">           
            <?php
                include '../db_connection.php';

                $conn = OpenCon(); 
                
                echo '
                <div class="custom-select">
                    <form method="post" action="">
                        <select name="choose">
                            <option>Wybierz język programowania...</option>';        

                $query1="SELECT nazwa_jezyka from jezyki_programowania order by nazwa_jezyka";
                $result1=mysqli_query($conn, $query1);
                while($row1=mysqli_fetch_assoc($result1))
				{		
					echo '<option value="'.$row1['nazwa_jezyka'].'">'.$row1['nazwa_jezyka'].'</option>';
				}
                
                echo '
                        </select>
                        <br>
                        <input type="submit" value="Usuń">
                    </form>
                </div>';

                $choose = isset($_POST['choose']) ? $_POST['choose'] : '';
                $check2=1;

                if ($choose != 'Wybierz język programowania...')
                {
                    $check_query1="SELECT nazwa_jezyka FROM wsparcia where nazwa_jezyka='$choose'";
                    $check_result1=mysqli_query($conn, $check_query1);
                    $check1=mysqli_num_rows($check_result1);//
                    $check2=0;
                }

                if ($check2 == 0)
                {
                    if ($check1 == 0)
                    {
                        if ($choose != 'Wybierz język programowania...' && strlen($choose) > 1) {
                            $query3="DELETE from jezyki_programowania where nazwa_jezyka='$choose'";
                            if (mysqli_query($conn, $query3) == TRUE) {
                                echo "<meta http-equiv='refresh' content='0'>"; 
                            }     
                        }
                                    
                    }
                    else
                    {
                        echo '<center>Nie udało się usunąć rekordu. Upewnij się, że nie jest on używany w innych tabelach!<center>';
                    }
                }
                
                $query2="SELECT nazwa_jezyka from jezyki_programowania";
                $result2=mysqli_query($conn, $query2);
                
                echo '<table>';
                echo '<tr><td>'.'Język programowania'.'</td></tr>';
                while($row2=mysqli_fetch_assoc($result2))
				{		
					echo '<tr><td>'.$row2['nazwa_jezyka'].'</td></tr>';
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