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
        return redirect('/#!principal');
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
            if ($request->json('id') == "" || $request->json('topic_id') == "") {
                throw new \Exception('Valor inválido.');
            }

            /* Verifica se o usuário informado está logado */
            if ($request->json('id') != Auth::id() || Auth::id() == null) {
                throw new \Exception('É necessário estar logado para acessar essa página.');
            }

            /* Instancia o controller de desempenho do tópico */
            $performanceController = new PerformanceController;

            /* Realiza a busca do desempenho do usuário */
            $userPerformance = $performanceController->query('user_id', $request->json('id'));

            /* Recupera todos os desempenhos de questões pertencentes ao usuário */
            $performanceQuestions = $performanceController->getPerformanceQuestions($userPerformance->id);

            /* Conta quantas questões existem cadastradas no desempenho de questão do usuário */
            $totalQuestions = $performanceQuestions->count();

            /* Instancia o controller de desempenho de questões */
            $performanceQuestionController = new PerformanceQuestionController;

            /* Instancia o controller de tópicos */
            $topicController = new TopicController;

            /* Recupera o tópico em que o usuário está */
            $userTopic = $topicController->read($request->json('topic_id'));


            /**
             * Se não existirem questões cadastradas
             */
            if ($totalQuestions == 0) {
                /* Recupera todas as questões do tópico */
                $questions = $topicController->getQuestions($userTopic->id);

                /* Sorteia as questões, selecionando a quantidade determinada no tópico */
                $questions = $questions->shuffle()->take($userTopic->quantity_questions);

                /* Alimenta (cadastra) a tabela de desempenho de questões com as questões sorteadas */
                for ($i = 0; $i < $userTopic->quantity_questions; $i++) {
                    $performanceQuestionController->create($userPerformance->id, $questions[$i]->id);
                }
            }


            /**
             * Seleciona a questão e as alternativas
             */
            /* Recupera a primeira questão não respondida. Caso todas já tenham sido respondidas, armazena o valor 0 */
            $question = $performanceQuestions->where('question_answered', 'nao')->first();

            /* Se há questão não respondida */
            if ($question) {
                /* Instancia o controller de questões */
                $questionController = new QuestionController;

                /* Recupera todas as alternativas da questão */
                $alternatives = $questionController->getAlternatives($question->question_id);

                /* Randomiza as alternativas */
                $alternatives = $alternatives->shuffle();

                /* Mapeia cada item da coleção (realiza as operações sobre as alternativas) */
                $alternatives->map(function ($alternative) {
                    $alternative['cdAlternativa'] = $alternative->id;
                    $alternative['conteudoAlternativa'] = $alternative->alternative;
                    array_except($alternative, ['id', 'alternative', 'question_id', 'created_at', 'updated_at']);
                });

                /* Conta quantas questões foram respondidas */
                $questions_answered = $performanceQuestions->where('question_answered', 'sim')->count();

                return [
                    'codigo' => 'success',
                    'objeto' => [
                        'questoesResolvidas' => $questions_answered.'/'.$userTopic->quantity_questions,
                        'questao' => [
                            'codigoQuestao' => $question->question_id,
                            'conteudoQuestao' => $question->question->question,
                            'alternativas' => $alternatives,
                        ],
                    ],
                    'mensagem' => null,
                ];
            }

            /* Senão */
            else {
                return [
                    'codigo' => 'success',
                    'objeto' => null,
                    'mensagem' => null,
                ];
            }
        } catch (\Exception $exception) {
            return [
                'codigo' => 'error',
                'objeto' => null,
                'mensagem' => $exception->getMessage(),
            ];
        }
    }

    /**
     * Função que avalia a resposta dada
     *
     * @param Request $request
     * @return array
     */
    public function check(Request $request)
    {
        try {
            /* Verifica a entrada de dados */
            if ($request->json('id') == "" || $request->json('alternative_id') == "") {
                //throw new \Exception('Valor inválido.');
        }

            /* Verifica se o usuário informado está logado */
            if ($request->json('id') != Auth::id() || Auth::id() == null) {
                //throw new \Exception('É necessário estar logado para acessar essa página.');
            }

            $jsonId = 1;
            $jsonAlternativeId = 1;

            /**/
            $alternativeController = new AlternativeController;

            /**/
            //$alternative = $alternativeController->read($request->json('alternative_id'));
            $alternative = $alternativeController->read($jsonAlternativeId);

            /**/
            switch ($alternative->right_answer)
            {
                /**
                 * //
                 */
                case 'sim' :
                {
                    return 'Resposta certa';
                    break;
                }

                /**
                 * //
                 */
                case 'nao' :
                {
                    return 'Resposta errada';
                    break;
                }
            }

            /*
            return [
                'codigo' => 'success',
                'objeto' => null,
                'mensagem' => null,
            ];
            */
        } catch (\Exception $exception) {
            return [
                'codigo' => 'error',
                'objeto' => null,
                'mensagem' => $exception->getMessage(),
            ];
        }
    }
}
