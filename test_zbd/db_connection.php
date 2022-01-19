<?php
function OpenCon()
    {
        $host="localhost";
        $user="root";
        $passwd="";
        $dbname="baza_zbd";
        $polaczenie=mysqli_connect($host,$user,$passwd,$dbname);

        return $polaczenie;
    }
 
function CloseCon($polaczenie)
    {
        mysqli_close($polaczenie);
    }  
?>