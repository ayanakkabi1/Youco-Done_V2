<?php
namespace App\Models;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Restaurant extends Model{
    use HasFactory,HasRoles;
    protected $fillable=[
        'name',
        'ville',
        'cuisine',
         'capacity',
         'user_id',
         'status'
         ];
    public function favoritedByUsers()
    {
        return $this->belongsToMany(User::class,'favorites');
    }

}