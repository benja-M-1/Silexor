<?php

class ApplicationTest extends PHPUnit_Framework_TestCase
{
    public function testName()
    {
        $application = new Silexor\Application();

        $this->assertEquals('silexor', $application->getName());
        $this->assertTrue($application->has('project:generate'));
    }
}
