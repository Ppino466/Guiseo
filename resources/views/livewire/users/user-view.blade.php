<div class="">
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card m-2">
                    <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                        <div class="bg-gradient-info shadow-info border-radius-lg pt-4 pb-3">
                            <h6 class="text-white text-capitalize ps-3">Usuario</h6>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                               
                                        <label for="name" class="form-label">Nombre (s):</label>
                                        <input type="text" id="name" class="form-control"
                                            value="{{ $user['name'] }}" disabled>
                              
                                        <label for="last_name" class="form-label">Apellidos:</label>
                                        <input type="text" id="last_name" class="form-control"
                                            value="{{ $user['last_name'] }}" disabled>
                                 
                                        <label for="email" class="form-label">Correo:</label>
                                        <input type="email" id="email" class="form-control"
                                            value="{{ $user['email'] }}" disabled>
                            
                                        <label for="created_at" class="form-label">Fecha de registro:</label>
                                        <input type="text" id="created_at" class="form-control"
                                            value="{{ $user['created_at'] }}" disabled>
                             
                            </div>
                            <div class="col-md-6">
                              
                                        <label for="phone" class="form-label">Teléfono:</label>
                                        <input type="tel" id="phone" class="form-control"
                                            value="{{ $user['phone'] }}" disabled>
                                  
                                        <label for="location" class="form-label">Ubicación:</label>
                                        <input type="text" id="location" class="form-control"
                                            value="{{ $user['location'] }}" disabled>
                                 
                                        <label for="about" class="form-label">Puesto:</label>
                                        <input id="about" class="form-control" value="{{ $user['about'] }}"
                                            disabled>
                                 
                                        <label for="updated_at" class="form-label">Ultima Modificación:</label>
                                        <input type="text" id="updated_at" class="form-control"
                                            value="{{ $user['updated_at']->diffForHumans() }}" disabled>
                                  
                            </div>
                        </div>
                    </div>
                    <div class="card-footer d-flex justify-content-end">
                        <button class="btn btn-outline-danger" wire:click="confirmDelete">Eliminar Perfil</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@push('js')
    <script>
          $(document).ready(function() {
        Livewire.on('confirmDelete', function(value) {
            mostrarConfirmacion("¿Estás seguro?", "¡No podrás revertir esto!", () => {
                Livewire.emit('deleteUser');
                mostrarAlerta("¡Realizado!", "La cuenta se ha eliminado.", "success");
            });
        });

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
        }});

          // Función para mostrar una alerta de SweetAlert2
          function mostrarAlerta(titulo, mensaje, icono) {
                Swal.fire({
                    title: titulo,
                    text: mensaje,
                    icon: icono,
                    confirmButtonText: 'Ok'
                });
            }
    
    </script>
@endpush