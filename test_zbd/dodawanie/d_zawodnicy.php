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
        <h1>DODAWANIE - ZAWODNICY</h1>
        <div class="php-script">           
            <?php
                include '../db_connection.php';

                $conn = OpenCon(); 
                
                echo '
                <div class="custom-select">
                    <form method="post" action="">
                        <label for="name">Imie:</label><br>
                        <input type="text" id="name" name="name" value="Imie" onkeypress="return (event.charCode > 64 && event.charCode < 91) || (event.charCode > 96 && event.charCode < 123) || (event.charCode==32)"><br>

                        <label for="lname">Nazwisko:</label><br>
                        <input type="text" id="lname" name="lname" value="Nazwisko" onkeypress="return (event.charCode > 64 && event.charCode < 91) || (event.charCode > 96 && event.charCode < 123) || (event.charCode==32)"><br>

                        <label for="bdate">Data urodzenia:</label><br>
                        <input type="date" id="bdate" name="bdate" value="2000-01-01"><br>

                        <label for="country">Kraj pochodzenia:</label><br>
                        <input type="text" id="country" name="country" value="Polska" onkeypress="return (event.charCode > 64 && event.charCode < 91) || (event.charCode > 96 && event.charCode < 123) || (event.charCode==32)"><br>

                        <label for="choose">Drużyna:</label><br>
                        <select name="choose">
                            <option>Wybierz drużynę...</option>';        

                $query1="SELECT nazwa_druzyny from druzyny order by nazwa_druzyny";
                $result1=mysqli_query($conn, $query1);
                while($row1=mysqli_fetch_assoc($result1))
				{		
					echo '<option value="'.$row1['nazwa_druzyny'].'">'.$row1['nazwa_druzyny'].'</option>';
				}
                
                echo '
                        </select>
                        <br>
                        <input type="submit" value="Dodaj">
                    </form>
                </div>';


                $name = isset($_POST['name']) ? $_POST['name'] : '';
                $lname = isset($_POST['lname']) ? $_POST['lname'] : '';
                $bdate = isset($_POST['bdate']) ? $_POST['bdate'] : '';
                $country = isset($_POST['country']) ? $_POST['country'] : '';
                $choose = isset($_POST['choose']) ? $_POST['choose'] : '';

                $name=ucfirst(strtolower($name));
                $lname=ucfirst(strtolower($lname));
                $country=ucfirst(strtolower($country));

                echo "<center>";

                    if ($choose != 'Wybierz drużynę...' && !empty($lname) && !empty($name) && !empty($country)) {
                        $query3="INSERT INTO zawodnicy(`imie`, `nazwisko`, `data_urodzenia`, `kraj_pochodzenia`, `nazwa_druzyny`) values ('$name', '$lname', '$bdate', '$country', '$choose')";
                        if (mysqli_query($conn, $query3) == TRUE) {
                            echo "Dodano zawodnika";
                        }
                    }
                    
                echo "</center>";

                CloseCon($conn);
            ?> 
        </div>             
    </content>
    <footer>
    </footer>
</body>
</html>