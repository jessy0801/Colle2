<?php
function showcalendar($mois, $annes) {
    $moistxt = cal_info(0);
    $moistxtfr = ['null', 'janvier', 'février', 'mars', 'avril', 'mai', 'juin', 'juillet', 'août', 'septembre', 'octobre', 'novembre', 'décembre'];
    $str =  '===================================='.PHP_EOL;
    $tocomp = 37 - strlen($moistxtfr[intval($mois)].' '.$annes);
    $b=0;
    $str .= '||';

    for ($b = round($tocomp/2); $b > 3; $b--) {
        $str .= ' ';
    }
    $str .= $moistxtfr[intval($mois)].' '.$annes;
    for ($b = round($tocomp/2); $b > 3; $b--) {
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
if (count($argv) > 1) {
    if ($argc > 2 && is_int(intval($argv[1])) && is_int(intval($argv[2])) && intval($argv[1]) <= 12) {
        showcalendar($argv[1], intval($argv[2]));
    } elseif (is_string($argv[1])) {
        $result = explode('-', $argv[1]);
        if (is_int(intval($result[0])) && is_int(intval($result[1])) && intval($result[1]) <= 12) {
            showcalendar(intval($result[1]), $result[0]);
        } else {
            return false;
        }
    }
}
