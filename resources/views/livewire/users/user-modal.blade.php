<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    <div class="modal-content">
        <div class="modal-header">
            @if ($user)
                <h5 class="modal-title font-weight-normal" id="userModalLabel">Editar usuario</h5>
            @else
                <h5 class="modal-title font-weight-normal" id="userModalLabel">Registrar usuario</h5>
            @endif
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <div class="row">
                <div class="col-md-6">
                    <label for="userName" class="form-label">Nombre(s)</label>
                    <div class="mb-3 input-group input-group-static">
                        <input type="text" class="form-control" id="userName" name="name" placeholder="Ingresa nombre(s)"
                            wire:model.defer="name">
                        @error('name')
                            <p class='text-danger inputerror'>{{ $message }}</p>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <label for="userLastName" class="form-label">Apellido(s)</label>
                    <div class="mb-3 input-group input-group-static">
                        <input type="text" class="form-control" id="userLastName" name="last_name"
                            placeholder="Ingresa apellido(s)" wire:model.defer="lastName">
                        @error('lastName')
                            <p class='text-danger inputerror'>{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <label for="userPhone" class="form-label">Teléfono</label>
                    <div class="mb-3 input-group input-group-static">
                        <input type="tel" class="form-control" id="userPhone" name="phone" placeholder="Ingresa teléfono"
                            wire:model.defer="phone">
                        @error('phone')
                            <p class='text-danger inputerror'>{{ $message }}</p>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <label for="userEmail" class="form-label">Correo</label>
                    <div class="mb-3 input-group input-group-static">
                        <input type="text" class="form-control" id="userEmail" name="email" placeholder="Ingresa correo"
                            wire:model.defer="email">
                        @error('email')
                            <p class='text-danger inputerror'>{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cerrar</button>
            <button type="button" class="btn btn-success" wire:click="saveOrUpdateUser" wire:loading.attr="disabled"
                wire:target="saveOrUpdateUser">Guardar</button>
            <div wire:loading wire:target="saveOrUpdateUser">
                Procesando...
            </div>
        </div>
    </div>
</div>
