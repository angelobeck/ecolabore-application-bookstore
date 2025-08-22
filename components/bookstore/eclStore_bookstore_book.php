<?php

class eclStore_bookstore_book extends eclStore
{

    public string $name = 'bookstore_book';

    const MODE_GENRE = 1;
    const MODE_AUTHOR = 2;
    const MODE_COLLECTION = 3;
    const MODE_BOOK = 4;
    const MODE_NARRATOR = 5;

    public array $fields = [
        // Indexing
        'id' => 'primary_key',
        'mode' => 'int/1',
        'name' => 'name/40',
        // categories
        'genre_name' => 'name/40',
        'author_name' => 'name/40',
        'collection_name' => 'name/40',
        'narrator_name' => 'name/40',
        // formats
        'format_braille' => 'int/1',
        'format_ink' => 'int/1',
        'format_digital' => 'int/1',
        'format_audio' => 'int/1',
        // Dates
        'created' => 'time',
        'updated' => 'time',
        'lastRead' => 'time',
        'lastComment' => 'time',
        // More sort options
        'hits' => 'int/4',
        'stars' => 'int/1',
        'spotlight' => 'int/1',
        'kids' => 'int/1',
        'adult' => 'int/1',
        'public' => 'int/1',
        // Contents
        'text' => 'array',
        'details' => 'array',
        'extras' => 'array',
        'files' => 'array',
        'keywords' => 'keywords'
    ];

    private array $rows = [];
    private array $originalRows = [];
    private array $deletedRows = [];
    private $indexByName = [];
    private array $notFound = [];
    private eclIo_database $database;

    public array $lastInsertedData = [];

    public function __construct()
    {
        global $io;
        if ($io->database->tableEnabled($this))
            $this->database = $io->database;
    }

    public function indexFoundRows($rows)
    {
        $found = [];
        foreach ($rows as $data) {
            if ($data['name'][0] == ':')
                continue;

            $id = $data['id'];
            if (isset($this->deletedRows[$id]))
                continue;

            if (!isset($this->rows[$id])) {
                $this->rows[$id] = $data;
                $this->originalRows[$id] = $data;
                $this->indexByName[$data['name']] = $id;
                $found[] = $data;
            } else
                $found[] = $this->rows[$id];
        }
        return $found;
    }

    public function insert(&$data)
    {
        if (!$this->database)
            return 0;

        $id = $this->database->insert($this, $data);
        $data['id'] = $id;
        $this->rows[$id] = $data;
        $this->originalRows[$id] = $data;
        $this->indexByName[$data['name']] = $id;
        $this->lastInsertedData = $data;
        return $id;
    }

    public function &open($name)
    {
        $found = [];
        if (isset($this->notFound[$name])) {
            return $found;
        }

        if (!isset($this->indexByName[$name])) {
            $this->indexFoundRows($this->database->select($this, ['name' => $name], 1));
        }

        if (!isset($this->indexByName[$name])) {
            $this->notFound[$name] = true;
            return $found;
        }

        $id = $this->indexByName[$name];
        $found = &$this->rows[$id];
        return $found;
    }

    public function &openById($id)
    {
        if (!isset($this->rows[$id])) {
            $this->indexFoundRows($this->database->select($this, ['id' => $id]));
        }

        $found = [];
        if (isset($this->rows[$id])) {
            $found = &$this->rows[$id];
        }
        return $found;
    }

    public function search($where, $max = 0, $offset = 0, $sort = 'name', $direction = 'asc')
    {
        $rows = $this->indexFoundRows($this->database->select($this, $where));

        if ($rows) {
            $sorted = [];
            foreach ($rows as $row) {
                $sorted[$row[$sort]][] = $row;
            }

            if ($direction == 'desc')
                krsort($sorted);
            else
                ksort($sorted);

            if ($max == 0)
                $max = count($rows);
            else
                $max += $offset;

            $list = [];
            $i = -1;
            foreach ($sorted as $doubled) {
                foreach ($doubled as $item) {
                    $i++;
                    if ($i >= $offset and $i < $max)
                        $list[] = $item;
                    elseif ($i > $max)
                        break 2;
                }
            }

            return $list;
        }
        return [];
    }

    public function delete($id)
    {
        if (defined('TRACKING_REMOVED_PAGES') and TRACKING_REMOVED_PAGES) {
            $data = &$this->openById($id);
            if (strlen($data['name']) == 32)
                $data['name'] = substr($data['name'], -2);
            $data['name'] = ':' . $data['name'];
            return;
        }

        if (isset($this->rows[$id])) {
            $data = $this->rows[$id];
            $this->deletedRows[$id] = $id;
            $this->rows[$id] = [];
            unset($this->originalRows[$id]);
            unset($this->indexByName[$data['name']]);
        }

        $this->database->delete($this, ['id' => $id]);
    }

    public function close()
    {
        foreach ($this->originalRows as $id => $originalRow) {
            if ($this->rows[$id] != $originalRow) {
                $this->database->update($this, $this->rows[$id], $originalRow);
            }
        }

        $this->indexByName = [];
        $this->rows = [];
        $this->originalRows = [];
        $this->deletedRows = [];
        $this->notFound = [];
    }

}
