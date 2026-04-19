@extends('layouts.app')

@section('title', 'Home')

@section('breadcrumb')
    <ol class="breadcrumb border-0 m-0">
        <li class="breadcrumb-item active">Home</li>
    </ol>
@endsection

@section('content')
    <div class="container-fluid">
        @can('show_total_stats')
        <div class="row">
            <div class="col-md-6 col-lg-3">
                <div class="card border-0">
                    <div class="card-body p-0 d-flex align-items-center shadow-sm">
                        <div class="bg-gradient-primary p-4 mfe-3 rounded-left">
                            <i class="bi bi-bar-chart font-2xl"></i>
                        </div>
                        <div>
                            <div class="text-value text-primary">{{ format_currency($revenue) }}</div>
                            <div class="text-muted text-uppercase font-weight-bold small">Revenue</div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-lg-3">
                <div class="card border-0">
                    <div class="card-body p-0 d-flex align-items-center shadow-sm">
                        <div class="bg-gradient-warning p-4 mfe-3 rounded-left">
                            <i class="bi bi-arrow-return-left font-2xl"></i>
                        </div>
                        <div>
                            <div class="text-value text-warning">{{ format_currency($sale_returns) }}</div>
                            <div class="text-muted text-uppercase font-weight-bold small">Sales Return</div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-lg-3">
                <div class="card border-0">
                    <div class="card-body p-0 d-flex align-items-center shadow-sm">
                        <div class="bg-gradient-success p-4 mfe-3 rounded-left">
                            <i class="bi bi-arrow-return-right font-2xl"></i>
                        </div>
                        <div>
                            <div class="text-value text-success">{{ format_currency($purchase_returns) }}</div>
                            <div class="text-muted text-uppercase font-weight-bold small">Purchases Return</div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-lg-3">
                <div class="card border-0">
                    <div class="card-body p-0 d-flex align-items-center shadow-sm">
                        <div class="bg-gradient-info p-4 mfe-3 rounded-left">
                            <i class="bi bi-trophy font-2xl"></i>
                        </div>
                        <div>
                            <div class="text-value text-info">{{ format_currency($profit) }}</div>
                            <div class="text-muted text-uppercase font-weight-bold small">Profit</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endcan

        @can('show_weekly_sales_purchases|show_month_overview')
        <div class="row mb-4">
            @can('show_weekly_sales_purchases')
            <div class="col-lg-7">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-header">
                        Sales & Purchases of Last 7 Days
                    </div>
                    <div class="card-body">
                        <canvas id="salesPurchasesChart"></canvas>
                    </div>
                </div>
            </div>
            @endcan
            @can('show_month_overview')
            <div class="col-lg-5">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-header">
                        Overview of {{ now()->format('F, Y') }}
                    </div>
                    <div class="card-body d-flex justify-content-center">
                        <div class="chart-container" style="position: relative; height:auto; width:280px">
                            <canvas id="currentMonthChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>
            @endcan
        </div>
        @endcan

        @can('show_monthly_cashflow')
        <div class="row">
            <div class="col-lg-12">
                <div class="card border-0 shadow-sm">
                    <div class="card-header">
                        Monthly Cash Flow (Payment Sent & Received)
                    </div>
                    <div class="card-body">
                        <canvas id="paymentChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
        @endcan

        @if(auth()->user()->email == 'superadmin@cstock.id')
            <div class="row">
                <div class="col-md-6 col-lg-3">
                    <div class="card border-0">
                        <div class="card-body p-0 d-flex align-items-center shadow-sm">
                            <div class="bg-gradient-success p-4 mfe-3 rounded-left">
                                <i class="bi bi-person-check font-2xl"></i>
                            </div>
                            <div>
                                <div class="text-value text-success">{{ number_format($activeUsers) }}</div>
                                <div class="text-muted text-uppercase font-weight-bold small">Active Users</div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 col-lg-3">
                    <div class="card border-0">
                        <div class="card-body p-0 d-flex align-items-center shadow-sm">
                            <div class="bg-gradient-danger p-4 mfe-3 rounded-left">
                                <i class="bi bi-person-x font-2xl"></i>
                            </div>
                            <div>
                                <div class="text-value text-secondary">{{ number_format($inactiveUsers) }}</div>
                                <div class="text-muted text-uppercase font-weight-bold small">Inactive Users</div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 col-lg-3">
                    <div class="card border-0">
                        <div class="card-body p-0 d-flex align-items-center shadow-sm">
                            <div class="bg-gradient-info p-4 mfe-3 rounded-left">
                                <i class="bi bi-file-earmark-text font-2xl"></i>
                            </div>
                            <div>
                                <div class="text-value text-info">{{ number_format($invoiceCount) }}</div>
                                <div class="text-muted text-uppercase font-weight-bold small">Invoices</div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 col-lg-3">
                    <div class="card border-0">
                        <div class="card-body p-0 d-flex align-items-center shadow-sm">
                            <div class="bg-gradient-warning p-4 mfe-3 rounded-left">
                                <i class="bi bi-file-earmark-font font-2xl"></i>
                            </div>
                            <div>
                                <div class="text-value text-warning">{{ number_format($quotationCount) }}</div>
                                <div class="text-muted text-uppercase font-weight-bold small">Quotations</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <div class="row mt-4">
                <div class="col-lg-12">
                    <div class="card border-0 shadow-sm">
                        <div class="card-header">
                            Membership Revenue (per Month)
                        </div>
                        <div class="card-body">
                            <canvas id="membershipRevenueChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        @endif

    </div>
@endsection

@section('third_party_scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.5.0/chart.min.js"
            integrity="sha512-asxKqQghC1oBShyhiBwA+YgotaSYKxGP1rcSYTDrB0U6DxwlJjU59B67U8+5/++uFjcuVM8Hh5cokLjZlhm3Vg=="
            crossorigin="anonymous" referrerpolicy="no-referrer"></script>
@endsection

@push('page_scripts')
    @vite('resources/js/chart-config.js')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const membershipRevenueData = @json($membershipRevenue); // Data dari controller

            // Menyusun data untuk chart
            const labels = membershipRevenueData.map(item => `${item.month}-${item.year}`);
            const data = membershipRevenueData.map(item => item.total_membership);

            // Membuat chart
            const ctx = document.getElementById('membershipRevenueChart').getContext('2d');
            new Chart(ctx, {
                type: 'line',
                data: {
                    labels: labels,
                    datasets: [{
                        label: 'Membership Revenue',
                        data: data,
                        borderColor: 'rgba(75, 192, 192, 1)',
                        backgroundColor: 'rgba(75, 192, 192, 0.2)',
                        fill: true,
                        tension: 0.4
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            display: true
                        },
                        tooltip: {
                            callbacks: {
                                label: function(tooltipItem) {
                                    return 'Rp ' + tooltipItem.raw.toLocaleString(); // Format uang
                                }
                            }
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: false,
                            ticks: {
                                callback: function(value) {
                                    return 'Rp ' + value.toLocaleString(); // Format uang pada sumbu Y
                                }
                            }
                        }
                    }
                }
            });
        });

    </script>
@endpush
