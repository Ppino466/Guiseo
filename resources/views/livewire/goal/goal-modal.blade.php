<div class="modal-dialog modal-lg modal-dialog-centered" role="document">
    <div class="modal-content">
        <div class="modal-header">
            @if ($statusGoal === 'completed')
                <h5 class="modal-title font-weight-normal" id="userModalLabel">Ver Meta</h5>
            @elseif ($userId)
                <h5 class="modal-title font-weight-normal" id="userModalLabel">Editar Meta</h5>
            @else
                <h5 class="modal-title font-weight-normal" id="userModalLabel">Registrar Meta</h5>
            @endif
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        
        <div class="modal-body">
            <div class="row">
                <div class="col-md-6 my-3" >
                    <label class="form-label">Empleado</label>
                    <div class="mb-3 input-group input-group-static">
                        @if ($userId)
                        <input type="text" id="userId" wire:model="userId" class="form-control" disabled>    
                        @else
                        <select class="form-control" id="selectedUser" name="selectedUser" wire:model="selectedUser">
                            <option value="">Selecciona uno</option>
                            @foreach($listUser as $user)
                                <option value="{{ $user->id }}">{{ $user->name }}</option>
                            @endforeach
                        </select>
                        @error('selectedUser')
                        <p class='text-danger inputerror'>{{ $message }}</p>
                    @enderror
                        @endif
                    </div>
                    @error('userId')
                        <p class='text-danger inputerror'>{{ $message }}</p>
                    @enderror
                </div>
                <div class="col-md-6">
                    <label for="type" class="form-label">Fecha Inico</label>
                    <div class="mb-3 input-group input-group-static">
                        <input type="text" id="dateInit" wire:model.defer="startDate" class="form-control" @if($statusGoal === 'completed') disabled @endif>
                        @error('startDate')
                        <p class='text-danger inputerror'>{{ $message }}</p>
                    @enderror
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <label for="type" class="form-label">Tipo</label>
                    <div class="input-group input-group-static mb-4">
                        <select class="form-control" id="type" name="type" wire:model="type" @if($statusGoal === 'completed') disabled @endif>
                            <option value="" selected>Selecciona una opción</option>
                            <option value="Quincena">Quincena</option>
                            <option value="Mensual">Mensual</option>
                            <option value="Cuatrimestral">Cuatrimestral</option>
                        </select>
                        @error('type')
                            <p class='text-danger inputerror'>{{ $message }}</p>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <label for="type" class="form-label">Fecha Fin</label>
                    <div class="mb-3 input-group input-group-static">
                        <input type="text" id="dateFinish" wire:model.defer="endDate" class="form-control" disabled>
                        @error('endDate')
                        <p class='text-danger inputerror'>{{ $message }}</p>
                    @enderror
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <label for="amount" class="form-label">Monto</label>
                    <div class="mb-3 input-group input-group-static">
                        <input type="text" class="form-control" id="amount" name="amount"
                            placeholder="Ingresa el nonto" wire:model="amount" @if($statusGoal === 'completed') disabled @endif>
                        @error('amount')
                            <p class='text-danger inputerror'>{{ $message }}</p>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <label for="type" class="form-label">Descripción</label>
                    <div class="input-group input-group-dynamic">
                        <textarea class="form-control" rows="2" wire:model.defer="description" placeholder="Se breve..."
                            spellcheck="false" @if($statusGoal === 'completed') disabled @endif></textarea>
                    </div>
                    @error('description')
                    <p class='text-danger inputerror'>{{ $message }}</p>
                @enderror
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cerrar</button>
            
            @if ($statusGoal === 'completed')
                <div wire:loading wire:target="updateGoal">
                    Procesando...
                </div>
            @else
                @if ($userId)
                    <button type="button" class="btn btn-success" wire:click="updateGoal" wire:loading.attr="disabled" wire:target="updateGoal">Guardar</button>
                    <div wire:loading wire:target="updateGoal">
                        Procesando...
                    </div>
                @else
                    <button type="button" class="btn btn-info" wire:click="saveGoal" wire:loading.attr="disabled" wire:target="saveGoal">Guardar</button>    
                    <div wire:loading wire:target="saveGoal">
                        Procesando...
                    </div>
                @endif
            @endif
        </div>
    </div>
</div>
@push('js')
    <script>
        $(document).ready(function() {
          
            var dateInit = $("#dateInit").flatpickr({
                dateFormat: "Y-m-d",
                locale: "es",
                allowInput: true,
                minDate: "today"
            });


            

        });
    </script>
@endpush
