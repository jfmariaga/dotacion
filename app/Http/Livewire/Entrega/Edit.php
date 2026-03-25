<?php

namespace App\Http\Livewire\Entrega;

use App\Models\Empleado;
use App\Models\EntregaEpp;
use App\Models\Epp;
use Livewire\Component;

class Edit extends Component
{
    public $modelId, $idEmple, $nombreEmpleado, $cc, $epp_id, $cargo, $responsable, $estado, $cantidad, $consumo, $empleado_id, $fechaEntrega;
    protected $listeners = ['getModelId'];

    // protected $rules = [
    //     'consumo' => 'required',
    // ];
    public function render()
    {
        $epp = Epp::orderBy('descripcion', 'ASC')->get();

        return view('livewire.entrega.edit', compact('epp'));
    }

    public function getModelId($modelId)
    {
        $this->modelId = $modelId;
        $model = EntregaEpp::find($this->modelId);
        $this->idEmple = $model->id;
        $this->empleado_id = $model->empleado_id;
        $this->cargo = $model->empleado->cargo;
        $this->nombreEmpleado = $model->empleado->nombre;
        $this->cc = $model->empleado->cc;
        $this->epp_id = $model->epp_id;
        $this->cantidad = $model->cantidad;
        $this->consumo = $model->consumo;
        $this->fechaEntrega = $model->fechaEntrega;
        $this->responsable = $model->responsable;
    }

    public function guardar()
    {
        // $this->validate();
        // $empleado = Empleado::where('id', $this->empleado_id);
        $entregas = EntregaEpp::all();
        $entrega = EntregaEpp::where('empleado_id', $this->empleado_id)->get();
        foreach ($entrega as $item) {
            $pedido = EntregaEpp::find($item->id);
            $pedido->consumo =  $this->consumo;
            $pedido->update();
        }
        $pedido = EntregaEpp::find($this->modelId);
        $pedido->cantidad =  $this->cantidad;
        $pedido->epp_id =  $this->epp_id;
        $pedido->update();


        $this->emitTo('entrega.index', 'render');
        $this->reset();
        $this->emit('consumo');
    }

    public function resetear()
    {
        $this->reset();
        $this->resetValidation();
        $this->emitTo('entrega.index', 'render');
    }
}
