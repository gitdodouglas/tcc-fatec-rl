<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StatusPerformance extends Model
{
    /**
     * Atributos que podem ser atribuídos em massa.
     *
     * @var array
     */
    protected $fillable = [
        'status_performance',
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
     * Relação um-para-muitos.
     * Função que retorna os desempenhos relacionadas ao estado de desempenho.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function performances()
    {
        return $this->hasMany(Performance::class);
    }
}
