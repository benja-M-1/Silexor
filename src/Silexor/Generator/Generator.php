<?php
/*
 * This file is part of the Symfony package.
 *
 * (c) Benjamin Grandfond <benjamin.grandfond@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

/**
 * GeneratorInterface Interface
 *
 * @author Benjamin Grandfond <benjamin.grandfond@gmail.com>
 * @since 23/10/11
 */

namespace Silexor\Generator;

class Generator
{
    public function renderFile($skeletonDir, $template, $target, $parameters = array())
    {
        $twig = new \Twig_Environment(new \Twig_Loader_Filesystem($skeletonDir), array(
            'debug'            => true,
            'cache'            => false,
            'strict_variables' => true,
            'autoescape'       => false,
        ));

        file_put_contents($target, $twig->render($template, $parameters));
    }
}
