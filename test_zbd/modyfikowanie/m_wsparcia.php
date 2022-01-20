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
        <h1>MODYFKIOWANIE - WSPARCIA</h1>
        <div class="php-script">           
            <?php
                include '../db_connection.php';

                $conn = OpenCon(); 

                echo '
                <div class="custom-select">
                    <form method="post" action="" id="form1">
                        <select name="choose" onchange="">
                            <option>Wybierz wsparcie...</option>';        

                $query1="SELECT nazwa_silnika, nazwa_jezyka from wsparcia order by nazwa_silnika, nazwa_jezyka";
                $result1=mysqli_query($conn, $query1);
                while($row1=mysqli_fetch_assoc($result1))
				{		
					echo '<option value="'.$row1['nazwa_silnika'].' | '.$row1['nazwa_jezyka'].'">'.$row1['nazwa_silnika'].' | '.$row1['nazwa_jezyka'].'</option>';
				}
                
                echo '
                        </select>
                        <input type="submit" value="Wybierz" form="form1">
                    </form>
                </div>';

                $choose = isset($_POST['choose']) ? $_POST['choose'] : '';

                $choose_array=array('a','b');
                $silnik='';
                $jezyk='';

                if($choose != 'Wybierz wsparcie...')
                {
                    $choose_array=explode(' | ', $choose);
                    if(!isset($choose_array[1]))
                    {
                        $choose_array[1] = null;
                    }
                    $silnik=$choose_array[0];
                    $jezyk=$choose_array[1];
                }

                
                if (is_string($choose) == 1) {
                    $query3="SELECT nazwa_silnika, nazwa_jezyka, maks_wersja_silnika from wsparcia where nazwa_silnika='$silnik' and nazwa_jezyka='$jezyk'";
                    $result3=mysqli_query($conn, $query3);
                    $row3 = null;
                    if (strlen($choose) >= 1) {
                        $row3=mysqli_fetch_assoc($result3);
                    }
                    $nazwa_silnika = isset($row3['nazwa_silnika']) ? $row3['nazwa_silnika'] : '';   
                    $nazwa_jezyka = isset($row3['nazwa_jezyka']) ? $row3['nazwa_jezyka'] : '';  
                    $maks_wersja_silnika = isset($row3['maks_wersja_silnika']) ? $row3['maks_wersja_silnika'] : ''; 

                    echo '
                    <div class="custom-select">
                        <form method="post" action="" id="form2">
                            <label for="wsparcie">Wsparcie:</label><br>    
                            <input type="text" name="wsparcie" value="'.$nazwa_silnika.'   '.$nazwa_jezyka.'" readonly><br>             

                            <label for="choose2">Maksymalna wersja silnika:</label><br>
                            <input type="text" name="choose2" value="'.$maks_wersja_silnika.'"><br>
                            <br>
                            <input type="submit" value="Modyfikuj" form="form2">
                        </form>
                    </div>';

                    $choose2 = isset($_POST['choose2']) ? $_POST['choose2'] : '';  
                    $wsparcie = isset($_POST['wsparcie']) ? $_POST['wsparcie'] : ''; 
                    
                    $wsparcie_array=array('a','b');
                    $check4=1;

                    if(!empty($wsparcie))
                    {
                        $wsparcie_array=explode('   ', $wsparcie);
                        if(!isset($wsparcie_array[1]))
                        {
                            $wsparcie_array[1] = null;
                        }
                        $silnik2=$wsparcie_array[0];
                        $jezyk2=$wsparcie_array[1];
                        $check4=0;
                    }

                    if($check4==0 && !empty($silnik2))
                    {
                        if (empty($choose2))
                        {
                            $query5="UPDATE wsparcia set maks_wersja_silnika=NULL where nazwa_silnika='$silnik2' and nazwa_jezyka='$jezyk2'";
                            if (mysqli_query($conn, $query5) == TRUE) {
                                echo "<center>Zmodyfikowano maksymalną wersję silnika</center>";
                            }
                        }
                        else
                        {
                            $query5="UPDATE wsparcia set maks_wersja_silnika='$choose2' where nazwa_silnika='$silnik2' and nazwa_jezyka='$jezyk2'";
                            if (mysqli_query($conn, $query5) == TRUE) {
                                echo "<center>Zmodyfikowano maksymalną wersję silnika</center>";
                            }
                        } 
                    }                                         
                }

                $query2="SELECT nazwa_silnika, nazwa_jezyka, coalesce(maks_wersja_silnika, 'najnowsza') as wersja from wsparcia order by nazwa_silnika, nazwa_jezyka";
                $result2=mysqli_query($conn, $query2);
                
                echo '<table>';
                echo '<tr><td>'.'Silnik'.'</td><td>'.'Język programowania'.'</td><td>'.'Maksymalna wersja silnika'.'</td></tr>';
                while($row2=mysqli_fetch_assoc($result2))
				{		
					echo '<tr><td>'.$row2['nazwa_silnika'].'</td><td>'.$row2['nazwa_jezyka'].'</td><td>'.$row2['wersja'].'</td></tr>';
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