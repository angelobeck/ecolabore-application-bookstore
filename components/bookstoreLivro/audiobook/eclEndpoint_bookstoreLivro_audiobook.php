<?php

class eclEndpoint_bookstoreLivro_audiobook extends eclEndpoint
{

    public function dispatch(array $input): array
    {
        global $io, $store;
        $name = $this->page->application->parent->name;

        $url = AWS_BUCKET . $name . '.mp3';
        return $this->response(['url' => $url]);
    }

}
