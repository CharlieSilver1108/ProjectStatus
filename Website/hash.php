<?php
function Factorial($number){
    $factorial = 1;
    for ($i = 1; $i <= $number; $i++){
      $factorial = $factorial * $i;
    }
    return $factorial;
}

function hash32($pwd){
    $o = array_fill(0, 32, NULL);
    if (is_float($pwd)){
        while($pwd % 1 != 0){
            $pwd *= 10;
        }
        $pwd = intval($pwd);
        $pwd = strval($pwd);
    }
    if (is_int($pwd)){
        $pwd = strval($pwd);
    }
    if (is_string($pwd)){
        $array_pwd = str_split($pwd);
        $pwd = NULL;
        foreach ($array_pwd as $char){
            $pwd .= (ord($char)+4);             //caesar cipher
        }
    }elseif (!is_string($pwd)){
        die;
    }
    $pwd_array = str_split($pwd);
    $z = array();
    foreach($pwd_array as $char){
        array_push($z, ord($char));
    }

    $length = count($z) - 1;
    for($i=1; $i<=$length; $i++){
        if(intval($z[$i]) % 3 == 0){
            $z[$i] = Factorial($z[$i]);
        }
        if(intval($z[$i]) % 2 == 0){
            $z[$i] = intval($z[$i]) / 2;
        }
    }
    echo '<pre>'; print_r($z); echo '</pre>';
    

}

hash32(12345678);
?>
