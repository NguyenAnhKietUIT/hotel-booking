function drawPieChart() {
    const xValues = ["Beach", "Mountain", "Iconic City", "Countryside", "Camping", "Tropical"];
    const yValues = [92, 168, 36, 45, 60, 84];
    const barColors = [ "#B1DFAE", " #CAEBBA", "#E6F2D3", "#B0E3F5", "#92C7F0", "#78AEE3"];
    const barColorsHover = ["rgb(177 223 174 / 0.6)", "rgb(202 235 186 / 0.6)", "rgb(230 242 211 / 0.6)",
                        "rgb(176 227 245 / 0.6)", "rgb(146 199 240 / 0.6)", "rgb(120 174 227 / 0.6)"]

    new Chart("property-statistic-by-category", {
        type: "pie",
        data: {
            labels: xValues,
            datasets: [{
                backgroundColor: barColors,
                hoverBackgroundColor: barColorsHover,
                data: yValues,
            }]
        },
        options: {
            title: {
                display: true,
                text: "Real estate statistics by category",
                fontColor: "white",
                fontSize: 16,
            },
        }
    });
}

function drawLineChart() {
    const xMonths = ['JAN', 'FEB', 'MAR', 'APR', 'MAY', 'JUN', 'JUL', 'AUG', 'SEP', 'OCT', 'NOV', 'DEC'];

    const yValues = [10, 40, 50, 100, 60, 70, 80, 20, 30, 90, 12, 20]

    new Chart("booking-year", {
        type: "line",
        data: {
        labels: xMonths,
        datasets: [{
            fill: false,
            lineTension: 0,
            backgroundColor: "rgba(255, 255, 255, 1)",
            borderColor: "rgba(255, 255, 255, 0.2)",
            data: yValues
            }]
        },
        options: {
        legend: {
            display: false
        },
        title: {
            display: true,
            text: "Statistics of bookings in the year",
            fontColor: "white",
            fontSize: 16,
        },
        scales: {
            yAxes: [
                {
                    ticks: {
                        fontColor: "white",
                        min: 0, 
                        max: 100,
                        beginAtZero: true,
                    },
                }
            ],
            xAxes: [
                {
                    ticks: {
                        fontColor: "white",
                    }
                }
            ],
        }
      }
    });
}

drawPieChart();
drawLineChart();