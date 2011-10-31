<?php
/**
 * ComposerInstaller class
 *
 * @author Benjamin Grandfond <benjamin.grandfond@gmail.com>
 * @since 31/10/11
 */

namespace Silexor\Installer;

use Silexor\Installer\InstallerInterface;
use Symfony\Component\Process\Process;
use Composer\Json\JsonFile;

class ComposerInstaller implements InstallerInterface
{
    /**
     * Packages for which Silex provides
     * Service Providers.
     * @var array
     */
    protected $packages = array(
        'form'        => array('name' => 'symfony/form',        'version' => '>=2.0'),
        'monolog'     => array('name' => 'monolog/monolog',     'version' => '>=1.0.0'),
        'translation' => array('name' => 'symfony/translation', 'version' => '>=2.0'),
        'twig-bridge' => array('name' => 'symfony/twig-bridge', 'version' => '>=2.0'),
        'validator'   => array('name' => 'symfony/validator',   'version' => '>=2.0'),
        'twig'        => array('name' => 'twig/twig',           'version' => '>=1.2.0'),
    );

    /**
     * Composer phar name.
     * @var string
     */
    protected $pharname = 'composer.phar';

    /**
     * Composer configuration file.
     * @var string
     */
    protected $jsonname = "composer.json";

    /**
     * Downloads Composer PHP Archive.
     *
     * @param $path
     * @return void
     */
    public function download($path)
    {
        $phar = file_get_contents('http://getcomposer.org/composer.phar');
        file_put_contents($path.'/'.$this->getPharname(), $phar);
    }

    /**
     * Install composer packages.
     *
     * @param string $path
     * @param array $packages
     * @return integer The process returned value.
     */
    public function downloadPackages($path, $packages)
    {
        if (empty($packages)) {
            return 0;
        }

        $this->generate($path, $packages);

        $process = new Process('php '.$this->getPharname().' install', realpath($path));
        $process->setTimeout(3);
        $process->run();

        if (!$process->isSuccessful()) {
            throw new \RuntimeException($process->getErrorOutput());
        }
        echo $process->getOutput();

        return $process->getExitCode();
    }

    /**
     * Generate the composer.json file with the
     * required packages.
     *
     * @throws \Exception
     * @param $path
     * @param $packages
     * @return void
     */
    public function generate($path, $packages)
    {
        $file = new JsonFile($path.'/'.$this->getJsonname());
        $requires = array();

        foreach ($packages as $package) {
            if (!isset($this->packages[$package])) {
                throw new \Exception(sprintf('Package "%s" not supported yet.', $package));
            }

            $requires[$this->packages[$package]['name']] = $this->packages[$package]['version'];
        }

        $file->write(array('requires' => $requires));
    }

    /**
     * @param string $pharname
     */
    public function setPharname($pharname)
    {
        $this->pharname = $pharname;
    }

    /**
     * @return string
     */
    public function getPharname()
    {
        return $this->pharname;
    }

    /**
     * @return string
     */
    public function getJsonname()
    {
        return $this->jsonname;
    }

    /**
     * @param string $jsonname
     * @return void
     */
    public function setJsonname($jsonname)
    {
        $this->jsonname = $jsonname;
    }
}
