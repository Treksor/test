<?
    error_reporting(E_ERROR|E_WARNING|E_PARSE|E_NOTICE);
    ini_set('display errors', 1);

    $ini_string='
[игрушка мягкая мишка белый]
цена ='. mt_rand(1,10).';
количество заказано = '. mt_rand(1,10).';
остаток на складе = '. mt_rand(0,10).';
discount = '. mt_rand(0,2).'0%;
    
[одежда детская куртка синияя синтепон]
цена = '. mt_rand(1,10).';
количество заказано = '. mt_rand(1,10).';
остаток на складе = '. mt_rand(0,10).';
discount = '. mt_rand(0,2).'0%;
    
[игрушка детская велосипед]
цена = '. mt_rand(1,10).';
количество заказано = '. mt_rand(1,10).';
остаток на складе = '. mt_rand(0,10).';
discount = '. mt_rand(0,2).'0%;
    
';
    $bd = parse_ini_string($ini_string,true);
//    print_r($bd);
//    foreach ($bd as $item => $massiv){
//        foreach($massiv as $param => $value){
//            echo "[$item]:[$param]:[$value]";
//            echo '<br>';
//        }
//    }
//    foreach ($bd as $i =>$array) {
//        ${"array{$i}"} = $array;
//        print_r($array);
//    }
//    echo $bd['игрушка мягкая мишка белый']['цена'];
//    echo 'Вы заказали:<br>';
//    echo 'Игрушка мягкая мишка белый';
//    echo '      в колличестве:',$bd['игрушка мягкая мишка белый']['количество заказано'],
//    'по цене',$bd['игрушка мягкая мишка белый']['цена'],
//    'общая стоимость составит:',$bd['игрушка мягкая мишка белый']['количество заказано']*$bd['игрушка мягкая мишка белый']['цена'];
//    if ($bd['игрушка мягкая мишка белый']['количество заказано']>$bd['игрушка мягкая мишка белый']['остаток на складе']){
//        echo $bd['игрушка мягкая мишка белый']['количество заказано'];
//    }
//        else {
//        echo 'извините, на складе только ',$bd['игрушка мягкая мишка белый']['остаток на складе'];
//        }
     $item1='Игрушка мягкая мишка белый';
     $item2='Одежда детская куртка синяя синтепон';
     $item3='Игрушка детская велосипед';

     $price1=$bd['игрушка мягкая мишка белый']['цена'];
     $price2=$bd['одежда детская куртка синияя синтепон']['цена'];
     $price3=$bd['игрушка детская велосипед']['цена'];

     $order1=$bd['игрушка мягкая мишка белый']['количество заказано'];
     $order2=$bd['одежда детская куртка синияя синтепон']['количество заказано'];
     $order3=$bd['игрушка детская велосипед']['количество заказано'];

     $storage1=$bd['игрушка мягкая мишка белый']['остаток на складе'];
     $storage2=$bd['одежда детская куртка синияя синтепон']['остаток на складе'];
     $storage3=$bd['игрушка детская велосипед']['остаток на складе'];

     $discount1=$bd['игрушка мягкая мишка белый']['discount'];
     $discount2=$bd['одежда детская куртка синияя синтепон']['discount'];
     $discount3=$bd['игрушка детская велосипед']['discount'];

//     function items($item1='Игрушка мягкая мишка белый',$item2='Одежда детская куртка синяя синтепон',
//                    $item3='Игрушка детская велосипед'){
//         echo "$item1<br>$item2<br>$item3";
//     }
    function item1($item1='Игрушка мягкая мишка белый'){
        global $order1,$storage1,$price1,$fullprice,$count;
        echo "$item1, в колличестве $order1 ед. товара";
        if ($order1>$storage1){
            echo ", но к сожалению у нас на складе только $storage1 ед. товара. ";
        }
        else {
            echo ". Cтоимость 1ед. товара составляет $price1$";
            $fullprice=($order1*$price1);
            $count=$order1;
        }
    }

    function item2($item2='Одежда детская куртка синяя синтепон'){
        global $order2,$storage2,$price2,$fullprice,$count;
        echo "$item2, в колличестве $order2 ед. товара";
        if ($order2>$storage2){
           echo ", но к сожалению у нас на складе только $storage2 ед. товара. ";
       }
        else {
           echo ". Cтоимость 1ед. товара составляет $price2$";
           $fullprice+=($order2*$price2);
           $count+=$order2;
       }
    }

    function item3($item3='Игрушка мягкая мишка белый'){
        global $order3,$storage3,$price3,$fullprice,$count;
        echo "$item3, в колличестве $order3 ед. товара";
        if ($order3>$storage3){
           echo ", но к сожалению у нас на складе только $storage3 ед. товара. ";
       }
        else {
           echo ". Cтоимость 1ед. товара составляет $price3$";
           $fullprice+=($order3*$price3);
           $count+=$order3;
       }
    }

     echo 'Вы заказали:<br>';
     item1();
     echo '<br>';
     echo $fullprice;
     echo '<br>';
     echo $count;
     echo '<br>';
     echo 'ПЕРВАЯ ФУНКЦИЯ ПОСЧИТАНА';
     echo '<br>';

     item2();
     echo '<br>';
     echo $fullprice;
     echo '<br>';
     echo $count;
     echo '<br>';
     echo 'Вторая ФУНКЦИЯ ПОСЧИТАНА';
     echo '<br>';
     item3();
     echo '<br>';
     echo $fullprice;
     echo '<br>';
     echo $count;
     echo '<br>';
     echo 'Третья ФУНКЦИЯ ПОСЧИТАНА';
     echo '<br>';



?>