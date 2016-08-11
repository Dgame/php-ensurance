# php-ensurance

## design by contract for PHP 7

```php
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
```

You can also specify your own Exception messages:

```php
ensure(1 === 1)->isTrue()->orThrow('You will never see this error');
```

Or, if you want to assert that some condition is true, use enforce:
```php
enforce(true)->orThrow('That is not true...');
```
