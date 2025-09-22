@extends('admin.app')

@section('page-title', 'Dashboard')

@section('pagecss')
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@700&display=swap" rel="stylesheet"/>

<link rel="stylesheet" href="../../assets/css/circular_custom.css" />
@endsection

@section('content')
  <!-- Content wrapper -->
  <div class="container-xxl flex-grow-1 container-p-y">
              <div class="row g-6">
                <!-- Total Vehicles -->
                
                <!-- Today's Cash Payments -->
                <div class="col-lg-3 col-sm-6 mb-2">
                  <div class="card card-border-shadow-success h-100">
                    <div class="card-body">
                      <div class="d-flex align-items-center mb-2">
                        <div class="avatar me-4">
                          <span class="avatar-initial rounded bg-label-success">
                            <i class="tf-icons ti ti-cash icon-40px"></i>
                          </span>
                        </div>
                        <h4 class="mb-0">AUD {{ number_format($todaysCashPayments ?? 0, 2) }}</h4>
                      </div>
                      <p class="mb-1">Today's Cash Payments</p>
                    </div>
                  </div>
                </div>
                <!-- Today's Other Payments -->
                <div class="col-lg-3 col-sm-6 mb-2">
                  <div class="card card-border-shadow-primary h-100">
                    <div class="card-body">
                      <div class="d-flex align-items-center mb-2">
                        <div class="avatar me-4">
                          <span class="avatar-initial rounded bg-label-primary">
                            <i class="tf-icons ti ti-credit-card icon-40px"></i>
                          </span>
                        </div>
                        <h4 class="mb-0">AUD {{ number_format($todaysOtherPayments ?? 0, 2) }}</h4>
                      </div>
                      <p class="mb-1">Today's Other Payments</p>
                    </div>
                  </div>
                </div>
                <!-- Today's Unpaid Amount -->
                <div class="col-lg-3 col-sm-6 mb-2">
                  <div class="card card-border-shadow-danger h-100">
                    <div class="card-body">
                      <div class="d-flex align-items-center mb-2">
                        <div class="avatar me-4">
                          <span class="avatar-initial rounded bg-label-danger">
                            <i class="tf-icons ti ti-alert-circle icon-40px"></i>
                          </span>
                        </div>
                        <h4 class="mb-0">AUD {{ number_format($todaysUnpaidAmount ?? 0, 2) }}</h4>
                      </div>
                      <p class="mb-1">Today's Unpaid Amount</p>
                    </div>
                  </div>
                </div>
                <!-- Available Vehicles -->
                 <div class="col-lg-3 col-sm-6 mb-2">
                  <div class="card card-border-shadow-primary h-100">
                    <div class="card-body">
                      <div class="d-flex align-items-center mb-2">
                        <div class="avatar me-4">
                          <span class="avatar-initial rounded bg-label-primary"
                            ><i class="tf-icons ti ti-car icon-40px"></i
                          ></span>
                        </div>
                        <h4 class="mb-0">{{ $totalVehicles ?? 0 }}</h4>
                      </div>
                      <p class="mb-1">Total Vehicles</p>
                    </div>
                  </div>
                </div>
                <div class="col-lg-3 col-sm-6 mb-2">
                  <div class="card card-border-shadow-success h-100">
                    <div class="card-body">
                      <div class="d-flex align-items-center mb-2">
                        <div class="avatar me-4">
                          <span class="avatar-initial rounded bg-label-success"
                            ><i class="tf-icons ti ti-target icon-40px"></i
                          ></span>
                        </div>
                        <h4 class="mb-0">{{ $availableVehicles ?? 0 }}</h4>
                      </div>
                      <p class="mb-1">Available Vehicles</p>
                    </div>
                  </div>
                </div>
                <!-- Rented Vehicles -->
                <div class="col-lg-3 col-sm-6 mb-2">
                  <div class="card card-border-shadow-info h-100">
                    <div class="card-body">
                      <div class="d-flex align-items-center mb-2">
                        <div class="avatar me-4">
                          <span class="avatar-initial rounded bg-label-info"
                            ><i class="tf-icons ti ti-key icon-40px"></i
                          ></span>
                        </div>
                        <h4 class="mb-0">{{ $rentedVehicles ?? 0 }}</h4>
                      </div>
                      <p class="mb-1">Rented Vehicles</p>
                    </div>
                  </div>
                </div>
                <!-- Sold Vehicles -->
                <div class="col-lg-3 col-sm-6 mb-2">
                  <div class="card card-border-shadow-warning h-100">
                    <div class="card-body">
                      <div class="d-flex align-items-center mb-2">
                        <div class="avatar me-4">
                          <span class="avatar-initial rounded bg-label-warning"
                            ><i class="tf-icons ti ti-shopping-cart icon-40px"></i
                          ></span>
                        </div>
                        <h4 class="mb-0">{{ $soldVehicles ?? 0 }}</h4>
                      </div>
                      <p class="mb-1">Sold Vehicles</p>
                    </div>
                  </div>
                </div>
                <!-- Under Repair Vehicles -->
                <div class="col-lg-3 col-sm-6 mb-2">
                  <div class="card card-border-shadow-secondary h-100">
                    <div class="card-body">
                      <div class="d-flex align-items-center mb-2">
                        <div class="avatar me-4">
                          <span class="avatar-initial rounded bg-label-secondary"
                            ><i class="tf-icons ti ti-tools icon-40px"></i
                          ></span>
                        </div>
                        <h4 class="mb-0">{{ $underRepairVehicles ?? 0 }}</h4>
                      </div>
                      <p class="mb-1">Under Repair Vehicles</p>
                    </div>
                  </div>
                </div>
                <!-- Dead Vehicles -->
                <div class="col-lg-3 col-sm-6 mb-2">
                  <div class="card card-border-shadow-danger h-100">
                    <div class="card-body">
                      <div class="d-flex align-items-center mb-2">
                        <div class="avatar me-4">
                          <span class="avatar-initial rounded bg-label-danger"
                            ><i class="tf-icons ti ti-alert-triangle icon-40px"></i
                          ></span>
                        </div>
                        <h4 class="mb-0">{{ $deadVehicles ?? 0 }}</h4>
                      </div>
                      <p class="mb-1">Dead Vehicles</p>
                    </div>
                  </div>
                </div>
                
                <div class="col-lg-3 col-sm-6 mb-2">
                    <div class="card card-border-shadow-info h-100">
                        <div class="card-body">
                            <div class="d-flex align-items-center mb-2">
                                <div class="avatar me-4">
                                    <span class="avatar-initial rounded bg-label-info">
                                        <i class="tf-icons ti ti-package icon-40px"></i>
                                    </span>
                                </div>
                                <h4 class="mb-0">{{ $totalStock ?? 0 }}</h4>
                            </div>
                            <p class="mb-1">Total Parts in Stock</p>
                            <p class="mb-0"><span class="text-heading fw-medium me-2"></span></p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6 mb-2">
                    <div class="card card-border-shadow-success h-100">
                        <div class="card-body">
                            <div class="d-flex align-items-center mb-2">
                                <div class="avatar me-4">
                                    <span class="avatar-initial rounded bg-label-success">
                                        <i class="tf-icons ti ti-cash icon-40px"></i>
                                    </span>
                                </div>
                                <h4 class="mb-0">{{ $soldQty ?? 0 }}</h4>
                            </div>
                            <p class="mb-1">Parts Sold</p>
                            <p class="mb-0">
                                <span class="text-heading fw-medium me-2">AUD {{ number_format($soldRevenue ?? 0, 2) }}</span>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6 mb-2">
                    <div class="card card-border-shadow-warning h-100">
                        <div class="card-body">
                            <div class="d-flex align-items-center mb-2">
                                <div class="avatar me-4">
                                    <span class="avatar-initial rounded bg-label-warning">
                                        <i class="tf-icons ti ti-tools icon-40px"></i>
                                    </span>
                                </div>
                                <h4 class="mb-0">{{ $usedQty ?? 0 }}</h4>
                            </div>
                            <p class="mb-1">Parts Used (Internal)</p>
                            <p class="mb-0">
                                <span class="text-heading fw-medium me-2">AUD {{ number_format($usedCost ?? 0, 2) }}</span>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6 mb-2">
                    <div class="card card-border-shadow-primary h-100">
                        <div class="card-body">
                            <div class="d-flex align-items-center mb-2">
                                <div class="avatar me-4">
                                    <span class="avatar-initial rounded bg-label-primary">
                                        <i class="tf-icons ti ti-truck-delivery icon-40px"></i>
                                    </span>
                                </div>
                                <h4 class="mb-0">{{ $restockedQty ?? 0 }}</h4>
                            </div>
                            <p class="mb-1">Parts Restocked</p>
                            <p class="mb-0">
                                <span class="text-heading fw-medium me-2">AUD {{ number_format($restockedCost ?? 0, 2) }}</span>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6 mb-2">
                    <div class="card card-border-shadow-success h-100">
                        <div class="card-body">
                            <div class="d-flex align-items-center mb-2">
                                <div class="avatar me-4">
                                    <span class="avatar-initial rounded bg-label-success">
                                        <i class="tf-icons ti ti-chart-bar icon-40px"></i>
                                    </span>
                                </div>
                                <h4 class="mb-0">AUD {{ number_format($partsProfit ?? 0, 2) }}</h4>
                            </div>
                            <p class="mb-1">Net Profit (Parts)</p>
                            <p class="mb-0"></p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6 mb-2">
                    <div class="card card-border-shadow-danger h-100">
                        <div class="card-body">
                            <div class="d-flex align-items-center mb-2">
                                <div class="avatar me-4">
                                    <span class="avatar-initial rounded bg-label-danger">
                                        <i class="tf-icons ti ti-tool icon-40px"></i>
                                    </span>
                                </div>
                                <h4 class="mb-0">AUD {{ number_format($ownUsedCost ?? 0, 2) }}</h4>
                            </div>
                            <p class="mb-1">Total Cost of Parts Used (Own)</p>
                            <p class="mb-0"></p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6 mb-2">
                    <div class="card card-border-shadow-danger h-100">
                        <div class="card-body">
                            <div class="d-flex align-items-center mb-2">
                                <div class="avatar me-4">
                                    <span class="avatar-initial rounded bg-label-danger">
                                        <i class="tf-icons ti ti-alert-triangle icon-40px"></i>
                                    </span>
                                </div>
                                <h4 class="mb-0">{{ $lowStockCount ?? 0 }}</h4>
                            </div>
                            <p class="mb-1">Low Stock Parts</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6 mb-2">
                    <div class="card card-border-shadow-info h-100">
                        <div class="card-body">
                            <div class="d-flex align-items-center mb-2">
                                <div class="avatar me-4">
                                    <span class="avatar-initial rounded bg-label-info">
                                        <i class="tf-icons ti ti-list icon-40px"></i>
                                    </span>
                                </div>
                                <h4 class="mb-0">{{ $totalPartTypes ?? 0 }}</h4>
                            </div>
                            <p class="mb-1">Total Part Types</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6 mb-2">
                    <div class="card card-border-shadow-warning h-100">
                        <div class="card-body">
                            <div class="d-flex align-items-center mb-2">
                                <div class="avatar me-4">
                                    <span class="avatar-initial rounded bg-label-warning">
                                        <i class="tf-icons ti ti-star icon-40px"></i>
                                    </span>
                                </div>
                                <h4 class="mb-0">{{ $mostUsedPart ?? '-' }}</h4>
                            </div>
                            <p class="mb-1">Most Used Part</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6 mb-2">
                    <div class="card card-border-shadow-success h-100">
                        <div class="card-body">
                            <div class="d-flex align-items-center mb-2">
                                <div class="avatar me-4">
                                    <span class="avatar-initial rounded bg-label-success">
                                        <i class="tf-icons ti ti-trophy icon-40px"></i>
                                    </span>
                                </div>
                                <h4 class="mb-0">{{ $mostSoldPart ?? '-' }}</h4>
                            </div>
                            <p class="mb-1">Most Sold Part</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6 mb-2">
                    <div class="card card-border-shadow-primary h-100">
                        <div class="card-body">
                            <div class="d-flex align-items-center mb-2">
                                <div class="avatar me-4">
                                    <span class="avatar-initial rounded bg-label-primary">
                                        <i class="tf-icons ti ti-wallet icon-40px"></i>
                                    </span>
                                </div>
                                <h4 class="mb-0">AUD {{ number_format($inventoryValue ?? 0, 2) }}</h4>
                            </div>
                            <p class="mb-1">Total Inventory Value</p>
                        </div>
                    </div>
                </div>
                
              </div>
            </div>

@endsection


@section('pagejs')

 <script src="../../assets/js/app-logistics-dashboard.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
<script>
  
loadScript("../../assets/js/circular_custom.js");
  function loadScript(scriptSrc) {
  var script = document.createElement('script');
  script.src = scriptSrc;
  document.head.appendChild(script);
  }

</script>

@endsection