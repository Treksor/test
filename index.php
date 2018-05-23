<?
    error_reporting(E_ERROR|E_WARNING|E_PARSE|E_NOTICE);
    ini_set('display errors', 1);

    echo"<h2>Задание 1</h2>";
    $name='Igor';
    $age=27;
    echo "Меня зовут $name. Мне $age лет.";
    echo "<br>";
    echo 'Меня зовут '.$name. '. Мне '.$age. ' лет.';
    unset($name, $age);
//    echo $name, $age;
//    Undefined variable: name; Undefined variable: age;


    echo "<h2>Задание 2</h2>";
    define('GOROD', 'Novosibirsk');
    if (GOROD) {
        echo GOROD;
    }else {
        echo 'No constanta';
    }
//    define ('GOROD', 'Moscow');
//    constant GOROD already defined

    echo "<h2>Задание 3</h2>";
    $book=array('Title'=>('Пробуждение Левиафана'),'Author'=>'Джеймсом Кори','Pages'=>'448');
    echo "Довольно давно я прочитал книгу $book[Title], написанную автором $book[Author], я осилил все $book[Pages]
    страниц, мне очень понравилось";


    echo "<h2>Задание 4</h2>";
    $book1=array('Title'=>('Пробуждение Левиафана'),'Author'=>'Джеймсом Кори','Pages'=>'448');
    $book2=array('Title'=>('Война Калибана'),'Author'=>'Джеймсом Кори','Pages'=>'576');
    $books=array($book1,$book2);
    $sum=$book1['Pages']+$book2['Pages'];
//    print_r($books[0][Title]);
//    print_r($books[1][Pages]);

    //предполагаю, что по заданию нужно записать через массив books
    echo "Довольно давно я прочитал книги {$books[0]['Title']} и {$books[1]['Title']}(на самом деле нет), написанные автором 
    {$books[0]['Author']}, в сумме я осилил {$books[0]['Pages']}+{$books[1]['Pages']} страниц <br>(на самом деле вторую книгу
    я даже не начал, к сожалению)<br><br>";

    //но как-то криво получается и сумму я не знаю как записать, поэтому второй вариант =)
    echo "Я прочитал книги $book1[Title] и $book2[Title], написанные автором $book1[Author], в сумме я осилил $sum страниц.";


    ?>
