<?php
declare(strict_types=1);


namespace OOP;


use OOP\Interfaces\SessionInterface;

class Session implements SessionInterface
{

    private static $instance;

    private $session = [];

    public static function getInstance()
    {
        if (static::$instance === null) {
            static::$instance = new static();
        }

        return static::$instance;
    }

    /**
     * @return bool
     */
    public function start() : bool
    {
        return session_start();
    }

    /**
     * @param array $only
     * @return array
     */
    public function all(array $only = [])
    {
        if (!empty($only)) {
            $result = [];

            foreach ($only as $key) {
                $result[$key] = $this->session[$key];
            }

            return $result;
        }
        return $this->session;
    }

    /**
     * @param $key
     * @param null $default
     * @return mixed
     */
    public function get($key, $default = null)
    {
        if(isset($this->session[$key])){
            return $this->session[$key];
        }

        return $default;
    }

    /**
     * @param $key
     * @param $value
     * @return array
     */
    public function set($key, $value): array
    {
        $this->session[$key] = $value;

        return $this->session;
    }

    /**
     * @param $key
     * @return bool|void
     */
    public function has($key) : bool
    {
        return isset($this->session[$key]);
    }

    /**
     * @param $key
     * @return array
     */
    public function remove($key): array
    {
        unset($this->session[$key]);

        return $this->session;
    }

    public function clear()
    {
        return session_destroy();
    }

    /**
     * @param array $session
     * @return Session
     */
    public function setSession(array $session): Session
    {
        $this->session = &$session;
        return $this;
    }
}
