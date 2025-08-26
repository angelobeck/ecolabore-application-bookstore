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
                'context' => ['label' => $control['label'] ?? '']
            ];

        $value = eclIo_convert::extractNumbers($value);
        if (strlen($value) !== 8)
            return [
                'message' => 'bookstoreCadastro_filterBornDate_invalidValue',
                'context' => []
            ];

        $day = substr($value, 0, 2);
        $month = substr($value, 2, 2);
        $year = substr($value, 4, 4);
        $century = substr($year, 0, 2);

        $bornDate = strtotime($year . '-' . $month . '-' . $day);

        $year18 = strval(intval($year) + 18);
        $minor = strtotime($year18 . '-' . $month . '-' . $day);
        if ($minor < TIME)
            $minor = 0;

        $year14 = strval(intval($year) + 14);
        $kid = strtotime($year14 . '-' . $month . '-' . $day);
        if ($kid < TIME)
            $kid = 0;

        if (
            $bornDate > TIME
            || intval($day) > 31
            || intval($month) > 12
            || ($century != '19' and $century != '20')
        )
            return [
                'message' => 'bookstoreCadastro_filterBornDate_invalidValue',
                'context' => []
            ];

        $formulary->setField('kid', $kid);
        $formulary->setField('minor', $minor);

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
