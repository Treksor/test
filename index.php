<?
    error_reporting(E_ERROR|E_WARNING|E_PARSE|E_NOTICE);
    ini_set('display errors', 1);

    $ini_string='
[игрушка мягкая мишка белый]
цена ='. mt_rand(1,10).';
количество заказано = '. mt_rand(1,10).';
остаток на складе = '. mt_rand(0,10).';
discount = '. mt_rand(0,2).';
    
[одежда детская куртка синияя синтепон]
цена = '. mt_rand(1,10).';
количество заказано = '. mt_rand(1,10).';
остаток на складе = '. mt_rand(0,10).';
discount = '. mt_rand(0,2).';
    
[игрушка детская велосипед]
цена = '. mt_rand(1,10).';
количество заказано = '. mt_rand(1,10).';
остаток на складе = '. mt_rand(0,10).';
discount = '. mt_rand(0,2).';
    
';
    $bd = parse_ini_string($ini_string,true);
//    print_r($bd);

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


    function item($order,$storage,$price,$item='Игрушка мягкая мишка белый'){
        global $fullprice,$count;
        $result= "$item, в колличестве $order ед. товара";
        if ($storage==0) {
            $result.= ", но, к сожалению, данный товар закончился на складе";
        }
        elseif ($order>$storage){
            $result.= ", но, к сожалению, у нас на складе только $storage ед. товара. ";
        }
        else {
            $result.= ". Cтоимость 1ед. товара составляет $price$";
            $fullprice+=($order*$price);
            $count+=$order;
        }
        return $result;
    }


    function sale($order,$storage){
        if ($order>=3 & $storage>$order){
            $special='За покупку трех и более велосипедов вы получаете скидку 30%';
        }
        else {
            $special='';
        }
        return $special;
    }




    function disc($item,$order,$price,$discount=''){
            global $fullprice;
            switch($discount){
            case '1':{
                $profit=(($order*$price)/100)*10;
                $text= "скидка на $item стоставляет 10%, вы экэномите $profit$";
                $fullprice-=$profit;
                break;
            }
            case '2':{
                $profit=(($order*$price)/100)*20;
                $text= "скидка на $item стоставляет 20%, вы экэномите $profit$";
                $fullprice-=$profit;
                break;
            }
                case '3':{
                 $profit=(($order*$price)/100)*30;
                 $text= "скидка на $item стоставляет 30%, вы экэномите $profit$";
                 $fullprice-=$profit;
                }
                break;
            default:
                $text= '';
                break;
        }
        return $text;
    }

     $count=0;
     $disc='disc';
     echo 'Вы заказали:<br>';
     echo item($order1,$storage1,$price1),'<br>';
     echo item($order2,$storage2,$price2,$item2),'<br>';
     echo item($order3,$storage3,$price3,$item3),'<br>';

     echo "Итого вы заказали $count вещей на сумму $fullprice$",'<br>','<br>';

    if ($count==0){
        exit;
    }

     echo ($order1<$storage1)? "{$disc($item1,$order1,$price1,$discount1)}<br>":'';
     echo ($order2<$storage2)? "{$disc($item2,$order2,$price2,$discount2)}<br>":'';
     if (sale($order3,$storage3))  {
         echo '<h2>',sale($order3,$storage3),'</h2>';
         echo $disc($item3,$order3,$price3,3),'<br>';
     }
     else{
         echo ($order3<$storage3)? "{$disc($item3,$order3,$price3,$discount3)}<br>":'';
         echo '<br>';
     }


     echo "Итого вы заказали $count вещей. Со скидкой сумма заказа составляет $fullprice$",'<br>';








?>