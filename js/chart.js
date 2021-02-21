var ctx = document.getElementById('myChart').getContext('2d');
var chart = new Chart(ctx, {
    type: 'line',
    data: {
        labels: ['A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M'],
        datasets: [{
            label: 'My First dataset',
            // showLine: false,	
            backgroundColor: '#262B2D',
            pointRadius: 0,
            // borderColor: 'rgb(255, 99, 132)',
            data: [5 ,5, 5 , 16, 17,19, 35, 45, 38, 65, 62, 58, 75]
        },
        {
            label: 'My Second dataset',
        //    data: [28, 48, 40, 19, 86, 27, 90],
        // backgroundColor: 'rgba(0,148,106, 0.65)',
            backgroundColor: '#006042',
            pointRadius: 0,
            borderColor: '#00A97F',
            borderWidth: 2,
            data: [0 ,1, 3, 11, 10, 15, 28, 38, 30, 48, 50, 50, 68]
        }]
    },

    // Configuration options go here
    options: {
        legend: {
            display: false,
          },
        scales: {
            yAxes: [{
                stacked: true,
                display: false
            }],
            xAxes: [{
                  display: false
                }],
        }
    }
});

