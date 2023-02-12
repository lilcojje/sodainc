<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Trucking extends Model
{
    use HasFactory;
	
	protected $table = "trucking";
    public $timestamps = false;
    protected $primaryKey = "trucking_id";

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'trucking_name',
        'vehicle_plate',
        'contact_person',
		'contact_number',
    ];

}
