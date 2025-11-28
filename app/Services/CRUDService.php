<?php

namespace App\Services;

use App\Models;
use Exception;

class CRUDService
{
    public function getCategorias()
    {
        return Models\Categoria::all();
    }

    public function getCategoriaBySlug($slug)
    {
        return Models\Categoria::where("slug", $slug)->firstOrFail();
    }

    public function getByBanca(int $bancaId) 
    {
        return Models\Produto::where('banca_id', $bancaId)->get();
    }

    public function createProduto(array $data)
    {
        return Models\Produto::create([
            'banca_id'      => $data['banca_id'],
            'nome'          => $data['nome'],
            'descricao'     => $data['descricao'],
            'imagem_url'    => $data['imagem_url'],
            'preco'         => $data['preco']
        ]);
    }

    public function getBancasUsuario(int $user_id) 
    {
        return Models\Banca::where('user_id', $user_id)->get();
    }

    public function getBancaById(int $id) 
    {
        return Models\Banca::find($id);
    }

    public function getBancaBySlug(string $slug) 
    {
        return Models\Banca::where('slug', $slug)->firstOrFail();
    }

    public function getBancasByCategoria(int $categoriaId) 
    {
        return Models\Banca::where('categoria_id', $categoriaId)->get();
    }

    public function createBanca(array $data)
    {
        return Models\Banca::create([
            'user_id'       => $data['user_id'],
            'categoria_id'  => $data['categoria_id'],
            'nome_fantasia' => $data['nome_fantasia'],
            'foto_url'      => $data['foto_url'],
            'descricao'     => $data['descricao'],
            'endereco'      => $data['endereco'],
            'telefone'      => $data['telefone'],
            'instagram'     => $data['instagram'],
            'bairro'        => $data['bairro'],
            'cidade'        => $data['cidade'],
            'numero'        => $data['numero']
        ]);
    }

    public function createEvento(array $data)
    {
        return Models\Evento::create([
            'titulo'    => $data['titulo'],
            'inicio'    => $data['inicio'],
            'fim'       => $data['fim'],
            'descricao' => $data['descricao'],
            'status'    => $data['status'],
            'user_id'   => $data['user_id'],
            'rua'       => $data['rua'],
            'numero'    => $data['numero'],
            'bairro'    => $data['bairro'],
            'cidade'    => $data['cidade'],
            'uf'        => $data['uf'],
            'cep'       => $data['cep'],
            'latitude'  => $data['latitude'],
            'longitude' => $data['longitude'],
        ]);
    }

    public function atualizarEvento(int $id, array $data)
    {
        $evento = Models\Evento::findOrFail($id);

        $evento->update([
            'titulo'    => $data['titulo'],
            'inicio'    => $data['inicio'],
            'fim'       => $data['fim'],
            'descricao' => $data['descricao'],
            'rua'       => $data['rua'],
            'numero'    => $data['numero'],
            'bairro'    => $data['bairro'],
            'cidade'    => $data['cidade'],
            'uf'        => $data['uf'],
            'cep'       => $data['cep'],
            'latitude'  => $data['latitude'],
            'longitude' => $data['longitude'],
        ]);

        return $evento->id;
    }


    public function getEventoById(int $id)
    {
        return Models\Evento::findOrFail($id);
    }

    public function getEventoBySlug(string $slug)
    {
        return Models\Evento::where('slug', $slug)->firstOrFail();
    }

    public function getEventosByUser(int $user_id)
    {
        return Models\Evento::where('user_id', $user_id)
            ->where('inicio', '>', now())
            ->get();
    }

    public function getProximosEventos($user_id)
    {
        return Models\Evento::where('inicio', '>', now())
            ->whereDoesntHave('participacoes', function($query) use ($user_id) {
                $query->where('user_id', $user_id);
            })
            ->orderBy('inicio', 'asc')
            ->get();
    }

    public function getEventosByLocalizacao($latitude, $longitude, $quantidade = 6) {
        return Models\Evento::selectRaw("
            eventos.*,
            ( 6371 * acos(
                cos( radians(?) ) *
                cos( radians(eventos.latitude) ) *
                cos( radians(eventos.longitude) - radians(?) ) +
                sin( radians(?) ) *
                sin( radians(eventos.latitude))
            )) AS distancia", 
            [
                $latitude, 
                $longitude, 
                $latitude
            ])
        ->orderBy('distancia', 'asc')
        ->paginate($quantidade);
    }

    public function getEventos($quantidade = 6)
    {
        return Models\Evento::where('inicio', '>', now())
            ->orderBy('inicio', 'asc')
            ->paginate($quantidade);
    }

    public function getMeusEventos($user_id)
    {
        return Models\Participacao::where('user_id', $user_id)
             ->whereHas('evento', function($query) {
                $query->where('inicio', '>', now());
            })
            ->with('evento')
            ->get()
            ->sortBy(function($participacao) {
                return $participacao->evento->inicio;
            });
    }

    public function createParticipacaoEvento($data) {
        
        $dataSave = [
            'user_id' => $data['user_id'],
            'evento_id' => $data['evento_id'],
        ];

        if (isset($data['bancas'])) {
            $dataSave['bancas'] = $data['bancas'];
        }

        return Models\Participacao::create($dataSave);
    }

    public function removerParticipacao($data) {
        $participacao = Models\Participacao::findOrFail($data['id']);

        if (empty($participacao)) {
            throw new Exception("Participação não encontrada");
        }

        if ($participacao->user_id <> $data['user_id']) {
            throw new Exception("Você não pode alterar a participação");
        }

        $participacao->delete();
    }

    public function getParticipacaoById($id) {
        return Models\Participacao::find($id);
    }

    public function getParticipacaoUsuarioEvento($user_id, $evento_id) {
        return Models\Participacao::where('user_id', $user_id)
            ->where('evento_id', $evento_id)
            ->first();
    }

    public function atualizarParticipacao(int $id, array $data)
    {
        $participacao = Models\Participacao::findOrFail($id);

        $participacao->update([
            'bancas' => $data["bancas"]
        ]);

        return $participacao->id;
    }

    public function deleteEvento($id) {
        $evento = Models\Evento::find($id);

        if (!$evento) {
            return false;
        }

        return $evento->delete();
    }

    public function createNotificacao($obj) {

        $dataSave = [
            'titulo' => 'Notificação Teste',
            'mensagem' => 'Teste',
            'banca_id' => null,
            'url' => '',
            'tipo' => 'teste',
            'evento_id' => null,
            'produto_id' => null
        ];

        return Models\Notificacao::create($dataSave);
    }

    public function getNotificacoesNaoLidas($idsLidas)
    {
        $query = Models\Notificacao::orderBy('id', 'desc');

        if (!empty($idsLidas)) {
            $query->whereNotIn('id', $idsLidas);
        }

        return $query->get();
    }
}