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
        <h1>DODAWANIE - DRUŻYNY</h1>
        <div class="php-script">           
            <?php
                include '../db_connection.php';

                $conn = OpenCon(); 
                
                echo '
                <div class="custom-select">
                    <form method="post" action="">
                        <label for="druzyna">Drużyna:</label><br>
                        <input type="text" id="druzyna" name="druzyna" value="Druzyna"><br>

                        <label for="date">Data założenia:</label><br>
                        <input type="date" id="date" name="date" value="2000-01-01"><br>

                        <label for="kraj">Kraj założenia:</label><br>
                        <input type="text" id="kraj" name="kraj" value="Polska" onkeypress="return (event.charCode > 64 && event.charCode < 91) || (event.charCode > 96 && event.charCode < 123) || (event.charCode==32)"><br>

                        <input type="submit" value="Dodaj">
                    </form>
                </div>';

                $druzyna = isset($_POST['druzyna']) ? $_POST['druzyna'] : '';
                $date = isset($_POST['date']) ? $_POST['date'] : '';
                $kraj = isset($_POST['kraj']) ? $_POST['kraj'] : '';
                
                $check_query="SELECT nazwa_druzyny FROM druzyny where nazwa_druzyny='$druzyna'";
                $check_result=mysqli_query($conn, $check_query);
                $check=mysqli_num_rows($check_result);
                if($check == 0)
                {
                    echo "<center>";

                    if (!empty($druzyna) && !empty($kraj)) 
                    {
                        $query3="INSERT INTO druzyny(`nazwa_druzyny`, `data_zalozenia`, `kraj_zalozenia`) values ('$druzyna', '$date', '$kraj')";
                        if (mysqli_query($conn, $query3) == TRUE) {
                            echo "Dodano drużynę";
                        }
                    }

                    echo "</center>";
                }
                else
                {
                    echo '<center>Dodanie zakończyło się niepowodzeniem! <br> Taka drużyna już istnieje w bazie danych!</center><br>';
                }

                CloseCon($conn);
            ?> 
        </div>             
    </content>
    <footer>
    </footer>
</body>
</html>