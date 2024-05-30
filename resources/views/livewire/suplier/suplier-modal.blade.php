<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    <div class="modal-content">
        <div class="modal-header">
            @if ($suplierId)
                <h5 class="modal-title font-weight-normal" id="suplierModalLabel">Editar Proveedor</h5>
            @else
                <h5 class="modal-title font-weight-normal" id="suplierModalLabel">Registrar Proveedor</h5>
            @endif
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <div class="row">
                <div class="col-md-6">
                    <label for="suplierName" class="form-label">Nombre</label>
                    <div class="mb-3 input-group input-group-static">
                        <input type="text" class="form-control" id="name" name="name"
                            placeholder="Ingresa nombre" wire:model.defer="name">
                        @error('name')
                            <p class='text-danger inputerror'>{{ $message }}</p>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <label for="contact_name" class="form-label">Nombre del Contacto</label>
                    <div class="mb-3 input-group input-group-static">
                        <input type="text" class="form-control" id="contact_name" name="contact_name"
                            placeholder="Ingresa el nombre del contacto" wire:model.defer="contact_name">
                        @error('contact_name')
                            <p class='text-danger inputerror'>{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <label for="address" class="form-label">Domicilio</label>
                    <div class="mb-3 input-group input-group-static">
                        <input type="text" class="form-control" id="address" name="address"
                            placeholder="Ingresa el domicilio" wire:model.defer="address">
                        @error('address')
                            <p class='text-danger inputerror'>{{ $message }}</p>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <label for="phone" class="form-label">Telefono</label>
                    <div class="mb-3 input-group input-group-static">
                        <input type="text" class="form-control" id="phone" name="phone"
                            placeholder="Ingresa el telefono" wire:model.defer="phone">
                        @error('phone')
                            <p class='text-danger inputerror'>{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <label for="email" class="form-label">Email</label>
                    <div class="mb-3 input-group input-group-static">
                        <input type="text" class="form-control" id="email" name="email"
                            placeholder="Ingresa el email" wire:model.defer="email">
                        @error('email')
                            <p class='text-danger inputerror'>{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cerrar</button>
            <button type="button" class="btn btn-success" wire:click="saveOrUpdateSuplier"
                wire:loading.attr="disabled" wire:target="saveOrUpdateSuplier">Guardar</button>
            <div wire:loading wire:target="saveOrUpdateSuplier">
                Procesando...
            </div>
        </div>
    </div>
</div>
