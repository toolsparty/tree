<?php

namespace ToolsParty\Tree;

/**
 * Class Configurable
 * @package ToolsParty\Tree
 */
trait Configurable {
    /**
     * Configurable constructor.
     * @param array $options
     */
    public function __construct(array $options = array())
    {
        $this->setOptions($options);
    }

    /**
     * @param array $options
     */
    protected function setOptions(array $options = [])
    {
        $properties = get_class_vars(static::className());

        foreach ($options as $name => $value) {
            if (array_key_exists($name, $properties)) {
                $this->$name = $value;
            }
        }
    }

    /**
     * @return string
     */
    public static function className()
    {
        return get_called_class();
    }
}