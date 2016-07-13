<?php

namespace Zhibaihe\Event;

class Dispatcher {

    protected $registry = null;

    protected static $defaultDispatcher = null;

    public function __construct($bindings = [])
    {
        $this->registry = new Registry($bindings);
    }

    public static function getDefaultDispatcher()
    {
        if( ! self::$defaultDispatcher){
            self::$defaultDispatcher = new static;
        }

        return self::$defaultDispatcher;
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
