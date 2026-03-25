<div>
    <div class="modal-body">
        <div class="row">
            <fieldset class="form-group floating-label-form-group col-lg-6 col-12">
                <label for="">Nombre</label>
                <input type="text" class="form-control  @error('nombre') border_error @enderror" placeholder="Nombre"
                    wire:model="nombre">
                @error('nombre')
                    <span class="input_error error text-danger">{{ $message }}</span>
                @enderror
            </fieldset>
            <br>
            <fieldset class="form-group floating-label-form-group col-lg-6 col-12">
                <label class="float-left"><b>Seleccionar Cargo</b></label>
                <select wire:model.defer="cargo" class="form-control ">
                    <option value="" selected>Seleccionar...</option>
                    @foreach ($cargos as $item)
                        <option value="{{ $item }}"> {{ $item }} </option>
                    @endforeach
                </select>
                @error('cargo')
                    <span class="c_error2 error text-danger">{{ $message }}</span>
                @enderror
            </fieldset>
            <br>
            <fieldset class="form-group floating-label-form-group col-lg-6 col-12">
                <label class="float-left"><b>Seleccionar Area</b></label>
                <select wire:model.defer="area" class="form-control ">
                    <option value="" selected>Seleccionar...</option>
                    @foreach ($areas as $item)
                        <option value="{{ $item->nombre }}"> {{ $item->nombre }} </option>
                    @endforeach
                </select>
                @error('area')
                    <span class="c_error2 error text-danger">{{ $message }}</span>
                @enderror
            </fieldset>
            {{-- <br>
            <fieldset class="form-group floating-label-form-group col-lg-6 col-12">
                <label class="float-left"><b>Centro de costos</b></label>
                <input type="nomber" class="form-control" disabled wire:model.defer="centro">
                @error('centro')
                    <span class="c_error2 error text-danger">{{ $message }}</span>
                @enderror
            </fieldset> --}}
            <br>
            <fieldset class="form-group floating-label-form-group col-lg-6 col-12">
                <label>Cedula</label>
                <input type="number" class="form-control @error('cc') border_error @enderror" placeholder="Cedula"
                    wire:model="cc">
                @error('cc')
                    <span class="input_error error text-danger">{{ $message }}</span>
                @enderror
            </fieldset>
            <br>
            <fieldset class="form-group floating-label-form-group col-lg-6 col-12">
                <label>Numero de tarjeta</label>
                <input type="password" class="form-control @error('password') border_error @enderror"
                    placeholder="Numero de tarjeta" wire:model="password">
                @error('password')
                    <span class="input_error error text-danger">{{ $message }}</span>
                @enderror
            </fieldset>
            <br>
            <fieldset class="form-group floating-label-form-group col-lg-6 col-12">
                <label>Tipo de contrato</label>
                <select wire:model.defer="contrato" @error('contrato') border_error @enderror class="form-control">
                    <option selected>Seleccionar...</option>
                    <option value="Vinculado"> Vinculado </option>
                    <option value="Ahora"> Ahora </option>
                    <option value="Manpower"> ManpowerGroup </option>
                </select>
                @error('estado')
                    <span class="input_error error text-danger">{{ $message }}</span>
                @enderror
            </fieldset>
            <br>
            <fieldset class="form-group floating-label-form-group col-lg-6 col-12">
                <label># de caja de dotación</label>
                <input type="number" class="form-control @error('caja') border_error @enderror" placeholder="Cedula"
                    wire:model="caja">
                @error('caja')
                    <span class="input_error error text-danger">{{ $message }}</span>
                @enderror
            </fieldset>
        </div>
    </div>
    <div class="modal-footer">
        <input type="submit" class="btn btn-outline-primary btn-sm" wire:click="guardar()" value="Guardar">
        <input type="reset" class="btn btn-outline-danger btn-sm" data-dismiss="modal" wire:click="resetear()"
            value="Cancelar">
    </div>
</div>
