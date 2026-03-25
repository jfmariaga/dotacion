<?php

namespace App\Http\Livewire\Colaborador;

use App\Models\area;
use App\Models\Empleado;
use Livewire\Component;

class EditarUsuario extends Component
{
    public $nombre, $cc, $area, $password, $centro, $modelId, $estado, $cargo,$contrato, $caja;
    public $user;
    protected $rules = [
        'nombre' => 'required',
        'cc' => 'required',
        'password' => 'required',
        'area' => 'required',
        'cargo' => 'required',
        'contrato' => 'required',
        'centro' => 'required'
    ];
    protected $listeners = ['getModelId'];
    public function render()
    {
        $areas = area::all();
        if ($this->area) {
            $areaCen1 =  area::where('nombre', $this->area)->get();
            foreach ($areaCen1 as $item) {
                $this->centro = $item->centro;
            }
        }
        return view('livewire.colaborador.editar-usuario',compact('areas'));
    }

    public function getModelId($modelId)
    {
        $this->modelId = $modelId;
        $model = Empleado::find($this->modelId);
        $this->nombre = $model->nombre;
        $this->cc = $model->cc;
        $this->password = $model->rfid;
        $this->area = $model->area;
        $this->centro = $model->centro;
        $this->cargo = $model->cargo;
        $this->estado = $model->estado;
        $this->caja = $model->caja;
        $this->contrato = $model->tp_contrato;
    }

    public function update()
    {

        $this->validate();

        $user = Empleado::find($this->modelId);
        $user->nombre =  $this->nombre;
        $user->cc = $this->cc;
        $user->rfid = $this->password;
        $user->area = $this->area;
        $user->centro = $this->centro;
        $user->cargo = $this->cargo;
        $user->estado = $this->estado;
        $user->caja = $this->caja;
        $user->tp_contrato = $this->contrato;
        $user->update();

        $this->emitTo('colaborador.index', 'render');
        $this->reset();
        $this->emit('editar');
    }

    public $cargos = [
        'ALMACENISTA DE  MANTENIMIENTO',
        'ANALISTA AMBIENTAL',
        'ANALISTA CONTABLE',
        'ANALISTA CONTABLE ',
        'ANALISTA CONTROL CALIDAD',
        'ANALISTA CONTROL CALIDAD (JUNIOR)',
        'ANALISTA COSTOS Y PRESU JUNIOR',
        'ANALISTA COSTOS Y PRESUPUESTO',
        'ANALISTA DE ALMACEN',
        'ANALISTA DE ASUNTOS REGULATORI',
        'ANALISTA DE BPM',
        'ANALISTA DE COMPENSACION',
        'ANALISTA DE COMPRAS',
        'ANALISTA DE COMPRAS (REP Y SERV)',
        'ANALISTA DE CONTROL CALIDAD',
        'ANALISTA DE CONTROL DE PRODUC',
        'ANALISTA DE I&D',
        'ANALISTA DE INVENTARIOS',
        'ANALISTA DE LOGISTICA',
        'ANALISTA DE MATERIAS PRIMAS',
        'ANALISTA DE MEJORA CONTINUA',
        'ANALISTA DE MICROBIOLOGIA',
        'ANALISTA DE PLANEACION',
        'ANALISTA DE QUEJAS Y RECLAMOS',
        'ANALISTA DE TECNOLOGIA',
        'ANALISTA GENTE Y CULTURA',
        'ANALISTA MATERIAL DE EMPAQUE',
        'ANALISTA PRODUCCION',
        'ANALISTA SIG',
        'ASEADOR DE PLANTA',
        'AUX DE DESPACHOS',
        'AUX DE OFICIOS VARIOS MANTENIM',
        'AUXILIAR ADMINISTRATIVO ALMACEN',
        'AUXILIAR AMBIENTAL PTAR',
        'AUXILIAR AMBIENTAL RECICLAJE',
        'AUXILIAR CAD',
        'AUXILIAR DE DESPACHOS',
        'AUXILIAR DE MICROBIOLOGIA',
        'AUXILIAR DE SERVICIOS GENERALE',
        'AUXILIAR GENTE Y CULTURA',
        'AUXILIAR SST',
        'CALDERISTA ',
        'COMPRADOR',
        'COORDINADOR CAD',
        'COORDINADOR DE COMPENSACION',
        'COORDINADOR DE CONTROL CALIDAD',
        'COORDINADOR DE TECNOLOGIA ',
        'DESARROLLADOR DE ABASTECIMIENTO',
        'ELECTRICISTA ',
        'FORMULADOR',
        'GERENTE ADTIVO Y FINANCIERO',
        'GERENTE DE INNOVACION',
        'GERENTE DE PLANTA',
        'GERENTE GENERAL',
        'INGENIERO DE EMPAQUES',
        'INGENIERO DE MANTENIMIENTO',
        'INGENIERO DE PROCESOS',
        'INGENIERO I&D',
        'INGENIERO JUNIOR DE INVESTIGACION Y DESARROLLO',
        'JEFE  MANTENIMIENTO',
        'JEFE CONTABILIDAD  IMPUESTOS',
        'JEFE DE ALMACEN',
        'JEFE DE CONTROL PRODUCCION',
        'JEFE DE CONTROL y ASEGURAMIENTO DE CALIDAD',
        'JEFE DE COSTOS Y PRESUPUESTOS',
        'JEFE DE LOGISTICA',
        'JEFE DE PLANEACION',
        'JEFE DE PLANTA',
        'JEFE DE PROYECTOS',
        'JEFE DE SISTEMAS INT DE GESTIO',
        'JEFE SST',
        'MECANICO',
        'MECANICO JUNIOR',
        'MENSAJERO',
        'METROLOGO',
        'OPERARIO DE MONTACARGAS',
        'OPERARIO EXPERTO',
        'OPERARIO EXPERTO BOD PROD TERM',
        'OPERARIO EXPERTO CONTROL DE P',
        'OPERARIO EXPERTO SUMINISTROS',
        'OPERARIO GENERAL',
        'OPERARIO GENERAL BOD PROD TERM',
        'PLANEADOR Y PROGRAMADOR DE MAN',
        'PRACTICANTE AMBIENTAL',
        'PRACTICANTE CAD',
        'PRACTICANTE CALIDAD',
        'PRACTICANTE CONTABILIDAD',
        'PRACTICANTE G&C',
        'PRACTICANTE MANTENIMIENTO',
        'PRACTICANTE MEJORA CONTINUA',
        'PRACTICANTE SST',
        'PRACTICANTE TECNOLOGÍA',
        'PRACTICANTE INVESTIGACIÓN Y DESARROLLO',
        'PROFESIONAL EN BIENESTAR Y DLL',
        'SUPERVISOR AMBIENTAL',
        'SUPERVISOR DE ALMACEN',
        'SUPERVISOR DE LOGISTICA',
        'SUPERVISOR DE MANTENIMIENTO',
        'SUPERVISOR DE PLANTA',
        'SUPERVISOR DE PLANTA ',
        'TESORERO',
    ];

    public function resetear()
    {
        $this->reset();
    }
}
