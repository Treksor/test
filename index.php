<?
    error_reporting(E_ERROR|E_WARNING|E_PARSE|E_NOTICE);
    ini_set('display errors', 1);
    echo "<h2>Задание 1</h2><br>";
//    $date=array(1,2,3,4,5);
//    print_r($date);
//    mt_srand(time());
    $date=array(mt_rand(),mt_rand(),mt_rand(),mt_rand(),mt_rand());
    echo "<br>";
//    $day1=date('d',$date[0]);
//    $day2=date('d',$date[1]);
//    $day3=date('d',$date[2]);
//    $day4=date('d',$date[3]);
//    $day5=date('d',$date[4]);
    echo $day1=date('d',$date[0]),', ';
    echo $day2=date('d',$date[1]),', ';
    echo $day3=date('d',$date[2]),', ';
    echo $day4=date('d',$date[3]),', ';
    echo $day5=date('d',$date[4]), '  ';
    echo 'минимальный день:'.min($day1,$day2,$day3,$day4,$day5),"<br>";
    echo $month1=date('m',$date[0]),', ';
    echo $month2=date('m',$date[1]),', ';
    echo $month3=date('m',$date[2]),', ';
    echo $month4=date('m',$date[3]),', ';
    echo $month5=date('m',$date[4]), '  ';
    echo 'максимальный месяц:'.max($month1,$month2,$month3,$month4,$month5),"<br>";

    sort($date);
    print_r($date);
    $selected=array_pop($date);
    echo "<br>".date('e, d.m.Y h:i:s',$selected). "<br>";
    print_r($date);
    date_default_timezone_set('America/New_York');
    echo "<br>".date('e, d.m.Y h:i:s',$selected);




    ?>
