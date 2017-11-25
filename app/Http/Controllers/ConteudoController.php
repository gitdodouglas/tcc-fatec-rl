<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ConteudoController extends Controller
{
    /**
     * Construtor responsável por verificar se o usuário está logado,
     * permitindo ou não o acesso à rota.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Função que redireciona para a url correta.
     * Utilizada quando a rota é acessada por um método GET.
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function index()
    {
        return redirect('/#!principal');
    }

    /**
     * Função que inicializa a página de conteúdo
     *
     * @param Request $request
     * @return array
     */
    public function content(Request $request)
    {
        try {
            /* Verifica a entrada de dados */
            if ($request->json('id') == "" || $request->json('topic_id') == "") {
                throw new \Exception('Valor inválido.');
            }

            /* Verifica se o usuário informado está logado */
            if ($request->json('id') != Auth::id() || Auth::id() == null) {
                throw new \Exception('É necessário estar logado para acessar essa página.');
            }

            /* Instancia o controller de tópicos */
            $topicController = new TopicController;

            /* Recupera o conteúdo do topico em que o usuário está */
            $content = $topicController->getContents($request->json('topic_id'));

            return [
                'codigo' => 'success',
                'objeto' => [
                    'conteudo' => $content[0]->content,
                ],
                'mensagem' => null,
            ];
        } catch (\Exception $exception) {
            return [
                'codigo' => 'error',
                'objeto' => null,
                'mensagem' => $exception->getMessage(),
            ];
        }
    }
}
