<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'users';

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
    protected $fillable = ['full_name', 'email', 'phone'];

    /**
     * User has expenses
     *
     * @return BelongsTo
     */
    public function expenses() {
        return $this->belongsTo('App\Models\Expense','user_id');
    }

    
}


