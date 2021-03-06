<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit0ad2069eea93cba9247c5bbf3c3f72aa
{
    public static $files = array (
        'be01b9b16925dcb22165c40b46681ac6' => __DIR__ . '/..' . '/wp-cli/php-cli-tools/lib/cli/cli.php',
        '3937806105cc8e221b8fa8db5b70d2f2' => __DIR__ . '/..' . '/wp-cli/mustangostang-spyc/includes/functions.php',
        'c65f753375faee349b7adc48c2ee7cc2' => __DIR__ . '/..' . '/wp-cli/db-command/db-command.php',
        '320cde22f66dd4f5d3fd621d3e88b98f' => __DIR__ . '/..' . '/symfony/polyfill-ctype/bootstrap.php',
        '3917c79c5052b270641b5a200963dbc2' => __DIR__ . '/..' . '/kint-php/kint/init.php',
        '841f98c5d948ce534a6f87abe5b50614' => __DIR__ . '/..' . '/roots/wp-password-bcrypt/wp-password-bcrypt.php',
        '68c39b88215b6cf7a0da164166670ef9' => __DIR__ . '/..' . '/wp-cli/core-command/core-command.php',
        '5e099d3cac677dd2bec1003ea7707745' => __DIR__ . '/..' . '/wp-cli/media-command/media-command.php',
        'f399c1c8d0c787d5c94c09884cdd9762' => __DIR__ . '/..' . '/wp-cli/rewrite-command/rewrite-command.php',
        '8ecb13f8bbc22b1b34d12b14ec01077a' => __DIR__ . '/..' . '/wp-cli/search-replace-command/search-replace-command.php',
    );

    public static $prefixLengthsPsr4 = array (
        'W' => 
        array (
            'Whoops\\' => 7,
        ),
        'S' => 
        array (
            'Symfony\\Polyfill\\Ctype\\' => 23,
            'Symfony\\Component\\Finder\\' => 25,
        ),
        'R' => 
        array (
            'Roots\\WPConfig\\' => 15,
        ),
        'P' => 
        array (
            'Psr\\Log\\' => 8,
        ),
        'M' => 
        array (
            'Mustangostang\\' => 14,
        ),
        'K' => 
        array (
            'Kint\\' => 5,
        ),
        'D' => 
        array (
            'Dotenv\\' => 7,
        ),
        'C' => 
        array (
            'Composer\\Semver\\' => 16,
            'Composer\\Installers\\' => 20,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Whoops\\' => 
        array (
            0 => __DIR__ . '/..' . '/filp/whoops/src/Whoops',
        ),
        'Symfony\\Polyfill\\Ctype\\' => 
        array (
            0 => __DIR__ . '/..' . '/symfony/polyfill-ctype',
        ),
        'Symfony\\Component\\Finder\\' => 
        array (
            0 => __DIR__ . '/..' . '/symfony/finder',
        ),
        'Roots\\WPConfig\\' => 
        array (
            0 => __DIR__ . '/..' . '/roots/wp-config/src',
        ),
        'Psr\\Log\\' => 
        array (
            0 => __DIR__ . '/..' . '/psr/log/Psr/Log',
        ),
        'Mustangostang\\' => 
        array (
            0 => __DIR__ . '/..' . '/wp-cli/mustangostang-spyc/src',
        ),
        'Kint\\' => 
        array (
            0 => __DIR__ . '/..' . '/kint-php/kint/src',
        ),
        'Dotenv\\' => 
        array (
            0 => __DIR__ . '/..' . '/vlucas/phpdotenv/src',
        ),
        'Composer\\Semver\\' => 
        array (
            0 => __DIR__ . '/..' . '/composer/semver/src',
        ),
        'Composer\\Installers\\' => 
        array (
            0 => __DIR__ . '/..' . '/composer/installers/src/Composer/Installers',
        ),
    );

    public static $fallbackDirsPsr4 = array (
        0 => __DIR__ . '/..' . '/wp-cli/core-command/src',
        1 => __DIR__ . '/..' . '/wp-cli/db-command/src',
        2 => __DIR__ . '/..' . '/wp-cli/media-command/src',
        3 => __DIR__ . '/..' . '/wp-cli/rewrite-command/src',
        4 => __DIR__ . '/..' . '/wp-cli/search-replace-command/src',
    );

    public static $prefixesPsr0 = array (
        'j' => 
        array (
            'johnpbloch\\Composer\\' => 
            array (
                0 => __DIR__ . '/..' . '/johnpbloch/wordpress-core-installer/src',
            ),
        ),
        'c' => 
        array (
            'cli' => 
            array (
                0 => __DIR__ . '/..' . '/wp-cli/php-cli-tools/lib',
            ),
        ),
        'W' => 
        array (
            'WP_CLI' => 
            array (
                0 => __DIR__ . '/..' . '/wp-cli/wp-cli/php',
            ),
        ),
        'R' => 
        array (
            'Requests' => 
            array (
                0 => __DIR__ . '/..' . '/rmccue/requests/library',
            ),
        ),
        'M' => 
        array (
            'Mustache' => 
            array (
                0 => __DIR__ . '/..' . '/mustache/mustache/src',
            ),
        ),
        'E' => 
        array (
            'Env' => 
            array (
                0 => __DIR__ . '/..' . '/oscarotero/env/src',
            ),
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit0ad2069eea93cba9247c5bbf3c3f72aa::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit0ad2069eea93cba9247c5bbf3c3f72aa::$prefixDirsPsr4;
            $loader->fallbackDirsPsr4 = ComposerStaticInit0ad2069eea93cba9247c5bbf3c3f72aa::$fallbackDirsPsr4;
            $loader->prefixesPsr0 = ComposerStaticInit0ad2069eea93cba9247c5bbf3c3f72aa::$prefixesPsr0;

        }, null, ClassLoader::class);
    }
}
