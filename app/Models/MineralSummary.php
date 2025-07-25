<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MineralSummary extends Model
{
    /**
     * El nombre de la tabla asociada con el modelo.
     *
     * @var string
     */
    protected $table = 'mineral_summary_view';

    /**
     * Indica si el modelo debe marcar las fechas.
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * Indica si el ID del modelo es auto-incremental.
     *
     * @var bool
     */
    public $incrementing = false;

    /**
     * El tipo de la clave primaria.
     *
     * @var string
     */
    protected $keyType = 'string';

    /**
     * La clave primaria para el modelo.
     *
     * @var string
     */
    protected $primaryKey = 'composite_key';

    /**
     * Indica que el modelo es solo de lectura.
     *
     * @var bool
     */
    protected $readOnly = true;

    /**
     * Los atributos que se pueden asignar en masa.
     *
     * @var list<string>
     */
    protected $fillable = [];

    /**
     * Los atributos que deben ser convertidos a tipos nativos.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'fecha' => 'date',
        'toneladas_mina' => 'decimal:2',
        'toneladas_trituradora' => 'decimal:2',
        'toneladas_puerto' => 'decimal:2',
    ];

    /**
     * Obtiene un identificador único para el registro basado en múltiples campos.
     * Este método se usa para generar una clave primaria compuesta.
     *
     * @return string
     */
    public function getCompositeKeyAttribute(): string
    {
        // Usamos fecha y proyecto_codigo como clave compuesta
        return md5($this->fecha . '_' . ($this->proyecto_codigo ?? 'unknown'));
    }
}
