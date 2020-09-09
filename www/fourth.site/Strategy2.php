<?php

abstract class Product
{
    protected $product;
    protected $render;

    public function __construct(string $title, float $price, Render $render)
    {
        $this->product['title'] = $title;
        $this->product['price'] = $price;
        $this->render = $render;
    }

    public function get()
    {
        return $this->render->get($this->product);
    }
}
abstract class Render
{
    abstract function get(object $product);
}

class PhoneProduct extends Product
{
}

class XMLRender extends Render
{
    function get(object $product)
    {
        return 'XMLRender';
    }
}

class JSONRender extends Render
{
    function get(object $product)
    {
        return json_encode($product);
    }
}

class HTMLRender extends Render
{
    function get(object $product)
    {
        return 'HTMLRender';
    }
}


$phone = new PhoneProduct( 'телефон', 3000, new JSONRender());

echo $phone->get();
