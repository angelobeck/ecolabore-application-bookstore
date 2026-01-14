<?php

class eclFilter_bookstoreCadastro_filterBornDate extends eclFilter
{

    static function create(eclEngine_formulary $formulary, array $control, string $name)
    {
        if (!isset($control['template']))
            $control['template'] = 'form_input';

        $control['name'] = $name;

        $value = $formulary->getField($control['target']);
        if (!$value && isset($control['default']))
            $control['value'] = $control['default'];
        else if (is_numeric($value))
            $control['value'] = strval($value);
        else if (is_string($value))
            $control['value'] = eclIo_convert::htmlSpecialChars($value);

        $formulary->appendChild($control);
    }

    static function sanitize(eclEngine_formulary $formulary, array $control): array
    {
        $value = $formulary->getReceived($control['target']);

        if (!is_string($value) || strlen($value) === 0)
            return [
                'message' => 'filter_string_requiredField',
                'context' => [
                    'label' => $control['label'] ?? '',
                    'id' => $control['id'] ?? ''
                ]
            ];

        if (strpos($value, '/')) {
            $parts = explode('/', $value);
            if (count($parts) != 3)
                return [
                    'message' => 'bookstoreCadastro_filterBornDate_invalidValue',
                    'context' => [
                        'id' => $control['id'] ?? ''
                    ]
                ];

            list($day, $month, $year) = $parts;
        } else {
            $value = eclIo_convert::extractNumbers($value);
            if (strlen($value) !== 8)
                return [
                    'message' => 'bookstoreCadastro_filterBornDate_invalidValue',
                    'context' => ['id' => $control['id'] ?? '']
                ];

            $day = substr($value, 0, 2);
            $month = substr($value, 2, 2);
            $year = substr($value, 4, 4);
        }

        $intDay = intval(trim($day));
        $intMonth = intval(trim($month));
        $intYear = intval(trim($year));

        if (
            !$intDay || $intDay > 31
            || !$intMonth || $intMonth > 12
            || !$intYear || $intYear < 1900 || $intYear > intval(date('Y'))
        )
            return [
                'message' => 'bookstoreCadastro_filterBornDate_invalidValue',
                'context' => ['id' => $control['id'] ?? '']
            ];

        $day = str_pad(strval($intDay), 2, '0', STR_PAD_LEFT);
        $month = str_pad(strval($intMonth), 2, '0', STR_PAD_LEFT);
        $year = strval($intYear);

        $timeBornDate = strtotime($year . '-' . $month . '-' . $day);

        $year18 = strval($intYear + 18);
        $timeMinor = strtotime($year18 . '-' . $month . '-' . $day);
        if ($timeMinor < TIME)
            $timeMinor = 0;

        $year14 = strval($intYear + 14);
        $timeKid = strtotime($year14 . '-' . $month . '-' . $day);
        if ($timeKid < TIME)
            $timeKid = 0;

        if ($timeBornDate > TIME)
            return [
                'message' => 'bookstoreCadastro_filterBornDate_invalidValue',
                'context' => ['id' => $control['id'] ?? '']
            ];

        $formulary->setField('kid', $timeKid);
        $formulary->setField('minor', $timeMinor);

        $formulary->setField($control['target'], $day . '/' . $month . '/' . $year);
        return [];
    }

    public static function save(eclEngine_formulary $formulary, array $control, string $name)
    {
        $value = '';

        if (isset($formulary->received[$name]))
            $value = $formulary->received[$name];

        // if ($value == '' && isset($control['required']))
        // $formulary->setErrorMessage($control, $name, 'form_alert_required');

        if ($value === '' && isset($control['clear']))
            $value = false;

        $formulary->setField($control['target'], $value);
    }

    static function view(eclEngine_formulary $formulary, array $control, string $name)
    {
        $control['template'] = 'view';

        $value = $formulary->getField($control['target']);
        if (!$value && isset($control['default']))
            $control['value'] = $control['default'];
        else if (is_numeric($value))
            $control['value'] = strval($value);
        else if (is_string($value))
            $control['value'] = eclIo_convert::htmlSpecialChars($value);

        $formulary->appendChild($control);
    }

}
