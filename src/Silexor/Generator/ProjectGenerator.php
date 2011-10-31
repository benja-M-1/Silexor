<?php
/**
 * ProjectGenerator class
 *
 * @author Benjamin Grandfond <benjamin.grandfond@gmail.com>
 * @since 23/10/11
 */

namespace Silexor\Generator;

use Silexor\Util\Filesystem;
use Silexor\Installer\SilexInstaller;
use Silexor\Installer\ComposerInstaller;

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
     * @var Array $providers
     */
    protected $providers;

    /**
     * @var Symfony\Component\HttpKernel\Util\Filesystem $filesystem
     */
    protected $filesystem;

    /**
     * @var Silexor\Installer\InstallerInterface
     */
    protected $silexInstaller;

    /**
     * @var Silexor\Installer\InstallerInterface
     */
    protected $composerInstaller;

    /**
     * Constructor
     *
     * @param $name
     * @param $path
     */
    public function __construct()
    {
        $this->filesystem = new Filesystem();
    }

    /**
     * Generates a basic Silex app.
     *
     * @throws \Exception|\RuntimeException
     *
     * @param String  $name      The Silex application name.
     * @param String  $path      The Silex application path.
     * @param Array   $providers The providers to add to the Silex application.
     * @param Boolean $clear     Removes the existing folder.
     * @return void
     */
    public function generate($name, $path, $providers = array(), $clear = false)
    {
        $this->name = $name;
        $this->path = $path;
        $this->providers = $providers;

        $this->dir = $this->path.'/'.$this->name;

        // Generate the base folder
        if (file_exists($this->dir)) {
            if ($clear) {
                $this->filesystem->remove($this->dir);
            } else {
                throw new \RuntimeException(sprintf('Unable to generate the bundle as the target directory "%s" is not empty.', realpath($this->dir)));
            }
        }

        try {
            $this->filesystem->mkdir($this->dir);
            $this->filesystem->mkdir($this->dir.'/src');
            $this->filesystem->mkdir($this->dir.'/tests');
            $this->filesystem->mkdir($this->dir.'/vendor');
            $this->filesystem->mkdir($this->dir.'/web');

            $silexInstaller = $this->getSilexInstaller();
            $silexInstaller->download($this->dir.'/vendor');

            $composerInstaller = $this->getComposerInstaller();
            $composerInstaller->download($this->dir);
            $composerInstaller->downloadPackages($this->dir, $providers);

            $this->renderFile(__DIR__.'/../Resources/skeleton/project', 'App.php', $this->dir.'/src/app.php', array('proivders' => $this->providers));
            $this->renderFile(__DIR__.'/../Resources/skeleton/project', 'Bootstrap.php', $this->dir.'/tests/bootstrap.php');
            $this->renderFile(__DIR__.'/../Resources/skeleton/project', 'ControllerTest.php', $this->dir.'/tests/ControllerTest.php');
            $this->renderFile(__DIR__.'/../Resources/skeleton/project', 'Index.php', $this->dir.'/web/index.php');
            $this->renderFile(__DIR__.'/../Resources/skeleton/project', 'phpunit.xml.dist', $this->dir.'/phpunit.xml.dist', array('name' => $this->name));
        } catch (\Exception $e) {
            $this->filesystem->remove($this->dir);
            throw $e;
        }
    }

    /**
     * @return Silexor\Installer\InstallerInterface
     */
    public function getSilexInstaller()
    {
        if ($this->silexInstaller === null) {
            $this->silexInstaller = new SilexInstaller();
        }

        return $this->silexInstaller;
    }

    /**
     * @param Silexor\Installer\InstallerInterface $silexInstaller
     */
    public function setSilexInstaller($silexInstaller)
    {
        $this->silexInstaller = $silexInstaller;
    }

    /**
     * @return Silexor\Installer\InstallerInterface
     */
    public function getComposerInstaller()
    {
        if ($this->composerInstaller === null) {
            $this->composerInstaller = new ComposerInstaller();
        }

        return $this->composerInstaller;
    }

    /**
     * @param Silexor\Installer\InstallerInterface $composerInstaller
     */
    public function setComposerInstaller($composerInstaller)
    {
        $this->composerInstaller = $composerInstaller;
    }
}
