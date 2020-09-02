<?php

// $word = 'текст';

// $fn = function() use ($word) {
//     var_dump($word);
// };

// $fn();

class Cat {
    protected $name;

    public function __construct($name)
    {
        $this->name = $name;
    }

    public function getName()
    {
        return $this->name;
    }
}

$bars = new Cat('Барсик');
$murz = new Cat('Мурзик');

$clouser = function($breed){
    $this->breed = $breed;
};

$clouser->call($bars, 'Као-мани');
$clouser->call($murz, 'Тайская');

echo '<pre>';
var_dump($bars, $murz);

$changeAge = function($delta){
    $this->age += $delta;
};
$changeAgeBars = $changeAge->bindTo($bars);
$changeAgeBars(2);

$changeAgeMurz = Closure::bind($changeAge, $murz);
$changeAgeMurz(3);
var_dump($bars, $murz);