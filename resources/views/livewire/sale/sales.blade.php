<div class="">
    <!-- Navbar -->
    <!-- End Navbar -->
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card m-2">
                    <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                        <div class="bg-gradient-info shadow-info border-radius-lg pt-4 pb-3">
                            <h6 class="text-white ps-3">Captura de Ventas</h6>
                        </div>
                    </div>
                    <div class="m-4">
                        <form>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-control my-3" wire:ignore>
                                        <label class="form-label">SKU</label>
                                        <select class="form-select" id="skuSelect" aria-label="Ingrese el SKU"
                                            wire:model="productId">
                                            <option value="">Ingrese el SKU</option>
                                            @foreach ($listProducts as $product)
                                                <option value="{{ $product->id }}">{{ $product->sku }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-control my-3">
                                        <label class="form-label">Nombre</label>
                                        <input type="text" class="form-control" id="productName" disabled
                                            wire:model="name">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-control my-3">
                                        <label class="form-label">Precio</label>
                                        <input type="text" class="form-control" id="price" disabled
                                            wire:model="price">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="input-group input-group-static my-4">
                                        <label>Cantidad</label>
                                        <input type="text" class="form-control" id="quantity"
                                            wire:model.defer="quantity">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-control my-3">
                                        <label class="form-label">Total</label>
                                        <input type="text" class="form-control" id="total" disabled
                                            wire:model="total">
                                    </div>
                                </div>
                            </div>
                            <div style="height: 400px; overflow-y: auto;">
                                <livewire:sale.detail-table theme="bootstrap-5" />
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <button type="button" class="btn btn-success w-100 my-3"
                                        onclick="confirmSale()">Confirmar Venta</button>
                                </div>
                                <div class="col-md-6">
                                    <button type="button" class="btn btn-danger w-100 my-3"
                                        onclick="cancelSale()">Cancelar</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@push('js')
    <script>
        $(document).ready(function() {
            $('#skuSelect').select2({
                theme: "classic",
                placeholder: "Ingrese el SKU",
                width: '100%',
                minimumResultsForSearch: 20,
                minimumInputLength: 3,
                language: "es"
            });

            $('#skuSelect').on('change', function() {

                var selectedValue = $(this).val();

                // Llama a Livewire y pasa el valor seleccionado a través de un evento personalizado
                Livewire.emit('productSelected', selectedValue);
            });

            const quantityElement = document.getElementById('quantity');
            const priceElement = document.getElementById('price');
            const totalElement = document.getElementById('total');

            const quantityMaskOptions = {
                mask: Number,
                min: 0,
                max: 9999,
                thousandsSeparator: ','
            };

            const currencyMaskOptions = {
                mask: '$num',
                blocks: {
                    num: {
                        mask: Number,
                        thousandsSeparator: ',',
                        radix: '.',
                        scale: 2,
                        signed: false,
                        normalizeZeros: true,
                        padFractionalZeros: true
                    }
                }
            };

            const quantityMask = IMask(quantityElement, quantityMaskOptions);
            quantityMask.updateValue(quantityElement.value);

            const priceMask = IMask(priceElement, currencyMaskOptions);
            priceMask.updateValue(priceElement.value);

            const totalMask = IMask(totalElement, currencyMaskOptions);
            totalMask.updateValue(totalElement.value);

            $('#quantity, #price').on('change keyup', function() {
                const price = parseFloat(priceMask.unmaskedValue);
                const quantity = parseFloat(quantityMask.unmaskedValue);
                const total = price * quantity;

                if (!isNaN(total)) {
                    totalMask.value = total.toFixed(2);
                } else {
                    totalMask.value = '';
                }
            });

            Livewire.hook('message.processed', (message, component) => {
                if (document.getElementById('quantity')) {
                    quantityMask.updateValue();
                    priceMask.updateValue();
                    totalMask.updateValue();
                }
            });
        });
        
    </script>
@endpush
