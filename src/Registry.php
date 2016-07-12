<?php

namespace Zhibaihe\Event;

class Registry{

    protected $store = [];

    public function set($key, $value)
    {
        $this->store[$key] = $value;
    }

    public function get($key)
    {
        if( ! $this->has($key)){
            return null;
        }

        return $this->store[$key];
    }

    public function has($key)
    {
        return array_key_exists($key, $this->store);
    }

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
