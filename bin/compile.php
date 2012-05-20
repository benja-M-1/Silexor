#!/usr/bin/env php
<?php
/**
 * This file is part of the Silexor Project
 *
 * (c) Benjamin Grandfond <benjamin.grandfond@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

require_once __DIR__ . '/../vendor/autoload.php';

use Silexor\Compiler;

$compiler = new Compiler();
$compiler->compile();
