<?php
function showcalendar($mois, $annes) {
    $moistxt = cal_info(0);
    $moistxtfr = ['null', 'janvier', 'février', 'mars', 'avril', 'mai', 'juin', 'juillet', 'août', 'septembre', 'octobre', 'novembre', 'décembre'];
    $str =  '===================================='.PHP_EOL;
    $tocomp = 37 - strlen($moistxtfr[intval($mois)].' '.$annes);
    $b=0;
    $str .= '||';
    $space = round($tocomp/2);

    for ($b = $space; $b > 3; $b--) {
        $str .= ' ';
    }
    $str .= $moistxtfr[intval($mois)].' '.$annes;
    for ($b = $space; $b > 3; $b--) {
        $str .= ' ';
    }
    if (strlen($moistxtfr[intval($mois)].' '.$annes)%2 === 1) {
        $str .= ' ';
    }
    $str .= '||'.PHP_EOL;
    $str .= '===================================='.PHP_EOL;
    $str .= '| Lu | Ma | Me | Je | Ve | Sa | Di |'.PHP_EOL;
    $str .= '------------------------------------'.PHP_EOL;
    $semai=0;
    $date = '1-'.$mois.'-'.$annes;
    $nameOfDay = date('D', strtotime($date));
    $daynames = ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'];
    foreach ($daynames as $day) {
        if ($nameOfDay == $day) {
            break;
        } else {
            $str .=  '|    ';
            $semai++;
        }
    }
    for ($i=1;$i <= cal_days_in_month(CAL_GREGORIAN, intval($mois), $annes) ;$i++) {
        if ($i < 10) {
            if ($semai=== 6) {

                $str .=  '|  '.$i.' |'.PHP_EOL;
                $str .='------------------------------------'.PHP_EOL;
                $semai=0;
            } else {
                $str .=  '|  '.$i.' ';
                $semai++;
            }
        } else {
            if ($semai=== 6) {
                $str .=  '| '.$i.' |'.PHP_EOL;
                $str .='------------------------------------'.PHP_EOL;
                $semai=0;
            } else {
                $str .=  '| '.$i.' ';
                $semai++;
            }
        }

    }
    if ($semai !== 0) {
        while ($semai <= 6) {
            $str .= '|    ';

            $semai++;
        }
        $str .=  '|'.PHP_EOL.'------------------------------------'.PHP_EOL;
    }


    echo $str;

}
if ($argc > 1 && intval($argv[1])) {
    for ($i=1;$i <= 12;$i++) {
        showcalendar($i, intval($argv[1]));
    }
}
