<?php
/**
 * SilexInstallerTest class.
 *
 * @author Benjamin Grandfond <benjamin.grandfond@gmail.com>
 * @since 31/10/11
 */

namespace Silexor\Tests\Installer;

use Silexor\Tests\Installer\InstallerTest;
use Silexor\Installer\SilexInstaller;

class SilexInstallerTest extends InstallerTest
{
    public function setUp()
    {
        parent::setUp();

        $this->installer = new SilexInstaller();
    }

    public function testDownload()
    {
        $this->installer->download($this->tmpDir);
        $this->assertTrue(file_exists($this->tmpDir.'/'.$this->installer->getPharname()));
    }
}
