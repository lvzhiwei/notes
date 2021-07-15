<?php

//require __DIR__ . '/vendor/autoload.php';
//
//$a = 1;
//
//$b = 2;
//
//$c = $a + $b;

include './Algo.php';

$algo = new Algo();

//$arr = [1,2,3,4,5,6,7,8];
//$arr = range(0, 1023);
$arr = range(0, 255);
$value = 1023;
//var_dump($algo->binarySearch($arr, $value));

//shuffle($arr);
//$arr = [99, 4,2,6,8,0,33];
//var_dump(microtime(true));
//var_dump($algo->selectShort($arr));
//var_dump(microtime(true));

//$arr = [33,33,99, 4,2,6,8,99,0,33];
//var_dump($algo->quickSort($arr));
//var_dump(microtime(true));
//shuffle($arr);
//var_dump($algo->quickSort($arr));
//var_dump(microtime(true));

//$tree = [
//	'a' => [
//		'b', 'c', 'd',
//	],
//	'b' => ['c'],
//	'd' => ['a'],
//	'c' => ['e'],
//];
//var_dump($algo->breadthFirstSearch($tree, 'a', 'e'));

var_dump($algo->greed());