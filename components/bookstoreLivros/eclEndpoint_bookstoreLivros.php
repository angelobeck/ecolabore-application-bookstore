<?php

class eclEndpoint_bookstoreLivros extends eclEndpoint
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
        $where['mode'] = eclStore_bookstore_book::MODE_BOOK;
        $where['keywords'] = implode(' ', $keywords);
        if (isset($input['kids']))
            $where['kids'] = 1;

        $rows = $io->database->select($store->bookstore_book, $where, 100);

        $groups = [];
        foreach ($rows as $row) {
            $points = 0;
            foreach ($keywords as $word) {
                if (strpos($row['name'], $word) !== false)
                    $points += 8;
                else if (strpos($row['details']['keywords1'], $word) !== false)
                    $points += 4;
                else if (strpos($row['details']['keywords2'], $word) !== false)
                    $points += 2;
                else
                    $points += 1;
            }
            if (!isset($groups[$points]))
                $groups[$points] = [$row];
            else
                $groups[$points][] = $row;
        }

        krsort($groups);
        $sorted = [];
        foreach ($groups as $group) {
            foreach ($group as $row) {
                $sorted[] = $row;
            }
        }
        return [
            'response' => [
                'message' => 'Pesquisando...',
                'children' => $sorted
            ]
        ];
    }

}
