<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Performance extends Model
{
    /**
     * Atributos que podem ser atribuídos em massa.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'user_email', 'topic_id', 'status_performance_id',
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
     * Função que retorna o estado de desempenho relacionado ao desempenho do tópico.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function statusPerformance()
    {
        return $this->belongsTo(StatusPerformance::class);
    }

    /**
     * Relação um-para-um.
     * Função que retorna o tópico relacionado ao desempenho do tópico.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function topic()
    {
        return $this->belongsTo(Topic::class);
    }

    /**
     * Relação um-para-muitos.
     * Função que retorna o desempenho de questões relacionado ao desempenho do tópico.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function performanceQuestions()
    {
        return $this->hasMany(PerformanceQuestion::class);
    }

    /**
     * Relação um-para-um.
     * Função que retorna o usuário relacionado ao desempenho do tópico.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
