<?php

abstract class Estate
{
    protected $adress;
    protected $price;
    protected $strategy;

    public function __construct(string $adress, float $price, Payment $strategy)
    {
        $this->adress = $adress;
        $this->price = $price;
        $this->strategy = $strategy;
    }

    public function valuation()
    {
        return $this->strategy->valuation($this->price);
    }
}
abstract class Payment
{
    abstract function valuation(float $price);
}

class Flat extends Estate
{

}

class Home extends Estate
{

}

class CashPayment extends Payment
{
    function valuation(float $price)
    {
        return $price;
    }
}

class MortgagePayment extends Payment
{
    private $firstPayment;
    private $p; // ставка
    private $n; // кол-во лет
    
    public function __construct($firstPayment, $p, $n)
    {
        $this->firstPayment = $firstPayment;
        $this->p = $p / 1200;
        $this->n = $n * 12;
    }

    function valuation(float $price)
    {
        return ceil($this->firstPayment + $this->n * $this->p * ($price - $this->firstPayment) / (1 - pow(1 + $this->p, -$this->n)) );
    }
}

class InstallmentPayment extends Payment
{
    function valuation(float $price)
    {
        return ceil($price * 1.1);
    }
}

$someFlat = new Flat('ул. Пушкина, р-он Колотушкино', 5e6, new MortgagePayment(1e6, 9, 10) );

$strategies = [
    new CashPayment(),
    new MortgagePayment(1e6, 9, 10),
    new InstallmentPayment(),
];

foreach($strategies as $strategy){
    $estate = new Home('Санкт-Петербург', 3e6, $strategy);
    echo $estate->valuation(), '<hr />';
}