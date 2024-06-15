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
  
    <div class="modal fade" id="goalModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
      
        <livewire:goal.goal-modal />
    </div>
</div>
@push('js')
    <script>
        let mask;

         $(document).ready(function() {
                    Livewire.on('modalOpen', function(value) {
                        Livewire.emit('editGoal', value);
                $('#goalModal').modal('show');
            });

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
            mask.updateValue();

                // Hook de Livewire para actualizar la máscara después del procesamiento del mensaje
                Livewire.hook('message.processed', (message, component) => {
                if (document.getElementById('amount')) {
                    mask.updateValue();
                }
            });

        });
    </script>
@endpush