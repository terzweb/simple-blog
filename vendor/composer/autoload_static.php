<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit389112fb8de5180087ccdd4694490f82
{
    public static $prefixesPsr0 = array (
        'o' => 
        array (
            'org\\bovigo\\vfs\\' => 
            array (
                0 => __DIR__ . '/..' . '/mikey179/vfsStream/src/main/php',
            ),
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixesPsr0 = ComposerStaticInit389112fb8de5180087ccdd4694490f82::$prefixesPsr0;

        }, null, ClassLoader::class);
    }
}