<?php

namespace LAVA\Models;

use LAVA\Traits\RelationshipsTrait;
use Zizaco\Entrust\Traits\EntrustUserTrait;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
	use EntrustUserTrait, RelationshipsTrait;

	//Nombre de la tabla en la base de datos
	protected $table = 'users';
    //protected $primaryKey = 'id';

	//Traza: Nombre de campos en la tabla para auditoría de cambios
	const CREATED_AT = 'created_at';
	const UPDATED_AT = 'modified_at';
	const DELETED_AT = 'deleted_at';
	protected $dates = ['created_at', 'modified_at', 'deleted_at'];

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'name',
		'username',
		'cedula',
		'email',
		'password',
		'USER_CREADOPOR',
		'USER_MODIFICADOPOR',
	];

	/**
	 * The attributes that should be hidden for arrays.
	 *
	 * @var array
	 */
	protected $hidden = [
		'password',
		'remember_token',
	];

    /**
     * Attributes to exclude from the Audit.
     *
     * @var array
     */
    protected $auditExclude = [
		'password',
		'remember_token',
    ];
    
	public static function rules($id = 0){
		return [
			'name'      => 'required|max:255',
			'username'  => ['required','max:15',static::unique($id,'username')],
			'cedula'    => ['required','max:15',static::unique($id,'cedula')],
			'email'     => ['required','email','max:320',static::unique($id,'email')],
			'roles_ids' => 'required|array',
			'password'  => 'required|min:6|confirmed',
		];
	}

    protected static function unique($id, $column, $table = null){
        $instance = new static;
        if(!isset($table))
            $table = $instance->table;
        return 'unique:'.$table.','.$column.','.$id.','.$instance->getKeyName();
    }

	//establecemos las relaciones con el modelo Role, ya que un usuario puede tener varios roles
	//y un rol lo pueden tener varios usuarios
	public function roles(){
		return $this->belongsToMany(Role::class);
	}

	/*
	 * Relación users-LAVADORAS (muchos a muchos). 
	 */
	public function lavadoras()
	{
		$foreingKey = 'USER_ID';
		$otherKey   = 'LAVA_ID';
		return $this->belongsToMany(Lavadora::class, 'USUARIOS_LAVADORAS', $foreingKey,  $otherKey);
	}


    /**
     * Perform the actual delete query on this model instance.
     * 
     * @return void
     */
    protected function runSoftDelete()
    {
        $query = $this->newQueryWithoutScopes()->where($this->getKeyName(), $this->getKey());

        $this->{$this->getDeletedAtColumn()} = $time = $this->freshTimestamp();

        $prefix = strtoupper(substr($this::CREATED_AT, 0, 4));
        $deleted_by = $prefix.'_ELIMINADOPOR';

        $query->update([
           $this->getDeletedAtColumn() => $this->fromDateTime($time),
           $deleted_by => auth()->user()->username
        ]);

        //$deleted_by => (\Auth::id()) ?: null
    }


    protected static function boot() {
        parent::boot();

        static::creating(function($model) {
            $model->username = strtolower($model->username);
            if(!isset($model->USER_CREADOPOR))
            	$model->USER_CREADOPOR = auth()->check() ? auth()->user()->username : 'SYSTEM';
            return true;
        });
        static::updating(function($model) {
            $model->USER_MODIFICADOPOR = auth()->check() ? auth()->user()->username : 'SYSTEM';
            return true;
        });
    }

}
