<?php

class eclFilter_bookstoreCadastro_filterDocument extends eclFilter
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

        $country = $formulary->getReceived('details.country');
        $document = $formulary->getReceived('details.document');
        $documentType = $formulary->getReceived('details.documentType');

        if (!is_string($document) || strlen($document) == 0) {
            return [
                'message' => 'filter_string_requiredField',
                'context' => [
                    'label' => $control['label'] ?? '',
                    'id' => $control['id'] ?? ''
                ]
            ];
        }

        $documentNumbers = eclIo_convert::extractNumbers(strval($document));
        if ($country == 'Brasil' && !self::checkCPF($documentNumbers)) {
            return [
                'message' => 'bookstoreCadastro_filterDocument_invalidCPF',
                'context' => [
                    'value' => $document,
                    'id' => $control['id'] ?? ''
                ]
            ];
        } else if ($country == 'Portugal' && !self::checkNIF($documentNumbers)) {
            return [
                'message' => 'bookstoreCadastro_filterDocument_invalidNIF',
                'context' => [
                    'value' => $document,
                    'id' => $control['id'] ?? ''
                ]
            ];
        } else if ($country != 'Brasil' && $country != 'Portugal' && strlen($documentNumbers) < 6) {
            return [
                'message' => 'bookstoreCadastro_filterDocument_invalidDocumentNumber',
                'context' => [
                    'value' => $document,
                    'id' => $control['id'] ?? ''
                ]
            ];
        }

        if ($country == 'Brasil') {
            $documentType = 'CPF';
            $document = substr($documentNumbers, 0, 9) . '-' . substr($documentNumbers, 9);
        } else if ($country == 'Portugal') {
            $documentType = 'NIF';
            $document = substr($documentNumbers, 0, 8) . '-' . substr($documentNumbers, 8);
        } else {
            if (!strlen($documentType)) {
                $id = $control['id'] ?? '';
                $id .= '_documentType';
                return [
                    'message' => 'bookstoreCadastro_filterDocument_invalidDocumentType',
                    'context' => ['id' => $id]
                ];
            }
        }

        if ($documentType == 'CPF' || $documentType == 'NIF') {
            $rows = $io->database->select($store->user, ['document' => $documentNumbers]);
            if ($rows) {
                return [
                    'message' => 'bookstoreCadastro_filterDocument_userAlreadyExists',
                    'context' => [
                        'value' => $document,
                        'id' => $control['id'] ?? ''
                    ]
                ];

            }
        }

        $formulary->setField('details.document', $document);
        $formulary->setField('details.documentType', $documentType);

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

    public static function checkCPF(string $cpf): bool
    {
        if (strlen($cpf) != 11)
            return false;
        if (preg_match('/(\d)\1{10}/', $cpf))
            return false;

        for ($t = 9; $t < 11; $t++) {
            for ($d = 0, $c = 0; $c < $t; $c++) {
                $d += $cpf[$c] * (($t + 1) - $c);
            }
            $d = ((10 * $d) % 11) % 10;
            if ($cpf[$c] != $d) {
                return false;
            }
        }
        return true;
    }

    public static function checkNIF(string $numbers): bool
    {
        if (strlen($numbers) != 9)
            return false;

        $sum = 0;
        $mult = 2;
        for ($i = 7; $i >= 0; $i--) {
            $sum += intval($numbers[$i]) * $mult;
            $mult++;
        }
        $dv = 11 - ($sum % 11);
        $dv = $dv >= 10 ? 0 : $dv;

        if ($dv == intval($numbers[8]))
            return true;
        else
            return false;
    }

}
