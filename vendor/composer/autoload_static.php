<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit6b5029092ce0884925a5854ae9087a65
{
    public static $prefixLengthsPsr4 = array (
        'S' => 
        array (
            'Symfony\\Component\\Process\\' => 26,
            'Spatie\\ImageOptimizer\\' => 22,
        ),
        'R' => 
        array (
            'Rakit\\Validation\\' => 17,
        ),
        'P' => 
        array (
            'Psr\\Log\\' => 8,
            'PHPMailer\\PHPMailer\\' => 20,
        ),
        'O' => 
        array (
            'Opis\\Database\\' => 14,
        ),
        'F' => 
        array (
            'Firebase\\JWT\\' => 13,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Symfony\\Component\\Process\\' => 
        array (
            0 => __DIR__ . '/..' . '/symfony/process',
        ),
        'Spatie\\ImageOptimizer\\' => 
        array (
            0 => __DIR__ . '/..' . '/spatie/image-optimizer/src',
        ),
        'Rakit\\Validation\\' => 
        array (
            0 => __DIR__ . '/..' . '/rakit/validation/src',
        ),
        'Psr\\Log\\' => 
        array (
            0 => __DIR__ . '/..' . '/psr/log/src',
        ),
        'PHPMailer\\PHPMailer\\' => 
        array (
            0 => __DIR__ . '/..' . '/phpmailer/phpmailer/src',
        ),
        'Opis\\Database\\' => 
        array (
            0 => __DIR__ . '/..' . '/opis/database/src',
        ),
        'Firebase\\JWT\\' => 
        array (
            0 => __DIR__ . '/..' . '/firebase/php-jwt/src',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit6b5029092ce0884925a5854ae9087a65::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit6b5029092ce0884925a5854ae9087a65::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit6b5029092ce0884925a5854ae9087a65::$classMap;

        }, null, ClassLoader::class);
    }
}
