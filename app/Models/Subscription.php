<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{
    use HasFactory;
    protected $table = 'subscriptions';
    protected $fillable = [
        'user_id',
        'name',
        'stripe_id',
        'stripe_status',
        'stripe_price'
    ]; 
    /*
        Defining the foreign relation of local column -> user_id on table users
    */
    public function adUser() {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }  
}
