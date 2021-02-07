<?php
/**
 * The $input variable contains an array of digits
 * Return an array which will contain the same digits but repetitive by its value
 * without changing the order.
 * Example: [1,3,2] => [1,3,3,3,2,2]
 *
 * @param  array  $input
 * @return array
 */
function repeatArrayValues(array $input)
{
	$b=[];
	foreach ($input as $item){
		for( $i = 0; $i < $item; $i++){
			array_push($b,$item);
		}
	}
	return $b;
}

/**
 * The $input variable contains an array of digits
 * Return the lowest unique value or 0 if there is no unique values or array is empty.
 * Example: [1, 2, 3, 2, 1, 5, 6] => 3
 *
 * @param  array  $input
 * @return int
 */
function getUniqueValue(array $input)
{
	
	$b=array_diff_assoc($input,array_unique($input));
	$c=[];
	foreach ($input as $item){
		if(!in_array($item,$b)){
			array_push($c,$item);
		}
	}
	if( count($c)>0){
		sort($c);
		Return $c[0];
	}else{
		Return 0;
}

}

/**
 * The $input variable contains an array of arrays
 * Each sub array has keys: name (contains strings), tags (contains array of strings)
 * Return the list of names grouped by tags
 * !!! The 'names' in returned array must be sorted ascending.
 *
 * Example:
 * [
 *  ['name' => 'potato', 'tags' => ['vegetable', 'yellow']],
 *  ['name' => 'apple', 'tags' => ['fruit', 'green']],
 *  ['name' => 'orange', 'tags' => ['fruit', 'yellow']],
 * ]
 *
 * Should be transformed into:
 * [
 *  'fruit' => ['apple', 'orange'],
 *  'green' => ['apple'],
 *  'vegetable' => ['potato'],
 *  'yellow' => ['orange', 'potato'],
 * ]
 *
 * @param  array  $input
 * @return array
 */
function groupByTag(array $input)
{
	$temparray=[];
	$newkeys=[];
	foreach($input as $item){
        $name=$item["name"];
        foreach ($item["tags"] as $tag){
            if(!in_array($tag,$newkeys)){
                array_push($newkeys,$tag);
                $temparray += [$tag => [$name]];
            }else{
                array_push($temparray[$tag],$name);
                sort($temparray[$tag]);
            }

        }
    }
return $temparray;
}

