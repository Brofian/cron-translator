# Cron Translator
A simple tool to create a readable text for humans from a cronjob expression.

Supported languages:
- de
- en (comming soon)

# Installation
```sh
// comming soon
```

# Usage
```php
use Brofian\CronTranslator\CronTranslator;

// 'Jede Minute'
echo CronTranslator::expressionToString('* * * * *');

// 'Jede Minute in jeder 1.Stunde an jedem 2.Tag, im März am einem Donnerstag'
echo CronTranslator::expressionToString('* 1 2 3 4');

// 'Jede 5,10,15,20.Minute in jeder 3,4,5.Stunde'
echo CronTranslator::expressionToString('5,10,15,20 3,4,5 * * *');

// 'Jede 15.Minute von 10 Uhr bis 12 Uhr von Montag bis Freitag'
echo CronTranslator::expressionToString('*/15 10-12 * * 1-5');
```
A second parameter can be passed to select the language: (currently, only german is available)
```php
echo CronTranslator::expressionToString('* * * * *', 'de');
```
