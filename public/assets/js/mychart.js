(function($) {
    $(document).ready(function(){
        var labels = Object.keys(users);
        console.log(labels);
        var data = Object.values(users);
        console.log(labels);

        var ctx = document.getElementById('myChart');
        myChartClass.chartData(ctx, 'bar', labels, data);

        var pieChart = document.getElementById('myPieChart');
        myChartClass.chartData(pieChart,'pie', labels, data);
    });

    var myChartClass = {
        chartData: function(ctx, type, labels, data) {
            new Chart(ctx, {
                type: type,
                data: {
                    labels: labels,
                    datasets: [{
                        label: '# Number Of Post',
                        data: data,
                        backgroundColor: [
                            'rgba(0, 128, 0, 0.2)',
                            'rgba(255, 99, 132, 0.2)',
                            'rgba(54, 162, 235, 0.2)',
                            'rgba(255, 206, 86, 0.2)',   // Add more colors as needed
                            'rgba(153, 102, 255, 0.2)',  // Add more colors as needed
                            // ...
                        ],

                        borderColor: [
                            'rgba(0, 128, 0, 0.2)',
                            'rgba(255, 99, 132, 1)',
                            'rgba(54, 162, 235, 1)',
                            'rgba(255, 206, 86, 1)',     // Corresponding border colors
                            'rgba(153, 102, 255, 1)',    // Corresponding border colors
                            // ...
                        ],

                        borderWidth: 1,
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        }
    };
})(jQuery);

