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
 * ProjectGenerator class
 *
 * @author Benjamin Grandfond <benjamin.grandfond@gmail.com>
 * @since 23/10/11
 */

namespace Silexor\Generator;

use Symfony\Component\HttpKernel\Util\Filesystem;

class ProjectGenerator extends Generator
{
    /**
     * Project name
     * @var String $name
     */
    protected $name;

    /**
     * Project path
     * @var String $path
     */
    protected $path;

    /**
     * @var Symfony\Component\HttpKernel\Util\Filesystem $filesystem
     */
    protected $filesystem;

    /**
     * Constructor
     * 
     * @param $name
     * @param $path
     */
    public function __construct($name, $path)
    {
        $this->name = $name;
        $this->path = $path;
        $this->filesystem = new Filesystem();
    }

    /**
     * Generates a basic Silex app.
     * 
     * @throws \Exception|\RuntimeException
     * @return void
     */
    public function generate()
    {
        $dir = $this->path.'/'.$this->name;

        // Generate the base folder
        if (file_exists($dir)) {
            throw new \RuntimeException(sprintf('Unable to generate the bundle as the target directory "%s" is not empty.', realpath($dir)));
        }

        try {
            $this->filesystem->mkdir($dir);
            $this->filesystem->mkdir($dir.'/src');
            $this->filesystem->mkdir($dir.'/tests');
            $this->filesystem->mkdir($dir.'/vendor');
            $this->filesystem->mkdir($dir.'/web');

            $phar = file_get_contents('http://silex.sensiolabs.org/get/silex.phar');
            file_put_contents($dir.'/vendor/silex.phar', $phar);

            $this->renderFile(__DIR__.'/../Resources/skeleton/project', 'App.php', $dir.'/src/app.php');
            $this->renderFile(__DIR__.'/../Resources/skeleton/project', 'Bootstrap.php', $dir.'/tests/bootstrap.php');
            $this->renderFile(__DIR__.'/../Resources/skeleton/project', 'ControllerTest.php', $dir.'/tests/ControllerTest.php');
            $this->renderFile(__DIR__.'/../Resources/skeleton/project', 'Index.php', $dir.'/web/index.php');
            $this->renderFile(__DIR__.'/../Resources/skeleton/project', 'phpunit.xml.dist', $dir.'/phpunit.xml.dist', array('name' => $this->name));
        } catch (\Exception $e) {
            $this->filesystem->remove($dir);
            throw $e;
        }
    }
}
