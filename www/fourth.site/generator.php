<?php

// function nextNumber($start, $limit, $delta = 3) {
//     while($start < $limit){
//         yield $start;
//         $start += $delta;
//     }
// }

// foreach($nextNumber(3, 30, 2) as $value){
//     echo $value, '<hr />';
// }

function readLines($file){
    $lines = file($file);
    for($i = 0; $i < count($lines); $i++){
        yield $lines[$i];
    }
}
foreach(readLines("generator.php") as $k => $v){
    echo "$k. $v <hr />";
}