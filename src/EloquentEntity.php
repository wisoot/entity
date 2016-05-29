<?php

namespace WWON\Entity;

use Illuminate\Database\Eloquent\Model;

class EloquentEntity extends Model
{

    /**
     * Determine if an attribute exists on the model.
     *
     * @param  string  $key
     * @return bool
     */
    public function __isset($key)
    {
        return parent::__isset(snake_case($key));
    }

    /**
     * Unset an attribute on the model.
     *
     * @param  string  $key
     */
    public function __unset($key)
    {
        parent::__unset(snake_case($key));
    }

    /**
     * Override the default functionality so we may access attributes via camelCase along with snake case. E.g.,
     *
     * echo $object->first_name;
     * echo $object->firstName;
     *
     * @param string $key
     * @return mixed
     */
    public function getAttribute($key)
    {
        return parent::getAttribute(snake_case($key));
    }

    /**
     * Override the default functionality so we may set attributes via camelCase along with snake case. E.g.,
     *
     * $object->first_name = "Bob";
     * $object->firstName = "Bob";
     *
     * @param string $key
     * @param mixed $value
     * @return mixed
     */
    public function setAttribute($key, $value)
    {
        parent::setAttribute(snake_case($key), $value);
    }

}