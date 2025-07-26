<?php
namespace Eventin\Ens;

class Config {

    /**
     * Config storage.
     *
     * @var array
     */
    protected static $config = [];

    /**
     * Set a config value.
     *
     * @param string $key
     * @param mixed  $value
     */
    public static function set( $key, $value ) {
        self::$config[$key] = $value;
    }

    /**
     * Get a config value.
     *
     * @param string $key
     * @param mixed  $default
     * @return mixed
     */
    public static function get( $key, $default = null ) {
        return self::$config[$key] ?? $default;
    }

    /**
     * Get all config values.
     *
     * @return array
     */
    public static function all() {
        return self::$config;
    }
}