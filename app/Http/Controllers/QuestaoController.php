<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class QuestaoController extends Controller
{
    /**
     * Construtor responsável por verificar se o usuário está logado,
     * permitindo ou não o acesso à rota.
     */
    public function __construct()
    {
        //$this->middleware('auth');
    }

    /**
     * Função que redireciona para a url correta.
     * Utilizada quando a rota é acessada por um método GET.
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function index()
    {
        return redirect('/#!questoes');
    }

    /**
     * Função que inicializa a página de questões
     *
     * @param Request $request
     * @return array
     */
    public function question(Request $request)
    {
        try {
            /* Verifica a entrada de dados */
            //if ($request->json('id') == "" || $request->json('topic_id') == "") {
                //throw new \Exception('Valor inválido.');
            //}

            /* Verifica se o usuário informado está logado */
            //if ($request->json('id') != Auth::id() || Auth::id() == null) {
                //throw new \Exception('É necessário estar logado para acessar essa página.');
            //}

            $jsonId = 1; //$request->json('id')
            $jsonTopicId = 1; //$request->json('topic_id')

            //

            return [
                'codigo' => 'success',
                'objeto' => [
                    'codigoTipoAlternativa' => null, //'1' ou '2' = 1 para se é alternativa, 2 se é fluxograma
                    'questao' => [
                        'codigoQuestao' => null,
                        'conteudoQuestao' => null,
                        'alternativas' => [
                            [
                                'cdAlternativa' => null,
                                'conteudoAlternativa' => null,
                            ],
                        ],
                    ],
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
