<?php

abstract class Product
{
    abstract public function getTitle();
}
abstract class Provider
{
    abstract public function create(string $modelName);
}

class FooPhoneProduct extends Product
{
    private $title;

    public function __construct($title)
    {
        $this->title = $title;
        echo __CLASS__, "<hr/>";
    }

    public function getTitle()
    {
        return $this->title;
    }
}

class FooCompanyProvider extends Provider
{
    public function create(string $modelName)
    {
        return new FooPhoneProduct($modelName);
    }
}

$fabric = new FooCompanyProvider;
$phone = $fabric->create('Модель 123');
echo $phone->getTitle();
