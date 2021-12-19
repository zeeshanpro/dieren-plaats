<?php 
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Ad;

class AdImage extends Model
{ 
     use HasFactory;
    protected $table = 'ad_images';
                
    /*
        Defining the foreign relation of local column -> ad_id on table ads
    */
    public function ad_imageAd() {
       return $this->belongsTo(Ad::class, 'ad_id', 'id');
    } 
}
