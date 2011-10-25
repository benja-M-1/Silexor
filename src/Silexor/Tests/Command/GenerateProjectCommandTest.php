<?php
/**
 * GenerateProjectCommandTest class.
 * 
 * @author Benjamin Grandfond <benjamin.grandfond@gmail.com>
 * @since 23/10/11
 */

namespace Silexor\Tests\Command;

use Symfony\Component\Console\Tester\CommandTester;
use Silexor\Application;
use Silexor\Command\GenerateProjectCommand;

class GenerateProjectCommandTest extends \PHPUnit_Framework_TestCase
{
    public function testExecute()
    {
        $name = 'test';
        $path = __DIR__.'/../../tmp';
        
        $generator = $this->getGenerator();
        $generator->expects($this->once())
            ->method('generate')
            ->with($name, $path);

        $command = new GenerateProjectCommand();
        $command->setGenerator($generator);
        $commandTester = new CommandTester($command);
        $commandTester->execute(array('name' => $name, '--path' => $path), array('interactive' => false));

        $this->assertContains('Generating "'.$name.'" in '.$path, $commandTester->getDisplay());
        $this->assertContains('Project "'.$name.'" generated', $commandTester->getDisplay());
    }

    /**
     * @return Silexor\Generator\ProjectGenerator
     */
    protected function getGenerator()
    {
        return $this->getMockBuilder('Silexor\Generator\ProjectGenerator')
            ->disableOriginalConstructor()
            ->setMethods(array('generate'))
            ->getMock();
    }
}