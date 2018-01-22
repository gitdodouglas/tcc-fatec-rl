<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TopicoController extends Controller
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
     * Função que inicializa a página de tópicos
     *
     * @param Request $request
     * @return array
     */
    public function topic(Request $request)
    {
        try {
            /* Verifica a entrada de dados */
            if ($request->json('id') == "" || $request->json('level_id') == "") {
                throw new \Exception('Valor inválido.');
            }

            /* Verifica se o usuário informado está logado */
            if ($request->json('id') != Auth::id() || Auth::id() == null) {
                throw new \Exception('É necessário estar logado para acessar essa página.');
            }

            /* Instancia o controller de níveis */
            $levelController = new LevelController;

            /* Recupera todos os tópicos pertencentes ao nível */
            $collection = $levelController->getTopics($request->json('level_id'));

            /* Instancia o controller de desempenho do tópico */
            $performanceController = new PerformanceController;

            /* Realiza a busca do desempenho do tópico */
            $userPerformance = $performanceController->query('user_id', $request->json('id'));

            /* Instancia o controller de tópicos */
            $topicController = new TopicController;

            /* Recupera o tópico em que o usuário está */
            $userTopic = $topicController->read($userPerformance->topic_id);

            /* Recupera todos os desempenhos de questões pertencentes ao usuário */
            $performanceQuestions = $performanceController->getPerformanceQuestions($userPerformance->id);

            /* Conta quantas questões foram respondidas */
            $questions_answered = $performanceQuestions->where('question_answered', 'sim')->count();

            /* Mapeia cada item da coleção (realiza as operações sobre cada tópico) */
            $collection->map(function($topic) use($userTopic, $questions_answered) {
                $topic['codigoTopico'] = $topic->id;
                $topic['nomeTopico'] = $topic->topic;
                if ($topic['number_sequence'] < $userTopic->number_sequence) {
                    $topic['questoesResolvidas'] = $topic->quantity_questions.'/'.$topic->quantity_questions;
                } else if ($topic['number_sequence'] == $userTopic->number_sequence) {
                    $topic['questoesResolvidas'] = $questions_answered.'/'.$topic->quantity_questions;
                } else {
                    $topic['questoesResolvidas'] = '0'.'/'.$topic->quantity_questions;
                }
                $topic['tipoEstado'] = $topic['number_sequence'] <= $userTopic->number_sequence && $topic->level_id <= $userTopic->level_id ? 1 : 0;
                $topic['topicoAtivo'] = $topic->id == $userTopic->id ? 1 : 0;
                array_except($topic, ['id', 'topic', 'description', 'number_sequence', 'quantity_questions', 'level_id', 'created_at', 'updated_at']);
            });

            return [
                'codigo' => 'success',
                'objeto' => [
                    'topicos' => $collection,
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
