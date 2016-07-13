<?php

namespace Zhibaihe\Event;

class Registry{

    protected $store = [];

    public function __construct($store = [])
    {
        $this->store = $store;
    }

    /**
     * Set the value for a key
     *
     * @param $key string The key
     * @param $value mixed The value
     */
    public function set($key, $value)
    {
        $this->store[$key] = $value;
    }

    /**
     * Get the value of a key
     *
     * @param $key string The key
     * @return mixed The value of the corresponding key
     */
    public function get($key)
    {
        if( ! $this->has($key)){
            return null;
        }

        return $this->store[$key];
    }

    /**
     * Check whether a key exists in the registry.
     *
     * @param $key string The key to be checked
     * @return boolean
     */
    public function has($key)
    {
        return array_key_exists($key, $this->store);
    }

    /**
     * Append a value to the registry.
     *
     * If the value of the key is not an array, it will be put into
     * an array, to which the new value will be appended. The resulting
     * array will then be assigned to the key. The key will be created
     * if it does not exist.
     *
     * @param $key string
     * @param $value mixed
     */
    public function append($key, $value)
    {
        $old = [];

        if($this->has($key)){
            $old = $this->get($key);
        }

        if( ! is_array($old)){
            $old = [$old];
        }

        $old[] = $value;

        $this->set($key, $old);
    }
}
