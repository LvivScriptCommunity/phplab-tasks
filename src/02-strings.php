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
    return lcfirst(str_replace('_', '',ucwords($input, '_')));
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
    $strs = explode(' ', $input);
    $rstr = '';

    foreach ($strs as $key => $s) {
        for ($i = mb_strlen($s, "UTF-8"); $i>= 0; $i--) {
            $rstr .= mb_substr($s, $i, 1, "UTF-8");
        }

        if ((count($strs) - 1) != $key) {
            $rstr .= ' ';
        }
    }

    return $rstr;
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
    $bandName =  ucfirst($noun);
    $firstLetter = substr($noun, 0, 1);
    $lastLetter = substr($noun, -1);

    if ($firstLetter == $lastLetter) {
        $bandName .= substr($noun, 1);
    } else {
        $bandName = 'The ' . $bandName;
    }

    return $bandName;
}
