@extends('layouts.app')
@section('content')
    <div class="dashboard-main-body">
        <div class="d-flex flex-wrap align-items-center justify-content-between gap-3 mb-24">
            <h6 class="fw-semibold mb-0">Statistiques</h6>
            <ul class="d-flex align-items-center gap-2">
                <li class="fw-medium">
                    <a href="{{ route('home') }}" class="d-flex align-items-center gap-1 hover-text-primary">
                        <iconify-icon icon="solar:home-smile-angle-outline" class="icon text-lg"></iconify-icon>
                        Accueil
                    </a>
                </li>
                <li>-</li>
                <li class="fw-medium">Client</li>
                <li>-</li>
                <li class="fw-medium">Statistiques</li>
            </ul>
        </div>

        <div class="card h-100 p-0 radius-12">
            <div class="card-header border-bottom bg-base py-16 px-24 d-flex align-items-center flex-wrap gap-3 justify-content-between">
                <div class="d-flex align-items-center flex-wrap gap-3">
                    <a href="{{ route('clients.add') }}" class="btn btn-primary text-sm btn-sm px-12 py-12 radius-8 d-flex align-items-center gap-2">
                        Commande
                    </a>
                </div>
            </div>
            <div class="card-body">
                <div class="row gy-4 mt-1">
                    <div class="col-xxl-6 col-xl-6">
                        <div class="card h-100 border shadow-none">
                            <div class="card-body">
                                <div class="d-flex flex-wrap align-items-center justify-content-between">
                                    <h6 class="text-lg mb-0">Chiffre d'affaire du client</h6>
                                    <select class="form-select form-select-sm w-auto">
                                        <option>Annuel</option>
                                        <option>Mensuel</option>
                                        <option>Semestriel</option>
                                        <option>Trimestriel</option>
                                        <option>Hebdomadaire</option>
                                    </select>
                                </div>
                                <div class="d-flex flex-wrap align-items-center gap-2 mt-8">
                                    <h6 class="mb-0">$27,200</h6>
                                    <span class="text-sm fw-semibold rounded-pill bg-success-focus text-success-main border br-success px-8 py-4 line-height-1">
                                        10% <iconify-icon icon="bxs:up-arrow" class="text-xs"></iconify-icon>
                                    </span>
                                    <span class="text-xs fw-medium">+ $1500 Per Day</span>
                                </div>
                                <div id="chart" class="pt-28 apexcharts-tooltip-style-1"></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xxl-6 col-xl-6">
                        <div class="card h-100 border shadow-none">
                            <div class="card-body">
                                <div class="d-flex align-items-center flex-wrap gap-2 justify-content-between mb-20">
                                    <h6 class="mb-2 fw-bold text-lg mb-0">Top 10 des modèles fréquents</h6>
                                    <select class="form-select form-select-sm w-auto bg-base border text-secondary-light">
                                        <option>Today</option>
                                        <option>Weekly</option>
                                        <option>Monthly</option>
                                        <option>Yearly</option>
                                    </select>
                                </div>

                                <div class="row gy-4">
                                    <div class="col-sm-6">
                                        <div id="world-map" class="h-100 border radius-8"></div>
                                    </div>

                                    <div class="col-sm-6">
                                        <div class="h-100 border p-16 pe-0 radius-8">
                                            <div class="max-h-266-px overflow-y-auto scroll-sm pe-16">
                                                <div class="d-flex align-items-center justify-content-between gap-3 mb-12 pb-2">
                                                    <div class="d-flex align-items-center w-100">
                                                        <img src="assets/images/flags/flag1.png" alt="" class="w-40-px h-40-px rounded-circle flex-shrink-0 me-12">
                                                        <div class="flex-grow-1">
                                                            <h6 class="text-sm mb-0">USA</h6>
                                                            <span class="text-xs text-secondary-light fw-medium">1,240 Users</span>
                                                        </div>
                                                    </div>
                                                    <div class="d-flex align-items-center gap-2 w-100">
                                                        <div class="w-100 max-w-66 ms-auto">
                                                            <div class="progress progress-sm rounded-pill" role="progressbar" aria-label="Success example" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">
                                                                <div class="progress-bar bg-primary-600 rounded-pill" style="width: 80%;"></div>
                                                            </div>
                                                        </div>
                                                        <span class="text-secondary-light font-xs fw-semibold">80%</span>
                                                    </div>
                                                </div>

                                                <div class="d-flex align-items-center justify-content-between gap-3 mb-12 pb-2">
                                                    <div class="d-flex align-items-center w-100">
                                                        <img src="assets/images/flags/flag2.png" alt="" class="w-40-px h-40-px rounded-circle flex-shrink-0 me-12">
                                                        <div class="flex-grow-1">
                                                            <h6 class="text-sm mb-0">Japan</h6>
                                                            <span class="text-xs text-secondary-light fw-medium">1,240 Users</span>
                                                        </div>
                                                    </div>
                                                    <div class="d-flex align-items-center gap-2 w-100">
                                                        <div class="w-100 max-w-66 ms-auto">
                                                            <div class="progress progress-sm rounded-pill" role="progressbar" aria-label="Success example" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">
                                                                <div class="progress-bar bg-orange rounded-pill" style="width: 60%;"></div>
                                                            </div>
                                                        </div>
                                                        <span class="text-secondary-light font-xs fw-semibold">60%</span>
                                                    </div>
                                                </div>

                                                <div class="d-flex align-items-center justify-content-between gap-3 mb-12 pb-2">
                                                    <div class="d-flex align-items-center w-100">
                                                        <img src="assets/images/flags/flag3.png" alt="" class="w-40-px h-40-px rounded-circle flex-shrink-0 me-12">
                                                        <div class="flex-grow-1">
                                                            <h6 class="text-sm mb-0">France</h6>
                                                            <span class="text-xs text-secondary-light fw-medium">1,240 Users</span>
                                                        </div>
                                                    </div>
                                                    <div class="d-flex align-items-center gap-2 w-100">
                                                        <div class="w-100 max-w-66 ms-auto">
                                                            <div class="progress progress-sm rounded-pill" role="progressbar" aria-label="Success example" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">
                                                                <div class="progress-bar bg-yellow rounded-pill" style="width: 49%;"></div>
                                                            </div>
                                                        </div>
                                                        <span class="text-secondary-light font-xs fw-semibold">49%</span>
                                                    </div>
                                                </div>

                                                <div class="d-flex align-items-center justify-content-between gap-3 mb-12 pb-2">
                                                    <div class="d-flex align-items-center w-100">
                                                        <img src="assets/images/flags/flag4.png" alt="" class="w-40-px h-40-px rounded-circle flex-shrink-0 me-12">
                                                        <div class="flex-grow-1">
                                                            <h6 class="text-sm mb-0">Germany</h6>
                                                            <span class="text-xs text-secondary-light fw-medium">1,240 Users</span>
                                                        </div>
                                                    </div>
                                                    <div class="d-flex align-items-center gap-2 w-100">
                                                        <div class="w-100 max-w-66 ms-auto">
                                                            <div class="progress progress-sm rounded-pill" role="progressbar" aria-label="Success example" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">
                                                                <div class="progress-bar bg-success-main rounded-pill" style="width: 100%;"></div>
                                                            </div>
                                                        </div>
                                                        <span class="text-secondary-light font-xs fw-semibold">100%</span>
                                                    </div>
                                                </div>

                                                <div class="d-flex align-items-center justify-content-between gap-3 mb-12 pb-2">
                                                    <div class="d-flex align-items-center w-100">
                                                        <img src="assets/images/flags/flag5.png" alt="" class="w-40-px h-40-px rounded-circle flex-shrink-0 me-12">
                                                        <div class="flex-grow-1">
                                                            <h6 class="text-sm mb-0">South Korea</h6>
                                                            <span class="text-xs text-secondary-light fw-medium">1,240 Users</span>
                                                        </div>
                                                    </div>
                                                    <div class="d-flex align-items-center gap-2 w-100">
                                                        <div class="w-100 max-w-66 ms-auto">
                                                            <div class="progress progress-sm rounded-pill" role="progressbar" aria-label="Success example" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">
                                                                <div class="progress-bar bg-info-main rounded-pill" style="width: 30%;"></div>
                                                            </div>
                                                        </div>
                                                        <span class="text-secondary-light font-xs fw-semibold">30%</span>
                                                    </div>
                                                </div>
                                                <div class="d-flex align-items-center justify-content-between gap-3">
                                                    <div class="d-flex align-items-center w-100">
                                                        <img src="assets/images/flags/flag1.png" alt="" class="w-40-px h-40-px rounded-circle flex-shrink-0 me-12">
                                                        <div class="flex-grow-1">
                                                            <h6 class="text-sm mb-0">USA</h6>
                                                            <span class="text-xs text-secondary-light fw-medium">1,240 Users</span>
                                                        </div>
                                                    </div>
                                                    <div class="d-flex align-items-center gap-2 w-100">
                                                        <div class="w-100 max-w-66 ms-auto">
                                                            <div class="progress progress-sm rounded-pill" role="progressbar" aria-label="Success example" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">
                                                                <div class="progress-bar bg-primary-600 rounded-pill" style="width: 80%;"></div>
                                                            </div>
                                                        </div>
                                                        <span class="text-secondary-light font-xs fw-semibold">80%</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Client Payment Status Start -->
                    <div class="col-xxl-4 col-lg-6">
                        <div class="card h-100 border shadow-none radius-8 border-0">
                            <div class="card-body p-24">
                                <h6 class="mb-2 fw-bold text-lg">Statuts des paiements</h6>
                                <span class="text-sm fw-medium text-secondary-light">Weekly Report</span>

                                <ul class="d-flex flex-wrap align-items-center justify-content-center mt-32">
                                    <li class="d-flex align-items-center gap-2 me-28">
                                        <span class="w-12-px h-12-px rounded-circle bg-success-main"></span>
                                        <span class="text-secondary-light text-sm fw-medium">Total à payer: 500</span>
                                    </li>
                                    <li class="d-flex align-items-center gap-2 me-28">
                                        <span class="w-12-px h-12-px rounded-circle bg-info-main"></span>
                                        <span class="text-secondary-light text-sm fw-medium">Réglé: 500</span>
                                    </li>
                                    <li class="d-flex align-items-center gap-2">
                                        <span class="w-12-px h-12-px rounded-circle bg-warning-main"></span>
                                        <span class="text-secondary-light text-sm fw-medium">Réliquat: 1500</span>
                                    </li>
                                </ul>
                                <div class="mt-40">
                                    <div id="paymentStatusChart" class="margin-16-minus"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Client Payment Status End -->

                    <!-- Earning Static start -->
                    <div class="col-xxl-8 col-lg-6">
                        <div class="card h-100 border shadow-none radius-8 border-0">
                            <div class="card-body p-24">
                                <div class="d-flex align-items-center flex-wrap gap-2 justify-content-between">
                                    <div>
                                        <h6 class="mb-2 fw-bold text-lg">Earning Statistic</h6>
                                        <span class="text-sm fw-medium text-secondary-light">Yearly earning overview</span>
                                    </div>
                                    <div class="">
                                        <select class="form-select form-select-sm w-auto bg-base border text-secondary-light">
                                            <option>Yearly</option>
                                            <option>Monthly</option>
                                            <option>Weekly</option>
                                            <option>Today</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="mt-20 d-flex justify-content-center flex-wrap gap-3">

                                    <div class="d-inline-flex align-items-center gap-2 p-2 radius-8 border pe-36 br-hover-primary group-item">
                        <span class="bg-neutral-100 w-44-px h-44-px text-xxl radius-8 d-flex justify-content-center align-items-center text-secondary-light group-hover:bg-primary-600 group-hover:text-white">
                        <iconify-icon icon="fluent:cart-16-filled" class="icon"></iconify-icon>
                        </span>
                                        <div>
                                            <span class="text-secondary-light text-sm fw-medium">Sales</span>
                                            <h6 class="text-md fw-semibold mb-0">$200k</h6>
                                        </div>
                                    </div>

                                    <div class="d-inline-flex align-items-center gap-2 p-2 radius-8 border pe-36 br-hover-primary group-item">
                        <span class="bg-neutral-100 w-44-px h-44-px text-xxl radius-8 d-flex justify-content-center align-items-center text-secondary-light group-hover:bg-primary-600 group-hover:text-white">
                        <iconify-icon icon="uis:chart" class="icon"></iconify-icon>
                        </span>
                                        <div>
                                            <span class="text-secondary-light text-sm fw-medium">Income</span>
                                            <h6 class="text-md fw-semibold mb-0">$200k</h6>
                                        </div>
                                    </div>

                                    <div class="d-inline-flex align-items-center gap-2 p-2 radius-8 border pe-36 br-hover-primary group-item">
                        <span class="bg-neutral-100 w-44-px h-44-px text-xxl radius-8 d-flex justify-content-center align-items-center text-secondary-light group-hover:bg-primary-600 group-hover:text-white">
                        <iconify-icon icon="ph:arrow-fat-up-fill" class="icon"></iconify-icon>
                        </span>
                                        <div>
                                            <span class="text-secondary-light text-sm fw-medium">Profit</span>
                                            <h6 class="text-md fw-semibold mb-0">$200k</h6>
                                        </div>
                                    </div>
                                </div>

                                <div id="barChart"></div>
                            </div>
                        </div>
                    </div>
                    <!-- Earning Static End -->

                    <div class="col-xxl-4 col-lg-6">
                        <div class="card h-100 border shadow-none radius-8 overflow-hidden">
                            <div class="card-body p-24">
                                <div class="d-flex align-items-center flex-wrap gap-2 justify-content-between">
                                    <h6 class="mb-2 fw-bold text-lg">Users Overview</h6>
                                    <div class="">
                                        <select class="form-select form-select-sm w-auto bg-base border text-secondary-light">
                                            <option>Today</option>
                                            <option>Weekly</option>
                                            <option>Monthly</option>
                                            <option>Yearly</option>
                                        </select>
                                    </div>
                                </div>


                                <div id="userOverviewDonutChart"></div>

                                <ul class="d-flex flex-wrap align-items-center justify-content-between mt-3 gap-3">
                                    <li class="d-flex align-items-center gap-2">
                                        <span class="w-12-px h-12-px radius-2 bg-primary-600"></span>
                                        <span class="text-secondary-light text-sm fw-normal">New:
                            <span class="text-primary-light fw-semibold">500</span>
                        </span>
                                    </li>
                                    <li class="d-flex align-items-center gap-2">
                                        <span class="w-12-px h-12-px radius-2 bg-yellow"></span>
                                        <span class="text-secondary-light text-sm fw-normal">Subscribed:
                            <span class="text-primary-light fw-semibold">300</span>
                        </span>
                                    </li>
                                </ul>

                            </div>
                        </div>
                    </div>

                    <!-- Total Transactions Start -->
                    <div class="col-xxl-4 col-lg-6">
                        <div class="card h-100 border shadow-none">
                            <div class="card-body p-24">
                                <div class="d-flex align-items-center flex-wrap gap-2 justify-content-between mb-20">
                                    <h6 class="mb-2 fw-bold text-lg">Total Transactions </h6>
                                    <div class="">
                                        <select class="form-select form-select-sm w-auto bg-base border text-secondary-light">
                                            <option>Yearly</option>
                                            <option>Monthly</option>
                                            <option>Weekly</option>
                                            <option>Today</option>
                                        </select>
                                    </div>
                                </div>

                                <ul class="d-flex flex-wrap align-items-center justify-content-between gap-3 mb-28">
                                    <li class="d-flex align-items-center gap-2">
                                        <span class="w-16-px h-16-px radius-2 bg-primary-600"></span>
                                        <span class="text-secondary-light text-lg fw-normal">Total Gain:
                                    <span class="text-primary-light fw-bold text-lg">$50,000</span>
                                </span>
                                    </li>
                                </ul>

                                <div id="transactionLineChart"></div>

                            </div>
                        </div>
                    </div>
                    <!-- Total Transactions End -->
                    <!-- Statistics Start -->
                    <div class="col-xxl-4 col-lg-6">
                        <div class="card h-100 radius-8 border-0">
                            <div class="card-body p-24">
                                <h6 class="mb-2 fw-bold text-lg">Statistic</h6>

                                <div class="mt-24">
                                    <div class="d-flex align-items-center gap-1 justify-content-between mb-44">
                                        <div>
                                            <span class="text-secondary-light fw-normal mb-12 text-xl">Daily Conversions</span>
                                            <h5 class="fw-semibold mb-0">%60</h5>
                                        </div>
                                        <div class="position-relative">
                                            <div id="semiCircleGauge"></div>

                                            <span class="w-36-px h-36-px rounded-circle bg-neutral-100 d-flex justify-content-center align-items-center position-absolute start-50 translate-middle bottom-0"><iconify-icon icon="mdi:emoji" class="text-primary-600 text-md mb-0"></iconify-icon></span>
                                        </div>
                                    </div>

                                    <div class="d-flex align-items-center gap-1 justify-content-between mb-44">
                                        <div>
                                            <span class="text-secondary-light fw-normal mb-12 text-xl">Visits By Day</span>
                                            <h5 class="fw-semibold mb-0">20k</h5>
                                        </div>
                                        <div id="areaChart"></div>
                                    </div>

                                    <div class="d-flex align-items-center gap-1 justify-content-between">
                                        <div>
                                            <span class="text-secondary-light fw-normal mb-12 text-xl">Today Income</span>
                                            <h5 class="fw-semibold mb-0">$5.5k</h5>
                                        </div>
                                        <div id="dailyIconBarChart"></div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                    <!-- Statistics End -->

                </div>
            </div>
        </div>
    </div>

@endsection
@section('scripts')
{{--    <script  src="{{ asset('assets/js/gfi/clients/form.js') }}"></script>--}}
{{--    <script  src="{{ asset('assets/js/gfi/clients/datatable.js') }}"></script>--}}
{{--    <script  src="{{ asset('assets/js/gfi/clients/statistique/chart.js') }}"></script>--}}

@endsection
