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
//    $output=array(                  //массив на выход для заполнения
//    'Наименование'=>0,
//    'Заказано'=>0,
//    'Остаток на складе'=>0,
//    'Цена без скидки'=>0,
//    'Цена со скидкой'=>0,
//    'Стоимость общая'=>0,
//    'Стоимость со скидкой общая'=>0
//    );

    $fullpricediscSUM=0;
    $fullpriceSUM=0;
    $notice=0;

    function notice($notice){
        if ($notice){
            echo "<h3>Поздравляем! Вы получаете скидку 30% на велосипеды</h3>";
        }
    }

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
         }
         else {
             $count=$item['остаток на складе'];
         }

         if ($key=='игрушка детская велосипед'&$item['количество заказано']>=3){
             $discount=$item['цена']*0.7;
             $notice=1;
         }
         else{
             $discount=discount($item['discount'],$item['цена']);
         }

         $fullprice=$item['цена']*$count;
         $fullpricedisc=$discount*$count;
         $fullpriceSUM+=$fullprice;
         $fullpricediscSUM+=$fullpricedisc;

         $out=array('Наименование'=>$key,
             'Вы закзали'=>$item['количество заказано'],
             'На складе'=>$item['остаток на складе'],
             'Цена'=>$item['цена'],
             'Цена со скидкой'=>$discount,
             'Общая стоимость'=>$fullprice,
             'Общая стоимость со скидкой'=>$fullpricedisc);
         $output[]=$out;



    }
//    $output[]=$fullpriceSUM;
//    $output[]=$fullpricediscSUM;
//    print_r($output);
    echo '<table border="1">';
    echo '<td><strong>Наименование</strong></td>
          <td><strong>Вы заказали</strong></td>
          <td><strong>На складе</strong></td>
          <td><strong>Цена</strong></td>
          <td><strong>Цена со скидкой</strong></td>
          <td><strong>Общая стоимость</strong></td>
          <td><strong>Общая стоимость со скидкой</strong></td>';
    foreach ($output as $value) {
        echo "<tr>";
        foreach ($value as $key => $data)
            echo "<td>".$data."</td>";
            echo "</tr>";
    }
    echo "<tr><td><td><td><td><td>
            <td>$fullpriceSUM</td>
            <td>$fullpricediscSUM</td>
            </td></td></td></td></td></tr>
            </table><br>";

    notice ($notice);






?>



