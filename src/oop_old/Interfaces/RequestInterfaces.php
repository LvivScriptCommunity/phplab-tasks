<?php


namespace OOP\Interfaces;


interface RequestInterfaces
{
    /**
     * returns $_GET parameter by $key and $default if does not exist
     *
     * @param $key
     * @param null $default
     * @return mixed
     */
    public function query($key, $default = null);

    /**
     * returns $_POST parameter by $key and $default if does not exist
     * @param $key
     * @param null $default
     * @return mixed
     */
    public function post($key, $default = null);

    /**
     * returns $_GET or $_POST parameter by $key.
     * If both are present - return $_POST.
     * If both ate empty - return $default
     *
     * @param $key
     * @param null $default
     * @return mixed
     */
    public function get($key, $default = null);

    /**
     * returns all $_GET + $_POST parameters in the associative array.
     * If $only is not empty - return only keys from $only parameter
     *
     * @param array $only
     * @return mixed
     */
    public function all(array $only = []);

    /**
     * return true if $key exists in $_GET or $_POST
     *
     * @param $key
     * @return bool
     */
    public function has($key) :bool;

    /**
     * returns users IP
     *
     * @return mixed
     */
    public function ip();

    /**
     * returns users browser User Agent
     *
     * @return mixed
     */
    public function userAgent();

    /**
     * returns Cookie object (see below)
     * @return mixed
     */
    public function cookies();

    /**
     * returns Session object (see below)
     * @return mixed
     */
    public function session();
}
