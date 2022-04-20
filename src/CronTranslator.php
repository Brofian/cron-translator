<?php declare(strict_types=1);

namespace Brofian\CronTranslator;

/**
 * @Usage:
 * CronTranslator::expressionToString("* * * * *", <optional> "de");
 */
class CronTranslator {

    public static function expressionToString(string $expression, string $language = 'de'): string {
        return (new CronTranslator($expression, $language))->toString();
    }

    protected array $data = [];
    protected array $translations = [];

    public function __construct(string $expression, string $language)
    {
        [$minutes, $hours, $day, $month, $weekday] = explode(' ', trim($expression));

        $this->data['minutes'] = $this->parseString($minutes, 0, 59, 'minute');
        $this->data['hours'] = $this->parseString($hours, 0, 23, 'hour');
        $this->data['days'] = $this->parseString($day, 1, 31, 'day');
        $this->data['months'] = $this->parseString($month, 1, 12, 'month');
        $this->data['weekdays'] = $this->parseString($weekday, 0, 6, 'weekday');

        $this->translations = require __DIR__ . '/translations/' . $language . '.php';
    }

    public function toString(): string {

        // minutes
        $minutes = $this->parseMinutePhrases();
        $hours = $this->parseHourPhrases();
        $days = $this->parseDayPhrases();
        $months = $this->parseMonthPhrases();
        $weekdays = $this->parseWeekdayPhrases();

        $string = $this->trans('phrases.minutes.prefix') . $minutes . $this->trans('phrases.minutes.suffix');

        if($hours) {
            $string .= $this->trans('phrases.hours.prefix') . $hours . $this->trans('phrases.hours.suffix');
        }
        if($days) {
            $string .= $this->trans('phrases.days.prefix') . $days . $this->trans('phrases.days.suffix');
        }
        if($months) {
            $string .= $this->trans('phrases.months.prefix') . $months . $this->trans('phrases.months.suffix');
        }
        if($weekdays) {
            $string .= $this->trans('phrases.weekdays.prefix') . $weekdays . $this->trans('phrases.weekdays.suffix');
        }

        return ucfirst($string);
    }


    protected function parseWeekdayPhrases(): string {
        $phrases = [];

        foreach($this->data['weekdays'] as $weekday) {
            if($weekday['interval']) {
                $phrase = sprintf($this->trans('phrases.weekdays.interval'), $weekday['interval']);
            }
            elseif(!$weekday['to'] && $weekday['from'] !== '*') {
                $phrase = sprintf($this->trans('phrases.weekdays.single'), $this->trans('weekdays.'.$weekday['from']));
            }
            else {
                $phrase = $this->trans('phrases.weekdays.always');
            }

            if($weekday['from'] !== '*' && ($weekday['interval'] || $weekday['to'])) {
                if($phrase === '') {
                    $phrase = $this->trans('phrases.weekdays.range_prefix');
                }

                $phrase .= sprintf($this->trans('phrases.weekdays.range'),
                    $this->trans('weekdays.'.$weekday['from']),
                    $weekday['to'] ? $this->trans('weekdays.'.$weekday['to']) : $this->trans('weekdays.7')
                );
            }

            $phrases[] = $phrase;
        }

        array_filter($phrases);

        return implode($this->trans('phrases.weekdays.connection'), $phrases);
    }

    protected function parseMonthPhrases(): string {
        $phrases = [];

        foreach($this->data['months'] as $month) {
            if($month['interval']) {
                $phrase = sprintf($this->trans('phrases.months.interval'), $month['interval']);
            }
            elseif(!$month['to'] && $month['from'] !== '*') {
                $phrase = sprintf($this->trans('phrases.months.single'), $this->trans('months.'.$month['from']));
            }
            else {
                $phrase = $this->trans('phrases.months.always');
            }

            if($month['from'] !== '*' && ($month['interval'] || $month['to'])) {
                if($phrase === '') {
                    $phrase .= $this->trans('phrases.months.range_prefix');
                }

                $phrase .= sprintf($this->trans('phrases.months.range'), $this->trans('months.'.$month['from']), $month['to'] ? $this->trans('months.'.$month['to']) : $this->trans('months.12'));
            }

            $phrases[] = $phrase;
        }

        array_filter($phrases);

        return implode($this->trans('phrases.months.connection'), $phrases);
    }

    protected function parseDayPhrases(): string {
        $phrases = [];

        // check, if it is a simple list
        if($this->isListOfSingleItems($this->data['days'])) {
            return sprintf($this->trans('phrases.days.single'), implode(',', array_column($this->data['days'], 'from')));
        }

        foreach($this->data['days'] as $day) {
            if($day['interval']) {
                $phrase = sprintf($this->trans('phrases.days.interval'), $day['interval']);
            }
            elseif(!$day['to'] && $day['from'] !== '*') {
                $phrase = sprintf($this->trans('phrases.days.single'), $day['from']);
            }
            else {
                $phrase = $this->trans('phrases.days.always');
            }

            if($day['from'] !== '*' && ($day['interval'] || $day['to'])) {
                if($phrase === '') {
                    $phrase .= $this->trans('phrases.days.range_prefix');
                }

                $phrase .= sprintf($this->trans('phrases.days.range'), $day['from'], $day['to'] ?? 31);
            }

            $phrases[] = $phrase;
        }

        array_filter($phrases);

        return implode($this->trans('phrases.days.connection'), $phrases);
    }

    protected function parseHourPhrases(): string {
        $phrases = [];

        // check, if it is a simple list
        if($this->isListOfSingleItems($this->data['hours'])) {
            return sprintf($this->trans('phrases.hours.single'), implode(',', array_column($this->data['hours'], 'from')));
        }


        foreach($this->data['hours'] as $hour) {
            if($hour['interval']) {
                $phrase = sprintf($this->trans('phrases.hours.interval'), $hour['interval']);
            }
            elseif(!$hour['to'] && $hour['from'] !== '*') {
                $phrase = sprintf($this->trans('phrases.hours.single'), $hour['from']);
            }
            else {
                $phrase = $this->trans('phrases.hours.always');
            }

            if($hour['from'] !== '*' && ($hour['interval'] || $hour['to'])) {
                if($phrase === '') {
                    $phrase .= $this->trans('phrases.hours.range_prefix');
                }

                $phrase .= sprintf($this->trans('phrases.hours.range'), $hour['from'], $hour['to'] ?? 23);
            }

            $phrases[] = $phrase;
        }

        array_filter($phrases);

        return implode($this->trans('phrases.hours.connection'), $phrases);
    }

    protected function parseMinutePhrases(): string {
        $phrases = [];

        // check, if it is a simple list
        if($this->isListOfSingleItems($this->data['minutes'])) {
            return sprintf($this->trans('phrases.minutes.single'), implode(',', array_column($this->data['minutes'], 'from')));
        }

        foreach($this->data['minutes'] as $minute) {
            if($minute['interval']) {
                $phrase = sprintf($this->trans('phrases.minutes.interval'), $minute['interval']);
            }
            elseif(!$minute['to'] && $minute['from'] !== '*') {
                $phrase = sprintf($this->trans('phrases.minutes.single'), $minute['from']);
            }
            else {
                $phrase = $this->trans('phrases.minutes.always');
            }

            if($minute['from'] !== '*' && ($minute['interval'] || $minute['to'])) {
                $phrase .= sprintf($this->trans('phrases.minutes.range'), $minute['from'], $minute['to'] ?? 59);
            }

            $phrases[] = $phrase;
        }

        return implode($this->trans('phrases.minutes.connection'), $phrases);
    }


    protected function parseString(string $string): array {
        $parts = explode(',', $string);
        $definitions = [];

        foreach($parts as $part) {
            $definition = [
                'from' => 0,
                'to' => null,
                'interval' => null
            ];

            if(strpos($part, '/') !== false)
                [$part, $definition['interval']] = explode('/', $part);
            if(strpos($part, '-'))
                [$definition['from'], $definition['to']] = explode('-', $part);
            else
                $definition['from'] = $part;

            $definitions[] = $definition;
        }

        return $definitions;
    }


    protected function trans(string $path): string {
        $a = &$this->translations;
        foreach(explode('.', $path) as $step) {
            $a = &$a[$step];
        }
        return $a;
    }

    protected function isListOfSingleItems(array $list): bool {
        return empty(array_filter($list, static function($item) {
            return (
                $item['from']       === '*' ||
                $item['to']         !== null ||
                $item['interval']   !== null
            );
        }));
    }

}