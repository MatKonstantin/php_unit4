<?php

/*
Создать класс Request - Singleton, у которого будут методы getPost(), getQuery(), getCookie()
Эти методы должны возвращать значение параметра по его названию

$request = Request::getInstance();
echo $request->getQuery('foo'); //http://fourth.site/?foo=123
*/

class Request 
{
    private static $instance = [];
    private $get = [];
    private $post = [];
    private $cookie = [];

    protected function __construct()
    {
        $this->get = $_GET;
        $this->post = $_POST;
        $this->cookie = $_COOKIE;
    }

    public static function getInstance(): Request
    {
        if (empty(self::$instance)) {
            self::$instance = new Request();
        }

        return self::$instance;
    }

    public function getQuery(string $param)
    {
        return isset($this->get[$param]) ? $this->get[$param] : false;
    }
    
    public function getCookie(string $param)
    {
        return isset($this->cookie[$param]) ? $this->cookie[$param] : false;
    }

    public function getPost(string $param)
    {
        return isset($this->post[$param]) ? $this->post[$param] : false;
    }
}

$cl = Request::getInstance()->getQuery('foo');
echo $cl;