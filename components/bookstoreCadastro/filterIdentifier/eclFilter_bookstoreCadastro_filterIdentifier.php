<?php

class eclFilter_bookstoreCadastro_filterIdentifier extends eclFilter
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
        global $io, $store;

        $value = $formulary->getReceived($control['target']);

        if (!is_string($value) || strlen($value) === 0)
            return [
                'message' => 'filter_string_requiredField',
                'context' => [
                    'label' => $control['label'] ?? '',
                    'id' => $control['id'] ?? ''
                ]
            ];

        $value = eclIo_convert::slug($value);
        if (strlen($value) <= 3)
            return [
                'message' => 'bookstoreCadastro_filterIdentifier_invalidValue',
                'context' => [
                    'id' => $control['id'] ?? ''
                ]
            ];

        $rows = $io->database->select($store->user, ['name' => $value]);
        if ($rows) {
            return [
                'message' => 'bookstoreCadastro_filterIdentifier_identifierAlreadyExists',
                'context' => [
                    'value' => $value,
                    'id' => $control['id'] ?? ''
                ]
            ];
        }


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
