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
        'topic', 'description', 'number_sequence', 'quantity_questions',
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
        'minimum_hit',
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
     * Função que retorna os conteúdos relacionados ao tópico.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function contents()
    {
        return $this->hasMany(Content::class);
    }

    /**
     * Relação um-para-muitos.
     * Função que retorna as questões relacionadas ao tópico.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function questions()
    {
        return $this->hasMany(Question::class);
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
