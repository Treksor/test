<?php
error_reporting(E_ERROR | E_WARNING | E_PARSE | E_NOTICE);
ini_set('display errors', 1);

$db = mysql_connect('localhost','treksor','123') or die('mysql dead');
mysql_select_db('treksor_test',$db) or die ('cant get db');
echo "connected <br>";

$result=mysql_query('select users.id,first_name,last_name,phone,department,departments.id as department_id,name 
from users left join departments on (users.department=departments.id) limit 2') or die('запрос не удался'.mysql_error());

echo "всего юзеров ".mysql_num_rows($result);


while ($row=mysql_fetch_assoc($result)){
    $row['last_name'].=" A.";
    mysql_query("update users set last_name='$row[last_name]' where id=$row[id]");
print_r($row);}

$insert_sql="INSERT INTO `users` (`first_name`, `last_name`, `phone`, `department`)
VALUES ('Е.', 'Баный', '79687765427', '3')";
$insert_sq2="INSERT INTO `users` (`first_name`, `last_name`, `phone`, `department`)
VALUES ('Виталий', 'Иванов', '79687787924', '3')";
mysql_query($insert_sql);
mysql_query($insert_sq2);


mysql_free_result($result);
mysql_close();