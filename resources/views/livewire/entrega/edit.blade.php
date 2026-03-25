<div>
    <div class="modal-header">
        <h5 class="modal-title">Agregar consumo</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close" wire:click="resetear()">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <div class="modal-body">
        @if ($idEmple != null)
            <div class="modal-body">
                <div class="row">
                    <fieldset class="form-group floating-label-form-group col-lg-6 col-12">
                        <label for="">Cedula</label>
                        <input type="number" disabled class="form-control  @error('cc') border_error @enderror"
                            wire:model="cc" disabled>
                        @error('cc')
                            <span class="input_error error text-danger">{{ $message }}</span>
                        @enderror
                    </fieldset>
                    <br>
                    <fieldset class="form-group floating-label-form-group col-lg-6 col-12">
                        <label for="">Nombre</label>
                        <input type="text" disabled
                            class="form-control  @error('nombreEmpleado') border_error @enderror"
                            wire:model="nombreEmpleado" disabled>
                        @error('nombreEmpleado')
                            <span class="input_error error text-danger">{{ $message }}</span>
                        @enderror
                    </fieldset>
                </div>
                <div class="row">
                    <fieldset class="form-group floating-label-form-group col-lg-6 col-12">
                        <label for="">Labor</label>
                        <input type="text" disabled class="form-control  @error('cargo') border_error @enderror"
                            wire:model="cargo" disabled>
                        @error('cargo')
                            <span class="input_error error text-danger">{{ $message }}</span>
                        @enderror
                    </fieldset>
                    <br>
                    <div class="form-group floating-label-form-group col-lg-6 col-12">
                        <label class="float-left"><b>Seleccionar Dotación</b></label>
                        <select  wire:model="epp_id" class="form-control">
                            <option value="" selected>Seleccionar...</option>
                            @foreach ($epp as $item)
                                <option value="{{ $item->id }}"> {{ $item->descripcion }} </option>
                            @endforeach
                        </select>
                        @error('epp_id')
                            <span class="c_error2 error text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-6">
                        <label>Cantidad</label>
                        <input type="number"  wire:model="cantidad" class="form-control">
                        @error('cantidad')
                            <span class="c_error2 error text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col-lg-6">
                        <label>Codigo de consumo</label>
                        <input type="number" wire:model="consumo" class="form-control">
                        @error('consumo')
                            <span class="c_error2 error text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            </div>
        @else
            <div class="spinner-border text-primary" role="status">
                <span class=" text-center"></span>
            </div>
        @endif
        <div class="modal-footer">
            <input type="submit" class="btn btn-outline-primary btn-sm" wire:click="guardar()" value="Guardar">
            <input type="reset" class="btn btn-outline-danger btn-sm" data-dismiss="modal" wire:click="resetear()"
                value="Cancelar">
        </div>
    </div>
    {{-- <script>
        document.addEventListener('livewire:load', function() {
            $('#select2').select2();
            $('#select2').on('change', function() {
                @this.set('epp_id', this.value);
            })
        })
    </script> --}}
</div>
