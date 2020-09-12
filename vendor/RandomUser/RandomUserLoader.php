<?php

class RandomUserLoader {

    public static function autoload($class) {
        if (0 !== strpos($class, 'RandomUser')) {
            return;
        }
        $file = str_replace("\\", "/", __DIR__ . "/../" . $class . ".php");

        if (is_file($file)) {
            require($file);
        } else {
            return;
        }
    }

    public static function register() {
        spl_autoload_register(array(__CLASS__, 'autoload'));
    }

}