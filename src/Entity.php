<?php

namespace WWON\Entity;

abstract class Entity
{
    /**
     * Entity constructor
     *
     * @param mixed $data
     */
    public function __construct($data = null)
    {
        if (empty($data)) {
            return;
        }

        if (is_object($data)) {
            $data = get_object_vars($data);
        }

        $this->setData($data);
    }

    /**
     * setData method
     *
     * @param array $data
     */
    public function setData(array $data = []): void
    {
        foreach ($data as $key => $value) {
            $attribute = $this->camelCase($key);
            if (property_exists($this, $attribute)) {
                $this->{$attribute} = $value;
            }
        }
    }

    /**
     * toArray method
     *
     * @param bool $ignoreEmptyField
     * @return array
     */
    public function toArray(bool $ignoreEmptyField = false): array
    {
        $data = [];
        $dump = get_object_vars($this);

        foreach ($dump as $key => $item) {
            if ($ignoreEmptyField
                && ($item === null || $item === [])) {
                continue;
            }

            $data[$this->snakeCase($key)] = $item;
        }

        return $data;
    }

    /**
     * magic set method - this method should never get called
     *
     * @param mixed $name
     * @param mixed $value
     * @throws ShitCodeException
     */
    public function __set($name, $value): void
    {
        throw new ShitCodeException();
    }

    /**
     * @param string $value
     * @return string
     */
    private function camelCase(string $value): string
    {
        $value = ucwords(str_replace(['-', '_'], ' ', $value));

        return lcfirst(str_replace(' ', '', $value));
    }

    /**
     * @param string $value
     * @return string
     */
    private function snakeCase(string $value): string
    {
        $value = preg_replace('/\s+/u', '', ucwords($value));

        $value = preg_replace('/(.)(?=[A-Z])/u', '$1_', $value);

        return mb_strtolower($value, 'UTF-8');
    }
}
