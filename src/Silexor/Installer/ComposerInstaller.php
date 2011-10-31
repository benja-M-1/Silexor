<?php
/**
 * ComposerInstaller class
 *
 * @author Benjamin Grandfond <benjaming@theodo.fr>
 * @since 31/10/11
 */

namespace Silexor\Installer;

use Silexor\Generator\JsonComposerGenerator;
use Symfony\Component\Process\Process;

class ComposerInstaller implements InstallerInterface
{
    protected $pharName = 'composer.phar';

    public function download($path)
    {
        $phar = file_get_contents('http://getcomposer.org/composer.phar');
        file_put_contents($path.'/'.$this->pharName, $phar);
    }

    /**
     * Download every packages.
     *
     * @param $path
     * @param $packages
     * @return integer The proces return value.
     */
    public function downloadPackages($path, $packages)
    {
        $generator = new JsonComposerGenerator();
        $generator->generate($path, $packages);

        $process = new Process('php '.$this->pharName.' install', realpath($path));
        $process->setTimeout(3);
        $process->run();
        if (!$process->isSuccessful()) {
            throw new RuntimeException($process->getErrorOutput());
        }
        echo $process->getOutput();
    }
}
