<?php namespace vikan\hsts;

class Bank
{
    public $name;
    public $url;

    public function __construct($name, $url)
    {
        $this->name = $name;
        $this->url = $url;
    }
}
