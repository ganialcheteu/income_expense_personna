@extends('admin.dashboard_layout')
@section('dashboard_body_content')
    <div class="home-tab">

        <div class="d-sm-flex align-items-center justify-content-between border-bottom">
            <ul class="nav nav-tabs" role="tablist">
                <li class="nav-item px-2">
                    <a class="nav-link active ps-0" id="home-tab" data-bs-toggle="tab" href="#overview" role="tab"
                        aria-controls="overview" aria-selected="true">Overview</a>
                </li>
                <x-only-super-admin :role="Auth::user()->role">
                    <li class="nav-item px-2">
                        <a class="nav-link  ps-0" id="home-tab" data-bs-toggle="tab" href="#activateAdmin" role="tab"
                            aria-controls="activateAdmin" aria-selected="false">Activate Admin</a>
                    </li>
                </x-only-super-admin>
            </ul>
        </div>

        <div class="tab-content tab-content-basic">
            <div class="tab-pane fade show active" id="overview" role="tabpanel" aria-labelledby="overview">
                <div class="row">
                    <div class="col-sm-12 our-numbers">
                        <div class="statistics-details d-flex align-items-center justify-content-between">

                            <!-- incomes -->
                            <div>
                                <p class="statistics-title">Incomes <Span class="text-bold text-primary text-small">/
                                        XAF</Span>
                                </p>
                                <h3 class="rate-percentage">
                                    {{ number_format($totalIncomes, 1) }}
                                </h3>
                                <p class="text-warning">
                                    {{ $totalIncomeRecords }} Rec.
                                </p>
                            </div>

                            <!-- expenses -->
                            <div>
                                <p class="statistics-title">Expenses <Span class="text-bold text-primary text-small">/
                                        XAF</Span>
                                </p>
                                <h3 class="rate-percentage">
                                    {{ number_format($totalExpenses, 1) }}
                                </h3>
                                <p class="text-warning">
                                    {{ $totalExpenseRecords }} Rec.
                                </p>
                            </div>

                            <!-- profit normal -->
                            <div>
                                <p class="statistics-title">Nor. Prof. <Span class="text-bold text-primary text-small">/
                                        XAF</Span>
                                </p>
                                <h2 class="rate-percentage">
                                    {{ number_format($totalNormalProfit, 1) }}
                                </h2>
                                <p class="text-warning">
                                    {{ $totalNormalIncomeRecords }} N/I Rec.
                                </p>
                            </div>

                            <!-- profit pfs -->
                            <div>
                                <p class="statistics-title">Pfs Prof. <Span class="text-bold text-primary text-small">/
                                        XAF</Span>
                                </p>
                                <h2 class="rate-percentage">
                                    {{ number_format($totalPfsProfit, 1) }}
                                </h2>
                                <p class="text-warning">
                                    <span>
                                        {{ $totalPfsIncomeRecords }} Pf/I Rec.
                                    </span>
                                </p>
                            </div>

                            <!-- Our customer -->
                            <div class="d-md-block">
                                <p class="statistics-title">
                                    Customers
                                </p>
                                <h3 class="rate-percentage">
                                    +{{ $totalCustomers }}
                                </h3>
                            </div>

                            <!-- Our Activities -->
                            <div class="d-md-block mt-0">
                                <p class="statistics-title">
                                    Activities
                                </p>
                                <h3 class="rate-percentage">
                                    +{{ $totalActivities }}
                                </h3>
                            </div>
                            <!-- total profit -->
                            <div class="d-md-block"
                                style="border: 1.3px solid #e29e09; border-radius:14px; padding: 10px; background-color: rgba(226, 158, 9,0.1);">
                                <p class="statistics-title text-warning">
                                    Total
                                    Prof. <Span class="text-bold text-primary fs-6">/ XAF</Span>
                                </p>
                                <h3 class="rate-percentage text-center fw-bold fs-4">

                                    {{ number_format($totalProfit, 1) }}

                                </h3>
                            </div>

                        </div>
                    </div>
                    <div class="chartsTables responsive">
                        <div class="charts">
                            <div class="bar-chart-inc-exp">
                                <canvas id="chartIncExp" role="img"
                                    aria-label="Bar chart for incomes and expenses monthly evolution"></canvas>
                            </div>
                            <div class="line-chart-exp">
                                <canvas id="lineChartIncExp" role="img"
                                    aria-label="Line chart for incomes and expenses virsualization"></canvas>
                            </div>
                            <div>
                                <div class="doughnut-chart-inc">
                                    <canvas id="doughnutChartIncCat" role="img"
                                        aria-label="Doughnut chart for incomes"></canvas>
                                </div>
                                <div class="doughnut-chart-exp">
                                    <canvas id="doughnutChartExpCat" role="img"
                                        aria-label="Doughnut chart for expenses"></canvas>
                                </div>
                            </div>
                        </div>

                        <div class="tables">
                            <div class="leaderboard">
                                <!-- header leaderboard customers -->
                                <div class="leaderboard-header text-center text-white position-relative m-2">
                                    <div class="d-flex align-items-center justify-content-between">
                                        <span class="mdi mdi-trophy text-warning p-2"></span>
                                        <h2>Customer ranking</h2>
                                    </div>
                                    <span class="badgeTop text-warning w-25 p-2 fw-bold  rounded-pill">Top 10</span>
                                    <div class="header-badge">{{ count($topCustomers) }} Customers</div>
                                    <div class="bubbles">
                                        <span></span>
                                        <span></span>
                                        <span></span>
                                        <span></span>
                                        <span></span>
                                        <span></span>
                                        <span></span>
                                        <span></span>
                                        <span></span>
                                        <span></span>
                                        <span></span>
                                        <span></span>
                                    </div>
                                </div>
                                <!-- Customers list -->
                                <div class="leaderboard-list">
                                    @foreach ($topCustomers as $index => $customer)
                                                                    <div class="leaderboard-item {{ $index >= 3 ? 'd-none more-customers' : '' }}
                                                                                                                    @if ($index === 0)
                                                                                                                         top-1
                                                                                                                    @elseif($index === 1)
                                                                                                                         top-2
                                                                                                                    @elseif($index === 2)
                                                                                                                         top-3
                                                                                                                    @endif"
                                                                        data-customer-id="{{ $customer['id'] }}">

                                                                        <!-- position badge -->
                                                                        <div class="badge me-3 d-flex align-items-center justify-content-center"
                                                                            style="min-width:50px;">
                                                                            @if ($index === 0)
                                                                                <img src="{{ asset('assets/images/badges/first.png') }}" alt="first place"
                                                                                    width="36">
                                                                            @elseif ($index === 1)
                                                                                <img src="{{ asset('assets/images/badges/second.png') }}" alt="second place"
                                                                                    width="36">
                                                                            @elseif($index === 2)
                                                                                <img src="{{ asset('assets/images/badges/third.png') }}" alt="third place"
                                                                                    width="36">
                                                                            @else
                                                                                <span class="fw-bold fs-5 text-warning">{{ $index + 1 }}</span>
                                                                            @endif
                                                                        </div>

                                                                        <!-- Avatar -->
                                                                        <div class="customer-avatar me-3">
                                                                            <div class="avatar-circle bg-primary">
                                                                                <!-- first letter avatar  -->
                                                                                {{ strtoupper(substr($customer['name'], 0, 1)) }}
                                                                            </div>
                                                                        </div>

                                                                        <!-- Infos principales -->
                                                                        <div class="customer-info me-auto">
                                                                            <h3>
                                                                                <?php
                                        $fullname = explode(' ', $customer['name']);
                                        echo htmlspecialchars($fullname[0], ENT_QUOTES, 'UTF-8');
                                                                                                                            ?>
                                                                            </h3>
                                                                            <div class="customer-meta">
                                                                                <span
                                                                                    class="mdi mdi-map-marker"></br>{{ $customer['city'] }},&nbsp;{{ $customer['country'] }}</span>
                                                                            </div>
                                                                        </div>

                                                                        <!-- Amount and VIP badge-->
                                                                        <div class="amount-info text-center">
                                                                            <div class="amount">
                                                                                {{ number_format($customer['total_income'], 0, ',', ' ') }}
                                                                                XAF
                                                                            </div>
                                                                            @if ($index < 3)
                                                                                <div class="vip-badge">
                                                                                    @if ($index === 0)
                                                                                        VIP GOLD
                                                                                    @elseif($index === 1)
                                                                                        VIP SILVER
                                                                                    @else
                                                                                        VIP BRONZE
                                                                                    @endif
                                                                                </div>
                                                                            @endif
                                                                        </div>
                                                                    </div>
                                    @endforeach
                                </div>
                                {{-- toggle button load more --}}
                                <div class="text-center my-3">
                                    <button id="toggle-customers-btn" onclick="toggleCustomers()" class="text-muted"
                                        style="background-color:unset; border:unset; font-size:12px;">Show more
                                        ...</button>
                                </div>

                                <!-- leaderboard footer -->
                                <div class="leaderboard-footer">
                                    <div class="last-update">Update at: {{ now()->format('d/m/Y  H:i') }}</div>
                                    <div class="actions">
                                        <button class="refresh-btn" onclick="refreshLeaderboard()">
                                            <span class="mdi mdi-update"> Update
                                        </button>
                                        <button class="export-btn" onclick="exportData()">
                                            <span class="mdi mdi-upload"></i> Export
                                        </button>
                                    </div>
                                </div>
                            </div>

                            <div class="leaderboard">
                                <!-- header leaderboard activities-->
                                <div class="leaderboard-header text-center text-white position-relative m-2">
                                    <div class="d-flex align-items-center justify-content-between">
                                        <span class="mdi mdi-trophy-award text-warning p-2"></span>
                                        <h2>Top Activities</h2>
                                    </div>
                                    <span class="badgeTop text-warning w-25 p-2 fw-bold rounded-pill">Top 5</span>
                                    <div class="header-badge">{{ count($topActivities) }} Activities</div>
                                    <div class="bubbles">
                                        <span></span>
                                        <span></span>
                                        <span></span>
                                        <span></span>
                                        <span></span>
                                        <span></span>
                                        <span></span>
                                        <span></span>
                                        <span></span>
                                        <span></span>
                                        <span></span>
                                        <span></span>
                                    </div>
                                </div>
                                <!-- Activities list -->
                                <div class="leaderboard-list">
                                    @foreach ($topActivities as $index => $activity)
                                                                    <div class="leaderboard-item  @if ($index === 0) top-1  @elseif($index === 1) top-2  @elseif($index === 2) top-3 @endif"
                                                                        data-activity-id="{{ $activity['id'] }}">

                                                                        <!-- position badge -->
                                                                        <div class="badge me-3 d-flex align-items-center justify-content-center"
                                                                            style="min-width:50px;">
                                                                            @if ($index === 0)
                                                                                <img src="{{ asset('assets/images/badges/first.png') }}" alt="first place"
                                                                                    width="36">
                                                                            @elseif ($index === 1)
                                                                                <img src="{{ asset('assets/images/badges/second.png') }}" alt="second place"
                                                                                    width="36">
                                                                            @elseif($index === 2)
                                                                                <img src="{{ asset('assets/images/badges/third.png') }}" alt="third place"
                                                                                    width="36">
                                                                            @else
                                                                                <span class="fw-bold fs-5 text-warning">{{ $index + 1 }}</span>
                                                                            @endif
                                                                        </div>

                                                                        <!-- Avatar -->
                                                                        <div class="activity-avatar me-3">
                                                                            <div class="avatar-circle bg-primary">
                                                                                <!-- first letter avatar  -->
                                                                                {{ strtoupper(substr($activity['name'], 0, 1)) }}
                                                                            </div>
                                                                        </div>

                                                                        <!-- Infos principales -->
                                                                        <div class="activity-info me-auto">
                                                                            <h6>
                                                                                <?php
                                        $fullname = explode(' ', $activity['name']);
                                        echo htmlspecialchars($fullname[0], ENT_QUOTES, 'UTF-8');
                                                                                                                            ?>
                                                                            </h6>
                                                                        </div>

                                                                        <!-- Amount and VIP badge-->
                                                                        <div class="amount-info text-center">
                                                                            <div class="amount">
                                                                                {{ number_format($activity['total_income'], 0, ',', ' ') }} XAF
                                                                            </div>
                                                                            @if ($index < 3)
                                                                                <div class="vip-badge">
                                                                                    @if ($index === 0)
                                                                                        VIP GOLD
                                                                                    @elseif($index === 1)
                                                                                        VIP SILVER
                                                                                    @else
                                                                                        VIP BRONZE
                                                                                    @endif
                                                                                </div>
                                                                            @endif
                                                                        </div>
                                                                    </div>
                                    @endforeach
                                </div>
                                <!-- leaderboard footer -->
                                <div class="leaderboard-footer">
                                    <div class="last-update">Update at: {{ now()->format('d/m/Y  H:i') }}</div>
                                    <div class="actions">
                                        <button class="refresh-btn" onclick="refreshLeaderboard()">
                                            <span class="mdi mdi-update"> Update
                                        </button>
                                        <button class="export-btn" onclick="exportData()">
                                            <span class="mdi mdi-upload"></i> Export
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <div class="tab-content tab-content-basic" style="border:unset;">
        <x-only-super-admin :role="Auth::user()->role">
            <div class="tab-pane fade" id="activateAdmin" role="tabpanel" aria-labelledby="activateAdmin">
                <!-- recuperation role user connecte -->
                <!-- Activate admins -->
                <div class="row flex-grow">
                    <div class="col-12 grid-margin stretch-card">
                        <div class="card card-rounded">
                            <div class="card-body">
                                <div
                                    class="activeAdminsHeader fw-bold d-flex justify-content-between align-items-center gap-2 mt-2 mb-4">
                                    <div>
                                        <h4 class="card-title card-title-dash">Income | Expense</h4>
                                        <span class="text-muted my-1">Waiting For Super Admin Approval</span>
                                    </div>
                                    <div>
                                        <span class="rounded-5 p-2 text-center btn-info flex-grow-1">{{ $activeAdmins }}
                                            act.</span>
                                        <span class="rounded-5 p-2 text-center btn-danger flex-grow-1">{{ $inactiveAdmins }}
                                            inact.</span>
                                    </div>

                                </div>
                                <div class="table-responsive  mt-1">
                                    <table class="table select-table">
                                        <span class="text-center">
                                            @if (session('info'))
                                                <div class="alert alert-success mx-auto">
                                                    {{ session('info') }}
                                            @endif
                                        </span>
                                        <thead>
                                            <tr>
                                                <th style="width: 5px;">Name</th>
                                                <th>Email</th>
                                                <th>Created At</th>
                                                <th>Status</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            {{-- admin list start --}}
                                            @foreach ($users as $user)
                                                <tr>

                                                    <td style="width: 5px; padding-left:8px;">
                                                        <h6>{{ $user->name }}</h6>
                                                    </td>
                                                    <td>
                                                        <h6>{{ $user->email }}</h6>
                                                    </td>

                                                    <td>
                                                        <h6>{{ $user->created_at->format('d M Y') }}</h6>
                                                        <h6>{{ $user->created_at->format('h:i A') }}</h6>
                                                    </td>
                                                    <td>
                                                        <form action="{{ route('user.toggleStatus', $user->id) }}"
                                                            method="POST">
                                                            @csrf
                                                            <button type="submit"
                                                                class="btn btn-mini mx-auto w-2 {{ $user->is_active ? 'btn-danger text-danger-50' : 'btn-info text-info-50' }}">
                                                                {{ $user->is_active ? 'Disable' : 'Enable' }}
                                                            </button>
                                                        </form>
                                                    </td>

                                                </tr>
                                            @endforeach
                                            {{-- admin list end --}}

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
        </x-only-super-admin>
    </div>
@endsection

';

{{-- datas from loginController sending to chart.Js .

Using this script ↓↓↓ to transfert datas from loginController to script canvas.js for charts of dashboard.

integrated browser CANVAS API will communicate with chartJS library to draw charts
in the browser. --}}

<!--for charts data-->
<script defer>
    window.chartData = {
        totalIncomesPerMonth: @json(array_values($incomesByMonth)),
        totalExpensesPerMonth: @json(array_values($expensesByMonth)),
        incomesByCategory: {
            labels: @json($incomesByCategory->pluck('category_name')),
            data: @json($incomesByCategory->pluck('total'))
        },
        expensesByCategory: {
            labels: @json($expensesByCategory->pluck('category_name')),
            data: @json($expensesByCategory->pluck('total'))
        },
        topActivities: {
            labels: @json($topActivities->pluck('name')),
            data: @json($topActivities->pluck('total'))
        }
    };
</script>
{{-- for customer list load more --}}
<!--customers load more-->
<script defer>
    function toggleCustomers() {
        const hiddenCustomers = document.querySelectorAll('.more-customers');
        const button = document.getElementById('toggle-customers-btn');

        // check if elements are visibles
        const isVisible = hiddenCustomers[0] && !hiddenCustomers[0].classList.contains('d-none');

        hiddenCustomers.forEach(e => {
            e.classList.toggle('d-none'); // toogle visiblity
        });

        // Change button text
        button.textContent = isVisible ? 'Show more ...' : 'Show less ...';
    }
</script>
