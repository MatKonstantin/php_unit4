<?php

class Cat {
    public function __construct($name)
    {
        $this->name = $name;
    }
}

$cats = new SplObjectStorage();

$cat1 = new Cat('Барсик');
$cat2 = new Cat('Кнопка');
$cat3 = new Cat('Батон');

$cats->attach($cat1);
$cats->attach($cat2);

echo '<pre>';
var_dump($cats->contains($cat1));
var_dump($cats->contains($cat2));
var_dump($cats->contains($cat3));

echo '<hr/>';
$cats->detach($cat1);
var_dump($cats->contains($cat1));
var_dump($cats->contains($cat2));
var_dump($cats->contains($cat3));

