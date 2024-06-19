<div class="">
    <!-- Navbar -->
    <!-- End Navbar -->
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card m-2">
                    <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                        <div class="bg-gradient-info shadow-info border-radius-lg pt-4 pb-3">
                            <h6 class="text-white text-capitalize ps-3">Tabla Metas</h6>
                        </div>
                    </div>

                    <div class="m-4">

                        <livewire:goal.goal-table theme="bootstrap-5" />
                    </div>

                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="goalModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">

        <livewire:goal.goal-modal />
    </div>
</div>
@push('js')
    <script>
        $(document).ready(function() {
            let mask;

            Livewire.on('modalOpen', function(value) {
                Livewire.emit('editGoal', value);
                $('#goalModal').modal('show');

                // Actualizar la máscara después de abrir el modal y recibir datos de Livewire
                if (mask && document.getElementById('amount')) {
                    mask.updateValue();
                }
            });

            Livewire.on('goalUpdated', function(value) {

                $('#goalModal').modal('hide');
                mostrarAlerta('¡Éxito!', 'Meta actualizada correctamente.', 'success');
            })

            const element = document.getElementById('amount');
            const maskOptions = {
                mask: '$num',
                blocks: {
                    num: {
                        mask: Number,
                        thousandsSeparator: ',',
                        radix: '.',
                        scale: 2,
                        signed: false,
                        normalizeZeros: true,
                        padFractionalZeros: true,
                    }
                }
            };

            mask = IMask(element, maskOptions);
            mask.updateValue(element.value);

            // Hook de Livewire para actualizar la máscara después del procesamiento del mensaje
            Livewire.hook('message.processed', (message, component) => {
                if (document.getElementById('amount')) {
                    mask.value = element.value;
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
