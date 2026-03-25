<div>
    <table id="example" class="display nowrap table-responsive" style="width:100%">
        <thead>
            <tr>
                <th class="text-center">Nombre</th>
                <th class="text-center">Cedula</th>
                <th class="text-center">T. Contrato</th>
                <th class="text-center">Centro de costos</th>
                <th class="text-center">Area</th>
                <th class="text-center">Item EPP</th>
                <th class="text-center">EPP entregado</th>
                <th class="text-center">Cantidad</th>
                <th class="text-center">Labor</th>
                <th class="text-center">Responsable</th>
                <th class="text-center">Fecha de entrega</th>
                {{-- <th class="text-center">Codigo de consumo</th> --}}
                {{-- <th class="text-center">FO-GH-74</th> --}}

            </tr>
        </thead>
        <tbody>
            @isset($reportes)
                @foreach ($reportes as $item)
                    <tr>
                        <td class="text-center">{{ $item->empleado->nombre }}</td>
                        <td class="text-center">{{ $item->empleado->cc }}</td>
                        <td class="text-center">{{ $item->empleado->tp_contrato }}</td>
                        <td class="text-center">{{ $item->empleado->centro }}</td>
                        <td class="text-center">{{ $item->empleado->area }}</td>
                        <td class="text-center">{{ $item->epp->item }}</td>
                        <td class="text-center">{{ $item->epp->descripcion }}</td>
                        <td class="text-center">{{ $item->cantidad }}</td>
                        <td class="text-center">{{ $item->empleado->cargo }}</td>
                        <td class="text-center">{{ $item->responsable }}</td>
                        <td class="text-center">{{ $item->fechaEntrega }}</td>
                        {{-- @if ($item->consumo)
                            <td class="text-center">{{ $item->consumo }}</td>
                        @else
                            <td class="text-center">
                                <a href="#" class="btn btn-sm btn-info"
                                    wire:click="selecItem({{ $item->id }},'update')" data-toggle="modal"
                                    data-target="#editEntrega"><i class="far fa-edit"></i>
                                </a>
                            </td>
                        @endif --}}
                        {{-- <td class="text-center"> <a class="btn btn-md btn-outline-dark"
                                href="{{ route('signpad.so-32', $item->empleado->id) }}"><i class="fas fa-download"></i>
                            </a>
                        </td> --}}
                    </tr>
                @endforeach
            @endisset
        </tbody>
    </table>

    @push('modals')
        @include('modals.editar-entrega')
    @endpush
</div>
