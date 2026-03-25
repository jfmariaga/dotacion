<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EntregaEpp extends Model
{
    protected $fillable = ['empleado_id','responsable','fechaEntrega','epp_id','cantidad','consumo','firma'];

    use HasFactory;

    public function empleado(){
        return $this->belongsTo(Empleado::class);
    }

    public function epp (){
        return $this->belongsTo(Epp::class);
    }
}
