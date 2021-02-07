<?php
/**
 * The $input variable contains text in snake case (i.e. hello_world or this_is_home_task)
 * Transform it into camel cased string and return (i.e. helloWorld or thisIsHomeTask)
 * @see http://xahlee.info/comp/camelCase_vs_snake_case.html
 *
 * @param  string  $input
 * @return string
 */
function snakeCaseToCamelCase(string $input)
{
	$temparray=explode("_",$input);
	for($i = 1; $i < count($temparray); $i++){
    $temparray[$i]=ucfirst($temparray[$i]);
	}
	return join("",$temparray);
}

/**
 * The $input variable contains multibyte text like 'ФЫВА олдж'
 * Mirror each word individually and return transformed text (i.e. 'АВЫФ ждло')
 * !!! do not change words order
 *
 * @param  string  $input
 * @return string
 */
function mirrorMultibyteString(string $input)
{

	$temparray=explode(" ",$input);
	for($i = 0; $i < count($temparray); $i++){
		$len=mb_strlen($temparray[$i]);
		$temptxt="";
		for($j = 0; $j <=$len ; $j++) {
			$temptxt=$temptxt . mb_substr($temparray[$i],$len-$j,1);
		}
		$temparray[$i]=$temptxt;
	}
	return join(" ",$temparray);
}

/**
 * My friend wants a new band name for her band.
 * She likes bands that use the formula: 'The' + a noun with first letter capitalized.
 * However, when a noun STARTS and ENDS with the same letter,
 * she likes to repeat the noun twice and connect them together with the first and last letter,
 * combined into one word like so (WITHOUT a 'The' in front):
 * dolphin -> The Dolphin
 * alaska -> Alaskalaska
 * europe -> Europeurope
 * Implement this logic.
 *
 * @param  string  $noun
 * @return string
 */
function getBrandName(string $noun)
{
	$len=strlen($noun)-1;
	if($noun[0]==$noun[$len]){
		$temp=ucfirst($noun);
		$temp=$temp.substr($noun,1,$len);
		return $temp;
	}else{
		return "The ".ucfirst($noun);
	}
}

