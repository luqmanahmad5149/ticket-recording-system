<h1>{{ $title }}</h1>
<canvas id="myChart" width="400" height="400" style="padding-bottom: 8px;"></canvas>
<input onchange="filterStartDate(this)" type="date" value="2022-11-07" min="2022-01-01" max="2022-12-31">
<input onchange="filterEndDate(this)" type="date" value="2022-11-13" min="2022-01-01" max="2022-12-31">
<select name="currencies" onchange="filterCurrency(this)">
    @foreach($currencies as $currency)
    <option value="{{ $currency->currency }}">{{ $currency->currency }}</option>
    @endforeach
</select>
<script>
$(function () {
    const dataJs = <?php echo json_encode($tickets); ?>;
    const dateChartJs = dataJs.map((data, index) => {
        let dayJs = new Date(data.date);
        return dayJs.setHours(0, 0, 0, 0);
    });

    const ticketChartJs = dataJs.map((data, index) => {
        return data.tickets;
    });

    var ctx = document.getElementById("myChart").getContext('2d');
    var myChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: dateChartJs,
            datasets: [{
                label: '# of Ticket',
                data: ticketChartJs,
                backgroundColor: [
                    'rgba(255, 99, 132, 0.2)',
                ],
                borderColor: [
                    'rgba(255,99,132,1)',
                ],
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero:true
                },
                x: {
                    min: '2022-11-07',
                    max: '2022-11-13',
                    type: 'time',
                    time: {
                        unit: 'day'
                    }
                }
            }
        }
    });

    function filterStartDate(date) {
        const startDate = new Date(date.value);
        myChart.options.scales.x.min = startDate.setHours(0, 0, 0, 0);
        myChart.update();
    }

    function filterEndDate(date) {
        const endDate = new Date(date.value);
        myChart.options.scales.x.max = endDate.setHours(0, 0, 0, 0);
        myChart.update();
    }

    function filterCurrency(currency) {
        const dataJs2 = [...dataJs];
        const filterDataJs2 = dataJs2.filter(data => {
            return data.currency == currency.value;
        });

        const dateChartJs2 = filterDataJs2.map((data, index) => {
            let dayJs = new Date(data.date);
            return dayJs.setHours(0, 0, 0, 0);
        });

        const ticketChartJs2 = filterDataJs2.map((data, index) => {
            return data.tickets;
        });

        myChart.data.labels = dateChartJs2;
        myChart.data.datasets[0].data = ticketChartJs2;
        myChart.update();
    }

    // export function to globals
    window.filterStartDate=filterStartDate;
    window.filterEndDate=filterEndDate;
    window.filterCurrency=filterCurrency;
});
</script>