document.addEventListener("DOMContentLoaded", function() {
            // Prepare sample data for Chart.js
            var ctx = document.getElementById('productChart').getContext('2d');
            var chartData = {
                labels: ['Fiction', 'Non-Fiction', 'Science', 'History', 'Biography'],
                datasets: [{
                    label: 'Books Borrowed',
                    data: [120, 150, 180, 90, 50],
                    backgroundColor: ['#3a57e8', '#4bc7d2', '#fbc658', '#51CACF', '#EF8157']
                }]
            };

            // Create the chart
            var productChart = new Chart(ctx, {
                type: 'pie', // Change this to the type of chart you want
                data: chartData,
                options: {
                    responsive: true,
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        });