
        <div class="container my-auto">
            <div class="row">
                <div class="col-lg-4 col-md-8 col-12 mx-auto">
                    <div class="card z-index-0 fadeIn3 fadeInBottom">
                        <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                            <div class="bg-gradient-info shadow-info border-radius-lg py-3 pe-1">
                                <h4 class="text-white font-weight-bolder text-center mt-2 mb-0">Cambia tu contraseña
                                </h4>
                            </div>
                        </div>
                        <div class="card-body">
                            @if (Session::has('email'))
                            <div class="alert alert-danger alert-dismissible text-white" role="alert">
                                <span class="text-sm">{{ Session::get('email') }}</span>
                                <button type="button" class="btn-close text-lg py-3 opacity-10" data-bs-dismiss="alert"
                                    aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            @endif
                            <form wire:submit.prevent="update" class="text-start">

                                <div
                                    class="input-group input-group-outline mt-3 @if(strlen($email ?? '') > 0) is-filled @endif">
                                    <label class="form-label">Correo</label>
                                    <input wire:model="email" type="email" class="form-control">
                                </div>
                                @error('email')
                                <p class='text-danger inputerror'>{{ $message }} </p>
                                @enderror

                                <div
                                    class="input-group input-group-outline mt-3 @if(strlen($password ?? '') > 0) is-filled @endif">
                                    <label class="form-label">Nueva contraseña</label>
                                    <input wire:model="password" type="password" class="form-control">
                                </div>
                                @error('password')
                                <p class='text-danger inputerror'>{{ $message }} </p>
                                @enderror

                                <div
                                    class="input-group input-group-outline mt-3 @if(strlen($passwordConfirmation ?? '') > 0) is-filled @endif">
                                    <label class="form-label">Confirma contraseña</label>
                                    <input wire:model="passwordConfirmation" type="password" class="form-control">
                                </div>
                                @error('password_confirmation')
                                <p class='text-danger inputerror'>{{ $message }} </p>
                                @enderror
                                <div class="text-center">
                                    <button type="submit" class="btn bg-gradient-info w-100 my-4 mb-2">Cambiar contraseña</button>
                                </div>
                               
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        