<div class="container my-auto mt-5">
    <div class="row signin-margin">
        <div class="col-lg-4 col-md-8 col-12 mx-auto">
            <div class="card ">
                <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                    <div class="bg-gradient-info shadow-info  py-3 pe-1" style="border-radius: 10px">
                        <h4 class="text-white font-weight-bolder text-center mt-2 mb-0">Iniciar Sesión</h4>

                    </div>
                </div>
                <div class="card-body">
                    <form wire:submit.prevent='store'>
                        @if (Session::has('status'))
                            <div class="alert alert-success alert-dismissible text-white" role="alert">
                                <span class="text-sm">{{ Session::get('status') }}</span>
                                <button type="button" class="btn-close text-lg py-3 opacity-10" data-bs-dismiss="alert"
                                    aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endif
                        <div
                            class="input-group input-group-static mt-3 @if (strlen($email ?? '') > 0) is-filled @endif">
                            <label >Correo</label>
                            <input wire:model='email' type="email" class="form-control">
                        </div>
                        @error('email')
                            <p class='text-danger inputerror'>{{ $message }} </p>
                        @enderror

                        <div
                            class="input-group input-group-static mt-3 @if (strlen($password ?? '') > 0) is-filled @endif">
                            <label >Contraseña</label>
                            <input wire:model="password" type="password" class="form-control">
                        </div>
                        @error('password')
                            <p class='text-danger inputerror'>{{ $message }} </p>
                        @enderror
                        {{-- <div class="form-check form-switch d-flex align-items-center my-3">
                            <input class="form-check-input" type="checkbox" id="rememberMe" wire:model="remember">
                            <label class="form-check-label mb-0 ms-2" for="rememberMe">Recordarme
                            </label>
                        </div> --}}
                        <div class="text-center">
                            <button type="submit" class="btn bg-gradient-info w-100 my-4 mb-2">Ingreso</button>
                        
                        <p class="text-sm text-center">
                            ¿Olvidaste tu contraseña? Restablecer su contraseña
                            <a href="{{ route('password.forgot') }}"
                                class="text-info text-gradient font-weight-bold">Aqui</a>
                        </p>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
