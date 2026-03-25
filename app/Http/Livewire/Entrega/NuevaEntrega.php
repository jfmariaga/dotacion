<?php

namespace App\Http\Livewire\Entrega;

use App\Models\area;
use App\Models\Empleado;
use App\Models\EntregaEpp;
use App\Models\Epp;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class NuevaEntrega extends Component
{
    public $modelId,$idEmple,$nombreEmpleado,$cc,$epp_id,$cargo,$responsable,$estado,$cantidad;
    protected $listeners=['getModelId'];
    protected $rules = [
        'nombreEmpleado' => 'required',
        'epp_id' => 'required',
        'cargo' => 'required',
        'cantidad' => 'required',
    ];

    public function render()
    {
        $epp = Epp::orderBy('descripcion','ASC')->get();
        return view('livewire.entrega.nueva-entrega',compact('epp'));
    }

    public function getModelId($modelId)
    {
        $this->modelId = $modelId;
        $model = Empleado::find($this->modelId);
        $this->idEmple = $model->id;
        $this->estado = $model->estado;
        $this->cargo = $model->cargo;
        $this->nombreEmpleado = $model->nombre;
        $this->cc = $model->cc;
    }

    public function guardar()
    {
        $this->validate();  
            $this->responsable = auth()->user()->name;
            $datos = [
               'empleado_id'=> $this->idEmple,
               'fechaEntrega'=> date('Y-m-d'),
               'responsable'=> $this->responsable,
               'epp_id' => $this->epp_id,
               'cantidad' => $this->cantidad,
            ];

            EntregaEpp::create($datos);
            $this->emitTo('entrega.index', 'render');
            $this->reset();
            $this->emit('entrega_ok');
    }

    public function resetear()
    {
        $this->reset();
        $this->resetValidation();
    }
}
