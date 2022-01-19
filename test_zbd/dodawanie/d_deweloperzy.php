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
        <h1>DODAWANIE - DEWELOPERZY</h1>
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

                        <label for="producent">Producent:</label><br>
                        <select name="producent">
                            <option>Wybierz producenta...</option>';        

                $query1="SELECT nazwa_producenta from producenci order by nazwa_producenta";
                $result1=mysqli_query($conn, $query1);
                while($row1=mysqli_fetch_assoc($result1))
				{		
					echo '<option value="'.$row1['nazwa_producenta'].'">'.$row1['nazwa_producenta'].'</option>';
				}
                
                echo '
                        </select>
                        <br>
                        <input type="submit" value="Dodaj">
                    </form>
                </div>';


                $name = isset($_POST['name']) ? $_POST['name'] : '';
                $lname = isset($_POST['lname']) ? $_POST['lname'] : '';
                $producent = isset($_POST['producent']) ? $_POST['producent'] : '';

                $name=ucfirst(strtolower($name));
                $lname=ucfirst(strtolower($lname));    

                echo "<center>";

                if ($producent != 'Wybierz producenta...' && !empty($lname) && !empty($name)) {
                    $query3="INSERT INTO deweloperzy(`imie`, `nazwisko`, `nazwa_producenta`) values ('$name', '$lname', '$producent')";
                    if (mysqli_query($conn, $query3) == TRUE) {
                        echo "Dodano dewelopera";
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