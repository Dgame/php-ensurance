<?php

use function Dgame\Ensurance\enforce;
use function Dgame\Ensurance\ensure;

require_once 'vendor/autoload.php';

ensure('Hello')->isNotEmpty()->isString()->isEqualTo('Hello');

ensure(42)->isInt();
ensure(3.14)->isFloat();

ensure(true)->isTrue();
ensure(false)->isFalse();

ensure(1)->isNotNull();
ensure(null)->isNull();

ensure(0)->isPositive();
ensure(-1)->isNegative();

ensure(4)->isEven();
ensure(3)->isOdd();

ensure('4')->isNumeric();
ensure(42)->isNumeric()->isGreaterThan(23);
ensure(23)->isNumeric()->isLessThan(42);

ensure(['a' => 'b'])->isArray()->hasKey('a')->hasLengthOf(1)->hasValue('b')->isAssociative();

ensure(true)->isTrue()->orThrow('That is not true...');
enforce(true)->orThrow('That is not true...');