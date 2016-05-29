<?php

namespace WWON\Entity;

class BasicEntity
{

    /**
     * Request constructor
     *
     * @param array $data
     */
    public function __construct(array $data = [])
    {
        foreach ($data as $key => $value) {
            $attribute = camel_case($key);

            if (property_exists($this, $attribute)) {
                $this->{$attribute} = $value;
            }
        }
    }

    /**
     * toArray method
     *
     * @return array
     */
    public function toArray()
    {
        return (array) $this;
    }

}