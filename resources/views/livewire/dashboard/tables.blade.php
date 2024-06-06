<div class="row mb-4">
    <div class="col-lg-4 col-md-6 mb-md-0 mb-4">
        <div class="card">
            <div class="card-header pb-0">
                <div class="row">
                    <div class="col-lg-6 col-7">
                        <h6>Ventas por categoria</h6>
                        <p class="text-sm mb-0 text-capitalize">Mes en curso (<span class="font-weight-bolder">{{$month}}</span>) </p>
                    </div>
                    <div class="col-lg-6 col-5 my-auto text-end">
                        <a class="btn" wire:click="refreshData"><i class="material-icons opacity-10">update</i></a>
                    </div>
                </div>
            </div>
            <div class="card-body px-0 pb-2">
                <div class="table-responsive">
                    <table class="table align-items-center mb-0">
                        <thead>
                            <tr>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Categoria</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Ventas</th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Meta</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($totalSaleCategory as $category): ?>
                                <tr>
                                    <td>
                                        <div class="d-flex flex-column justify-content-center p-2">
                                            <h6 class="mb-0 text-sm"><?= htmlspecialchars($category->category_name) ?></h6>
                                        </div>
                                    </td>
                                    <td class="align-middle text-center text-sm">
                                        <span class="text-xs font-weight-bold"> $<?= number_format($category->total_sales, 2) ?></span>
                                    </td>
                                    <td class="align-middle">
                                        <div class="progress-wrapper w-75 mx-auto">
                                            <div class="progress-info">
                                                <div class="progress-percentage">
                                                    <span class="text-xs font-weight-bold"><?= number_format($category->percentage_achieved, 1) ?>%</span>
                                                </div>
                                            </div>
                                            <div class="progress">
                                                <div class="progress-bar bg-gradient-info" role="progressbar"
                                                     style="width: <?= min(100, number_format($category->percentage_achieved, 1)) ?>%"
                                                     aria-valuenow="<?= min(100, number_format($category->percentage_achieved, 1)) ?>"
                                                     aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
                
            </div>
        </div>
    </div>
    <div class="col-lg-4 col-md-6 mb-md-0 mb-4">
      <div class="card">
          <div class="card-header pb-0">
              <div class="row">
                  <div class="col-lg-6 col-7">
                      <h6>Ventas por empleado</h6>
                      <p class="text-sm mb-0 text-capitalize">Mes en curso (<span class="font-weight-bolder">{{$month}}</span>) </p>
                  </div>
                  <div class="col-lg-6 col-5 my-auto text-end">
                    <a class="btn" wire:click="refreshData"><i class="material-icons opacity-10">update</i></a>
                  </div>
              </div>
          </div>
          <div class="card-body px-0 pb-2">
            <div class="table-responsive">
                <table class="table align-items-center mb-0">
                    <thead>
                        <tr>
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Nombre</th>
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Ventas</th>
                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Meta</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($totalSaleUser as $sale)
                        <tr>
                            <td>
                                <div class="d-flex flex-column justify-content-center p-2">
                                    <h6 class="mb-0 text-sm">{{ $sale->user_name }}</h6>
                                </div>
                            </td>
                            <td class="align-middle text-center text-sm">
                                <span class="text-xs font-weight-bold"> ${{ number_format($sale->total_sales, 2) }} </span>
                            </td>
                            <td class="align-middle">
                                <div class="progress-wrapper w-75 mx-auto">
                                    <div class="progress-info">
                                        <div class="progress-percentage">
                                            <span class="text-xs font-weight-bold">{{ round($sale->percentage_achieved) }}%</span>
                                        </div>
                                    </div>
                                    <div class="progress">
                                        <div class="progress-bar bg-gradient-info" style="width: {{ round($sale->percentage_achieved) }}%"
                                            role="progressbar" aria-valuenow="{{ round($sale->percentage_achieved) }}" aria-valuemin="0"
                                            aria-valuemax="100"></div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            
          </div>
      </div>
  </div>
    <div class="col-lg-4 col-md-6" >
        <div class="card h-100">
            <div class="card-header pb-0">
                <div class="row">
                    <div class="col-lg-6 col-7">
                        <h6>Inventario</h6>
                        <p class="text-sm mb-0 text-capitalize">Mes en curso (<span class="font-weight-bolder">{{$month}}</span>) </p>
                    </div>
                    <div class="col-lg-6 col-5 my-auto text-end">
                        <a class="btn" wire:click="refreshData"><i class="material-icons opacity-10">update</i></a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="timeline timeline-one-side">
                    <div class="timeline-block mb-3">
                      <span class="timeline-step">
                          <i class="material-icons text-info text-gradient">archive</i>
                      </span>
                        <div class="timeline-content">
                            <h6 class="text-dark text-sm font-weight-bold mb-0">Niveles de inventario
                            </h6>
                            <p class="text-secondary font-weight-bold text-xs mt-1 mb-0">{{ number_format($inventoryLevel) }}
                            </p>
                        </div>
                    </div>
                    <div class="timeline-block mb-3">
                      <span class="timeline-step">
                          <i class="material-icons text-danger text-gradient">report_problem</i>
                      </span>
                      <div class="timeline-content">
                          <h6 class="text-dark text-sm font-weight-bold mb-0">Prodcutos sin stock</h6>
                          <p class="text-secondary font-weight-bold text-xs mt-1 mb-0">{{$alertsStock}}
                          </p>
                      </div>
                  </div>
                    <div class="timeline-block mb-3">
                      <span class="timeline-step">
                          <i class="material-icons text-success text-gradient">keyboard_arrow_up</i>
                      </span>
                        <div class="timeline-content">  
                          <h6 class="text-dark text-sm font-weight-bold mb-0">Producto más vendido</h6>
                            <p class="text-secondary font-weight-bold text-xs mt-1 mb-0">{{$mostSoldProduct}}
                            </p>
                        </div>
                    </div>
                    <div class="timeline-block mb-3">
                      <span class="timeline-step">
                          <i class="material-icons text-danger text-gradient">keyboard_arrow_down</i>
                      </span>  
                      <div class="timeline-content">
                            <h6 class="text-dark text-sm font-weight-bold mb-0">Producto menos vendido
                                </h6>
                            <p class="text-secondary font-weight-bold text-xs mt-1 mb-0">{{$leastSoldProduct}}
                            </p>
                        </div>
                    </div>
                    <div class="timeline-block mb-3">
                      <span class="timeline-step">
                          <i class="material-icons text-success text-gradient">attach_money</i>
                      </span>
                        <div class="timeline-content">
                            <h6 class="text-dark text-sm font-weight-bold mb-0">Valor del inventario</h6>
                            <p class="text-secondary font-weight-bold text-xs mt-1 mb-0">${{ number_format($totalInventoryCost, 2) }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>