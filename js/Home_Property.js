function drawChart() {
    const xDates = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24, 25, 26, 27, 28, 29, 30, 31];
    const xMonths = ['JAN', 'FEB', 'MAR', 'APR', 'MAY', 'JUN', 'JUL', 'AUG', 'SEP', 'OCT', 'NOV', 'DEC'];

    const yValues = [0, 10, 40, 50, 100, 60, 70, 80, 20, 30, 90, 12, 20, 55, 78, 24, 30, 30, 30, 60, 65, 58, 90, 92]

    new Chart("analytics", {
        type: "line",
        data: {
        labels: xDates,
        datasets: [{
            fill: false,
            lineTension: 0,
            backgroundColor: "rgba(0, 0, 0, 1)",
            borderColor: "rgba(0, 0, 0, 0.2)",
            data: yValues
            }]
        },
        options: {
        legend: {
            display: false
        },
        title: {
            display: true,
            text: "Reservation(s)"
        },
        scales: {
            yAxes: [
                {
                    ticks: {
                        min: 0, 
                        max: 100
                    }
                }
            ],
        }
      }
    });
}

drawChart();