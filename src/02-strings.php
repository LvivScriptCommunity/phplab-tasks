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
    $str = explode('_', $input);

    $res = $str[0];

    for ($i = 1; $i < count($str); $i++) {
        $res .= ucwords($str[$i]);
    }

    return $res;

    return lcfirst(str_replace('_', '', ucwords($input, '_')));
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
    $str2 = explode(' ', $input);
    $arr = [];

    foreach ($str2 as $word => $value) {
        $encode = mb_detect_encoding($value);
        $strLength = mb_strlen($value, $encode);
        $rev = '';

        while ($strLength > 0) {
            $rev .= mb_substr($value, $strLength, 1, $encode);
        }

        $arr[] = $rev;
    }

    return implode(' ', $arr);
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
    $firstLetter = substr($noun, 0, 1);
    $lastLetter = substr($noun, -1);
    $out = '';

    if ($firstLetter != $lastLetter) {
        $out = 'The ' . ucfirst($noun);
    } else {
        $capStr = substr(ucfirst($noun), 0, -1);
        $out = $capStr . $noun;
    }

    return $out;
}