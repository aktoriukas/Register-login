<?php
    function test_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
        } 
     
    function lock($code){
        $key = array("A"=>"Q", "B"=>"W", "C"=>"E", "D"=>"R", "E"=>"T", "F"=>"Y", "G"=>"U", "H"=>"I", "I"=>"O", "J"=>"P", "K"=>"A", "L"=>"S", "M"=>"D", "N"=>"F", "O"=>"G", "P"=>"H", "Q"=>"J", "R"=>"K", "S"=>"L", "T"=>"Z", "U"=>"X", "V"=>"C", "W"=>"V", "X"=>"B", "Y"=>"N", "Z"=>"M",);
        $keys = array("a"=>"q", "b"=>"w", "c"=>"e", "d"=>"r", "e"=>"t", "f"=>"y", "g"=>"u", "h"=>"i", "i"=>"o", "j"=>"p", "k"=>"a", "l"=>"s", "m"=>"d", "n"=>"f", "o"=>"g", "p"=>"h", "q"=>"j", "r"=>"k", "s"=>"l", "t"=>"z", "u"=>"x", "v"=>"c", "w"=>"v", "x"=>"b", "y"=>"n", "z"=>"m",);

        $final ='';
        $mystr = str_split($code);
        $lenght = strlen($code);
           foreach($mystr as $x){
            foreach($keys as $keysX => $keysZ){
                if ($keysX == $x){
                    $final .= $keysZ;
                }
            }
               foreach($key as $keyX => $keyZ){
                   if ($keyX == $x){
                       $final .= $keyZ;
                   }
                }
             }

        return $final;
    }
?>