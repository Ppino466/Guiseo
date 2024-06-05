<div class="row">
    <div class="col-xl-4 col-sm-6 mb-xl-0 mb-4">
        <div class="card">
            <div class="card-header p-3 pt-2">
                <div
                    class="icon icon-lg icon-shape bg-gradient-dark shadow-dark text-center border-radius-xl mt-n4 position-absolute">
                    <i class="material-icons opacity-10">paid</i>
                </div>
                <div class="text-end pt-1">
                    <p class="text-sm mb-0 text-capitalize">Ingreso del día (<span class="font-weight-bolder">{{$day}}</span>) </p>
                    <h4 class="mb-0">${{number_format($salesDay,2)}}</h4>
                </div>
            </div>
            <hr class="dark horizontal my-0">
            <div class="card-footer p-3">
                <p class="mb-0">
                    <span class="text-{{ $dayDifference > 0 ? 'success' : 'danger' }} text-sm font-weight-bolder px-2">
                        {{ number_format($dayDifference, 2) }}%
                    </span>
                    Diferencia de ventas del día anterior
                </p>
            </div>
        </div>
    </div>
      <div class="col-xl-4 col-sm-6 mb-xl-0 mb-4">
          <div class="card">
              <div class="card-header p-3 pt-2">
                  <div
                      class="icon icon-lg icon-shape bg-gradient-success shadow-success text-center border-radius-xl mt-n4 position-absolute">
                      <i class="material-icons opacity-10">wallet</i>
                  </div>
                  <div class="text-end pt-1">
                      <p class="text-sm mb-0 text-capitalize">Ingreso del mes (<span class="font-weight-bolder">{{$month}}</span>) </p>
                      <h4 class="mb-0">${{ number_format($salesMonth, 2) }}</h4>
                  </div>
              </div>
              <hr class="dark horizontal my-0">
              <div class="card-footer p-3">
                <p class="mb-0">
                    <span class="text-{{ $monthDifference > 0 ? 'success' : 'danger' }} text-sm font-weight-bolder px-2">
                        {{ number_format($monthDifference, 2) }}%
                    </span>
                    Diferencia de ventas del mes anterior
                </p>
            </div>
          </div>
      </div>
      <div class="col-xl-4 col-sm-6">
        <div class="card">
            <div class="card-header p-3 pt-2">
                <div
                    class="icon icon-lg icon-shape bg-gradient-info shadow-info text-center border-radius-xl mt-n4 position-absolute">
                    <i class="material-icons opacity-10">book</i>
                </div>
                <div class="text-end pt-1">
                    <p class="text-sm mb-0 text-capitalize">Ticket promedio</p>
                    <h4 class="mb-0">${{ number_format($averageTicket, 2) }}</h4>
                </div>
            </div>
            <hr class="dark horizontal my-0">
            <div class="card-footer p-3">
                <p class="mb-0"><span class="text-info text-sm font-weight-bolder px-2">{{ number_format($productsTicket) }}</span>Productos promedio</p>
            </div>
        </div>
    </div>
  </div>