<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitbc4b96328913466a54d8779250521a09
{
    public static $prefixLengthsPsr4 = array (
        'w' => 
        array (
            'workpayment\\' => 12,
        ),
        'a' => 
        array (
            'app\\' => 4,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'workpayment\\' => 
        array (
            0 => __DIR__ . '/..' . '/workpayment/core',
        ),
        'app\\' => 
        array (
            0 => __DIR__ . '/../..' . '/app',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitbc4b96328913466a54d8779250521a09::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitbc4b96328913466a54d8779250521a09::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInitbc4b96328913466a54d8779250521a09::$classMap;

        }, null, ClassLoader::class);
    }
}