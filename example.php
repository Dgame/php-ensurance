<?php

use function Dgame\Ensurance\ensure;

require_once 'vendor/autoload.php';

$a = null;
//ensure($a)->isNotNull()->orThrow('$a is null!!')->isNotEmpty()->orThrow('It is empty!!!');
ensure($a)->orThrow('$a check failed')->isNotNull()->orThrow('$a is null!!')->isNotEmpty()->orThrow('It is empty!!!');