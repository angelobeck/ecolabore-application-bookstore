<?php

class eclEndpoint_bookstoreAdminUsuarios_detalhes_status extends eclEndpoint
{

    public function dispatch(array $input): array
    {
        global $io, $store;
        $userId = intval($this->page->application->parent->name);

        $user = &$store->user->openById($userId);
        if (!$user)
            return $this->error('');

       if (isset($input['status'])) {
            $formulary = $this->page->createFormulary('bookstoreAdminUsuarios_detalhes_status_edit', $user);
            $formulary->sanitize($input);
            if ($formulary->error)
                return $this->error($formulary->error);

            $user = $formulary->data;
        }

        return $this->response(['status' => $user['status']]);
    }

}
