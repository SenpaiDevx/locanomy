<?php

namespace App\Support;
final class ModuleTypeScriptRegistry
{
    private static array $directories = [];

    // set
    public static function add (string $directory) : void
    {
        self::$directories[] = $directory;
    }

    // get
    public static function directories(): array
    {
        return self::$directories;
    }
}