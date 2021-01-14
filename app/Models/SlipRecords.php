<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SlipRecords extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'slip_records';

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
    protected $fillable = ['user_id', 'company_id','pay_period','date','earning','deduction'];

    protected $dates = ['date'];

    /**
    *
    */
    public function employee()  {
        return $this->belongsTo(Employee::class,'user_id');
    }
}
