<?php

class eclEndpoint_bookstoreLivro extends eclEndpoint
{

    public function dispatch(array $input): array
    {
        global $io, $store;
        $name = $this->page->application->name;

        $where = [
            'name' => $name,
            'mode' => eclStore_bookstore_book::MODE_BOOK
        ];

        $rows = $io->database->select($store->bookstore_book, $where, 1);
        if (!$rows)
            return $this->error();

        $files = [];
        if (is_dir(PATH_ROOT . 'livros/' . $name)) {
            foreach (scandir(PATH_ROOT . 'livros/' . $name) as $file) {
                if ($file[0] == '.')
                    continue;

                $files[] = $file;
            }
        }

        $message = self::bookRestrictions($this->page, $rows[0]);
        $restrictions = self::userRestrictions($this->page);
        if (!$message && !isset($restrictions['kid']))
            $this->linkUser();

        return $this->response([
            'book' => $rows[0],
            'files' => $files,
            'is_favorite' => $this->isFavorite($rows[0], $input)
        ]);
    }

    private function linkUser()
    {
        global $io, $store;

        if (!isset($this->page->session['user']['name']))
            return;

        $userName = $this->page->session['user']['name'];
        $user = $store->user->open($userName);
        if (!$user)
            return;

        $userId = $user['id'];
        $userContent = &$store->userContent->open($userId, '-public');
        if (!$userContent)
            return;

        $bookName = $this->page->application->name;
        $where = [
            'mode' => eclStore_bookstore_book::MODE_BOOK,
            'name' => $bookName
        ];
        $rows = $io->database->select($store->bookstore_book, $where);
        $book = $rows[0];

        $data = $book;
        $data['details']['readers'] = $this->linkUserToBook($book, $userContent);

        $io->database->update($store->bookstore_book, $data, $book);

        $this->linkBookToUser($book, $userContent);
    }

    private function linkUserToBook($book, $userContent): array
    {
        $insert = [
            'id' => $userContent['user_id'],
            'title' => $userContent['text']['title']['pt']['value']
        ];

        if (!isset($book['details']['readers']))
            return [$insert];

        $readers = $book['details']['readers'];
        $length = count($readers);
        $found = -1;
        for ($i = 0; $i < $length; $i++) {
            $reader = $readers[$i];
            if ($reader['id'] == $userContent['user_id']) {
                $found = $i;
                break;
            }
        }

        if ($found > -1)
            array_splice($readers, $i, 1);
        else if ($length == 20)
            array_pop($readers);

        array_unshift($readers, $insert);

        return $readers;
    }

    private function linkBookToUser($book, &$userContent)
    {
        $insert = [
            'name' => $book['name'],
            'title' => $book['text']['title']['pt']['value']
        ];

        if (isset($userContent['details']['favorite_books'])) {
            $favorites = $userContent['details']['favorite_books'];
            $found = -1;
            $length = count($favorites);
            for ($i = 0; $i < $length; $i++) {
                $favorite = $favorites[$i];
                if ($favorite['name'] == $insert['name']) {
                    $found = $i;
                    break;
                }
            }
            if ($found > -1) {
                array_splice($favorites, $found, 1);
                array_unshift($favorites, $insert);
                $userContent['details']['favorite_books'] = $favorites;
                return;
            }
        }

        if (isset($userContent['details']['recent_books'])) {
            $recents = $userContent['details']['recent_books'];
            $found = -1;
            $length = count($recents);
            for ($i = 0; $i < $length; $i++) {
                $recent = $recents[$i];
                if ($recent['name'] == $insert['name']) {
                    $found = $i;
                    break;
                }
            }
            if ($found > -1)
                array_splice($recents, $found, 1);
            else if ($length == 20)
                array_pop($recents);

            array_unshift($recents, $insert);
            $userContent['details']['recent_books'] = $recents;
            return;
        }

        $userContent['details']['recent_books'] = [$insert];
    }

    private function isFavorite($book, $input): bool
    {
        global $store;

        if (!isset($this->page->session['user']['name']))
            return false;

        $userName = $this->page->session['user']['name'];
        $user = $store->user->open($userName);
        if (!$user)
            return false;

        $insert = [
            'name' => $book['name'],
            'title' => $book['text']['title']['pt']['value']
        ];

        $userContent = &$store->userContent->open($user['id'], '-public');
        if (!isset($userContent['details']['favorite_books'])) {
            if (isset($input['action']) and $input['action'] == 'favorite_subscribe') {
                $userContent['details']['favorite_books'] = [$insert];
                return true;
            }
            return false;
        }

        $favorites = $userContent['details']['favorite_books'];
        $length = count($favorites);
        $found = -1;
        for ($i = 0; $i < $length; $i++) {
            $favorite = $favorites[$i];
            if ($favorite['name'] == $book['name'])
                $found = $i;
            break;
        }
        if (isset($input['action']) and $input['action'] == 'favorite_unsubscribe' and $found > -1) {
            array_splice($favorites, $found, 1);
            $userContent['details']['favorite_books'] = $favorites;
            return false;
        } else if (isset($input['action']) and $input['action'] == 'favorite_subscribe') {
            if ($found > -1)
                array_splice($favorites, $found, 1);

            array_unshift($favorites, $insert);
            $userContent['details']['favorite_books'] = $favorites;
            return true;
        }
        if ($found > -1)
            return true;
        else
            return false;
    }

    static function bookRestrictions(eclEngine_page $page, array $book, bool $downloadEnabled = false): string
    {
        $restrictions = self::userRestrictions($page);

        if (isset($restrictions['kid']) and $book['adult'])
            return 'Este livro possui conteúdo adulto. Apenas leitores cadastrados com mais de 18 anos podem ter acesso a seu conteúdo.';

        if (isset($restrictions['public']) and !$book['public'])
            return 'Este livro está protegido por direitos autorais. Somente leitores cadastrados podem ter acesso a seu conteúdo.';

        if (isset($restrictions['unverified']) and $downloadEnabled)
            return 'Somente leitores verificados podem baixar os livros.';

        return '';
    }

    static function userRestrictions(eclEngine_page $page): array
    {
        if (!isset($page->session['user']['name']))
            return [
                'kid' => true,
                'public' => true,
                'unverified' => true
            ];

        $user = $page->session['user'];
        if ($user['name'] == ADMIN_NAME)
            return [];

        $restrictions = [];

        if (isset($user['kid']) and $user['kid'])
            $restrictions['kid'] = true;

        if (!isset($user['verified']) || $user['verified'] != 4)
            $restrictions['unverified'] = true;

        return $restrictions;
    }

}
