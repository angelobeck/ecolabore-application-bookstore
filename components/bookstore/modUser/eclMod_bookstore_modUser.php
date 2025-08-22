<?php

class eclMod_bookstore_modUser extends eclMod
{
    public string $login_url = '';
    public string $subscribe_url = '';
    public string $profile_url = '';
    public string $logout_url = '';
    public bool $isConnected = false;

    public function connectedCallback(): void
    {
        $page = $this->page;
        if (isset($page->session['user']['name'])) {
            $this->isConnected = true;
$this->profile_url = $page->url([$page->domain->name, 'estante', 'perfil']);
$this->logout_url = $page->url(true, true, '_logout');
        } else {
            $this->login_url = $page->url([...$page->application->path, '-login']);
            $this->subscribe_url = $page->url([$page->domain->name, 'cadastrar']);
        }
    }

}
