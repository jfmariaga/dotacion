<?php

namespace App\Http\Livewire\Reporte;

use App\Models\EntregaEpp;
use Livewire\Component;


class Reporte extends Component
{
    public $item;
    public function render()
    {
        $reportes = EntregaEpp::all();
        return view('livewire.reporte.reporte', compact('reportes'));
    }

    public function selecItem($userId, $action)
    {
        $this->item = $userId;

        if ($action == 'delete') {
           $this->emit('delete_ok');
        } else {
            $this->emitTo('entrega.edit','getModelId', $this->item);
        }
    }
}
