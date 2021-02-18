<?php
declare(strict_types=1);


namespace OOP;


use OOP\Interfaces\CookiesInterfaces;

class Cookies implements CookiesInterfaces
{

    protected $time = 3600;
    private $cookies;

    public function __construct($cookies)
    {
        $this->cookies = &$cookies;
    }

    public function all(array $only = [])
    {
        if (!empty($only)) {
            $result = [];

            foreach ($only as $key) {
                $result[$key] = $this->cookies[$key];
            }

            return $result;
        }
        return $this->cookies;
    }

    public function get($key, $default = null)
    {
        if(isset($this->cookies[$key])){
            return $this->cookies[$key];
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
        setcookie($key, $value, time()+$this->time, "/");
        return $this->cookies;
    }

    /**
     * @param $key
     * @return bool|void
     */
    public function has($key) : bool
    {
        return isset($this->cookies[$key]);
    }

    /**
     * @param $key
     * @return bool
     */
    public function remove($key): bool
    {
        return setcookie($key,"", time() - $this->time);
    }
}
