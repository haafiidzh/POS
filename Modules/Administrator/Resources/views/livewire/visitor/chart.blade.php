<div class="col-lg-9 mb-3">
    <div class="card">
        <div class="card-body">
            <h6 class="card-title">Jumlah Pengunjung Website</h6>
            <p class="text-success font-semibold h4">
                {{ $total_visitor }} Pengunjung
            </p>
            <div class="position-relative" wire:ignore wire:loading.class="skeleton" style="height: 320px;">
                <canvas id="visitor-chart"></canvas>
            </div>
        </div>
    </div>
</div>

@push('script')
    <script>
        window.addEventListener('DOMContentLoaded', function() {
            const ctx = document.getElementById('visitor-chart').getContext('2d');
            const colors = window.chartjs_options.colors;
            let options = window.chartjs_options.line;
            let gradient = ctx.createLinearGradient(0, 0, 0, 400);
            gradient.addColorStop(.5, colors.gradient_primary.from);
            gradient.addColorStop(0, colors.gradient_primary.to);

            /**
             * Add data too chart
             *
             * @param {object} chart
             * @param {object} response
             */
            function addData(chart, response) {
                chart.data.labels = response[0].labels;
                chart.data.datasets = response[0].data;
                // chart.data.datasets[0].backgroundColor = [colors.warning, colors.primary, colors.light]

                chart.update();
            }

            /**
             * Remove chart data
             *
             * @param {object} chart
             */
            function removeData(chart) {
                chart.data.labels = [];
                chart.data.datasets = []
                chart.update();
            }
            /**
             * Update chart data (label, datasets)
             *
             * @param {object} chart
             * @param {object} response
             */
            function upadateChart(chart, response) {
                removeData(chart)
                addData(chart, response)
            }

            console.log(@json($labels));
            // Modify default options
            // Set data labels
            options.data.labels = @json($labels);
            // Set datasets
            options.data.datasets = @json($data);

            // Set colors to pie chart
            options.data.datasets[0].fill = true
            options.data.datasets[0].fillColor = gradient

            // Modify data tooltip
            options.options = {
                responsive: true,
                maintainAspectRatio: false,
                elements: {
                    line: {
                        tension: 0.4
                    }
                },
                plugins: {
                    tooltip: {
                        callbacks: {
                            label: function(item) {
                                return (`${item.formattedValue} Pengunjung`)
                            }
                        }
                    }
                }
            }

            // Render Chart
            const chart = new Chart(ctx, options);

            window.addEventListener('update-visitor-chart', function(e) {
                const res = e.detail
                console.log(res);
                upadateChart(chart, res)
            })

        })
    </script>
@endpush
