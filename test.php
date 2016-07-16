<?php

use function Dgame\Ensurance\enforce;

require_once 'vendor/autoload.php';

enforce('That must be a valid value of the given array')->ensure('Randy')->isString()->isValueOf(['Marcel']);