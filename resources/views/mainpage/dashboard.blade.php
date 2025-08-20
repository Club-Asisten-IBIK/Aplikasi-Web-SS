@extends('layouts.index')

@section('title', 'Dashboard')

@section('content')
    <div class="dashboard-container">
        @include('layouts.topbar.topbar', [
            'breadcrumb' => ['Dashboard'],
            'title' => 'Dashboard',
            'subtitle' => 'Manage your team members and their account permission here.',
        ])
        <hr>
        <div class="row g-4 align-items-stretch">
            <!-- Attendance Chart -->
            <div class="col-lg-7">
                <div class="soft-card p-4 h-100">
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <span class="fw-bold"><i class="bi bi-graph-up me-2"></i>Employee Attendance</span>
                        <button class="btn btn-sm btn-light"><i class="bi bi-arrows-fullscreen"></i></button>
                    </div>
                    <canvas id="attChart" height="120"></canvas>
                    <div class="d-flex justify-content-center gap-4 mt-3 legend-pills">
                        <span class="pill"><span class="dot dot-hadir"></span>Hadir</span>
                        <span class="pill"><span class="dot dot-izin"></span>Izin</span>
                        <span class="pill"><span class="dot dot-sakit"></span>Sakit</span>
                        <span class="pill"><span class="dot dot-alfa"></span>Alfa</span>
                    </div>
                </div>
            </div>
            <!-- Employee List -->
            <div class="col-lg-5">
                <div class="soft-card p-4 h-100">
                    <div class="fw-bold mb-2"><i class="bi bi-people me-2"></i>Employee</div>
                    <div class="table-responsive">
                        <table class="table table-borderless align-middle mb-0">
                            <thead>
                                <tr class="text-muted small">
                                    <th>Name</th>
                                    <th>Position</th>
                                    <th class="text-end">Today Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <img src="https://randomuser.me/api/portraits/men/1.jpg" class="avatar me-2"
                                                alt="">
                                            <div>
                                                <div class="fw-semibold">Muhammad Alfan</div>
                                                <div class="text-muted small">YPSS-PDSS-001</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <span class="chip teacher">Teacher</span>
                                        <span class="chip staff">Staff</span>
                                    </td>
                                    <td class="text-end text-success fw-semibold">
                                        <span class="status-dot"><i class="bi bi-circle-fill"></i></span>Hadir
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <img src="https://randomuser.me/api/portraits/women/2.jpg" class="avatar me-2"
                                                alt="">
                                            <div>
                                                <div class="fw-semibold">Katarina Andrea</div>
                                                <div class="text-muted small">YPSS-PDSS-002</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td><span class="chip staff">Staff</span></td>
                                    <td class="text-end text-danger fw-semibold">
                                        <span class="status-dot"><i class="bi bi-circle-fill"></i></span>Alfa
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <img src="https://randomuser.me/api/portraits/men/3.jpg" class="avatar me-2"
                                                alt="">
                                            <div>
                                                <div class="fw-semibold">Mahesa Alghifari</div>
                                                <div class="text-muted small">YPSS-PDSS-003</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td><span class="chip teacher">Teacher</span></td>
                                    <td class="text-end text-success fw-semibold">
                                        <span class="status-dot"><i class="bi bi-circle-fill"></i></span>Hadir
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <img src="https://randomuser.me/api/portraits/men/4.jpg" class="avatar me-2"
                                                alt="">
                                            <div>
                                                <div class="fw-semibold">Muhammad Alfan</div>
                                                <div class="text-muted small">YPSS-PDSS-001</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <span class="chip teacher">Teacher</span>
                                        <span class="chip staff">Staff</span>
                                    </td>
                                    <td class="text-end text-success fw-semibold">
                                        <span class="status-dot"><i class="bi bi-circle-fill"></i></span>Hadir
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <img src="https://randomuser.me/api/portraits/women/5.jpg" class="avatar me-2"
                                                alt="">
                                            <div>
                                                <div class="fw-semibold">Katarina Andrea</div>
                                                <div class="text-muted small">YPSS-PDSS-002</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td><span class="chip staff">Staff</span></td>
                                    <td class="text-end text-danger fw-semibold">
                                        <span class="status-dot"><i class="bi bi-circle-fill"></i></span>Alfa
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <hr>
        <div class="row g-4 align-items-stretch">
            <!-- Finance Chart -->
            <div class="col-lg-7">
                <div class="soft-card p-4 h-100">
                    <div class="fw-bold mb-2"><i class="bi bi-bar-chart me-2"></i>Finance</div>
                    <canvas id="financeChart" height="120"></canvas>
                </div>
            </div>
            <!-- Calendar Academic -->
            <div class="col-lg-5">
                <div class="soft-card p-4 h-100">
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <span class="fw-bold"><i class="bi bi-calendar-event me-2"></i>Calendar Academic</span>
                        <select class="form-select form-select-sm w-auto">
                            <option>February</option>
                            <option>March</option>
                            <option>April</option>
                        </select>
                    </div>
                    <div class="table-responsive calendar">
                        <table class="table align-middle mb-0">
                            <thead class="dow">
                                <tr>
                                    <th>S</th>
                                    <th>M</th>
                                    <th>T</th>
                                    <th>W</th>
                                    <th>T</th>
                                    <th>F</th>
                                    <th>S</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td class="mark-success text-center">1</td>
                                    <td class="mark-danger text-center">2</td>
                                    <td class="text-center">3</td>
                                </tr>
                                <tr>
                                    <td class="text-center">4</td>
                                    <td class="text-center">5</td>
                                    <td class="mark-info text-center">6</td>
                                    <td class="text-center">7</td>
                                    <td class="text-center">8</td>
                                    <td class="mark-info text-center">9</td>
                                    <td class="text-center">10</td>
                                </tr>
                                <tr>
                                    <td class="text-center">11</td>
                                    <td class="text-center">12</td>
                                    <td class="text-center">13</td>
                                    <td class="text-center">14</td>
                                    <td class="text-center">15</td>
                                    <td class="text-center">16</td>
                                    <td class="text-center">17</td>
                                </tr>
                                <tr>
                                    <td class="mark-warn text-center">18</td>
                                    <td class="text-center">19</td>
                                    <td class="text-center">20</td>
                                    <td class="text-center">21</td>
                                    <td class="mark-success text-center">22</td>
                                    <td class="mark-warn text-center">23</td>
                                    <td class="text-center">24</td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="mt-2 small text-muted">
                            <span class="me-3">Legend:
                                <span class="dot dot-hadir"></span> Event |
                                <span class="dot dot-alfa"></span> Holiday |
                                <span class="dot dot-izin"></span> Exam |
                                <span class="dot dot-sakit"></span> Activity
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <!-- Chart.js CDN -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.1/dist/chart.umd.min.js"></script>
    <script>
        // Attendance Chart
        (function() {
            const ctx = document.getElementById('attChart').getContext('2d');
            const gradGreen = ctx.createLinearGradient(0, 0, 0, 220);
            gradGreen.addColorStop(0, 'rgba(52,168,83,.35)');
            gradGreen.addColorStop(1, 'rgba(52,168,83,0)');
            const gradYellow = ctx.createLinearGradient(0, 0, 0, 220);
            gradYellow.addColorStop(0, 'rgba(245,197,66,.35)');
            gradYellow.addColorStop(1, 'rgba(245,197,66,0)');
            const gradOrange = ctx.createLinearGradient(0, 0, 0, 220);
            gradOrange.addColorStop(0, 'rgba(243,161,59,.35)');
            gradOrange.addColorStop(1, 'rgba(243,161,59,0)');
            const gradRed = ctx.createLinearGradient(0, 0, 0, 220);
            gradRed.addColorStop(0, 'rgba(234,67,53,.35)');
            gradRed.addColorStop(1, 'rgba(234,67,53,0)');

            new Chart(ctx, {
                type: 'line',
                data: {
                    labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul'],
                    datasets: [{
                            label: 'Hadir',
                            data: [60, 62, 58, 61, 66, 62, 75],
                            borderColor: '#34a853',
                            backgroundColor: gradGreen,
                            fill: true,
                            tension: .4,
                            pointRadius: 0,
                            borderWidth: 2
                        },
                        {
                            label: 'Izin',
                            data: [20, 18, 17, 16, 17, 16, 18],
                            borderColor: '#f5c542',
                            backgroundColor: gradYellow,
                            fill: true,
                            tension: .4,
                            pointRadius: 0,
                            borderWidth: 2
                        },
                        {
                            label: 'Sakit',
                            data: [12, 10, 9, 11, 10, 9, 10],
                            borderColor: '#f3a13b',
                            backgroundColor: gradOrange,
                            fill: true,
                            tension: .4,
                            pointRadius: 0,
                            borderWidth: 2
                        },
                        {
                            label: 'Alfa',
                            data: [8, 10, 16, 12, 7, 9, 12],
                            borderColor: '#ea4335',
                            backgroundColor: gradRed,
                            fill: true,
                            tension: .4,
                            pointRadius: 0,
                            borderWidth: 2
                        },
                    ]
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            display: false
                        },
                        tooltip: {
                            mode: 'index',
                            intersect: false
                        }
                    },
                    scales: {
                        x: {
                            grid: {
                                display: false
                            }
                        },
                        y: {
                            grid: {
                                color: 'rgba(0,0,0,.05)'
                            },
                            ticks: {
                                stepSize: 10
                            }
                        }
                    }
                }
            });
        })();

        // Finance Bar Chart
        (function() {
            const ctx2 = document.getElementById('financeChart').getContext('2d');
            new Chart(ctx2, {
                type: 'bar',
                data: {
                    labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul'],
                    datasets: [{
                            label: 'Income',
                            data: [90, 80, 50, 95, 110, 70, 85],
                            backgroundColor: '#b0b0b0',
                            borderRadius: 6
                        },
                        {
                            label: 'Expense',
                            data: [75, 70, 45, 70, 55, 60, 80],
                            backgroundColor: '#c63e42',
                            borderRadius: 6
                        }
                    ]
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            display: false
                        }
                    },
                    scales: {
                        x: {
                            grid: {
                                display: false
                            }
                        },
                        y: {
                            grid: {
                                color: 'rgba(0,0,0,.05)'
                            },
                            beginAtZero: true
                        }
                    }
                }
            });
        })();
    </script>
@endpush
