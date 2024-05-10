<div class="">
    <!-- Navbar -->
    <!-- End Navbar -->
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card m-2">
                    <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                        <div class="bg-gradient-info shadow-info border-radius-lg pt-4 pb-3">
                            <h6 class="text-white text-capitalize ps-3">Tabla Usuarios</h6>
                        </div>

                    </div>
                    <div class="m-4">
                        <div class="d-flex justify-content-end">
                            <button type="button" class="btn btn-secondary"
                                wire:click="$emit('modalOpen')">Registrar</button>
                        </div>
                        <livewire:user-table theme="bootstrap-5" />
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="userModal" tabindex="-1" role="dialog" aria-labelledby="userModalLabel"
        aria-hidden="true" wire:ignore>
        <div class="modal-dialog modal-dialog-centered" role="document">
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
                    <div class="mb-3">
                        <label for="userName" class="form-label">Nombre(s)</label>
                        <input type="text" class="form-control" id="userName" name="name"
                            placeholder="Ingresa nombre(s)" wire:model.defer="name">
                    </div>
                    <div class="mb-3">
                        <label for="userLastName" class="form-label">Apellido(s)</label>
                        <input type="text" class="form-control" id="userLastName" name="last_name"
                            placeholder="Ingresa apellido(s)" wire:model.defer="lastName">
                    </div>
                    <div class="mb-3">
                        <label for="userPhone" class="form-label">Teléfono</label>
                        <input type="tel" class="form-control" id="userPhone" name="phone"
                            placeholder="Ingresa teléfono" wire:model.defer="phone">
                    </div>
                    <div class="mb-3">
                        <label for="userEmail" class="form-label">Correo</label>
                        <input type="text" class="form-control" id="userEmail" name="email"
                            placeholder="Ingresa correo" wire:model.defer="email">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    @if ($user)
                    <button type="button" class="btn btn-success" wire:click="updateUser" wire:loading.attr="disabled"
                        wire:target="updateUser">Guardar</button>
                    <div wire:loading wire:target="updateUser">
                        Procesando...
                    </div>    
                    @else
                    <button type="button" class="btn btn-success" wire:click="saveUser" wire:loading.attr="disabled"
                        wire:target="saveUser">Guardar</button>
                    <div wire:loading wire:target="saveUser">
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
            const element = document.getElementById('userPhone');
            const maskOptions = {
                mask: '000-000-00-00'
            };
            mask = IMask(element, maskOptions);
            mask.updateValue();

            // Eventos de Livewire
            Livewire.on('userUpdated', function(value) {
                $('#userModal').modal('hide');
                mostrarAlerta('¡Éxito!', 'Usuario actualizado correctamente.', 'success');
            });

            Livewire.on('modalOpen', function(value) {
                Livewire.emit('editUser', value);
                $('#userModal').modal('show');
            });

            Livewire.on('listenerBaja', function(value) {
                mostrarConfirmacion("¿Estás seguro?", "¡No podrás revertir esto!", () => {
                    Livewire.emit('downUser',value);
                    mostrarAlerta("¡Realizado!", "El usuario se ha dado de baja.", "success");
                });
            });

            Livewire.on('listenerAlta', function(value) {
                mostrarConfirmacion("¿Estás seguro?", "Esto reactivará el acceso del usuario al sistema.",
                () => {
                    Livewire.emit('upUser',value);
                    mostrarAlerta("¡Realizado!", "El usuario ha sido dado de alta.", "success");
                });
            });

            // Hook de Livewire para actualizar la máscara después del procesamiento del mensaje
            Livewire.hook('message.processed', (message, component) => {
                if (document.getElementById('userPhone')) {
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
