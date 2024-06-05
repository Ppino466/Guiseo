<div>
      <!-- Navbar -->
      <!-- End Navbar -->
       <div class="container-fluid py-4">
          <div class="row">
            <div class="col-xl-4 col-sm-6 mb-xl-0 mb-4">
                <div class="card">
                    <div class="card-header p-3 pt-2">
                        <div
                            class="icon icon-lg icon-shape bg-gradient-dark shadow-dark text-center border-radius-xl mt-n4 position-absolute">
                            <i class="material-icons opacity-10">paid</i>
                        </div>
                        <div class="text-end pt-1">
                            <p class="text-sm mb-0 text-capitalize">Ingreso del día (<span class="font-weight-bolder">05/06/2024</span>) </p>
                            <h4 class="mb-0">$53,000</h4>
                        </div>
                    </div>
                    <hr class="dark horizontal my-0">
                    <div class="card-footer p-3">
                        <p class="mb-0"><span class="text-success text-sm font-weight-bolder">+55% </span>Al día del anterior</p>
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
                              <p class="text-sm mb-0 text-capitalize">Ingreso del mes (<span class="font-weight-bolder">Junio</span>) </p>
                              <h4 class="mb-0">$3,462.00</h4>
                          </div>
                      </div>
                      <hr class="dark horizontal my-0">
                      <div class="card-footer p-3">
                          <p class="mb-0"><span class="text-danger text-sm font-weight-bolder px-2">-2%</span>Que el mes pasado</p>
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
                            <h4 class="mb-0">$1,200.00</h4>
                        </div>
                    </div>
                    <hr class="dark horizontal my-0">
                    <div class="card-footer p-3">
                        <p class="mb-0"><span class="text-success text-sm font-weight-bolder px-2">5</span>Productos promedio</p>
                    </div>
                </div>
            </div>
          </div>
          <div class="row mt-4">
              <div class="col-lg-6 col-md-6 mt-4 mb-4">
                  <div class="card z-index-2  ">
                      <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2 bg-transparent">
                          <div class="bg-gradient-success shadow-success border-radius-lg py-3 pe-1">
                              <div class="chart">
                                  <canvas id="chart-line" class="chart-canvas" height="170"></canvas>
                              </div>
                          </div>
                      </div>
                      <div class="card-body">
                          <h6 class="mb-0 "> Ingresos por meses</h6>
                          <hr class="dark horizontal">
                          <div class="d-flex ">
                              <i class="material-icons text-sm my-auto me-1">assignment</i>
                              <p class="mb-0 text-sm">Acumulado de ventas del año actual: </p>
                          </div>
                      </div>
                  </div>
              </div>
              <div class="col-lg-6 mt-4 mb-3">
                  <div class="card z-index-2 ">
                      <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2 bg-transparent">
                          <div class="bg-gradient-info shadow-info border-radius-lg py-3 pe-1">
                              <div class="chart">
                                  <canvas id="chart-line-tasks" class="chart-canvas" height="170"></canvas>
                              </div>
                          </div>
                      </div>
                      <div class="card-body">
                          <h6 class="mb-0 ">Ingresos por día</h6>
                          <hr class="dark horizontal">
                          <div class="d-flex ">
                              <i class="material-icons text-sm my-auto me-1">assignment</i>
                              <p class="mb-0 text-sm">Acumulado de ventas del semana actual:</p>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
          <div class="row mb-4">
              <div class="col-lg-4 col-md-6 mb-md-0 mb-4">
                  <div class="card">
                      <div class="card-header pb-0">
                          <div class="row">
                              <div class="col-lg-6 col-7">
                                  <h6>Ventas por categoria</h6>
                                  <p class="text-sm mb-0 text-capitalize">Mes en curso (<span class="font-weight-bolder">Junio</span>) </p>
                              </div>
                              <div class="col-lg-6 col-5 my-auto text-end">
                                  <div class="dropdown float-lg-end pe-4">
                                      <a class="cursor-pointer" id="dropdownTable" data-bs-toggle="dropdown"
                                          aria-expanded="false">
                                          <i class="fa fa-ellipsis-v text-secondary"></i>
                                      </a>
                                      <ul class="dropdown-menu px-2 py-3 ms-sm-n4 ms-n5"
                                          aria-labelledby="dropdownTable">
                                          <li><a class="dropdown-item border-radius-md" href="javascript:;">Exportar</a>
                                          </li>
                                          <li><a class="dropdown-item border-radius-md" href="javascript:;">Actualizar</a>
                                          </li>
                                      </ul>
                                  </div>
                              </div>
                          </div>
                      </div>
                      <div class="card-body px-0 pb-2">
                          <div class="table-responsive">
                              <table class="table align-items-center mb-0">
                                  <thead>
                                      <tr>
                                          <th
                                              class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                              Categoria</th>
                                          <th
                                              class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                              Ingresos</th>
                                          <th
                                              class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                              Meta</th>
                                      </tr>
                                  </thead>
                                  <tbody>
                                      <tr>
                                          <td>                                          
                                            <div class="d-flex flex-column justify-content-center p-2">
                                                      <h6 class="mb-0 text-sm">Categoria 1</h6>
                                            </div>                                           
                                          </td>
                                          <td class="align-middle text-center text-sm">
                                              <span class="text-xs font-weight-bold"> $14,000 </span>
                                          </td>
                                          <td class="align-middle">
                                              <div class="progress-wrapper w-75 mx-auto">
                                                  <div class="progress-info">
                                                      <div class="progress-percentage">
                                                          <span class="text-xs font-weight-bold">10%</span>
                                                      </div>
                                                  </div>
                                                  <div class="progress">
                                                      <div class="progress-bar bg-gradient-info w-10"
                                                          role="progressbar" aria-valuenow="10" aria-valuemin="0"
                                                          aria-valuemax="100"></div>
                                                  </div>
                                              </div>
                                          </td>
                                      </tr>
                                      <tr>
                                          <td>
                                            <div class="d-flex flex-column justify-content-center p-2">
                                                <h6 class="mb-0 text-sm">Categoria 1</h6>
                                      </div>   
                                          </td>
                                          <td class="align-middle text-center text-sm">
                                              <span class="text-xs font-weight-bold"> $3,000 </span>
                                          </td>
                                          <td class="align-middle">
                                              <div class="progress-wrapper w-75 mx-auto">
                                                  <div class="progress-info">
                                                      <div class="progress-percentage">
                                                          <span class="text-xs font-weight-bold">10%</span>
                                                      </div>
                                                  </div>
                                                  <div class="progress">
                                                      <div class="progress-bar bg-gradient-info w-10"
                                                          role="progressbar" aria-valuenow="10" aria-valuemin="0"
                                                          aria-valuemax="100"></div>
                                                  </div>
                                              </div>
                                          </td>
                                      </tr>
                                      <tr>
                                          <td>
                                            <div class="d-flex flex-column justify-content-center p-2">
                                                <h6 class="mb-0 text-sm">Categoria 2</h6>
                                      </div>   
                                          </td>
                                          <td class="align-middle text-center text-sm">
                                              <span class="text-xs font-weight-bold"> Not set </span>
                                          </td>
                                          <td class="align-middle">
                                              <div class="progress-wrapper w-75 mx-auto">
                                                  <div class="progress-info">
                                                      <div class="progress-percentage">
                                                          <span class="text-xs font-weight-bold">100%</span>
                                                      </div>
                                                  </div>
                                                  <div class="progress">
                                                      <div class="progress-bar bg-gradient-success w-100"
                                                          role="progressbar" aria-valuenow="100" aria-valuemin="0"
                                                          aria-valuemax="100"></div>
                                                  </div>
                                              </div>
                                          </td>
                                      </tr>
                                      <tr>
                                          <td>
                                            <div class="d-flex flex-column justify-content-center p-2">
                                                <h6 class="mb-0 text-sm">Categoria 3</h6>
                                      </div>   
                                          </td>
                                          <td class="align-middle text-center text-sm">
                                              <span class="text-xs font-weight-bold"> $20,500 </span>
                                          </td>
                                          <td class="align-middle">
                                              <div class="progress-wrapper w-75 mx-auto">
                                                  <div class="progress-info">
                                                      <div class="progress-percentage">
                                                          <span class="text-xs font-weight-bold">100%</span>
                                                      </div>
                                                  </div>
                                                  <div class="progress">
                                                      <div class="progress-bar bg-gradient-success w-100"
                                                          role="progressbar" aria-valuenow="100" aria-valuemin="0"
                                                          aria-valuemax="100"></div>
                                                  </div>
                                              </div>
                                          </td>
                                      </tr>
                                      <tr>
                                          <td>
                                            <div class="d-flex flex-column justify-content-center p-2">
                                                <h6 class="mb-0 text-sm">Categoria 4</h6>
                                          </td>
                                          <td class="align-middle text-center text-sm">
                                              <span class="text-xs font-weight-bold"> $500 </span>
                                          </td>
                                          <td class="align-middle">
                                              <div class="progress-wrapper w-75 mx-auto">
                                                  <div class="progress-info">
                                                      <div class="progress-percentage">
                                                          <span class="text-xs font-weight-bold">25%</span>
                                                      </div>
                                                  </div>
                                                  <div class="progress">
                                                      <div class="progress-bar bg-gradient-info w-25"
                                                          role="progressbar" aria-valuenow="25" aria-valuemin="0"
                                                          aria-valuemax="25"></div>
                                                  </div>
                                              </div>
                                          </td>
                                      </tr>
                                      <tr>
                                          <td>
                                            <div class="d-flex flex-column justify-content-center p-2">
                                                <h6 class="mb-0 text-sm">Categoria 5</h6>
                                          </td>
                                          <td class="align-middle text-center text-sm">
                                              <span class="text-xs font-weight-bold"> $2,000 </span>
                                          </td>
                                          <td class="align-middle">
                                              <div class="progress-wrapper w-75 mx-auto">
                                                  <div class="progress-info">
                                                      <div class="progress-percentage">
                                                          <span class="text-xs font-weight-bold">40%</span>
                                                      </div>
                                                  </div>
                                                  <div class="progress">
                                                      <div class="progress-bar bg-gradient-info w-40"
                                                          role="progressbar" aria-valuenow="40" aria-valuemin="0"
                                                          aria-valuemax="40"></div>
                                                  </div>
                                              </div>
                                          </td>
                                      </tr>
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
                                <p class="text-sm mb-0 text-capitalize">Mes en curso (<span class="font-weight-bolder">Junio</span>) </p>
                            </div>
                            <div class="col-lg-6 col-5 my-auto text-end">
                                <div class="dropdown float-lg-end pe-4">
                                    <a class="cursor-pointer" id="dropdownTable" data-bs-toggle="dropdown"
                                        aria-expanded="false">
                                        <i class="fa fa-ellipsis-v text-secondary"></i>
                                    </a>
                                    <ul class="dropdown-menu px-2 py-3 ms-sm-n4 ms-n5"
                                        aria-labelledby="dropdownTable">
                                        <li><a class="dropdown-item border-radius-md" href="javascript:;">Exportar</a>
                                        </li>
                                        <li><a class="dropdown-item border-radius-md" href="javascript:;">Actualizar</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body px-0 pb-2">
                        <div class="table-responsive">
                            <table class="table align-items-center mb-0">
                                <thead>
                                    <tr>
                                        <th
                                            class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Nombre</th>
                                        <th
                                            class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                            Ventas</th>
                                        <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Meta</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>                                          
                                          <div class="d-flex flex-column justify-content-center p-2">
                                                    <h6 class="mb-0 text-sm">Empleado 1</h6>
                                          </div>                                           
                                        </td>
                                        <td class="align-middle text-center text-sm">
                                            <span class="text-xs font-weight-bold"> $14,000 </span>
                                        </td>
                                        <td class="align-middle">
                                            <div class="progress-wrapper w-75 mx-auto">
                                                <div class="progress-info">
                                                    <div class="progress-percentage">
                                                        <span class="text-xs font-weight-bold">10%</span>
                                                    </div>
                                                </div>
                                                <div class="progress">
                                                    <div class="progress-bar bg-gradient-info w-10"
                                                        role="progressbar" aria-valuenow="10" aria-valuemin="0"
                                                        aria-valuemax="100"></div>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                          <div class="d-flex flex-column justify-content-center p-2">
                                              <h6 class="mb-0 text-sm">Empleado 2</h6>
                                    </div>   
                                        </td>
                                        <td class="align-middle text-center text-sm">
                                            <span class="text-xs font-weight-bold"> $3,000 </span>
                                        </td>
                                        <td class="align-middle">
                                            <div class="progress-wrapper w-75 mx-auto">
                                                <div class="progress-info">
                                                    <div class="progress-percentage">
                                                        <span class="text-xs font-weight-bold">10%</span>
                                                    </div>
                                                </div>
                                                <div class="progress">
                                                    <div class="progress-bar bg-gradient-info w-10"
                                                        role="progressbar" aria-valuenow="10" aria-valuemin="0"
                                                        aria-valuemax="100"></div>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                          <div class="d-flex flex-column justify-content-center p-2">
                                              <h6 class="mb-0 text-sm">Empleado 3</h6>
                                    </div>   
                                        </td>
                                        <td class="align-middle text-center text-sm">
                                            <span class="text-xs font-weight-bold"> Not set </span>
                                        </td>
                                        <td class="align-middle">
                                            <div class="progress-wrapper w-75 mx-auto">
                                                <div class="progress-info">
                                                    <div class="progress-percentage">
                                                        <span class="text-xs font-weight-bold">100%</span>
                                                    </div>
                                                </div>
                                                <div class="progress">
                                                    <div class="progress-bar bg-gradient-success w-100"
                                                        role="progressbar" aria-valuenow="100" aria-valuemin="0"
                                                        aria-valuemax="100"></div>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                          <div class="d-flex flex-column justify-content-center p-2">
                                              <h6 class="mb-0 text-sm">Empleado 4</h6>
                                    </div>   
                                        </td>
                                        <td class="align-middle text-center text-sm">
                                            <span class="text-xs font-weight-bold"> $20,500 </span>
                                        </td>
                                        <td class="align-middle">
                                            <div class="progress-wrapper w-75 mx-auto">
                                                <div class="progress-info">
                                                    <div class="progress-percentage">
                                                        <span class="text-xs font-weight-bold">100%</span>
                                                    </div>
                                                </div>
                                                <div class="progress">
                                                    <div class="progress-bar bg-gradient-success w-100"
                                                        role="progressbar" aria-valuenow="100" aria-valuemin="0"
                                                        aria-valuemax="100"></div>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                          <div class="d-flex flex-column justify-content-center p-2">
                                              <h6 class="mb-0 text-sm">Empleado 5</h6>
                                        </td>
                                        <td class="align-middle text-center text-sm">
                                            <span class="text-xs font-weight-bold"> $500 </span>
                                        </td>
                                        <td class="align-middle">
                                            <div class="progress-wrapper w-75 mx-auto">
                                                <div class="progress-info">
                                                    <div class="progress-percentage">
                                                        <span class="text-xs font-weight-bold">25%</span>
                                                    </div>
                                                </div>
                                                <div class="progress">
                                                    <div class="progress-bar bg-gradient-info w-25"
                                                        role="progressbar" aria-valuenow="25" aria-valuemin="0"
                                                        aria-valuemax="25"></div>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                          <div class="d-flex flex-column justify-content-center p-2">
                                              <h6 class="mb-0 text-sm">Categoria 5</h6>
                                        </td>
                                        <td class="align-middle text-center text-sm">
                                            <span class="text-xs font-weight-bold"> $2,000 </span>
                                        </td>
                                        <td class="align-middle">
                                            <div class="progress-wrapper w-75 mx-auto">
                                                <div class="progress-info">
                                                    <div class="progress-percentage">
                                                        <span class="text-xs font-weight-bold">40%</span>
                                                    </div>
                                                </div>
                                                <div class="progress">
                                                    <div class="progress-bar bg-gradient-info w-40"
                                                        role="progressbar" aria-valuenow="40" aria-valuemin="0"
                                                        aria-valuemax="40"></div>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
              <div class="col-lg-4 col-md-6">
                  <div class="card h-100">
                      <div class="card-header pb-0">
                          <h6>Inventario</h6>
                          <p class="text-sm">
                              <span class="font-weight-bold">Datos generales</span>
                              <p class="text-sm mb-0 text-capitalize">Mes en curso (<span class="font-weight-bolder">Junio</span>) </p>
                          </p>
                      </div>
                      <div class="card-body p-3">
                          <div class="timeline timeline-one-side">
                              <div class="timeline-block mb-3">
                                <span class="timeline-step">
                                    <i class="material-icons text-info text-gradient">archive</i>
                                </span>
                                  <div class="timeline-content">
                                      <h6 class="text-dark text-sm font-weight-bold mb-0">Niveles de inventario
                                      </h6>
                                      <p class="text-secondary font-weight-bold text-xs mt-1 mb-0">150,200
                                      </p>
                                  </div>
                              </div>
                              <div class="timeline-block mb-3">
                                <span class="timeline-step">
                                    <i class="material-icons text-danger text-gradient">report_problem</i>
                                </span>
                                <div class="timeline-content">
                                    <h6 class="text-dark text-sm font-weight-bold mb-0">Prodcutos sin stock</h6>
                                    <p class="text-secondary font-weight-bold text-xs mt-1 mb-0">1
                                    </p>
                                </div>
                            </div>
                              <div class="timeline-block mb-3">
                                <span class="timeline-step">
                                    <i class="material-icons text-success text-gradient">keyboard_arrow_up</i>
                                </span>
                                  <div class="timeline-content">  
                                    <h6 class="text-dark text-sm font-weight-bold mb-0">Producto más vendido</h6>
                                      <p class="text-secondary font-weight-bold text-xs mt-1 mb-0">Product 1
                                      </p>
                                  </div>
                              </div>
                              <div class="timeline-block mb-3">
                                <span class="timeline-step">
                                    <i class="material-icons text-danger text-gradient">keyboard_arrow_down</i>
                                </span>  
                                <div class="timeline-content">
                                      <h6 class="text-dark text-sm font-weight-bold mb-0">Producto menos vendido
                                          April</h6>
                                      <p class="text-secondary font-weight-bold text-xs mt-1 mb-0">Producto 3
                                      </p>
                                  </div>
                              </div>
                              <div class="timeline-block mb-3">
                                <span class="timeline-step">
                                    <i class="material-icons text-success text-gradient">attach_money</i>
                                </span>
                                  <div class="timeline-content">
                                      <h6 class="text-dark text-sm font-weight-bold mb-0">Valor del inventario</h6>
                                      <p class="text-secondary font-weight-bold text-xs mt-1 mb-0">$1,150,000.00
                                      </p>
                                  </div>
                              </div>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
      </div> 
  </div>
  @push('js')
  <script src="{{ asset('assets') }}/js/plugins/chartjs.min.js"></script>
  <script>
      var ctx = document.getElementById("chart-line-tasks").getContext("2d");

      new Chart(ctx, {
          type: "bar",
          data: {
              labels: ["M", "T", "W", "T", "F", "S", "S"],
              datasets: [{
                  label: "Sales",
                  tension: 0.4,
                  borderWidth: 0,
                  borderRadius: 4,
                  borderSkipped: false,
                  backgroundColor: "rgba(255, 255, 255, .8)",
                  data: [50, 20, 10, 22, 50, 10, 40],
                  maxBarThickness: 6
              }, ],
          },
          options: {
              responsive: true,
              maintainAspectRatio: false,
              plugins: {
                  legend: {
                      display: false,
                  }
              },
              interaction: {
                  intersect: false,
                  mode: 'index',
              },
              scales: {
                  y: {
                      grid: {
                          drawBorder: false,
                          display: true,
                          drawOnChartArea: true,
                          drawTicks: false,
                          borderDash: [5, 5],
                          color: 'rgba(255, 255, 255, .2)'
                      },
                      ticks: {
                          suggestedMin: 0,
                          suggestedMax: 500,
                          beginAtZero: true,
                          padding: 10,
                          font: {
                              size: 14,
                              weight: 300,
                              family: "Roboto",
                              style: 'normal',
                              lineHeight: 2
                          },
                          color: "#fff"
                      },
                  },
                  x: {
                      grid: {
                          drawBorder: false,
                          display: true,
                          drawOnChartArea: true,
                          drawTicks: false,
                          borderDash: [5, 5],
                          color: 'rgba(255, 255, 255, .2)'
                      },
                      ticks: {
                          display: true,
                          color: '#f8f9fa',
                          padding: 10,
                          font: {
                              size: 14,
                              weight: 300,
                              family: "Roboto",
                              style: 'normal',
                              lineHeight: 2
                          },
                      }
                  },
              },
          },
      });


      var ctx2 = document.getElementById("chart-line").getContext("2d");

      new Chart(ctx2, {
          type: "line",
          data: {
              labels: ["Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
              datasets: [{
                  label: "Mobile apps",
                  tension: 0,
                  borderWidth: 0,
                  pointRadius: 5,
                  pointBackgroundColor: "rgba(255, 255, 255, .8)",
                  pointBorderColor: "transparent",
                  borderColor: "rgba(255, 255, 255, .8)",
                  borderColor: "rgba(255, 255, 255, .8)",
                  borderWidth: 4,
                  backgroundColor: "transparent",
                  fill: true,
                  data: [50, 40, 300, 320, 500, 350, 200, 230, 500],
                  maxBarThickness: 6

              }],
          },
          options: {
              responsive: true,
              maintainAspectRatio: false,
              plugins: {
                  legend: {
                      display: false,
                  }
              },
              interaction: {
                  intersect: false,
                  mode: 'index',
              },
              scales: {
                  y: {
                      grid: {
                          drawBorder: false,
                          display: true,
                          drawOnChartArea: true,
                          drawTicks: false,
                          borderDash: [5, 5],
                          color: 'rgba(255, 255, 255, .2)'
                      },
                      ticks: {
                          display: true,
                          color: '#f8f9fa',
                          padding: 10,
                          font: {
                              size: 14,
                              weight: 300,
                              family: "Roboto",
                              style: 'normal',
                              lineHeight: 2
                          },
                      }
                  },
                  x: {
                      grid: {
                          drawBorder: false,
                          display: false,
                          drawOnChartArea: false,
                          drawTicks: false,
                          borderDash: [5, 5]
                      },
                      ticks: {
                          display: true,
                          color: '#f8f9fa',
                          padding: 10,
                          font: {
                              size: 14,
                              weight: 300,
                              family: "Roboto",
                              style: 'normal',
                              lineHeight: 2
                          },
                      }
                  },
              },
          },
      });
      
      var ctx3 = document.getElementById("chart-bars").getContext("2d");

      new Chart(ctx3, {
          type: "line",
          data: {
              labels: ["Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
              datasets: [{
                  label: "Mobile apps",
                  tension: 0,
                  borderWidth: 0,
                  pointRadius: 5,
                  pointBackgroundColor: "rgba(255, 255, 255, .8)",
                  pointBorderColor: "transparent",
                  borderColor: "rgba(255, 255, 255, .8)",
                  borderWidth: 4,
                  backgroundColor: "transparent",
                  fill: true,
                  data: [50, 40, 300, 220, 500, 250, 400, 230, 500],
                  maxBarThickness: 6

              }],
          },
          options: {
              responsive: true,
              maintainAspectRatio: false,
              plugins: {
                  legend: {
                      display: false,
                  }
              },
              interaction: {
                  intersect: false,
                  mode: 'index',
              },
              scales: {
                  y: {
                      grid: {
                          drawBorder: false,
                          display: true,
                          drawOnChartArea: true,
                          drawTicks: false,
                          borderDash: [5, 5],
                          color: 'rgba(255, 255, 255, .2)'
                      },
                      ticks: {
                          display: true,
                          padding: 10,
                          color: '#f8f9fa',
                          font: {
                              size: 14,
                              weight: 300,
                              family: "Roboto",
                              style: 'normal',
                              lineHeight: 2
                          },
                      }
                  },
                  x: {
                      grid: {
                          drawBorder: false,
                          display: false,
                          drawOnChartArea: false,
                          drawTicks: false,
                          borderDash: [5, 5]
                      },
                      ticks: {
                          display: true,
                          color: '#f8f9fa',
                          padding: 10,
                          font: {
                              size: 14,
                              weight: 300,
                              family: "Roboto",
                              style: 'normal',
                              lineHeight: 2
                          },
                      }
                  },
              },
          },
      });

  </script>
  @endpush
