<?php
/**
 * JsonComposerGenerator class
 *
 * @author Benjamin Grandfond <benjaming@theodo.fr>
 * @since 31/10/11
 */
namespace Silexor\Generator;

use Composer\Json\JsonFile;

class JsonComposerGenerator
{
    protected $filename = "composer.json";

    protected $packages = array(
        'form'        => array('name' => 'symfony/form', 'version' => '>=2.0'),
        'monolog'     => array('name' => 'monolog/monolog', 'version' => '>=1.0.0'),
        'translation' => array('name' => 'symfony/translation', 'version' => '>=2.0'),
        'twig-bridge' => array('name' => 'symfony/twig-bridge', 'version' => '>=2.0'),
        'validator'   => array('name' => 'symfony/validator', 'version' => '>=2.0'),
        'twig'        => array('name' => 'twig/twig', 'version' => '>=1.2.0'),
    );

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
