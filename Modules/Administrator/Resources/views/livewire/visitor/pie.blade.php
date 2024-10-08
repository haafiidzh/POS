<div class="col-lg-3 mb-3" data-wrapper="visitor-pie-chart">
    <div class="card">
        <div class="card-body" wire:ignore>
            <h6 class="card-title mb-2">Statistik Pengunjung</h6>
            <div class="d-flex justify-content-center" wire:ignore style="height: 330px;">
                <canvas id="visitor-pie-chart"></canvas>
            </div>
        </div>
    </div>
</div>

@push('script')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const ctx = document.getElementById('visitor-pie-chart').getContext('2d');

            window.addEventListener('load-pie-chart', function(event) {
                console.log(@json($data));
                // Dummy data for testing purposes
                const data = @json($data);

                // Clear the canvas before creating a new chart
                if (window.visitorPieChart) {
                    window.visitorPieChart.destroy();
                }

                window.visitorPieChart = new Chart(ctx, {
                    type: 'pie',
                    data: data,
                    options: {
                        responsive: true,
                        plugins: {
                            legend: {
                                position: 'top',
                            },
                            tooltip: {
                                callbacks: {
                                    label: function(context) {
                                        const label = context.label || '';
                                        const value = context.raw || 0;
                                        return `${label}: ${value} Pengunjung`;
                                    }
                                }
                            }
                        }
                    }
                });
            });

            // Trigger the load-pie-chart event with dummy data for testing
            window.dispatchEvent(new CustomEvent('load-pie-chart', {
                detail: {
                    data: {} // No need to pass data as we are using dummy data directly
                }
            }));
        });
    </script>
@endpush
