<?php
/**
 * ComposerInstallerTest class.
 *
 * @author Benjamin Grandfond <benjamin.grandfond@gmail.com>
 * @since 31/10/11
 */

namespace Silexor\Test\Installer;

use Silexor\Tests\Installer\InstallerTest;
use Silexor\Installer\ComposerInstaller;

class ComposerInstallerTest extends InstallerTest
{
    public function setUp()
    {
        parent::setUp();

        $this->installer = new ComposerInstaller();
    }

    public function testDownload()
    {
        $this->installer->download($this->tmpDir);
        $this->assertTrue(file_exists($this->tmpDir.'/'.$this->installer->getPharname()));
    }

    public function testDownloadPackages()
    {
        $this->assertEquals(0, $this->installer->downloadPackages($this->tmpDir, array()));
    }

    public function testGenerate()
    {
        $this->installer->generate($this->tmpDir, array());
        $this->assertTrue(file_exists($this->tmpDir.'/'.$this->installer->getJsonname()));
    }

    public function testGenerateWithProviders()
    {
        $this->installer->generate($this->tmpDir, array('twig', 'monolog'));
        $this->assertTrue(file_exists($this->tmpDir.'/'.$this->installer->getJsonname()));
        $this->assertContains('twig\/twig', file_get_contents($this->tmpDir.'/'.$this->installer->getJsonname()));
        $this->assertContains('monolog\/monolog', file_get_contents($this->tmpDir.'/'.$this->installer->getJsonname()));
    }
}
