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
        <h1>DODAWANIE - WYDAWCY</h1>
        <div class="php-script">           
            <?php
                include '../db_connection.php';

                $conn = OpenCon(); 
                
                echo '
                <div class="custom-select">
                    <form method="post" action="">
                        <label for="wydawca">Wydawca:</label><br>
                        <input type="text" id="wydawca" name="wydawca" value="Wydawca"><br>

                        <input type="submit" value="Dodaj">
                    </form>
                </div>';

                $wydawca = isset($_POST['wydawca']) ? $_POST['wydawca'] : '';
                
                $check_query="SELECT nazwa_wydawcy FROM wydawcy where nazwa_wydawcy='$wydawca'";
                $check_result=mysqli_query($conn, $check_query);
                $check=mysqli_num_rows($check_result);
                if($check == 0)
                {
                    echo "<center>";

                    if(!empty($wydawca))
                    {
                        $query1="INSERT INTO wydawcy(`nazwa_wydawcy`) values ('$wydawca')";
                        if (mysqli_query($conn, $query1) == TRUE) 
                        {
                            echo "Dodano wydawcę";
                        }
                    }
                    
                    echo "</center>";
                }
                else
                {
                    echo '<center>Dodanie zakończyło się niepowodzeniem! <br> Taki wydawca już istnieje w bazie danych!</center><br>';
                }

                CloseCon($conn);
            ?> 
        </div>             
    </content>
    <footer>
    </footer>
</body>
</html>