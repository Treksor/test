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
    print_r($bd);
//    $output=array(                  //массив на выход для заполнения
//    'Наименование'=>0,
//    'Заказано'=>0,
//    'Остаток на складе'=>0,
//    'Стоимость без скидки'=>0,
//    'Стоимость со скидкой'=>0,
//    );

    function order($order, $storage)                //проверка заказ <-> остаток
    {
        if ($storage == 0 || $order>$storage) {
        $result = 0;
        } else {
        $result = 1;
        }
        return $result;
    }


    function discount($disc,$price)             //вычисление цены со скидкой
    {
        switch ($disc){
            case '1':
            {
            $price=$price*0.9;
            break;
            }
            case '2':
            {
            $price=$price*0.8;
            break;
            }
        }
        return $price;
    }

    foreach ($bd as $key=>$item){

         if (order($item['количество заказано'],$item['остаток на складе'])) {
             $count = $item['количество заказано'];
             $fullprice=$item['цена']*$item['количество заказано'];
         }
         else {
             $count=$item['остаток на складе'];
             $fullprice=$item['цена']*$item['остаток на складе'];
         }

         if ($key='игрушка детская велосипед'&$item['количество заказано']>=3){
             $discount=$item['цена']*0.7;
             $fullpricedisc=$discount*$count;
         }
         else{
             $discount=discount($item['discount'],$item['цена']);
             $fullpricedisc=$discount*$count;
         }




    }







?>



