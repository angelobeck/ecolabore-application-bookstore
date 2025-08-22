<?php

class eclEndpoint_bookstoreCadastro extends eclEndpoint
{

    public function dispatch(array $input): array
    {
        global $io, $store;

        if (!isset($input['step']) or !isset($input['fields']))
            return $this->error('');

        $formularyName = $this->getFormularyName($input['step'], $input['fields']);
        $formulary = $this->page->createFormulary($formularyName, $input['fields']);

        if ($formulary->sanitize($input['fields'])) {
            if ($input['step'] === 5) {

            } else if ($input['step'] === 6) {

            }
            return $this->response(['fields' => $formulary->data]);
        }

        return $this->error($formulary->error);
    }

    private function getFormularyName(string $step, array $fields): string
    {
        switch ($step) {
            case '1':
                return 'bookstoreCadastro_formularyStart';
            case '2':
                if (isset($fields['minor']) and $fields['minor'])
                    return 'bookstoreCadastro_formularySponsor';
                else
                    return 'bookstoreCadastro_formularyPersonal';
            case '3':
                return 'bookstoreCadastro_formularyPublic';
            case '4':
                return 'bookstoreCadastro_formularyLogin';
            case '5':
                return 'bookstoreCadastro_formularyCheckout';
            case '6':
            default:
                return 'bookstoreCadastro_formularyDocument';
        }
    }

}
