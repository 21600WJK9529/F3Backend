<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitb27b0af35d25929ec7c908c978fcc554
{
    public static $files = array (
        '45e8c92354af155465588409ef796dbc' => __DIR__ . '/..' . '/bcosca/fatfree/lib/base.php',
    );

    public static $prefixesPsr0 = array (
        'M' => 
        array (
            'Monolog' => 
            array (
                0 => __DIR__ . '/..' . '/monolog/monolog/src',
            ),
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixesPsr0 = ComposerStaticInitb27b0af35d25929ec7c908c978fcc554::$prefixesPsr0;

        }, null, ClassLoader::class);
    }
}