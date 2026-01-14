<?php

class eclFilter_bookstoreCadastro_filterMail extends eclFilter
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


        if (!preg_match('/^[a-zA-Z0-9._-]+[@][a-z0-9_-]+[.][a-z0-9._-]+$/', $value))
            return [
                'message' => 'bookstoreCadastro_filterMail_invalidValue',
                'context' => [
                    'value' => $value,
                    'id' => $control['id'] ?? ''
                    ]
            ];

        $formulary->setField($control['target'], $value);
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
