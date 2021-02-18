<?php


namespace OOP\Interfaces;


interface SessionInterface
{

    /**
     * returns all $_SESSION in the associative array.
     * If $only is not empty - return only keys from $only parameter
     * @param array $only
     * @return mixed
     */
    public function all(array $only = []);

    /**
     * returns $_SESSION value by key and $default if key does not exist
     *
     * @param $key
     * @param null $default
     * @return mixed
     */
    public function get($key, $default = null);

    /**
     * sets data to session
     *
     * @param $key
     * @param $value
     * @return mixed
     */
    public function set($key, $value);

    /**
     * true if $key exists in $_SESSION
     *
     * @param $key
     * @return bool
     */
    public function has($key): bool;

    /**
     * Removes session data by name
     *
     * @param $key
     */
    public function remove($key);

    /**
     * Clears the session
     *
     * @return mixed
     */
    public function clear();
}
