<?php

use function Dgame\Ensurance\enforce;
use function Dgame\Ensurance\ensure;

require_once 'vendor/autoload.php';

ensure('Hallo')->isNotEmpty()->isString()->isEqualTo('Hallo');

ensure(42)->isInt();
ensure(3.14)->isFloat();
ensure(true)->isTrue();
ensure(false)->isFalse();
ensure(1)->isNotNull();
ensure(null)->isNull();
ensure(0)->isPositive();
ensure(-1)->isNegative();
ensure(42)->isNumeric()->isGreaterThan(23);
ensure(23)->isNumeric()->isLessThan(42);
ensure('4')->isNumeric();

ensure(['a' => 'b'])->isArray()->hasKey('a')->haslengthOf(1)->hasValue('b')->isAssociative();

ensure(true)->isTrue()->orThrow('That is not true...');
enforce(true)->orThrow('That is not true...');