<?php

/**
 * Created by Reliese Model.
 * Date: Tue, 28 May 2019 17:56:44 +0000.
 */

namespace App;

use Illuminate\Database\Eloquent\Model as Eloquent;

/**
 * Class Village
 * 
 * @property int $id
 * @property string $uuid
 * @property string $nom
 * @property int $chef_id
 * @property int $communes_id
 * @property string $deleted_at
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * 
 * @property \App\Commune $commune
 * @property \Illuminate\Database\Eloquent\Collection $clients
 *
 * @package App
 */
class Village extends Eloquent
{
	use \Illuminate\Database\Eloquent\SoftDeletes;use \App\Helpers\UuidForKey;

	protected $casts = [
		'chef_id' => 'int',
		'communes_id' => 'int'
	];

	protected $fillable = [
		'uuid',
		'nom',
		'chef_id',
		'communes_id'
	];

	public function commune()
	{
		return $this->belongsTo(\App\Commune::class, 'communes_id');
	}

	public function clients()
	{
		return $this->hasMany(\App\Client::class);
	}
}
