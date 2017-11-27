<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PerformanceQuestion extends Model
{
    /**
     * Atributos que podem ser atribuídos em massa.
     *
     * @var array
     */
    protected $fillable = [
        'question_answered', 'answered_correctly',
    ];

    /**
     * Atributos que NÃO podem ser atribuídos em massa.
     *
     * @var array
     */
    protected $guarded = [
        'id', 'created_at', 'updated_at',
    ];

    /**
     * Relação um-para-um.
     * Função que retorna o desempenho do tópico relacionado ao desempenho das questões.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function performance()
    {
        return $this->belongsTo(Performance::class);
    }

    /**
     * Relação um-para-um.
     * Função que retorna questão relacionada ao desempenho das questões.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function question()
    {
        return $this->belongsTo(Question::class);
    }
}
