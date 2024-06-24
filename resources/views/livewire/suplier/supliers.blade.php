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
                            <button type="button" class="btn btn-info"
                                wire:click="$emit('modalOpen')">Registrar</button>
                        </div>
                        <livewire:suplier.suplier-table theme="bootstrap-5" />
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="suplierModal" tabindex="-1" role="dialog" aria-labelledby="suplierModalLabel"
        aria-hidden="true">
        <livewire:suplier.suplier-modal />
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

            Livewire.on('suplierCreated', function(value) {
                $('#userModal').modal('hide');
                mostrarAlerta('¡Éxito!', 'Proveedor se registrado correctamente.', 'success');
            });

            Livewire.on('modalOpen', function(value) {
                Livewire.emit('editSuplier', value);
            });

            Livewire.on('ok', function(value) {
                $('#suplierModal').modal('show');
            });

            Livewire.on('listenerBaja', function(value) {
                mostrarConfirmacion("¿Estás seguro?", "¡No podrás revertir esto!", () => {
                    Livewire.emit('downSuplier', value);
                    mostrarAlerta("¡Realizado!", "El proveedor se ha dado de baja.", "success");
                });
            });

            Livewire.on('listenerAlta', function(value) {
                mostrarConfirmacion("¿Estás seguro?", "Esto reactivará el proveedor en el sistema.",
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
                    confirmButtonColor: "#1A73E8",
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
