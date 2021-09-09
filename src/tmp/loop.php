<?php
// $i = 0;

// while ($i <= 50) {
//   echo $i . PHP_EOL;
//   $i += 10;
// }

// while (true) {
//   if ($i <= 50) {
//     echo $i . PHP_EOL;
//     $i += 10;
//   } else {
//     break;
//   }
// }


// $numbers = [1, 2, 3, 4, 5];
// foreach ($numbers as $number) {
//   echo $number * 2 . PHP_EOL;
// }

$currencies = [
  'japan' => 'yen',
  'us' => 'dollar',
  'england' => 'pound',
];
foreach ($currencies as $country => $currency) {
  echo $country . ': ' . $currency . PHP_EOL;
}
