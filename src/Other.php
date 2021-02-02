<?php
array_multisort($input);
$newArr =[];
foreach ($arr as $item){
    $newArr = array_merge_recursive($newArr, array_combine ( $item['tags'], array_fill(0, count($item['tags']), $item['name'])));
}
ksort($newArr);

var_dump( $newArr);