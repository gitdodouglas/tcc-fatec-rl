<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Level extends Model
{
    /**
     * Atributos que podem ser atribuídos em massa.
     *
     * @var array
     */
    protected $fillable = [
        'level', 'description',
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
     * Função que retorna os tópicos relacionados ao nível.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function topics()
    {
        return $this->hasMany(Topic::class)->orderBy('number_sequence');
    }
}
