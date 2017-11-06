<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * Atributos que podem ser atribuídos em massa.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'nickname', 'birth', 'email', 'password',
    ];

    /**
     * Atributos que NÃO podem ser atribuídos em massa.
     *
     * @var array
     */
    protected $guarded = [
        'id', 'created_at', 'updated_at', 'activated_at',
    ];

    /**
     * Atributos que devem ser ocultos para arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
    ];

    /**
     * Relação um-para-um.
     * Função que retorna o tipo relacionado ao usuário.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function typeUser()
    {
        return $this->belongsTo(TypeUser::class);
    }

    /**
     * Relação um-para-muitos.
     * Função que retorna o desempenho relacionado ao usuário.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function performances()
    {
        return $this->hasMany(Performance::class);
    }

    /**
     * Desabilita a função RememberToken.
     *
     * @return null
     */
    public function getRememberTokenName()
    {
        return null;
    }
}