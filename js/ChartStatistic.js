const ctx = document.getElementById('barchart').getContext('2d');

        const barchart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'],
                datasets: [{
                    label: 'Total Laporan',
                    data: [12, 19, 3, 5, 2, 3, 1, 3, 4, 12, 1, 3],
                    borderWidth: 1,
                    backgroundColor: [
                        'rgba(54, 162, 235, 0.2)'
                    ],
                    borderColor: [
                        'rgba(54, 162, 235, 1)'
                    ]
                }]
            },
            options: {
                responsive: false,  // Disable responsiveness
                maintainAspectRatio: false, // Ensure the chart uses the specified dimensions
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
});
