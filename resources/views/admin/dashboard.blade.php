@extends('admin.admin')
@section('title')
    <title>Admin Panel - Gardena Connect</title>
    <style>
        .custom-scrollbar::-webkit-scrollbar {
            height: 4px;
        }
        .custom-scrollbar::-webkit-scrollbar-thumb {
            background: #d1d5db;
            border-radius: 10px;
        }
        
        /* Styles pour contenir les graphiques */
        .chart-wrapper {
            position: relative;
            width: 100%;
            overflow: hidden;
        }
        
        .chart-canvas-container {
            position: relative;
            width: 100% !important;
            height: 240px !important;
        }
        
        /* Responsive pour petits écrans */
        @media (max-width: 768px) {
            .chart-canvas-container {
                height: 200px !important;
            }
            .compact-chart {
                min-height: 220px !important;
            }
        }
        
        /* Correction débordement */
        .overflow-guard {
            overflow: hidden;
            position: relative;
        }
        
        /* Boutons période avec meilleur feedback */
        .period-btn {
            transition: all 0.2s ease;
            user-select: none;
        }
        .period-btn.active {
            background-color: white !important;
            color: #1f2937 !important;
            box-shadow: 0 1px 3px rgba(0,0,0,0.1);
            font-weight: 500;
        }
        .period-btn:not(.active):hover {
            background-color: #f3f4f6;
        }
    </style>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
@endsection
@section('adminContent')
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4">Panel Admin</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item active">Vue d'ensemble</li>
            </ol>
            
            <div class="p-4 grid grid-cols-1 lg:grid-cols-2 gap-4">
                {{-- COLONNE GAUCHE --}}
                <div class="space-y-4">
                    <div class="mb-3">
                        <p class="font-semibold text-gray-800 text-sm">Évolution des inscriptions mensuelles</p>
                        <p class="text-xs text-gray-500">Nouveaux inscrits chaque mois</p>
                    </div>
                    <!-- Conteneur graphique -->
                    <div class="chart-wrapper">
                        <div class="chart-canvas-container">
                            <canvas id="inscriptionsChart"></canvas>
                        </div>
                    </div>

                    <!-- Légende CLARIFIÉE -->
                    <div class="mt-4 grid grid-cols-1 sm:grid-cols-2 gap-3">
                        <div class="bg-blue-50 p-3 rounded-lg">
                            <div class="flex items-center mb-2">
                                <div class="w-3 h-3 rounded-full bg-blue-500 mr-2"></div>
                                <span class="font-medium text-sm">Jardiniers</span>
                            </div>
                            <div class="text-xs text-gray-600 space-y-1">
                                <div>Ce mois : <span class="font-bold text-blue-700" id="currentMonthJardinier">0</span></div>
                                <div>Total période : <span class="font-bold text-blue-700" id="totalJardiniers">0</span></div>
                            </div>
                        </div>
                        
                        <div class="bg-green-50 p-3 rounded-lg">
                            <div class="flex items-center mb-2">
                                <div class="w-3 h-3 rounded-full bg-green-500 mr-2"></div>
                                <span class="font-medium text-sm">Particuliers</span>
                            </div>
                            <div class="text-xs text-gray-600 space-y-1">
                                <div>Ce mois : <span class="font-bold text-green-700" id="currentMonthParticulier">0</span></div>
                                <div>Total période : <span class="font-bold text-green-700" id="totalParticuliers">0</span></div>
                            </div>
                        </div>
                    </div>

                    <div class="mt-3 p-2 bg-gray-50 rounded text-xs text-gray-600">
                        <i class="bi bi-info-circle text-blue-500 mr-1"></i>
                        <strong>Comment lire ce graphique :</strong> Chaque point représente les <strong>nouveaux inscrits</strong> du mois. 
                        Les totaux affichés sont la <strong>somme de tous les mois</strong>.
                    </div>

                </div>

                {{-- COLONNE DROITE : STATISTIQUES FINANCIÈRES --}}
                <div class="bg-white border border-gray-200 rounded-xl p-4 shadow-sm flex flex-col">
                    <!-- En-tête avec boutons CORRIGÉS -->
                    <div class="mb-4">
                        <h3 class="font-semibold text-gray-800 text-sm mb-1">Statistiques financières</h3>
                        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-2">
                            <p class="text-xs text-gray-500">Projets vs Revenus (FCFA)</p>
                            
                            <!-- Boutons période - CORRECTION CLIC -->
                            <div class="inline-flex items-center rounded-lg bg-gray-100 p-0.5" id="periodButtons">
                                <button
                                    class="period-btn active px-3 py-1 text-xs font-medium rounded-md"
                                    onclick="updateApex('monthly')"
                                    data-period="monthly"
                                >
                                    Mois
                                </button>
                                <button
                                    class="period-btn px-3 py-1 text-xs font-medium rounded-md"
                                    onclick="updateApex('quarterly')"
                                    data-period="quarterly"
                                >
                                    Trimestre
                                </button>
                                <button
                                    class="period-btn px-3 py-1 text-xs font-medium rounded-md"
                                    onclick="updateApex('annually')"
                                    data-period="annually"
                                >
                                    Année
                                </button>
                            </div>
                        </div>
                        
                        <!-- Info période active -->
                        <div id="periodInfo" class="mt-2 text-xs text-blue-600 font-medium">
                            Affichage des données mensuelles
                        </div>
                    </div>

                    <!-- Graphique financier -->
                    <div class="flex-1 overflow-hidden">
                        <div id="apex-area" class="w-full" style="height: 240px;"></div>
                    </div>
                    
                    <!-- Résumé -->
                    <div class="mt-4 pt-3 border-t">
                        <div id="statsSummary" class="text-xs text-gray-600 mb-2">
                            <!-- Rempli dynamiquement -->
                        </div>
                        
                        <div class="flex items-center justify-between text-xs">
                            <div class="flex items-center space-x-4">
                                <div class="flex items-center">
                                    <div class="w-3 h-0.5 bg-blue-500 mr-1"></div>
                                    <span>Projets réalisés</span>
                                </div>
                                <div class="flex items-center">
                                    <div class="w-3 h-0.5 bg-green-500 mr-1"></div>
                                    <span>Revenus générés</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Tableau -->
            <div class="card mb-4 mt-4">
                <div class="card-header py-2 px-4 bg-gray-50">
                    <div class="flex items-center justify-between">
                        <div>
                            <i class="fas fa-table me-1 text-sm"></i>
                            <span class="font-medium text-sm text-slate-700">Récap projets</span>
                        </div>
                        <span class="text-xs text-gray-500">{{ $missions->count() }} missions</span>
                    </div>
                </div>
                <div class="card-body p-4">
                    <div class="overflow-x-auto">
                        <table id="datatablesSimple" class="w-full text-sm">
                            <thead class="bg-gray-100 text-xs">
                                <tr>
                                    <th class="px-3 py-2 text-left">Projet</th>
                                    <th class="px-3 py-2 text-left">Auteur</th>
                                    <th class="px-3 py-2 text-left">Jardinier</th>
                                    <th class="px-3 py-2 text-left">Soum.</th>
                                    <th class="px-3 py-2 text-left">Début</th>
                                    <th class="px-3 py-2 text-left">Montant</th>
                                </tr>
                            </thead>
                            <tbody class="text-sm">
                                @forelse ($missions as $mission)
                                    <tr class="border-b hover:bg-gray-50">
                                        <td class="px-3 py-2 truncate max-w-[150px]" title="{{ $mission->projet->titre }}">
                                            {{ Str::limit($mission->projet->titre, 20) }}
                                        </td>
                                        <td class="px-3 py-2">
                                            <div class="flex items-center">
                                                <div class="w-6 h-6 rounded-full bg-blue-100 flex items-center justify-center mr-2">
                                                    <span class="text-xs text-blue-800">{{ strtoupper(substr($mission->user->prenom, 0, 1)) }}</span>
                                                </div>
                                                <span>{{ Str::limit($mission->user->prenom, 8) }}</span>
                                            </div>
                                        </td>
                                        <td class="px-3 py-2">
                                            <div class="flex items-center">
                                                <div class="w-6 h-6 rounded-full bg-green-100 flex items-center justify-center mr-2">
                                                    <span class="text-xs text-green-800">{{ strtoupper(substr($mission->jardinier->user->prenom, 0, 1)) }}</span>
                                                </div>
                                                <span>{{ Str::limit($mission->jardinier->user->prenom, 8) }}</span>
                                            </div>
                                        </td>
                                        <td class="px-3 py-2 text-center">
                                            <span class="inline-flex items-center justify-center w-6 h-6 rounded-full {{ $mission->projet->propositions->count() > 3 ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-800' }} text-xs font-medium">
                                                {{ $mission->projet->propositions->count() }}
                                            </span>
                                        </td>
                                        <td class="px-3 py-2 text-gray-600">
                                            {{ date('d/m', strtotime($mission->projet->created_at)) }}
                                        </td>
                                        <td class="px-3 py-2 font-medium text-green-700 whitespace-nowrap">
                                            {{ number_format($mission->montant, 0, '', ' ') }} XOF
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center py-6 text-gray-500 text-sm">
                                            <i class="bi bi-inbox text-lg mb-1 block"></i>
                                            Aucune mission
                                        </td>
                                    </tr>
                                @endforelse                       
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </main>

    {{-- ------------------ DONNÉES ------------------ --}}
    <script>
        // Données BRUTES récupérées du contrôleur
        const statsData = {
            monthly: @json($monthly),
            quarterly: @json($quarterly),
            annually: @json($annually),
        };
        
        // Données d'inscriptions
        const inscriptionLabels = {!! json_encode($inscriptions->pluck('period')) !!};
        const jardinierData = {!! json_encode($inscriptions->pluck('jardiniers')) !!};
        const particulierData = {!! json_encode($inscriptions->pluck('particuliers')) !!};
        
        // Calculer les totaux POUR AFFICHAGE
        const totalJardiniersPeriod = jardinierData.reduce((a, b) => a + b, 0);
        const totalParticuliersPeriod = particulierData.reduce((a, b) => a + b, 0);
        
        console.log('=== DONNÉES INSCRIPTIONS ===');
        console.log('Périodes:', inscriptionLabels);
        console.log('Jardiniers par mois:', jardinierData);
        console.log('Particuliers par mois:', particulierData);
        console.log('Total jardiniers (somme mois):', totalJardiniersPeriod);
        console.log('Total particuliers (somme mois):', totalParticuliersPeriod);
        console.log('======================');
    </script>

    {{-- ------------------ CHART.JS AVEC AFFICHAGE CLARIFIÉ ------------------ --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const canvas = document.getElementById('inscriptionsChart');
            const container = canvas.parentElement;
            
            // Définir les dimensions
            canvas.width = container.clientWidth;
            canvas.height = container.clientHeight;
            
            const ctx = canvas.getContext('2d');
            
            // Récupérer les derniers mois (max 12)
            const maxDisplay = Math.min(inscriptionLabels.length, 12);
            const displayLabels = inscriptionLabels.slice(-maxDisplay);
            const displayJardiniers = jardinierData.slice(-maxDisplay);
            const displayParticuliers = particulierData.slice(-maxDisplay);
            
            // Dernier mois (le plus récent)
            const lastMonthIndex = displayLabels.length - 1;
            const lastMonthJardinier = displayJardiniers[lastMonthIndex] || 0;
            const lastMonthParticulier = displayParticuliers[lastMonthIndex] || 0;
            
            // Mettre à jour les affichages des totaux
            document.getElementById('currentMonthJardinier').textContent = lastMonthJardinier;
            document.getElementById('currentMonthParticulier').textContent = lastMonthParticulier;
            document.getElementById('totalJardiniers').textContent = totalJardiniersPeriod;
            document.getElementById('totalParticuliers').textContent = totalParticuliersPeriod;
            
            // Créer le graphique
            const inscriptionsChart = new Chart(ctx, {
                type: 'bar', // Changé en barres pour mieux voir les valeurs par mois
                data: {
                    labels: displayLabels,
                    datasets: [
                        {
                            label: 'Nouveaux jardiniers',
                            data: displayJardiniers,
                            backgroundColor: 'rgba(59, 130, 246, 0.7)',
                            borderColor: '#3B82F6',
                            borderWidth: 1,
                            borderRadius: 4,
                            barPercentage: 0.6,
                            categoryPercentage: 0.8
                        },
                        {
                            label: 'Nouveaux particuliers',
                            data: displayParticuliers,
                            backgroundColor: 'rgba(16, 185, 129, 0.7)',
                            borderColor: '#10B981',
                            borderWidth: 1,
                            borderRadius: 4,
                            barPercentage: 0.6,
                            categoryPercentage: 0.8
                        }
                    ]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            position: 'top',
                            labels: {
                                boxWidth: 12,
                                padding: 15,
                                font: { size: 11 }
                            }
                        },
                        tooltip: {
                            mode: 'index',
                            intersect: false,
                            backgroundColor: 'rgba(255, 255, 255, 0.95)',
                            titleFont: { size: 11 },
                            bodyFont: { size: 11 },
                            padding: 10,
                            displayColors: true,
                            callbacks: {
                                label: function(context) {
                                    const label = context.dataset.label || '';
                                    const value = context.parsed.y;
                                    return `${label}: ${value} inscription(s) ce mois`;
                                },
                                afterBody: function(context) {
                                    const jardinierIndex = context[0].dataIndex;
                                    const particulierIndex = context[1]?.dataIndex || jardinierIndex;
                                    
                                    // Calculer les totaux cumulés jusqu'à ce mois
                                    let cumulJardiniers = 0;
                                    let cumulParticuliers = 0;
                                    
                                    for (let i = 0; i <= jardinierIndex; i++) {
                                        cumulJardiniers += displayJardiniers[i] || 0;
                                    }
                                    
                                    for (let i = 0; i <= particulierIndex; i++) {
                                        cumulParticuliers += displayParticuliers[i] || 0;
                                    }
                                    
                                    return [
                                        '',
                                        `Total cumulé jardiniers: ${cumulJardiniers}`,
                                        `Total cumulé particuliers: ${cumulParticuliers}`
                                    ];
                                }
                            }
                        }
                    },
                    scales: {
                        x: {
                            grid: {
                                display: false,
                                drawBorder: false
                            },
                            ticks: {
                                font: { size: 10 },
                                maxRotation: 45,
                                minRotation: 0
                            },
                            title: {
                                display: true,
                                text: 'Mois',
                                font: { size: 11, weight: 'bold' }
                            }
                        },
                        y: {
                            beginAtZero: true,
                            grid: {
                                color: 'rgba(229, 231, 235, 0.5)',
                                drawBorder: false
                            },
                            ticks: {
                                font: { size: 10 },
                                stepSize: 1,
                                callback: function(value) {
                                    return Number.isInteger(value) ? value : '';
                                }
                            },
                            title: {
                                display: true,
                                text: 'Nombre de nouveaux inscrits',
                                font: { size: 11, weight: 'bold' }
                            }
                        }
                    },
                    interaction: {
                        intersect: false,
                        mode: 'index'
                    }
                }
            });
            
            // Redimensionnement
            window.addEventListener('resize', function() {
                canvas.width = container.clientWidth;
                canvas.height = container.clientHeight;
                inscriptionsChart.resize();
            });
            
            // Afficher les données dans la console pour débogage
            console.log('=== GRAPHIQUE INSCRIPTIONS ===');
            console.log('Mois affichés:', displayLabels);
            console.log('Jardiniers par mois (affichés):', displayJardiniers);
            console.log('Particuliers par mois (affichés):', displayParticuliers);
            console.log('Dernier mois - Jardiniers:', lastMonthJardinier);
            console.log('Dernier mois - Particuliers:', lastMonthParticulier);
            console.log('==========================');
        });
    </script>

    {{-- ------------------ APEXCHART (inchangé) ------------------ --}}
    <script>
        let chart;
        let currentPeriod = 'monthly';

        function updateActiveButton(period) {
            document.querySelectorAll('.period-btn').forEach(btn => {
                btn.classList.remove('active', 'bg-white', 'text-gray-900', 'shadow-sm');
                btn.classList.add('text-gray-500');
            });
            
            const activeBtn = document.querySelector(`.period-btn[data-period="${period}"]`);
            if (activeBtn) {
                activeBtn.classList.add('active', 'bg-white', 'text-gray-900', 'shadow-sm');
                activeBtn.classList.remove('text-gray-500');
            }
        }

        function updateApex(period) {
            currentPeriod = period;
            updateActiveButton(period);
            
            let data = statsData[period];
            let periods = data.map(d => d.period);
            let projects = data.map(d => d.total_projects);
            let amount = data.map(d => d.total_amount);
            
            const totalProjects = projects.reduce((a, b) => a + b, 0);
            const totalAmount = amount.reduce((a, b) => a + b, 0);
            
            document.getElementById('periodInfo').innerHTML = 
                `Affichage des données ${period === 'monthly' ? 'mensuelles' : period === 'quarterly' ? 'trimestrielles' : 'annuelles'}`;
                
            document.getElementById('statsSummary').innerHTML = `
                <strong>Total période :</strong> 
                <span class="text-blue-600">${totalProjects} projets</span> | 
                <span class="text-green-600">${totalAmount.toLocaleString('fr-FR')} FCFA</span>
            `;
            
            let options = {
                chart: { 
                    type: 'line',
                    height: 240,
                    toolbar: { show: false }
                },
                stroke: { 
                    curve: 'smooth',
                    width: 3
                },
                colors: ['#3B82F6', '#10B981'],
                series: [
                    { name: "Projets", data: projects },
                    { name: "Revenus (FCFA)", data: amount }
                ],
                xaxis: { categories: periods },
                yaxis: [
                    { title: { text: "Projets" } },
                    {
                        opposite: true,
                        title: { text: "FCFA" },
                        labels: { 
                            formatter: function(val) { 
                                if (val >= 1000000) return (val/1000000).toFixed(1) + 'M';
                                if (val >= 1000) return (val/1000).toFixed(0) + 'k';
                                return val;
                            }
                        }
                    }
                ],
                tooltip: {
                    y: {
                        formatter: function(val, { seriesIndex }) {
                            if (seriesIndex === 1) {
                                return val.toLocaleString('fr-FR') + ' FCFA';
                            }
                            return val;
                        }
                    }
                }
            };

            if (chart) chart.destroy();
            chart = new ApexCharts(document.querySelector("#apex-area"), options);
            chart.render();
        }

        document.addEventListener('DOMContentLoaded', function() {
            updateActiveButton('monthly');
            updateApex('monthly');
        });
    </script>
@endsection