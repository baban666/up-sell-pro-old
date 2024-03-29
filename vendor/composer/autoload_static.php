<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitd43c4b269159c78a6a041baeabc7515b
{
    public static $fallbackDirsPsr4 = array (
        0 => __DIR__ . '/../..' . '/app',
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->fallbackDirsPsr4 = ComposerStaticInitd43c4b269159c78a6a041baeabc7515b::$fallbackDirsPsr4;
            $loader->classMap = ComposerStaticInitd43c4b269159c78a6a041baeabc7515b::$classMap;

        }, null, ClassLoader::class);
    }
}
