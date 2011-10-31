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
    protected $pharname = 'silex.phar';

    public function download($path)
    {
        $phar = file_get_contents('http://silex.sensiolabs.org/get/silex.phar');
        file_put_contents($path.'/'.$this->getPharname(), $phar);
    }

    /**
     * @param string $pharname
     * @return void
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
}
