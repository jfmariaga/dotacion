<?php

namespace App\Http\Livewire\Entrega;

use App\Models\Empleado;
use App\Models\EntregaEpp;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;
    protected $paginationTheme = "bootstrap";
    public $item,$idNew, $action, $search,$idemple="",$item2,$nombre="",$caja="";
    public $firma="1";
    protected $listeners = ['render'];

    public function updatingSearch()
    {
        $this->resetPage();
    }
    public function render()
    {
        if ($this->search === "") {
            $this->idemple = "";
        }

        $empleado = Empleado::where('rfid', $this->search)
        // ->orWhere('cc', $this->search)
        ->Where('estado', 0)
        ->get();
        foreach ($empleado as $item) {
        $this->item2 = $item;
        $this->idemple = $item->id;
        $this->firma = $item->firma;
        $this->nombre = $item->nombre;
        $this->caja = $item->caja;
        }
        $entrega = EntregaEpp::latest('id')
        ->where('empleado_id', $this->idemple)
        ->paginate(8);
        
        return view('livewire.entrega.index', compact('entrega','empleado'));
    }

    public function selecItem($userId, $action)
    {
        $this->idNew = $userId;

        if ($action == 'delete') {
           $this->emit('delete_ok');
        } else {
            $this->emitTo('entrega.nueva-entrega','getModelId', $this->idNew);
        }
    }
}
