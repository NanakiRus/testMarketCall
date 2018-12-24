<?php
//Предлагается выполнить следующие задания:
//1. Спроектировать структуру таблиц(ы) для хранения Контактов,
//которые могут иметь друзей из этого же списка Контактов (в рамках
//задачи достаточно хранить только Имя Контакта). Если Контакт 2
//является другом Контакта 1, это не означает, что Контакт 1 является
//другом Контакта 2.

'create table contacts
(
  id   int auto_increment
    primary key,
  name varchar(255) not null
);'
  
'create table contacts_id
(
  contact_id int not null,
  friend_id  int not null,
  primary key (contact_id, friend_id)
);'
//==================

//1.1. Написать запрос sql, отображающий список Контактов, имеющих
//больше 5 друзей.

'SELECT Name
FROM contacts_id,
     contacts
WHERE contact_id = id
GROUP BY contact_id
HAVING COUNT(friend_id) > 5'
//===================

//1.2. Написать запрос sql, отображающий все пары Контактов, которые
//дружат друг с другом. Исключить дубликаты.
//(задача на sql запросы, использование PHP запрещено)

'SELECT *
FROM contacts_id,
     contacts_id as ci
LEFT JOIN contacts ON contact_id = id
WHERE contacts_id.friend_id = ci.contact_id
  AND ci.friend_id = contacts_id.contact_id'
//====================

//2. Имеется массив числовых значений [4, 5, 8, 9, 1, 7, 2]. В
//распоряжении есть функция array_swap(&amp;$arr, $num) { … } которая
//меняем местами элемент на позиции $num и элемент на 0 позиции.
// Т.е. при выполнении array_swap([3, 6, 2], 2) на выходе получим [2, 6,
//3].
//Написать код, сортирующий массив по возрастанию, используя только
//функцию array_swap.

function array_swap(array &$arr, int $num) {
    if (!isset($arr[$num])) {
        return false;
    }

    [$arr[0], $arr[$num]] = [$arr[$num], $arr[0]];

    return true;
}

$array = [4, 5, 8, 9, 1, 7, 2];

$countedArray = \count($array);
        
$newArr = [];
for ($i = 0; $i < $countedArray; $i++) {
    foreach ($array as $key => $value) {
        if ($array[0] > $array[$key]) {
            array_swap($array, $key);
        }
     }
     $newArr[] = \array_shift($array);
}
//====================


//3. Написать на PHP парсер html страницы (на входе url), который на
//выходе будет отображать количество и название всех используемых
//html тегов. Использование готовых парсеров и библиотек запрещено.
//(обязательно использование ООП подхода, демонстрирующее
//взаимодействие объектов)
