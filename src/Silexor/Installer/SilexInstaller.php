<?php
/**
 * SilexInstaller class
 *
 * @author Benjamin Grandfond <benjamin.grandfond@gmail.com>
 * @since 31/10/11
 */

namespace Silexor\Installer;

class SilexInstaller implements InstallerInterface
{
    public function download($path)
    {
        $phar = file_get_contents('http://silex.sensiolabs.org/get/silex.phar');
        file_put_contents($path.'/silex.phar', $phar);
    }
}
