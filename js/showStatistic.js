document.addEventListener("DOMContentLoaded", function() {
    var currentYear = new Date().getFullYear();
    fetchMonthlyStats(currentYear);
});

document.getElementById('tahun').addEventListener('change', function() {
    var selectedYear = this.value;
    console.log(selectedYear);
    fetchMonthlyStats(selectedYear);
});

function fetchMonthlyStats(year) {
    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function() {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                var response = JSON.parse(xhr.responseText);
                updateChart(response);
            } else {
                console.error("Error fetching monthly statistics: " + xhr.status);
            }
        }
    };
    xhr.open("GET", "findStatisticData.php?year=" + year, true);
    xhr.send();
}

function updateChart(data) {
    var ctx = document.getElementById('monthlyChart').getContext('2d');
    
    // Destroy the previous chart if it exists
    if (window.myChart instanceof Chart) {
        window.myChart.destroy();
    }

    var colors = [
        '#FF6384', '#36A2EB', '#FFCE56', '#4BC0C0', '#9966FF', '#FF9F40',
        '#E7E9ED', '#76FF03', '#D32F2F', '#1976D2', '#F57C00', '#388E3C'
    ];

    window.myChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
            datasets: [{
                label: 'Total Reports',
                data: Object.values(data),
                backgroundColor: colors,
                borderWidth: 1,
                borderRadius: 10 
            }]
        },
        options: {
            plugins: {
                legend: {
                    display: true,
                    labels: {
                        color: 'black'
                    }
                },
                roundedBars: true
            },
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        color: 'black'
                    },
                    grid: {
                        display: false
                    }
                },
                x: {
                    ticks: {
                        color: 'black'
                    },
                    grid: {
                        display: false
                    }
                }
            }
        }
    });
}
