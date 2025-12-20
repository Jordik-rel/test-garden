@extends('jardinier.recap.base')
@section('title')
    <title>Tableau de bord Jardinier - Gardena Connect</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
@endsection

@section('content')

<div class="p-6 grid grid-cols-1 md:grid-cols-2 gap-6 items-stretch">

    {{-- LEFT COLUMN --}}
    <div class="space-y-6">
        <div class="grid grid-cols-1 gap-6 md:grid-cols-2 items-stretch">

            <!-- Customers Card -->
            <div class="bg-white p-6 rounded-xl shadow h-full flex items-end gap-4">
                <div>
                    <div class="p-3 bg-gray-100 rounded-lg text-gray-600 text-2xl">
                        <i class="bi bi-people"></i>
                    </div>
                    <p class="text-gray-500">Jardiniers</p>
                    <p class="text-3xl font-bold">3,782</p>
                </div>
                <div>
                    <span class="text-green-600 bg-green-100 px-3 py-1 mt-2 inline-block rounded-full text-xs">
                        ↑ 11.01%
                    </span>
                </div>
            </div>

            <!-- Orders Card -->
            <div class="bg-white p-6 rounded-xl shadow h-full flex items-end gap-4">
                <div>
                    <div class="p-3 bg-gray-100 rounded-lg text-gray-600 text-2xl">
                        <i class="bi bi-box-seam"></i>
                    </div>
                    <p class="text-gray-500">Projets</p>
                    <p class="text-3xl font-bold">5,359</p>
                </div>
                <div>
                    <span class="text-red-600 bg-red-100 px-3 py-1 mt-2 inline-block rounded-full text-xs">
                        ↓ 9.05%
                    </span>
                </div>
            </div>
        </div>

        <!-- Monthly Sales Chart -->
        <div class="md:col-span-2 h-fit bg-white p-6 rounded-xl shadow">
            <p class="font-semibold text-lg">Ventes par mois</p>
            <canvas id="salesChart" class="mt-4 h-52"></canvas>
        </div>
    </div>

    {{-- RIGHT COLUMN : NEW STATISTICS CARD --}}
    <div class="rounded-2xl bg-white border border-gray-200 p-6 h-full flex flex-col shadow">

        <!-- Header -->
        <div class="flex flex-col gap-5 mb-6">
            <div class="w-full">
                <h3 class="text-lg font-semibold text-gray-800">Statistique</h3>
                <p class="mt-1 text-gray-500 text-sm">Target you’ve set for each month</p>
            </div>

            <!-- Buttons -->
            <div>
                <div class="inline-flex items-center gap-0.5 rounded-lg bg-gray-100 p-0.5">
                    <button
                        class="px-3 py-2 font-medium rounded-md text-sm bg-white text-gray-900 shadow"
                        onclick="updateApex('monthly', event)"
                    >
                        Mois
                    </button>
                    <button
                        class="px-3 py-2 font-medium rounded-md text-sm text-gray-500 hover:text-gray-900"
                        onclick="updateApex('quarterly', event)"
                    >
                        Quarterly
                    </button>
                    <button
                        class="px-3 py-2 font-medium rounded-md text-sm text-gray-500 hover:text-gray-900"
                        onclick="updateApex('annually', event)"
                    >
                        Annuel
                    </button>
                </div>
            </div>
        </div>

        <!-- Chart -->
        <div class="max-w-full overflow-x-auto custom-scrollbar">
            <div id="apex-area" class="-ml-4 min-w-[1000px] xl:min-w-full pl-2 h-[310px]"></div>
        </div>

    </div>

</div>

@endsection


@section('script')

{{-- ------------------ CHART.JS (Ton code existant) ------------------ --}}
<script>
    const salesCtx = document.getElementById('salesChart').getContext('2d');

    new Chart(salesCtx, {
        type: 'bar',
        data: {
            labels: ['Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec'],
            datasets: [{
                label: 'Sales',
                data: [120, 340, 210, 290, 130, 160, 110, 250, 170, 350, 190, 280],
                borderRadius: 8,
                backgroundColor: '#4F46E5'
            }]
        },
        options: {
            plugins: { legend: { display: false } },
            scales: {
                y: { beginAtZero: true, grid: { display: false } },
                x: { grid: { display: false } }
            }
        }
    });
</script>

{{-- ------------------ APEXCHARTS : NEW CARD ------------------ --}}
<script>
    const apexData = {
        monthly: {
            series: [
                { name: 'Sales', data: [180,190,170,160,175,165,170,205,230,210,240,235] },
                { name: 'Revenue', data: [40,30,50,40,55,40,70,100,110,120,150,140] }
            ]
        },
        quarterly: {
            series: [
                { name: 'Sales', data: [550, 505, 600, 680] },
                { name: 'Revenue', data: [130, 180, 210, 260] }
            ]
        },
        annually: {
            series: [
                { name: 'Sales', data: [2100, 2400, 2600] },
                { name: 'Revenue', data: [500, 650, 780] }
            ]
        }
    };

    const apexOptions = {
        chart: {
            type: 'area',
            height: 310,
            toolbar: { show: false }
        },
        colors: ['#465FFF', '#9CB9FF'],
        fill: {
            gradient: { enabled: true, opacityFrom: 0.55, opacityTo: 0 }
        },
        stroke: { curve: 'straight', width: 2 },
        markers: { size: 0 },
        dataLabels: { enabled: false },
        xaxis: {
            categories: ['Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec'],
            axisBorder: { show: false },
            axisTicks: { show: false }
        },
        grid: {
            xaxis: { lines: { show: false } },
            yaxis: { lines: { show: true } }
        },
        legend: { show: false },
        series: apexData.monthly.series
    };

    let apexChart = new ApexCharts(document.querySelector("#apex-area"), apexOptions);
    apexChart.render();

    function updateApex(type, button) {
        apexChart.updateSeries(apexData[type].series);

        const buttons = button.parentNode.querySelectorAll("button");
        buttons.forEach(b => b.classList.remove("bg-white", "text-gray-900", "shadow"));
        button.classList.add("bg-white", "text-gray-900", "shadow");
    }
</script>

<style>
.custom-scrollbar::-webkit-scrollbar {
    height: 6px;
}
.custom-scrollbar::-webkit-scrollbar-thumb {
    background: #d1d5db;
    border-radius: 10px;
}
</style>

@endsection
