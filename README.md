# Tree

Используется для преобразования списка (массива) элементов вида:
 
 ```php
 $categories = [
     [
         'cid' => 1,
         'sub_id' => 0,
         'name' => 'Category 1'
     ],
     [
         'cid' => 2,
         'sub_id' => 0,
         'name' => 'Category 2'
     ],
     [
         'cid' => 3,
         'sub_id' => 1,
         'name' => 'Category 3'
     ],
     [
         'cid' => 4,
         'sub_id' => 3,
         'name' => 'Category 4'
     ],
     [
         'cid' => 5,
         'sub_id' => 3,
         'name' => 'Category 5'
     ],
     [
         'cid' => 6,
         'sub_id' => 2,
         'name' => 'Category 6'
     ],
     [
         'cid' => 7,
         'sub_id' => 5,
         'name' => 'Category 7'
     ],
     [
         'cid' => 8,
         'sub_id' => 7,
         'name' => 'Category 8'
     ],
 ];
 ```
 в древовидную структуру
 
 ```php
 [
    [
        'cid' => 1,
        'sub_id' => 0,
        'name' => 'Category 1',
        'children' => [
            [
                'cid' => 3,
                'sub_id' => 1,
                'name' => 'Category 3',
                'children' => [...]
            ],
            ...
        ],
        ...
    ]
 ]
 ```
 
 что очень помогает выводить подобные струкутры:
 
 ```
 Category 1
 - Category 3
 -- Category 4
 -- Category 5
 ---- Category 7
 ---- Category 8
 Category 2
 - Category 6
 ```
 
 см. примеры <https://github.com/toolsparty/tree/tree/master/example>