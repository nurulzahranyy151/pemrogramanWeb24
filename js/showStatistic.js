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
    
    // Hancurkan grafik sebelumnya jika ada
    if (window.myChart instanceof Chart) {
        window.myChart.destroy();
    }

    window.myChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
            datasets: [{
                label: 'Total Reports',
                data: Object.values(data),
                backgroundColor: 'rgba(54, 162, 235, 0.2)',
                borderColor: 'rgba(54, 162, 235, 1)',
                borderWidth: 1
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
