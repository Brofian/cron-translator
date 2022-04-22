# Cron Translator
A simple tool to create a readable text for humans from a cronjob expression.

Supported languages:
- de
- en (comming soon)

> Hint: I created this package, because i was not completely satisfied with the (at this time) most popular solution [lorisleiva/cron-translator](https://packagist.org/packages/lorisleiva/cron-translator) and wanted to create a much more simple way. If you are searching for a professional solution, i would recommend the other package

# Installation
```sh
composer require brofian/cron-translator
```

# Usage
```php
use Brofian\CronTranslator\CronTranslator;

// 'Jede Minute'
echo CronTranslator::expressionToString('* * * * *');

// 'Jede Minute der 1.Stunde an jedem 2.Tag, im März am einem Donnerstag'
echo CronTranslator::expressionToString('* 1 2 3 4');

// 'Die 17. und 30.Minute der 2.Stunde von Montag bis Freitag'
echo CronTranslator::expressionToString('17,30 2 * * 1-5');

// 'Jede 15.Minute von 10 Uhr bis 12 Uhr von Montag bis Freitag'
echo CronTranslator::expressionToString('*/15 10-12 * * 1-5');
```
A second parameter can be passed to select the language: (currently, only german is available)
```php
echo CronTranslator::expressionToString('* * * * *', 'de');
```
