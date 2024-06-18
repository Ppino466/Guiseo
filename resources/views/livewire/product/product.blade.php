<div class="">
    <!-- Navbar -->
    <!-- End Navbar -->
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card m-2">
                    <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                        <div class="bg-gradient-info shadow-info border-radius-lg pt-4 pb-3">
                            <h6 class="text-white text-capitalize ps-3">Tabla Productos</h6>
                        </div>

                    </div>

                    <div class="m-4">
                        <div class="d-flex justify-content-end">
                            @role('Master|Administrador')
                            <button type="button" class="btn btn-success"
                                wire:click="$emit('modalOpen')">Registrar</button>
                                @endrole
                        </div>
                        <livewire:product.product-table theme="bootstrap-5" />
                    </div>

                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="productModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true" wire:ignore>

        <livewire:product.product-modal />
    </div>
</div>
@push('js')
    <script>
         $(document).ready(function() {
            Livewire.on('modalOpen', function(value) {
                // Livewire.emit('editUser', value);
                Livewire.emit('editProduct', value);
            });

        Livewire.on('ok', function(value) {
            $('#productModal').modal('show');
        });

        //Mensaje en la creación de un producto
        Livewire.on('productCreated', function(value) {
                mostrarAlerta('¡Éxito!', 'Producto registrado correctamente.', 'success');
                //('#productModal').modal('hide');
        });

        //Mensaje para la actualización de información
        Livewire.on('productUpdated', function(value) {
                mostrarAlerta('¡Éxito!', 'Producto actualizado correctamente.', 'success');
                //('#productModal').modal('hide');
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
        });
    </script>
@endpush
