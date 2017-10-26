<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Alternative extends Model
{
    /**
     * Atributos que podem ser atribuídos em massa.
     *
     * @var array
     */
    protected $fillable = [
        'alternative', 'right_answer',
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
     * Atributos que devem ser ocultos para arrays.
     *
     * @var array
     */
    protected $hidden = [
        'right_answer',
    ];

    /**
     * Relação um-para-um.
     * Função que retorna a questão relacionada à alternativa.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function question()
    {
        return $this->belongsTo(Question::class);
    }
}
