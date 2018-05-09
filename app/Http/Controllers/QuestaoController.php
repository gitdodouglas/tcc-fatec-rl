<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class QuestaoController extends Controller
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
                $questions = $topicController->getQuestions($userPerformance->topic_id);

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
                        'nomeTopico' => $userTopic->topic,
                        'questoesResolvidas' => ($questions_answered + 1).'/'.$userTopic->quantity_questions,
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
                throw new \Exception('Valor inválido.');
        }

            /* Verifica se o usuário informado está logado */
            if ($request->json('id') != Auth::id() || Auth::id() == null) {
                throw new \Exception('É necessário estar logado para acessar essa página.');
            }

            /* Variáveis auxiliares */
            $status = 0; $desbloqueio = 0; $mensagem = ''; $mensagemDesbloq = ''; $resposta = '';
            /* ------------------------------------------------- */


            /**
             * Análise da resposta
             */
            /* Instancia o controller de Alternativas */
            $alternativeController = new AlternativeController;

            /* Recupera a alternativa escolhida */
            $alternative = $alternativeController->read($request->json('alternative_id'));

            /* Recupera a ID da questão através da ID da alternativa */
            $questionId = $alternativeController->getQuestion($request->json('alternative_id'));

            /* Instancia o controller de desempenho do tópico */
            $performanceController = new PerformanceController;

            /* Realiza a busca do desempenho do usuário */
            $userPerformance = $performanceController->query('user_id', $request->json('id'));

            /* Recupera a questão respondida dentro do desempenho de questões pertencentes ao usuário */
            $questionUser = $performanceController->getPerformanceQuestions($userPerformance->id)->where('question_id', $questionId->id)->first();

            /* Instancia o controller de desempenho de questões */
            $performanceQuestionController = new PerformanceQuestionController;

            /* Recupera o desempenho da questão escolhida */
            $performanceQuestion = $performanceQuestionController->read($questionUser->id);

            /* Avalia a resposta dada */
            switch ($alternative->right_answer)
            {
                /**
                 * Resposta correta
                 */
                case 'sim' :
                {
                    /* Altera o desempenho da questão */
                    $performanceQuestion->question_answered = 'sim';
                    $performanceQuestion->answered_correctly = 'sim';
                    $performanceQuestion->save();

                    /* Feedback para o usuário */
                    //$status = 1; $mensagem = 'Resposta correta. Parabéns, continue assim!';
                    $status = 1; $mensagem = 'Resposta certa!';

                    break;
                }

                /**
                 * Resposta errada
                 */
                case 'nao' :
                {
                    /* Altera o desempenho da questão */
                    $performanceQuestion->question_answered = 'sim';
                    $performanceQuestion->answered_correctly = 'nao';
                    $performanceQuestion->save();

                    /* Instancia o controller de questões */
                    $questionController = new QuestionController;

                    /* Recupera a resposta correta da questão */
                    $respostaCorreta = $questionController->getAlternatives($questionId->id)->where('right_answer', 'sim')[0]->alternative;

                    /* Feedback para o usuário */
                    //$mensagem = 'Resposta certa: ' . $respostaCorreta;
                    $status = 2; $mensagem = 'Resposta errada!'; $resposta = $respostaCorreta;

                    break;
                }
            }


            /**
             * Análise do progresso
             */
            /* Conta quantas questões estão cadastradas */
            $totalQuestoes = $performanceController->getPerformanceQuestions($userPerformance->id)->count();

            /* Conta quantas questões foram respondidas */
            $totalQuestoesRespondidas = $performanceController->getPerformanceQuestions($userPerformance->id)->where('question_answered', 'sim')->count();

            /* Conta quantas questões foram respondidas corretamente */
            $totalQuestoesCorretas = $performanceController->getPerformanceQuestions($userPerformance->id)->where('answered_correctly', 'sim')->count();

            /* Se a última questão foi respondida */
            if ($totalQuestoesRespondidas == $totalQuestoes) {


                /* Se o aproveitamento for maior ou igual a 60% */
                if ( ceil(($totalQuestoesCorretas/$totalQuestoes) * 100) >= 60 ) {

                    /* Instancia o controller de tópicos */
                    $topicController = new TopicController;

                    /* Recupera a ID do nível atual */
                    $levelId = $topicController->getLevel($userPerformance->topic_id)->id;

                    /* Recupera o número de sequência do tópico atual */
                    $seqTopico = $topicController->read($userPerformance->topic_id)->number_sequence;

                    /* Instancia o controller de níveis */
                    $levelController = new LevelController;

                    /* Conta quantos tópicos existem cadastrados no nível */
                    $totalTopicos = $levelController->getTopics($levelId)->count();

                    /* Se o número de sequência do tópico não for o último, desbloqueia o próximo tópico */
                    if ($seqTopico != $totalTopicos) {
                        $userPerformance->topic_id = $topicController->query('number_sequence', $seqTopico + 1)->id;
                        $userPerformance->save();
                        DB::table('performance_questions')->where('performance_id', $userPerformance->id)->delete();
                        $desbloqueio = 1; $mensagemDesbloq = 'Parabéns, você desbloqueou o próximo tópico!';
                    }
                    /* Senão, desbloqueia o próximo nível */
                    else {
                        $userPerformance->topic_id = $levelController->getTopics( (($levelId + 1) < 3 ? ($levelId + 1) : 3) )[0]->id;
                        $userPerformance->save();
                        DB::table('performance_questions')->where('performance_id', $userPerformance->id)->delete();
                        $desbloqueio = 2; $mensagemDesbloq = 'Parabéns, você desbloqueou o próximo nível!';
                    }

                }
                /* Senão */
                else {
                    DB::table('performance_questions')->where('performance_id', $userPerformance->id)->delete();
                    $desbloqueio = 3; $mensagemDesbloq = 'Recomendamos que reveja o conteúdo teórico para poder prosseguir.';
                }


            }
            
            /* Instancia um novo controller de tópicos */
            $newTopicController = new TopicController;
            
            /* Recupera novamente a ID do nível atual */
            $newLevelId = $newTopicController->getLevel($userPerformance->topic_id)->id;
            
            /* Recupera a ID do tópico atual */
            $topicoId = $userPerformance->topic_id;
            
            /* Devolve a ID do próximo tópico */
            $proxTopico = ($topicoId + 1);
            
            /* Devolve a ID do próximo nível */
            $proxNivel = ($newLevelId + 1);

            return [
                'codigo' => 'success',
                'objeto' => [
                    'resposta' => [
                        'cdStatus' => $status,
                        'respCorreta' => $resposta,
                        'cdDesbloqueio' => $desbloqueio,
                        'msgDesbloqueio' => $mensagemDesbloq,
                        'proxTopico' => $proxTopico,
                        'proxNivel' => $proxNivel,
                    ],
                ],
                'mensagem' => $mensagem,
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
