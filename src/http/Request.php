<?php
namespace OP\Tasks\Http;

class Request
{
    protected $post;
    protected $get;
    protected $server;
    protected $session;

    public function __construct()
    {
        $this->post = $_POST;
        $this->get = $_GET;
        $this->server = $_SERVER;
        $this->session = $_SESSION;
    }

    public function getPost()
    {
        return $this->post;
    }

    public function getGet()
    {
        return $this->get;
    }
    public function getServer()
    {
        return $this->server;
    }
    public function getSession()
    {
        return $this->session;
    }
    public function setSession($param, $value)
    {
        $this->session[$param] = $value;
        $_SESSION = $this->session[$param];
    }
}
