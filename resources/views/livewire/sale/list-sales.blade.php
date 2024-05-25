<div class="">
    <!-- Navbar -->
    <!-- End Navbar -->
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card m-2">
                    <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                        <div class="bg-gradient-info shadow-info border-radius-lg pt-4 pb-3">
                            <h6 class="text-white ps-3">Lista de Ventas</h6>
                        </div>
                        <div class="my-3">
                        <livewire:sale.sales-table theme="bootstrap-5" />
                    </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="userModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content">
            <div class="modal-header">
              <h1 class="modal-title fs-5" id="staticBackdropLabel">Detalle Venta</h1>
              @if ($latestDate)
            <p class="card-text">Fecha: {{ \Carbon\Carbon::parse($latestDate)->format('d/m/Y H:i') }}</p>
        @else
            <p class="card-text">No se encontraron detalles de ventas recientes.</p>
        @endif
            </div>
            <div class="modal-body">
                <table class="table table-striped">
                    <thead>
                      <tr>
                        <th scope="col">Producto</th>
                        <th scope="col">Cantidad</th>
                        <th scope="col">Precio unitario</th>
                        <th scope="col">Total</th>
                      </tr>
                    </thead>
                    <tbody>
                      @forelse ($data as $item)
                      <tr>
                       
                        <td>{{ $item->product->name }}</td> 
                        <td>{{ $item->quantity }}</td>
                        <td>{{ '$' . number_format($item->unit_price, 2) }}</td> 
                        <td>{{ '$' . number_format($item->quantity * $item->unit_price, 2) }}</td> 
                      </tr>
                      @empty
                      <tr>
                        <td colspan="4">No hay detalles.</td>
                      </tr>
                      @endforelse
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="3" class="text-end"><strong>Total de la Venta:</strong></td>
                            <td><strong>{{ '$' . number_format($totalSale, 2) }}</strong></td> <!-- Mostrar el total de la venta -->
                        </tr>
                    </tfoot>
                  </table>
            </div>
            <div class="modal-footer d-flex justify-content-between">
                <div>
                    @if ($userName)
                        <p class="card-text mb-0">Vendido por: {{ $userName }}</p>
                    @else
                        <p class="card-text mb-0">No se encontró el nombre del usuario.</p>
                    @endif
                </div>
                <div>
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-success">
                        <i class="material-icons opacity-10">file_download</i>
                    </button>
                </div>
            </div>
            
          </div>
        </div>
      </div>
</div>
@push('js')
    <script>
          $(document).ready(function() {
            Livewire.on('modalOpen', function(value) {
              Livewire.emit('showDetail', value);
              
            });

            Livewire.on('ok', function(value) {
            
                $('#userModal').modal('show');
            });
          });
    </script>
@endpush