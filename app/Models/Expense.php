<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Expense extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'expenses';

    /**
    * The database primary key value.
    *
    * @var string
    */
    protected $primaryKey = 'id';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['user_id', 'date', 'amount', 'description'];

    /**
     * Relationship: Company belongs to many Users.
     *
     * @return Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function users()  {
        return $this->belongsTo('App\Models\User', 'user_id');
    }
}
