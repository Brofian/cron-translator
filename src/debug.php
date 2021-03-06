<?php declare(strict_types=1);

require_once __DIR__.'/CronTranslator.php';

use Brofian\CronTranslator\CronTranslator;

echo CronTranslator::expressionToString('17,30 2 * * 1-5') . PHP_EOL;
echo CronTranslator::expressionToString('* 1 2 3 4') . PHP_EOL;
echo CronTranslator::expressionToString('*/15 8-12 * * 1-5') . PHP_EOL;
echo CronTranslator::expressionToString('30 */4 * * 1-5') . PHP_EOL;
echo CronTranslator::expressionToString('10 */6 * * *') . PHP_EOL;


// echo CronTranslator::expressionToString('* 1 2 3 4') . PHP_EOL;
// echo CronTranslator::expressionToString('20-30 6-18 10-20 4-10 1-5') . PHP_EOL;
// echo CronTranslator::expressionToString('*/15 10-12 * * 1-5') . PHP_EOL;
// echo CronTranslator::expressionToString('5,10,15,20 3,4 * * *') . PHP_EOL;
