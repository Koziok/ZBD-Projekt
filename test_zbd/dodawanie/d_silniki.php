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
        <h1>DODAWANIE - SILNIKI</h1>
        <div class="php-script">           
            <?php
                include '../db_connection.php';

                $conn = OpenCon(); 
                
                echo '
                <div class="custom-select">
                    <form method="post" action="">
                        <label for="silnik">Silnik:</label><br>
                        <input type="text" id="silnik" name="silnik" value="Silnik"><br>

                        <label for="date">Data powstania:</label><br>
                        <input type="date" id="date" name="date" value="2022-01-01"><br>

                        <input type="submit" value="Dodaj">
                    </form>
                </div>';

                $silnik = isset($_POST['silnik']) ? $_POST['silnik'] : '';
                $date = isset($_POST['date']) ? $_POST['date'] : '';             
                
                $check_query="SELECT nazwa_silnika FROM silniki where nazwa_silnika='$silnik'";
                $check_result=mysqli_query($conn, $check_query);
                $check=mysqli_num_rows($check_result);
                if($check == 0)
                {
                    echo "<center>";

                    if (!empty($silnik)) {
                        $query3="INSERT INTO silniki(`nazwa_silnika`, `data_powstania`) values ('$silnik', '$date')";
                        if (mysqli_query($conn, $query3) == TRUE) {
                            echo "Dodano silnik";
                        }
                    }

                    echo "</center>";
                }
                else
                {
                    echo '<center>Dodanie zakończyło się niepowodzeniem! <br> Taki silnik już istnieje w bazie danych!</center><br>';
                }

                CloseCon($conn);
            ?> 
        </div>             
    </content>
    <footer>
    </footer>
</body>
</html>