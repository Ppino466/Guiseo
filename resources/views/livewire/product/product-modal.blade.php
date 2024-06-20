<div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
        <div class="modal-header">
            @if ($productId)
                <h5 class="modal-title font-weight-normal" id="userModalLabel">Editar producto</h5>
            @else
                <h5 class="modal-title font-weight-normal" id="userModalLabel">Registrar producto</h5>
            @endif
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" >
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            {{-- STEP 1 --}}
            @if ($currentStep == 1)
                {{-- Paso 1 (datos proveedor) --}}
                <div class="row">
                    <div class="col-md-5 mx-auto">
                        <div class="form-control my-3">
                            <label class="form-label">Proveedor</label>
                            <select class="form-select" id="supplierSelect" aria-label="Seleccione un proveedor"
                                wire:model="supplierId" @if($productId) disabled @endif>
                                <option value="">Seleccione proveedor</option>
                                @foreach ($listSuppliers as $supplier)
                                    <option value="{{ $supplier->id }}">{{ $supplier->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        @error('supplierId')
                            <p class='text-danger inputerror'>{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            @endif

            {{-- STEP 2 --}}
            @if ($currentStep == 2)
                {{-- Paso 2 (datos estaticos) --}}
                <div class="row">
                    <div class="col-md-6">
                        <label for="productName" class="form-label">Nombre</label>
                        <div class="mb-3 input-group input-group-static">
                            <input type="text" class="form-control" id="name" name="name"
                                placeholder="Ingresa nombre del producto" wire:model.defer="name">
                            @error('name')
                                <p class='text-danger inputerror'>{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label for="description" class="form-label">Descripción</label>
                        <div class="mb-3 input-group input-group-static">
                            <input type="text" class="form-control" id="description" name="description"
                                placeholder="Ingresa descripción del producto" wire:model.defer="description">
                            @error('description')
                                <p class='text-danger inputerror'>{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <label for="price" class="form-label">Precio</label>
                        <div class="mb-3 input-group input-group-static">
                            <input type="number" class="form-control" id="price" name="price"
                                placeholder="Ingresa precio del producto" wire:model.defer="price">
                            @error('price')
                                <p class='text-danger inputerror'>{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Categoria</label>
                        <select class="form-select" id="categorySelect" aria-label="Seleccione una categoria"
                            wire:model="categoryId">
                            <option value="">Seleccione una categoria</option>
                            @foreach ($listCategories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                        @error('categoryId')
                            <p class='text-danger inputerror'>{{ $message }}</p>
                        @enderror
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <label for="sku" class="form-label">SKU</label>
                        <div class="mb-3 input-group input-group-static">
                            <input type="text" class="form-control" id="sku" name="sku"
                                placeholder="Ingresa SKU del producto" wire:model.defer="sku">
                            @error('sku')
                                <p class='text-danger inputerror'>{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label for="image" class="form-label">Imagen</label>
                        <div class="mb-3 input-group input-group-static">
                            {{-- <input type="text" class="form-control" id="image" name="image"
                                placeholder="Ingresa imagen del producto" wire:model.defer="image"> --}}
                                <input type="file" class="form-control" id="image" name="image" wire:model.defer="image">
                            @error('image')
                                <p class='text-danger inputerror'>{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>
            @endif

            {{-- STEP 3 --}}
            @if ($currentStep == 3)
                {{-- Paso 3 (datos inventario) --}}
                <div class="row">
                    <div class="col-md-4">
                        <label for="productLocation" class="form-label">Locación</label>
                        <div class="mb-3 input-group input-group-static">
                            <input type="text" class="form-control" id="location" name="location"
                                placeholder="Ingrese locación del producto" wire:model.defer="location">
                            @error('location')
                                <p class='text-danger inputerror'>{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-4">
                        <label for="quantity" class="form-label">Cantidad</label>
                        <div class="mb-3 input-group input-group-static">
                            <input type="number" class="form-control" id="quantity" name="quantity"
                                placeholder="Ingresa cantidad del producto" wire:model.defer="quantity">
                            @error('quantity')
                                <p class='text-danger inputerror'>{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-4">
                        <label for="entryDate" class="form-label">Fecha de entrada</label>
                        <div class="mb-3 input-group input-group-static">
                            <input type="date" class="form-control" id="entryDate" name="entryDate"
                                placeholder="Ingresa fecha" wire:model.defer="entryDate">
                            @error('entryDate')
                                <p class='text-danger inputerror'>{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <label for="minQuantity" class="form-label">Cantidad mínima</label>
                        <div class="mb-3 input-group input-group-static">
                            <input type="number" class="form-control" id="minQuantity" name="minQuantity"
                                placeholder="Ingrese cantidad mínima del producto" wire:model.defer="minQuantity">
                            @error('minQuantity')
                                <p class='text-danger inputerror'>{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-4">
                        <label for="maxQuantity" class="form-label">Cantidad máxima</label>
                        <div class="mb-3 input-group input-group-static">
                            <input type="number" class="form-control" id="maxQuantity" name="maxQuantity"
                                placeholder="Ingresa cantidad máxima del producto" wire:model.defer="maxQuantity">
                            @error('maxQuantity')
                                <p class='text-danger inputerror'>{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Estado</label>
                        <select class="form-select" id="statusSelect" aria-label="Seleccione un estado"
                            wire:model="status">
                            <option value="">Seleccione un estado</option>
                            <option value="active">Activo</option>
                            <option value="inactive">Inactivo</option>
                            <option value="pending_restock">Restock pendiente</option>
                        </select>
                        @error('status')
                            <p class='text-danger inputerror'>{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            @endif
        </div>

        <div class="modal-footer">
            @if ($currentStep == 1)
                <button type="button" class="btn btn-success" wire:click="increaseStep()">Next</button>
            @endif

            @if ($currentStep == 2)
                <button type="button" class="btn btn-outline-secondary" wire:click="decreaseStep()">Back</button>
                <button type="button" class="btn btn-success" wire:click="increaseStep()">Next</button>
            @endif

            @if ($currentStep == 3)
                <button type="button" class="btn btn-outline-secondary" wire:click="decreaseStep()">Back</button>
                <button type="submit" class="btn btn-info" wire:click="saveOrUpdateProduct()">Guardar</button>
            @endif
        </div>
    </div>
</div>
