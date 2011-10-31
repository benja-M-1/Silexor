<?php
/**
 * SilexInstallerTest class.
 *
 * @author Benjamin Grandfond <benjamin.grandfond@gmail.com>
 * @since 31/10/11
 */

namespace Silexor\Tests\Installer;

use Silexor\Util\Filesystem;

abstract class InstallerTest extends \PHPUnit_Framework_TestCase
{
    protected $filesystem;
    protected $tmpDir;

    public function setUp()
    {
        $this->tmpDir = __DIR__.'/tmp';
        $this->filesystem = new Filesystem();
        $this->filesystem->remove($this->tmpDir);
        $this->filesystem->mkdir($this->tmpDir);
    }

    public function tearDown()
    {
        $this->filesystem->remove($this->tmpDir);
    }
}
