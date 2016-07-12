<?php

namespace Zhibaihe\Event;

class Dispatcher {

    protected $registry;

    public function __construct()
    {
        $this->registry = new Registry;
    }

    /**
     * Add an event listener to registry.
     *
     * @param $event string Event name
     * @param $callback Callable Callback function
     */
    public function listen($event, $callback)
    {
        $this->registry->append($event, $callback);
    }

    /**
     * Dispatch an event
     *
     * @param $event string Event name
     * @param $params array An array of parameters to pass to event listeners
     */
    public function dispatch($event, $params = [])
    {
        if( ! $this->registry->has($event)){
            return;
        }

        if( ! is_array($params)){
            $params = [$params];
        }

        foreach($this->registry->get($event) as $callback){
            if(is_callable($callback)){
                call_user_func_array($callback, $params);
            }
        }
    }
}
