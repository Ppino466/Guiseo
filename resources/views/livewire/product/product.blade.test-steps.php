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
                            <button type="button" class="btn btn-secondary"
                                wire:click="$emit('modalOpen')">Registrar</button>
                        </div>
                        <livewire:product.product-table theme="bootstrap-5" />
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="userModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true" >
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    @if ($product)
                        <h5 class="modal-title font-weight-normal" id="userModalLabel">Editar producto</h5>
                    @else
                        <h5 class="modal-title font-weight-normal" id="userModalLabel">Registrar producto</h5>
                    @endif
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true" style="color: black">X</span>
                    </button>
                </div>
                <div class="modal-body">

                    <form id="productForm">
                        <!-- Paso 1 -->
                        <h4>Información Proveedor</h4>
                        <section>
                            <div class="form-control my-3">
                                <label class="form-label">Nombre</label>
                                <input type="text" class="form-control" id="dato" 
                                    wire:model="dato">
                            </div>
                        </section>

                        <!-- Paso 2 -->
                        <h4>Información Estatica</h4>
                        <section>
                        </section>

                        <!-- Paso 3 -->
                        <h4>Información Inventario</h4>
                        <section>
                        </section>
                    </form>

                </div>
                <div class="modal-footer">
                  
                    <button class="btn btn-outline-secondary" id="btnAnterior">
                        Anterior
                    </button>
                    <button class="btn btn-info" id="btnSiguiente">
                        Siguiente
                    </button>
                    <button class="btn btn-info" id="btnFinalizar"  wire:click="save">
                        Guardar
                    </button>
                </div>
                <style>
                    .wizard>.actions {
                        display: none !important;
                        /* Oculta los botones predeterminados */
                    }
                </style>

            </div>
        </div>
    </div>
</div>
@push('js')
    <script src="{{ asset('/assets/custom/steps/jquery.steps.min.js') }}"></script>
    <script src="{{ asset('/assets/custom/jquery-validate/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('/assets/custom/jquery-validate/localization/messages_es.min.js') }}"></script>
    <script>
$(document).ready(function() {
    Livewire.on('modalOpen', function(value) {
        $('#userModal').modal('show');
        $('#btnAnterior').hide(); 
        $('#btnFinalizar').hide(); 
    });

    $('#btnSiguiente').on('click', function() {
        $("#productForm").steps('next');
        $('#btnCerrar').hide();
    });

    $('#btnAnterior').on('click', function() {
        $("#productForm").steps('previous');
    });

    var form = $('#productForm');

    form.steps({
        headerTag: 'h4',
        bodyTag: 'section',
        labels: {
            finish: "Terminar",
            next: "Siguiente",
            previous: "Anterior",
            loading: "Cargando ..."
        },
        transitionEffect: 'slideLeft',
        onStepChanging: function(event, currentIndex, newIndex) {
            return true;
        },
        onStepChanged: function(event, currentIndex, priorIndex) {
            var totalSteps = $(this).find('.steps ul li').length;
            var isLastStep = currentIndex === totalSteps - 1;
            if (currentIndex === 0) {
                $('#btnAnterior').hide();
               
            } else {
                $('#btnAnterior').show();
              
            }
            if (isLastStep) {
                $('#btnSiguiente').hide();
                $('#btnFinalizar').show();
            } else {
                $('#btnSiguiente').show();
                $('#btnFinalizar').hide();
            }
        },
        onFinishing: function(event, currentIndex) {
            return true; // Permitir la finalización del formulario sin validación
        },
        onFinished: function(event, currentIndex) {
            // Realizar acciones después de que se haya completado el formulario
            
        }
    });
});

    </script>
@endpush
