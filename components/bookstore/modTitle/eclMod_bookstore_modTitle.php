<?php

class eclMod_bookstore_modTitle extends eclMod
{
    public array|string $title;

    public function connectedCallback(): void
    {
        $this->title = $this->page->application->data['text']['title'] ?? $this->page->application->name;
    }
}
