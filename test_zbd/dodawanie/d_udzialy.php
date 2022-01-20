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
        <h1>DODAWANIE - UDZIAŁY</h1>
        <div class="php-script">           
            <?php
                include '../db_connection.php';

                $conn = OpenCon(); 
                
                echo '
                <div class="custom-select">
                    <form method="post" action="">

                        <label for="turniej">Turniej:</label><br>
                        <select name="turniej">
                            <option>Wybierz turniej...</option>';        
                $query1="SELECT nazwa_turnieju from turnieje ORDER BY nazwa_turnieju";
                $result1=mysqli_query($conn, $query1);
                while($row=mysqli_fetch_assoc($result1))
                {		
                    echo '<option value="'.$row['nazwa_turnieju'].'">'.$row['nazwa_turnieju'].'</option>';
                }                
                echo '
                        </select><br>

                        <label for="druzyna">Drużyna:</label><br>
                        <select name="druzyna">
                            <option>Wybierz drużynę...</option>';        
                $query2="SELECT nazwa_druzyny from druzyny ORDER BY nazwa_druzyny";
                $result2=mysqli_query($conn, $query2);
                while($row=mysqli_fetch_assoc($result2))
                {		
                    echo '<option value="'.$row['nazwa_druzyny'].'">'.$row['nazwa_druzyny'].'</option>';
                }                
                echo '
                        </select><br>

                        <label for="nagroda">Nagroda pieniężna:</label><br>
                        <input type="text" id="nagroda" name="nagroda" value="1.000 USD" onkeypress="return (event.charCode > 47 && event.charCode < 58) || (event.charCode==46) || (event.charCode==85) || (event.charCode==83) || (event.charCode==68)"><br>

                        <label for="miejsce">Zajęte miejsce:</label><br>
                        <input type="text" id="miejsce" name="miejsce" value="3-4" onkeypress="return (event.charCode > 47 && event.charCode < 58) || (event.charCode==45) || (event.charCode==68) || (event.charCode==81))"><br>

                        <input type="submit" value="Dodaj">
                    </form>
                </div>';

                $turniej = isset($_POST['turniej']) ? $_POST['turniej'] : '';
                $druzyna = isset($_POST['druzyna']) ? $_POST['druzyna'] : '';
                $nagroda = isset($_POST['nagroda']) ? $_POST['nagroda'] : '';
                $miejsce = isset($_POST['miejsce']) ? $_POST['miejsce'] : '';
                $check1=1;

                if ($turniej != 'Wybierz drużynę...' && $druzyna != 'Wybierz drużynę...')
                {
                    $check_query="SELECT nazwa_turnieju, nazwa_druzyny FROM udzialy where nazwa_turnieju='$turniej' and nazwa_druzyny='$druzyna'";
                    $check_result=mysqli_query($conn, $check_query);
                    $check=mysqli_num_rows($check_result);
                    $check1=0;
                }
                
                if ($check1 == 0)
                {
                    if($check == 0)
                    {
                        echo "<center>";

                        if ($turniej != 'Wybierz turniej...' && $druzyna != 'Wybierz drużynę...' && !empty($nagroda) && !empty($miejsce)) 
                        {
                            $query3="INSERT INTO udzialy(`nagroda_pieniezna`, `zajete_miejsce`, `nazwa_turnieju`, `nazwa_druzyny`) values ('$nagroda', '$miejsce', '$turniej', '$druzyna')";
                            if (mysqli_query($conn, $query3) == TRUE) {
                                echo "Dodano udział drużyny w turnieju";
                            }
                        }

                        echo "</center>";
                    }
                    else
                    {
                        echo '<center>Dodanie zakończyło się niepowodzeniem! <br> Ta drużyna już bierze udział w tym turnieju!</center><br>';
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