<?php

namespace App\Http\Extensions\Singleton;

trait SingletonTrait
{
    private static $instance;

    private function __construct() {}

    private function __clone(): void {}

    public static function instance(): self
    {
        if(self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }
}
