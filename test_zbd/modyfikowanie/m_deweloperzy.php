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
            <a href="m_deweloperzy.php"><ul>Zmień miejsce zatrudnienia dewelopera</ul></a>
            <a href="m_zawodnicy.php"><ul>Zmień drużynę zawodnika</ul></a>
            <a href="m_wsparcia.php"><ul>Zmień maksymalną wersję silnika</ul></a>
        </li>
    </header>
    <content>
        <h1>MODYFKIOWANIE - DEWELOPERZY</h1>
        <div class="php-script">           
            <?php
                include '../db_connection.php';

                $conn = OpenCon(); 

                echo '
                <div class="custom-select">
                    <form method="post" action="" id="form1">
                        <select name="choose" onchange="">
                            <option>Wybierz dewelopera...</option>';        

                $query1="SELECT id_dewelopera from deweloperzy order by id_dewelopera";
                $result1=mysqli_query($conn, $query1);
                while($row1=mysqli_fetch_assoc($result1))
				{		
					echo '<option value="'.$row1['id_dewelopera'].'">'.$row1['id_dewelopera'].'</option>';
				}
                
                echo '
                        </select>
                        <input type="submit" value="Wybierz" form="form1">
                    </form>
                </div>';

                $choose = isset($_POST['choose']) ? $_POST['choose'] : '';

                if (is_int((int)$choose) == 1) {
                    $query3="SELECT id_dewelopera, imie, nazwisko, nazwa_producenta from deweloperzy where id_dewelopera=$choose";
                    $result3=mysqli_query($conn, $query3);
                    $row3 = null;
                    if ($choose >= 1) {
                        $row3=mysqli_fetch_assoc($result3);
                    }                      

                    echo '
                    <div class="custom-select">
                        <form method="post" action="" id="form2">
                            <label for="id">ID:</label><br>    
                            <input type="text" name="id" value="'.$row3['id_dewelopera'].'" readonly><br>                  

                            <label for="choose">Producent (pracodawca):</label><br>
                            <select name="choose2">
                                <option>'.$row3['nazwa_producenta'].'</option>';        

                    $query4="SELECT nazwa_producenta from producenci order by nazwa_producenta";
                    $result4=mysqli_query($conn, $query4);
                    while($row4=mysqli_fetch_assoc($result4))
                    {		
                        echo '<option value="'.$row4['nazwa_producenta'].'">'.$row4['nazwa_producenta'].'</option>';
                    }
                    
                    echo '
                            </select>
                            <br>
                            <input type="submit" value="Modyfikuj" form="form2">
                        </form>
                    </div>';

                    $choose2 = isset($_POST['choose2']) ? $_POST['choose2'] : '';  
                    $id = isset($_POST['id']) ? $_POST['id'] : '';  

                    $query5="UPDATE deweloperzy set nazwa_producenta='$choose2' where id_dewelopera=$id";
                    if (mysqli_query($conn, $query5) == TRUE) {
                        echo "<center>Zmodyfikowano pracodawcę dewelopera</center>";
                    }
                }

                $query2="SELECT id_dewelopera, imie, nazwisko, nazwa_producenta from deweloperzy order by id_dewelopera";
                $result2=mysqli_query($conn, $query2);
                
                echo '<table>';
                echo '<tr><td>'.'ID'.'</td><td>'.'Imie'.'</td><td>'.'Nazwisko'.'</td><td>'.'Producent (pracodawca)'.'</td></tr>';
                while($row2=mysqli_fetch_assoc($result2))
				{		
					echo '<tr><td>'.$row2['id_dewelopera'].'</td><td>'.$row2['imie'].'</td><td>'.$row2['nazwisko'].'</td><td>'.$row2['nazwa_producenta'].'</td></tr>';
				}
                echo '</table>';

                CloseCon($conn);
            ?> 
        </div>             
    </content>
    <footer>
    </footer>
</body>
</html>