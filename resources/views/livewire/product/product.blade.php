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
                        <livewire:product.product-table theme="bootstrap-5" />
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="userModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true" wire:ignore>
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    @if ($product)
                        <h5 class="modal-title font-weight-normal" id="userModalLabel">Editar producto</h5>
                    @else
                        <h5 class="modal-title font-weight-normal" id="userModalLabel">Registrar producto</h5>
                    @endif
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cerrar</button>
                    @if ($product)
                        <button type="button" class="btn btn-success" wire:click="updateUser"
                            wire:loading.attr="disabled" wire:target="updateUser">Guardar</button>
                        <div wire:loading wire:target="updateUser">
                            Procesando...
                        </div>
                    @else
                        <button type="button" class="btn btn-success" wire:click="saveUser"
                            wire:loading.attr="disabled" wire:target="saveUser">Guardar</button>
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
         $(document).ready(function() {
                    Livewire.on('modalOpen', function(value) {
                // Livewire.emit('editUser', value);
                $('#userModal').modal('show');
            });
        });
    </script>
@endpush