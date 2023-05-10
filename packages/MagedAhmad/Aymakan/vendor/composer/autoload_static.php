<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit0e1bba97328abbc861ab6952cdac69d5
{
    public static $prefixLengthsPsr4 = array (
        'M' => 
        array (
            'MagedAhmad\\Aymakan\\' => 19,
        ),
        'A' => 
        array (
            'Aymakan\\' => 8,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'MagedAhmad\\Aymakan\\' => 
        array (
            0 => __DIR__ . '/../..' . '/src',
        ),
        'Aymakan\\' => 
        array (
            0 => __DIR__ . '/..' . '/aymakan/php-sdk/src',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit0e1bba97328abbc861ab6952cdac69d5::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit0e1bba97328abbc861ab6952cdac69d5::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit0e1bba97328abbc861ab6952cdac69d5::$classMap;

        }, null, ClassLoader::class);
    }
}
