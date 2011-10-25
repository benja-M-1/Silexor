<?php
/**
 * GeneratorInterface Interface
 *
 * @author Benjamin Grandfond <benjamin.grandfond@gmail.com>
 * @author Fabien Potencier <fabien@symfony.com>
 * @since 23/10/11
 */

namespace Silexor\Generator;

class Generator
{
    protected function renderFile($skeletonDir, $template, $target, $parameters = array())
    {
        if (!is_dir(dirname($target))) {
            mkdir(dirname($target), 0777, true);
        }

        $twig = new \Twig_Environment(new \Twig_Loader_Filesystem($skeletonDir), array(
            'debug'            => true,
            'cache'            => false,
            'strict_variables' => true,
            'autoescape'       => false,
        ));

        file_put_contents($target, $twig->render($template, $parameters));
    }
}
