<?php

class eclMod_bookstore_modLevelUp extends eclMod
{
    public string $url;
    public array | string $label;
    public bool $showModule = false;

    public function connectedCallback(): void
    {
        $parent = $this->page->application->parent;
        if ($parent->applicationName === 'bookstore')
            return;

        $this->url = $this->page->url($parent->path);
        $this->label = $parent->data['text']['title'] ?? 'um nível acima';
        $this->showModule = true;

    }

}
