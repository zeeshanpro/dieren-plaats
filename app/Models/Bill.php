<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bill extends Model
{
    use HasFactory;
    protected $table = 'bills';
    protected $fillable = [
        'source',
        'charge',
        'user_id'
    ]; 
    /*
        Defining the foreign relation of local column -> user_id on table users
    */
    public function adUser() {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }  
}
