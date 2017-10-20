<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TypeValidation extends Model
{
    /**
     * Atributos que podem ser atribuídos em massa.
     *
     * @var array
     */
    protected $fillable = [
        'type_validation',
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
     * Função que retorna as validações relacionadas ao tipo.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function validations()
    {
        return $this->hasMany(Validation::class);
    }
}
