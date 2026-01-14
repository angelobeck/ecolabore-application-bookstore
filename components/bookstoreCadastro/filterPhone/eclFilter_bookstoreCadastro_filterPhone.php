<?php

class eclFilter_bookstoreCadastro_filterPhone extends eclFilter
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
        $phone = $formulary->getReceived('details.phone');
        $countryCode = $formulary->getReceived('details.countryCode');
        $id = $control['id'] ?? '';

        if (!is_string($countryCode) || !preg_match('/^[+][0-9]{1,3}$/', $countryCode)) {
            return [
                'message' => 'bookstoreCadastro_filterPhone_invalidCountryCode',
                'context' => [
                    'id' => $id . '_countryCode'
                ]
            ];
        }

                if (!is_string($phone) || strlen($phone) == 0) {
            return [
                'message' => 'filter_string_requiredField',
                'context' => [
                    'label' => $control['label'] ?? '',
                    'id' => $control['id'] ?? ''
                ]
            ];
        }

        $phoneNumbers = eclIo_convert::extractNumbers($phone);
        if (strlen($phoneNumbers) < 7) {
            return [
                'message' => 'bookstoreCadastro_filterPhone_invalidPhone',
                'context' => [
                    'value' => $phone,
                    'id' => $id
                ]
            ];
        }

        $formulary->setField('details.countryCode', $countryCode);
        $formulary->setField('details.phone', $phone);
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
