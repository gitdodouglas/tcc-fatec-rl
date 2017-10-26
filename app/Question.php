<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    /**
     * Atributos que podem ser atribuídos em massa.
     *
     * @var array
     */
    protected $fillable = [
        'question',
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
     * Função que retorna o tópico relacionado à questão.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function topic()
    {
        return $this->belongsTo(Topic::class);
    }

    /**
     * Relação um-para-muitos.
     * Função que retorna as alternativas relacionadas à questão.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function alternatives()
    {
        return $this->hasMany(Alternative::class);
    }

    /**
     * Relação um-para-muitos.
     * Função que retorna os desempenhos relacionados à questão.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function performanceQuestions()
    {
        return $this->hasMany(PerformanceQuestion::class);
    }
}
