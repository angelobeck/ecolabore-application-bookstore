<?php

class eclEndpoint_bookstoreAdminLivros_generosCadastrar extends eclEndpoint
{

    public function dispatch(array $input): array
    {
        global $store;
        $names = 'Adriano Pellegrini & Deborah Bapt
Alexandre
Aline Bei
Aline Macedo
Aline Penteado
Ana Claudia Quintana Arantes
Ana Maria Morais
Andrea Suhett
Andressa Bodê
Antônio Gonzales
Any Carvalho & Dayse Richffer
Arnaldo Santini
Audren de Azevedo
Beth Goulart
Bruna Castiel e Yuri Magalhães
Caio Passos & Dri Chiovatto
Carlos Campanili
Carlos Sobrinho
Carlos Viegas
Carol Duarte
Carol Leipelt
Claudia Ventura
Cláudia Ricart
Daniel Farias
Dayse Richffer
Deborah Bapt
Diego Muras
Elina de Souza
Erika Riba
Eugênio Dale
Felipe de Barros
Fernanda
Fernanda Gabriela Pires Soares Pinto
Francisco Bretas
Fritz Gianvito
Genésio de Barros
Gisele Toledo
Graça Cunha
Gustavo Falcão
Hector Gomes
Ingo Ostrovsky
Isabel Guéron
Isabella Saes
Itamar Vieira Júnior
Ivan Velame
Jeferson Tenório
Joana Caetano
João Silvério Trevisan
Juliana Araújo
Juliana Birchal
Liana Monteiro
Lola Belli
Luanna Rocha
Luciana Caruso
Luciane Romanovski
Luciane Romanovski & Roberto Garcia
Lucianna Mauren
Luciano Gatti
Maitê Proença
Maju Coutinho
Marcelo Klein
Marcelo Sanches
Marcus Vinnicius Moreno
Marina Mota
Martha Mellinger
Michelle Bruck
Milton Hatoum, Adriana Ferreira, Roms Ferreira, Graça Cunha e Victor Bittow
Nilcéia Parizze
Nizo Neto
Odilon Esteves
Patricia Ferrer
Patt Souza
Paula Calaes
Paulo Betti
Paulo Vinicius Justo Fernandes
Rafa Canedo
Rafael Cortez
Rennata Airoldi
Roberto Barcellos
Roberto Garcia
Simone Centurione, Silvia Salgado e Carlos Poli
Siro Sales
Spencer Toth
Sérgio Medeiros
Tarsila Amorim
Tati Pasquali
Tiago Torres
Victoria Blat
Victoria Blat & Luiza Tiso
Zezé Motta';

foreach(explode(CRLF, $names) as $title) {
    $name = eclIo_convert::slug($title);

    $data = [
        'name' => $name,
        'mode' => eclStore_bookstore_book::MODE_NARRATOR,
        'text' => ['title' => ['pt' => ['value' => $title]]]
    ];
    $store->bookstore_book->insert($data);
}


        return [
            'response' => [
                'message' => 'Inserindo dados',
            ]
        ];
    }

}
