Basics test<?php
/**
 * The $input variable contains text in snake case (i.e. hello_world or this_is_home_task)
 * Transform it into a camel-cased string and return (i.e. helloWorld or thisIsHomeTask)
 * @see http://xahlee.info/comp/camelCase_vs_snake_case.html
 *
 * @param  string  $input
 * @return string
 */
function snakeCaseToCamelCase(string $input,  $capitalizeFirstCharacter = false)
{
     //return str_replace($separator, '', ucwords($input, $separator));
    return $str = lcfirst (str_replace(' ', '', ucwords(str_replace('_', ' ', $input))));
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
    $mirror = mb_str_split($input, 1, mb_internal_encoding());
    $mirror = implode('', array_reverse($mirror));
    return $mirror = implode(' ', array_reverse(explode(' ', $mirror)));
}

/**
 * My friend wants a new band name for her band.
 * She likes bands that use the formula: 'The' + a noun with the first letter capitalized.
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
    $first = substr($noun, 0, 1);
    $last = substr($noun, -1);
    $the = 'The';
    if ($last == $first){
        return ucfirst($first . '' . str_repeat(substr($noun, 1), 2));
    } else {
        return $result = $the . ' ' . ucfirst($noun);
    }
}