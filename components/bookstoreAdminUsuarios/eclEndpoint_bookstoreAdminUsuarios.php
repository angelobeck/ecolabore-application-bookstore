<?php

class eclEndpoint_bookstoreAdminUsuarios extends eclEndpoint
{

    public function dispatch(array $input): array
    {
        global $io, $store;
        set_time_limit(3);
        $plainKeywords = $input['keywords'] ?? '';
        $keywords = [];
        foreach (explode(' ', $plainKeywords) as $word) {
            $word = trim(eclIo_convert::slug($word));
            if (strlen($word) < 2)
                continue;

            $keywords[] = $word;
        }

        if (!$keywords)
            return ['error' => ['message' => 'O texto a pesquisar é muito curto']];

        $where = [];
        $where['name'] = '-public';
        $where['keywords'] = implode(' ', $keywords);

        $rows = $io->database->select($store->userContent, $where, 100);
return [
            'response' => [
                'message' => 'Pesquisando...',
                'children' => $rows
            ]
        ];
    }

}
