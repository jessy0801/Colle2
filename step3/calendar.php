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
    $str .= ucfirst($moistxtfr[intval($mois)]).' '.$annes;
    for ($b = round($tocomp/2); $b > 3; $b--) {
        $str .= ' ';
    }
    echo strlen($moistxtfr[intval($mois)].' '.$annes).PHP_EOL;
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
$result = [];
$result1 = [];
$date = '';
while ($date !== 'exit') {
    $date  = readline('Choisissez une date : ');
    $result = explode(' ', $date);
    $result1 = explode('-', $date);
    if (count($result) === 2 &&is_int(intval($result[0])) && is_int(intval($result[1])) && intval($result[0]) <= 12) {
        showcalendar(intval($result[0]), $result[1]);
    } elseif (count($result1) === 2 && is_int(intval($result1[0])) && is_int(intval($result1[1])) && intval($result1[1]) <= 12) {
        showcalendar(intval($result1[1]), $result1[0]);
    } elseif (intval($date)) {
        for ($i=1;$i <= 12;$i++) {
            showcalendar($i, $date);
        }
    }
}
