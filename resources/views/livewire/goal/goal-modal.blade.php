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
                <div class="col-md-6 my-3" wire:ignore>
                    <label class="form-label">Empleado</label>
                    <select class="form-select" id="userSelect" aria-label="Buscar..." wire:model="user_id">
                        <option value="">Selecciona al empleado</option>
                        @foreach ($listUser as $user)
                            <option value="{{ $user->id }}">{{ $user->name }}</option>
                        @endforeach
                    </select>
                    @error('user_id')
                        <p class='text-danger inputerror'>{{ $message }}</p>
                    @enderror
                </div>
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

            </div>
            <div class="row">
                <div class="col-md-6">
                    <label for="type" class="form-label">Fecha Inico</label>
                    <div class="mb-3 input-group input-group-static">
                        <input type="text" id="dateInit" class="form-control ">
                    </div>
                </div>
                <div class="col-md-6">
                    <label for="type" class="form-label">Fecha Fin</label>
                    <div class="mb-3 input-group input-group-static">
                        <input type="text" id="dateFinish" class="form-control ">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6" wire:ignore>
                    <label for="amount" class="form-label">Monto</label>
                    <div class="mb-3 input-group input-group-static">
                        <input type="text" class="form-control" id="amount" name="amount"
                            placeholder="Ingresa el nonto" wire:model.defer="amount" maxlength="10">
                        @error('amount')
                            <p class='text-danger inputerror'>{{ $message }}</p>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <label for="type" class="form-label">Descripción</label>
                    <div class="input-group input-group-dynamic">
                        <textarea class="form-control" rows="2" placeholder="Se breve..."
                            spellcheck="false"></textarea>
                    </div>
                </div>

            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cerrar</button>
            <button type="button" class="btn btn-success" wire:click="saveOrUpdateSuplier" wire:loading.attr="disabled"
                wire:target="saveOrUpdateSuplier">Guardar</button>
            <div wire:loading wire:target="saveOrUpdateSuplier">
                Procesando...
            </div>
        </div>
    </div>
</div>
@push('js')
    <script>
        $(document).ready(function() {

            $('#userSelect').select2({
                placeholder: "Buscar...",
                width: '100%',
                minimumResultsForSearch: 20,
                minimumInputLength: 3,
                language: "es",
                dropdownParent: $('#goalModal')
            });

          

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
