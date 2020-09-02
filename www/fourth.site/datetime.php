<?php

$dt1 = new DateTimeImmutable('2020-02-15');
$dt1->modify('+1 day');
echo "<pre>", var_dump($dt1) ,"</pre>";
echo "<pre>", $dt1->format('d-m-Y H:i:s') ,"</pre>";
echo "<pre>", $dt1->format(
    DateTimeImmutable::W3C
) ,"</pre>";

$dt2 = new DateTime('2020-12-10');
$dt2->modify('+10 day');
echo "<pre>", $dt1->format(
    DateTimeImmutable::RFC7231
) ,"</pre>";

echo "<pre>", var_dump($dt2->diff($dt1)) ,"</pre>";

$interval = new DateInterval('P3M');
$dt2->add($interval);
echo "<pre>", $dt2->format(
    DateTimeImmutable::RFC7231
) ,"</pre>";

$daterange = new DatePeriod($dt1, $interval, $dt2);
foreach($daterange as $date){
    echo $date->format('d-m-Y H:i:s'), '<hr />';
}