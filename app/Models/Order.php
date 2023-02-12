<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
	
	protected $table = "order";
    public $timestamps = false;
    protected $primaryKey = "order_id";

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'dr_number',
        'customer_id',
		'batch_order',
        'destination',
		'customer_trucking_id',
		'order_date',
		'variety',
		'kg',
		'price',
		'quantity',
		'deductions',
		'total',
		'served_status',
		'deposit',
		'banks',
		'delivered',
		'status',
    ];

}
