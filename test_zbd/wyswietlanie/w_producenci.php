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
        <h1>WYŚWIETLANIE - PRODUCENCI</h1>
        <div class="php-script">           
            <?php
                include '../db_connection.php';

                $conn = OpenCon(); 

                echo '
                <div class="custom-select">
                    <form method="post" action="">
                        <select name="choose" onchange="this.form.submit()">
                            <option>Wybierz producenta...</option>';        

                $query1="SELECT nazwa_producenta from producenci";
                $result1=mysqli_query($conn, $query1);
                while($row1=mysqli_fetch_assoc($result1))
				{		
					echo '<option value="'.$row1['nazwa_producenta'].'">'.$row1['nazwa_producenta'].'</option>';
				}
                
                echo '
                        </select>
                    </form>
                </div>';

                $choose = isset($_POST['choose']) ? $_POST['choose'] : '';

                $query2="SELECT nazwa_producenta, data_powstania, siedziba FROM producenci WHERE nazwa_producenta='$choose'";
                $result2=mysqli_query($conn,$query2);
                $row2=mysqli_fetch_assoc($result2);
                
                echo '<table>';
                
                if ($choose != NULL)
                {
                    echo '<tr><td>Nazwa</td><td>Data powstania</td><td>Siedziba</td></tr><br>';
                    echo '<tr><td>'.$row2['nazwa_producenta'].'</td><td>'.$row2['data_powstania'].'</td><td>'.$row2['siedziba'].'</td></tr>';
                }
                else
                {
                    echo '<h2>Nie wybrano żadnego producenta...</h2>';
                }

                echo '</table><table>';

                $query3="SELECT imie, nazwisko FROM deweloperzy WHERE nazwa_producenta='$choose'";

                $result3=mysqli_query($conn,$query3);
                $check1=mysqli_num_rows($result3);

                if ($check1 != 0)
                {
                    echo '<h2>Deweloperzy:</h2>';
                    echo '<tr><td>Imię'.'</td><td>'.'Nazwisko</td></tr>';
                }

                while($row3=mysqli_fetch_assoc($result3))
				{		
					echo '<tr><td>'.$row3['imie'].'</td><td>'.$row3['nazwisko'].'</td></tr>';
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