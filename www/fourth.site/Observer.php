<?php

interface Observable
{
    public function attach(Observer $observer);
    public function detach(Observer $observer);
    public function notify();
}

class Author implements Observable
{
    private $observers = [];
    public $name;

    public function __construct(string $name)
    {
        $this->name = $name;
    }

    public function attach(Observer $observer)
    {
        $this->observers[] = $observer;
    }

    public function detach(Observer $observer)
    {
        $this->observers = array_filter(
            $this->observers,
            function($element) use ($observer){
                return !($element === $observer);
            }
        );
    }

    public function notify()
    {
        foreach($this->observers as $obs){
            echo $obs->update($this), '<hr />';
        }
    }

    public function write($text)
    {        
        echo $this->name . " написал: " . $text;
        $this->notify();
    }

}

interface Observer
{
    public function update(Observable $observable);
}

class User implements Observer
{
    public $name;

    public function __construct($name)
    {
        $this->name = $name;
    }

    public function update(Observable $observable)
    {
        return __CLASS__ . " по имени " . $this->name . " написал: " .$observable->name . " это великий писатель";
    }
}

class Critic implements Observer
{
    public $name;

    public function __construct($name)
    {
        $this->name = $name;
    }

    public function update(Observable $observable)
    {
        return __CLASS__ . " по имени " . $this->name . " написал: " .$observable->name . " это посредственный писатель";
    }
}

class Historian implements Observer
{
    public $name;

    public function __construct($name)
    {
        $this->name = $name;
    }

    public function update(Observable $observable)
    {
        return __CLASS__ . " по имени " . $this->name . " написал: " .$observable->name . " - не достоверный писатель, который попадет в историю";
    }
}

$author = new Author('А.С. Пушкин');

$user1 = new User('Иванов И.');
$user2 = new User('Петрова Н.А.');
$critic = new Critic('Н.Н. Пушкин');
$historian = new Historian('Сумкина А.');

$author->attach($user2);
$author->attach($critic);
$author->attach($historian);

$author->write('Книга');