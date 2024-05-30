<div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
        <div class="modal-header">
            @if ($product)
                <h5 class="modal-title font-weight-normal" id="userModalLabel">Editar producto</h5>
            @else
                <h5 class="modal-title font-weight-normal" id="userModalLabel">Registrar producto</h5>
            @endif
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" >
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            {{-- STEP 1 --}}
            @if ($currentStep == 1)
                <div class="step-one">
                    Paso 1 (datos proveedor)
                    {{-- Esta sentencia debe de ir abajo de cada input --}}
                    {{-- @error('name') <p class='text-danger inputerror'>{{ $message }}</p>@enderror --}}
                </div>
            @endif

            {{-- STEP 2 --}}
            @if ($currentStep == 2)
                <div class="step-two">
                    Paso 2 (datos estaticos)
                </div>
            @endif

            {{-- STEP 3 --}}
            @if ($currentStep == 3)
                <div class="step-three">
                    Paso 3 (datos inventario)
                </div>
            @endif
        </div>
        <div class="modal-footer">
            @if ($currentStep == 1)
               
                <button type="button" class="btn btn-success" wire:click="increaseStep()">Next</button>
            @endif

            @if ($currentStep == 2)
                <button type="button" class="btn btn-outline-secondary" wire:click="decreaseStep()">Back</button>
                <button type="button" class="btn btn-success" wire:click="increaseStep()">Next</button>
            @endif

            @if ($currentStep == 3)
                <button type="button" class="btn btn-outline-secondary" wire:click="decreaseStep()">Back</button>
                <button type="submit" class="btn btn-info" wire:click="saveOrUpdateUser()">Guardar</button>
            @endif
        </div>
    </div>
</div>
