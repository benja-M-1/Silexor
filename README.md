# Silexor

## What is it?

Silexor is a set of commands that accelerate your Silex app generation.

It is based on the awesome Symfony components:

* ClassLoader
* Yaml
* Console
* HttpKernel (only for the Filesystem class)

And uses Twig to generate base files.

Silexor is inspired by the SensioGeneratorBundle for the Symfony framework.

Find more information about Silex at http://silex.sensiolabs.org/

## Installation

    git clone git://github.com/benja-M-1/Silexor.git
    git submodule update --init --recursive


## Usage

### Generate a Silex project

    $ php src/console project:generate MyProject --path='/path/to/your/project'

This command will generate your Silex app under the MyProject folder in `/path/to/your/project`.

The structure of the generated project looks like this:

* `src`
* `tests`
* `vendor`
* `web`

The `project:generate` command also generates every files you need to run a simple Silex app (pleonasm):

* `src/app.php`: this is the first controller of your application
* `web/index.php`: web bootstrapper
* `vendor/silex.phar`: PHP archive including Silex  (directly downloaded from the Silex website)
* `tests/boostrap.php`: the unit test bootstrap
* `tests/ControllerTest.php`: the functional test of the first controller contained in `app.php`
* `phpunit.xml.dist`: PHPUnit configuration file

Once the project is generated, you can run the tests:

    $ phpunit tests

![PHPUnit results](https://github.com/benja-M-1/Silexor/blob/master/src/Silexor/Resources/doc/phpunit_result.png?raw=true)


## TODO

* Providing options lo add services in the generation of the app.php file (doctrine, twig, ...)
* Service provider generator
* Controller provider generator
