<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Validation extends Model
{
    /**
     * Atributos que podem ser atribuídos em massa.
     *
     * @var array
     */
    protected $fillable = [
        'validation',
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
        'validation',
    ];

    /**
     * Relação um-para-um.
     * Função que retorna o tipo relacionado à validação.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function typeValidation()
    {
        return $this->belongsTo(TypeValidation::class);
    }

    /**
     * Relação um-para-um.
     * Função que retorna o usuário relacionado a validação.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
