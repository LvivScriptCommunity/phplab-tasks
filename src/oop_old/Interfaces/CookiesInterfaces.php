<?php


namespace OOP\Interfaces;


interface CookiesInterfaces
{
    /**
     * returns all $_COOKIES in the associative array.
     * If $only is not empty - return only keys from $only parameter
     *
     * @param array $only
     * @return mixed
     */
    public function all(array $only = []);

    /**
     * returns $_COOKIE value by key and $default if key does not exist
     * @param $key
     * @param null $default
     * @return mixed
     */
    public function get($key, $default = null);

    /**
     * sets cookie
     * @param $key
     * @param $value
     * @return mixed
     */
    public function set($key, $value);

    /**
     * return true if $key exists in $_COOKIES
     * @param $key
     * @return bool
     */
    public function has($key) :bool;

    /**
     * removes cookie by name
     * @param $key
     * @return mixed
     */
    public function remove($key);
}
