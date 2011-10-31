<?php
/**
 * @author Benjamin Grandfond <benjamin.grandfond@gmail.com>
 * @since 23/10/11
 */

require_once __DIR__.'/../vendor/Symfony/Component/ClassLoader/UniversalClassLoader.php';

use Symfony\Component\ClassLoader\UniversalClassLoader;

$loader = new UniversalClassLoader();
$loader->registerNamespaces(array(
    'Symfony'  => __DIR__.'/../vendor',
    'Composer' => __DIR__.'/../vendor/Composer/src',
    'Silexor'  => array(__DIR__.'/../src', __DIR__),
));

$loader->registerPrefixes(array(
    'Twig_' => __DIR__.'/../vendor/Twig/lib'
));

$loader->register();
