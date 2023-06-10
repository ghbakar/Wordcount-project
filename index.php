<?php


/*
TODO: redesign the file 

- get file and read 
- count words 
- get longest word 
- most repated word 
- shortest word 
- less repetad word 
- word is exist 
remove the non-words like -"'/. etc
- number of letters if file  
return in json format 


*/
require_once './fileInfo.php';
// 'ёяшертыуиопюъщэжьлкйчгфдсазхцвбнмЁЯШЕРТЫУИОПЮЪЩЭЖЬЛКЙЧГФДСАЗХЦВБНМ»«–'
$object = new fileInfo('polnoe-esenin-en.txt');

// echo 'list of number if repated list  <pre>';
// print_r($object->listRepatedWords());
// echo '</pre>';


echo 'number of words <pre>';
print_r($object->numberOfWords());
echo '</pre>';

echo 'the longest word <pre>';
print_r($object->longestWord());
echo '</pre>';

echo ' shortest word in file <pre>';
print_r($object->shortestWord());
echo '</pre>';


echo 'most repeated word <pre>';
print_r($object->mostRepatedWord());
echo '</pre>';

echo 'less repeated Word <pre>';
print_r($object->lessRepatedWord());
echo '</pre>';


// echo 'word if exist <pre>';
// print_r($object->is_existWord('the'));
// echo '</pre>';

// echo 'number of letters <pre>';
// print_r($object->numberOfletters());
// echo '</pre>';




// $wordsCount = array_count_values($wordsArray);
