<div class="">
    <!-- Navbar -->
    <!-- End Navbar -->
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card m-2">
                    <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                        <div class="bg-gradient-info shadow-info border-radius-lg pt-4 pb-3">
                            <h6 class="text-white text-capitalize ps-3">Tabla Proveedores</h6>
                        </div>

                    </div>
                    <div class="m-4">
                        <div class="d-flex justify-content-end">
                            <button type="button" class="btn btn-secondary"
                                wire:click="$emit('modalOpen')">Registrar</button>
                        </div>
                        <livewire:suplier.suplier-table theme="bootstrap-5" />
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="suplierModal" tabindex="-1" role="dialog" aria-labelledby="suplierModalLabel"
        aria-hidden="true" wire:ignore>
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    @if ($suplier)
                        <h5 class="modal-title font-weight-normal" id="suplierModalLabel">Editar Proveedor</h5>
                    @else
                        <h5 class="modal-title font-weight-normal" id="suplierModalLabel">Registrar Proveedor</h5>
                    @endif
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="suplierName" class="form-label">Nombre</label>
                        <input type="text" class="form-control" id="name" name="name"
                            placeholder="Ingresa nombre" wire:model.defer="name">
                    </div>
                    <div class="mb-3">
                        <label for="contact_name" class="form-label">Nombre del Contacto</label>
                        <input type="text" class="form-control" id="contact_name" name="contact_name"
                            placeholder="Ingresa el nombre del contacto" wire:model.defer="contact_name">
                    </div>
                    <div class="mb-3">
                        <label for="address" class="form-label">Domicilio</label>
                        <input type="text" class="form-control" id="address" name="address"
                            placeholder="Ingresa el domicilio" wire:model.defer="address">
                    </div>
                    <div class="mb-3">
                        <label for="phone" class="form-label">Telefono</label>
                        <input type="text" class="form-control" id="phone" name="phone"
                            placeholder="Ingresa el telefono" wire:model.defer="phone">
</div>
                <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="text" class="form-control" id="email" name="email"
                            placeholder="Ingresa el email" wire:model.defer="email">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    @if ($suplier)
                        <button type="button" class="btn btn-success" wire:click="updateSuplier"
                            wire:loading.attr="disabled" wire:target="updateSuplier">Guardar</button>
                        <div wire:loading wire:target="updateSuplier">
                            Procesando...
                        </div>
                    @else
                        <button type="button" class="btn btn-success" wire:click="saveSuplier"
                            wire:loading.attr="disabled" wire:target="saveSuplier">Registrar</button>
                        <div wire:loading wire:target="saveSuplier">
                            Procesando...
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

</div>
@push('js')
    <script>
        let mask;

        $(document).ready(function() {
            const element = document.getElementById('phone');
            const maskOptions = {
                mask: '000-000-00-00'
            };
            mask = IMask(element, maskOptions);
            mask.updateValue();

            // Eventos de Livewire
            Livewire.on('suplierUpdated', function(value) {

                $('#suplierModal').modal('hide');
                mostrarAlerta('¡Éxito!', 'Proveedor actualizado correctamente.', 'success');
            });

            Livewire.on('modalOpen', function(value) {
                Livewire.emit('editSuplier', value);
                $('#suplierModal').modal('show');
            });

            Livewire.on('listenerBaja', function(value) {
                mostrarConfirmacion("¿Estás seguro?", "¡No podrás revertir esto!", () => {
                    Livewire.emit('downSuplier', value);
                    mostrarAlerta("¡Realizado!", "El proveedor se ha dado de baja.", "success");
                });
            });

            Livewire.on('listenerAlta', function(value) {
                mostrarConfirmacion("¿Estás seguro?", "Esto reactivará el proveedor+en el sistema.",
                    () => {
                        Livewire.emit('upSuplier', value);
                        mostrarAlerta("¡Realizado!", "El proveedor ha sido dado de alta.", "success");
                    });
            });

            // Hook de Livewire para actualizar la máscara después del procesamiento del mensaje
            Livewire.hook('message.processed', (message, component) => {
                if (document.getElementById('phone')) {
                    mask.updateValue();
                }
            });

            // Función para mostrar una alerta de SweetAlert2
            function mostrarAlerta(titulo, mensaje, icono) {
                Swal.fire({
                    title: titulo,
                    text: mensaje,
                    icon: icono,
                    confirmButtonText: 'Ok'
                });
            }

            // Función para mostrar una confirmación de SweetAlert2
            function mostrarConfirmacion(titulo, mensaje, callback) {
                Swal.fire({
                    title: titulo,
                    text: mensaje,
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Sí, continuar"
                }).then((result) => {
                    if (result.isConfirmed) {
                        callback();
                    }
                });
            }
        });
    </script>
@endpush
