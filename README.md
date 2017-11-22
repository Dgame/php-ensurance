# php-ensurance

[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/Dgame/php-ensurance/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/Dgame/php-ensurance/?branch=master)
[![Code Coverage](https://scrutinizer-ci.com/g/Dgame/php-ensurance/badges/coverage.png?b=master)](https://scrutinizer-ci.com/g/Dgame/php-ensurance/?branch=master)
[![Build Status](https://scrutinizer-ci.com/g/Dgame/php-ensurance/badges/build.png?b=master)](https://scrutinizer-ci.com/g/Dgame/php-ensurance/build-status/master)
[![StyleCI](https://styleci.io/repos/63493775/shield?branch=master)](https://styleci.io/repos/63493775)
[![Build Status](https://travis-ci.org/Dgame/php-ensurance.svg?branch=master)](https://travis-ci.org/Dgame/php-ensurance)

## design by contract for PHP

If your check fails, an Exception is thrown

## Strings

### equality
```php
ensure('foo')->isString()->isEqualTo('foo');
ensure('foo')->isString()->isNotEqualTo('bar');
```

### pattern
```php
ensure('test@foo')->isString()->match('#^[a-z]+@\w{3}$#i');
ensure('FooBar')->isString()->beginsWith('Fo');
ensure('FooBar')->isString()->endsWith('ar');
```

### size
```php
ensure('foo')->isString()->hasLengthOf(3);
ensure('foo')->isString()->isShorterThan(4);
ensure('foo')->isString()->isLongerThan(2);
```

and more

## Numerics

### type check
```php
ensure(42)->isInt();
ensure('42')->isInt();

ensure(4.2)->isFloat();
ensure('4.2')->isFloat();
```

### value check
```php
ensure(42)->isNumeric()->isGreaterThan(23);
ensure(23)->isNumeric()->isLessThan(42);
ensure(42)->isEqualTo(42);
```

### positive / negative
```php
foreach (range(0, 100) as $n) {
    ensure($n)->isPositive();
}
````

```php
foreach (range(-1, -100) as $n) {
    ensure($n)->isNegative();
}
```

### even / odd
```php
for ($i = 0; $i < 42; $i += 2) {
    ensure($i)->isEven();
}
```

```php
for ($i = 1; $i < 42; $i += 2) {
    ensure($i)->isOdd();
}
```

### between range
```php
ensure(2)->isNumeric()->isBetween(1, 3);
```

## array

### check for a key
```php
ensure(['a' => 'b'])->isArray()->hasKey('a');
```

### check for a value
```php
ensure(['a', 'b'])->isArray()->hasValue('a');
```

### check length
```php
ensure([])->isArray()->hasLengthOf(0);
ensure(range(0, 99))->isArray()->hasLengthOf(100);
```

```php
ensure([1, 2, 3])->isArray()->isShorterThan(4);
ensure([1, 2, 3])->isArray()->isLongerThan(2);
```

### check if associativ or not
```php
ensure(['a' => 'b'])->isArray()->isAssociative();
```

## ensure not empty / not null

```php
ensure('')->isNotNull()->isNotEmpty();
```

## ensure identity (`===`) / equality (`==`)
```php
ensure(42)->isEqualTo('42');
```

```php
ensure(42)->isIdenticalTo(42);
```

## bool

### is true / false

```php
ensure((2 * 3) === (3 * 2))->isTrue();
ensure((2 * 3) === (3 * 3))->isFalse();
```
----

You can also specify your own Exception messages:

```php
ensure(1 === 1)->isTrue()->orThrow('You will never see this error');
```


# Enforcement

If you want to enforce that some condition is true, use enforce:
```php
enforce(true)->orThrow('That is not true...');
```

# Assurance

If you want to assure that some condition is true, you could use the PHP `assert` function. Sadly, PHP assertions are disabled in production mode, but `assure` is not:

```php
assure(0);
```

Will throw an AssertionError as a correctly configured `assert` would do.
