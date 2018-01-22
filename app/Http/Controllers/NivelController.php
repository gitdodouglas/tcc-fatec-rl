<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NivelController extends Controller
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
     * Função que inicializa a página de níveis
     *
     * @param Request $request
     * @return array
     */
    public function level(Request $request)
    {
        try {
            /* Verifica a entrada de dados */
            if ($request->json('id') == "") {
                throw new \Exception('Valor inválido.');
            }

            /* Verifica se o usuário informado está logado */
            if ($request->json('id') != Auth::id() || Auth::id() == null) {
                throw new \Exception('É necessário estar logado para acessar essa página.');
            }

            /* Variáveis que armazenam os resultados dos cáculos e os status dos níveis */
            $porcentBasico = 0; $estadoBasico = 1;
            $porcentInter = 0; $estadoInter = 0;
            $porcentAvanc = 0; $estadoAvanc = 0;
            /* ------------------------------------------------- */

            /* Instancia o controller de desempenho do tópico */
            $performanceController = new PerformanceController;

            /* Realiza a busca do desempenho do usuário */
            $userPerformance = $performanceController->query('user_id', $request->json('id'));

            /* Instancia o controller de tópico */
            $topicController = new TopicController;

            /* Realiza a busca do tópico */
            $userTopic = $topicController->query('id', $userPerformance->topic_id);

            /* Define o nível em que o usuário está */
            $userLevel = $userTopic->level_id;

            /* Instancia o controller de níveis */
            $levelController = new LevelController;

            /* Recupera todos os tópicos pertencentes ao nível */
            $collection = $levelController->getTopics($userLevel);

            /* Conta quantos tópicos existem no nível */
            $totalTopicos = $collection->count();

            /* Realiza as atribuições com base no nível em que o usuário está */
            switch ($userLevel)
            {
                /**
                 * Nível básico
                 */
                case 1 :
                {
                    /* Calcula a porcentagem do progresso do usuário neste nível */
                    $porcentBasico = ceil((($userTopic->number_sequence - 1) / $totalTopicos) * 100);

                    break;
                }

                /**
                 * Nível intermediário
                 */
                case 2 :
                {
                    /* Completa o nível básico; Libera o nível intermediário */
                    $porcentBasico = 100; $estadoInter = 1;

                    /* Calcula a quantidade de tópicos do nível básico */
                    $totalTopicosBasico = $levelController->getTopics(1)->count();

                    /* Calcula a porcentagem do progresso do usuário neste nível */
                    $porcentInter = ceil((($userTopic->number_sequence - $totalTopicosBasico - 1) / $totalTopicos) * 100);

                    break;
                }

                /**
                 * Nível avançado
                 */
                case 3 :
                {
                    /* Completa o nível básico e intermediário; Libera o nível intermediário e avançado */
                    $porcentBasico = 100; $porcentInter = 100;
                    $estadoInter = 1; $estadoAvanc = 1;

                    /* Calcula a quantidade de tópicos do nível básico */
                    $totalTopicosBasico = $levelController->getTopics(1)->count();

                    /* Calcula a quantidade de tópicos do nível intermediário */
                    $totalTopicosInter = $levelController->getTopics(2)->count();

                    /* Calcula a porcentagem do progresso do usuário neste nível */
                    $porcentAvanc = ceil((($userTopic->number_sequence - ($totalTopicosBasico + $totalTopicosInter) - 1) / $totalTopicos) * 100);

                    break;
                }

                /**
                 * Default
                 */
                default :
                {
                    /* Completa o nível básico, intermediário e avançado; Libera todos os níveis */
                    $porcentBasico = 100; $porcentInter = 100; $porcentAvanc = 100;
                    $estadoInter = 1; $estadoAvanc = 1;

                    break;
                }
            }

            return [
                'codigo' => 'success',
                'objeto' => [
                    'niveis' => [
                        'basico' => [
                            'codigoNivel' => 1,
                            'porcentagem' => $porcentBasico,
                            'tipoEstado' => $estadoBasico,
                        ],
                        'intermediario' => [
                            'codigoNivel' => 2,
                            'porcentagem' => $porcentInter,
                            'tipoEstado' => $estadoInter,
                        ],
                        'avancado' => [
                            'codigoNivel' => 3,
                            'porcentagem' => $porcentAvanc,
                            'tipoEstado' => $estadoAvanc,
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
