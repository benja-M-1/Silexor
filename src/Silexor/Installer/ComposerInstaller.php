<?php
/**
 * ComposerInstaller class
 *
 * @author Benjamin Grandfond <benjamin.grandfond@gmail.com>
 * @since 31/10/11
 */

namespace Silexor\Installer;

use Silexor\Generator\JsonComposerGenerator;
use Symfony\Component\Process\Process;

class ComposerInstaller implements InstallerInterface
{
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
    protected $filename = "composer.json";

    /**
     * Downloads Composer PHP Archive.
     *
     * @param $path
     * @return void
     */
    public function download($path)
    {
        $phar = file_get_contents('http://getcomposer.org/composer.phar');
        file_put_contents($path.'/'.$this->pharname, $phar);
    }

    /**
     * Install composer packages.
     *
     * @param $path
     * @param $packages
     * @return integer The proces return value.
     */
    public function downloadPackages($path, $packages)
    {
        $this->generate($path, $packages);

        $process = new Process('php '.$this->pharname.' install', realpath($path));
        $process->setTimeout(3);
        $process->run();
        if (!$process->isSuccessful()) {
            throw new RuntimeException($process->getErrorOutput());
        }
        echo $process->getOutput();
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
        $file = new JsonFile($path.'/'.$this->filename);
        $requires = array();

        foreach ($packages as $package) {
            if (!isset($this->packages[$package])) {
                throw new \Exception(sprintf('Package "%s" not supported yet.', $package));
            }

            $requires[$this->packages[$package]['name']] = $this->packages[$package]['version'];
        }

        $file->write(array('requires' => $requires));
    }
}
