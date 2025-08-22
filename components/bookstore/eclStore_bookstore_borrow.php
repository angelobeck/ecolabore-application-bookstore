<?php

class eclStore_bookstore_borrow extends eclStore
{

    public string $name = 'bookstore_borrow';

    public array $fields = [
        // Indexing
        'id' => 'primary_key',
        'user_id' => 'int/4',
        'book_id' => 'int/4',
        'status' => 'int/1',
        // Dates
        'borrow' => 'time',
        'promise' => 'time',
        'return' => 'time',
        'lastContact' => 'time'
    ];

    private array $rows = [];
    private array $originalRows = [];
    private array $deletedRows = [];
    private eclIo_database $database;

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
            $id = $data['id'];
            if (isset($this->deletedRows[$id]))
                continue;

            if (!isset($this->rows[$id])) {
                $this->rows[$id] = $data;
                $this->originalRows[$id] = $data;
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
        $this->lastInsertedData = $data;
        return $id;
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

    public function delete($id)
    {
        if (isset($this->rows[$id])) {
            $data = $this->rows[$id];
            $this->deletedRows[$id] = $id;
            $this->rows[$id] = [];
            unset($this->originalRows[$id]);
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

        $this->rows = [];
        $this->originalRows = [];
        $this->deletedRows = [];
    }

}
