<?php
declare(strict_types=1);


namespace OOP;


use OOP\Interfaces\RequestInterfaces;

class Request implements RequestInterfaces
{

    private $get;
    private $post;
    private $server;
    public $cookies;
    public $session;

    public function __construct($get, $post, $server, $cookies, $session)
    {
        $this->get = $get;
        $this->post = $post;
        $this->server = $server;
        $this->cookies = $cookies;
        $this->session = $session;
    }

    /**
     * @param $key
     * @param null $default
     * @return mixed|null
     */
    public function query($key, $default = null)
    {
        if (isset($this->get[$key])) {
            return $this->get[$key];
        }

        return $default;
    }

    public function post($key, $default = null)
    {
        if (isset($this->post[$key])) {
            return $this->post[$key];
        }

        return $default;
    }

    public function get($key, $default = null)
    {
        if (isset($this->get[$key]) && isset($this->post[$key])) return $this->post[$key];
        if (isset($this->get[$key])) return $this->get[$key];
        if (!isset($this->get[$key]) && !isset($this->post[$key])) return $default;
    }

    public function all(array $only = [])
    {
        $result = [];
        if (!empty($only)) {
            foreach ($only as $key) {
                if (isset($this->get[$key])) $result['get'][$key] = $this->get[$key];
                if (isset($this->post[$key])) $result['post'][$key] = $this->post[$key];
            }
            return $result;
        }

        $result['get'] = $this->get;
        $result['post'] = $this->post;

        return $result;
    }

    public function has($key): bool
    {
        if (isset($this->get[$key]) || isset($this->post[$key])) {
            return true;
        } else {
            return false;
        }
    }

    public function ip()
    {
        return $this->server['REMOTE_ADDR'];
    }

    public function userAgent()
    {
        return $this->server['HTTP_USER_AGENT'];
    }

    public function cookies()
    {
        return $this->cookies;
    }

    public function session()
    {
        return $this->session;
    }
}
