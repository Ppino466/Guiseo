<div class="modal-dialog modal-lg modal-dialog-centered" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title font-weight-normal" id="userModalLabel">Editar Meta</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <div class="row">
                <div class="col-md-6 my-3" >
                    <label class="form-label">Empleado</label>
                    <div class="mb-3 input-group input-group-static">
                        <input type="text" id="userId" wire:model="userId" class="form-control" disabled>
                    </div>
                    @error('userId')
                        <p class='text-danger inputerror'>{{ $message }}</p>
                    @enderror
                </div>
                <div class="col-md-6">
                    <label for="type" class="form-label">Fecha Inico</label>
                    <div class="mb-3 input-group input-group-static">
                        <input type="text" id="dateInit" wire:model.defer="startDate" class="form-control ">
                    </div>
                </div>
                
            </div>
            <div class="row">
                <div class="col-md-6">
                    <label for="type" class="form-label">Tipo</label>
                    <div class="input-group input-group-static mb-4">
                        <select class="form-control" id="type" name="type" wire:model.defer="type">
                            <option value="Quincena">Quincena</option>
                            <option value="Mensual">Mensual</option>
                            <option value="Cuatrimestral">Cuatrimestral</option>
                        </select>
                        @error('type')
                            <p class='text-danger inputerror'>{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="col-md-6">
                    <label for="type" class="form-label">Fecha Fin</label>
                    <div class="mb-3 input-group input-group-static">
                        <input type="text" id="dateFinish" wire:model.defer="endDate" class="form-control" disabled>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <label for="amount" class="form-label">Monto</label>
                    <div class="mb-3 input-group input-group-static">
                        <input type="text" class="form-control" id="amount" name="amount"
                            placeholder="Ingresa el nonto" wire:model="amount" >
                        @error('amount')
                            <p class='text-danger inputerror'>{{ $message }}</p>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <label for="type" class="form-label">Descripción</label>
                    <div class="input-group input-group-dynamic">
                        <textarea class="form-control" rows="2" wire:model.defer="description" placeholder="Se breve..."
                            spellcheck="false"></textarea>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cerrar</button>
            <button type="button" class="btn btn-success" wire:click="updateGoal" wire:loading.attr="disabled"
                wire:target="updateGoal">Guardar</button>
            <div wire:loading wire:target="updateGoal">
                Procesando...
            </div>
        </div>
    </div>
</div>
@push('js')
    <script>
        $(document).ready(function() {
          
            var dateInit = $("#dateInit").flatpickr({
                dateFormat: "Y-m-d",
                locale: "es",
                allowInput: true,
                minDate: "today",
                onClose: function(selectedDates) {
                    if (selectedDates.length > 0) {
                        updateEndDate();
                    }
                }
            });

            var dateFinish = $("#dateFinish").flatpickr({
                dateFormat: "Y-m-d",
                locale: "es",
                allowInput: true,
                minDate: "today",
            
            });

            dateFinish.set("minDate", "today");

            function updateEndDate() {
                var selectedDates = dateInit.selectedDates;
                if (selectedDates.length > 0) {
                    var startDate = selectedDates[0];
                    var endDate = new Date(startDate);
                    var type = $("#type").val(); 

                   
                    switch (type) {
                        case "Quincena":
                            endDate.setDate(endDate.getDate() + 15);
                            break;
                        case "Mensual":
                            endDate.setMonth(endDate.getMonth() + 1);
                            break;
                        case "Cuatrimestral":
                            endDate.setMonth(endDate.getMonth() + 4);
                            break;
                        default:
          
                        endDate.setDate(endDate.getDate() + 30);
                        break;
                    }

                    dateFinish.setDate(endDate);
                    dateFinish.set("minDate", startDate);
                }
            }

            $("#type").on("change", function() {
                updateEndDate();
            });

        });
    </script>
@endpush
