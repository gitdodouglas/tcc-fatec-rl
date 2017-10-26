<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Topic extends Model
{
    /**
     * Atributos que podem ser atribuídos em massa.
     *
     * @var array
     */
    protected $fillable = [
        'topic', 'description', 'number_sequence', 'quantity_questions', 'minimum_hit',
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
     * Função que retorna o nível relacionado ao tópico.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function level()
    {
        return $this->belongsTo(Level::class);
    }

    /**
     * Relação um-para-muitos.
     * Função que retorna as questões relacionadas ao tópico.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function questions()
    {
        return$this->hasMany(Question::class);
    }

    /**
     * Relação um-para-muitos.
     * Função que retorna os desempenhos relacionados ao tópico.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function performances()
    {
        return $this->hasMany(Performance::class);
    }
}
