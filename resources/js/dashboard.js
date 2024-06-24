document.addEventListener('DOMContentLoaded', function () {
    const ctx = document.getElementById('notesChart').getContext('2d');
    const notesData = JSON.parse(document.getElementById('notesData').textContent);

    const labels = notesData.map(data => data.date);
    const data = notesData.map(data => data.count);

    new Chart(ctx, {
        type: 'line',
        data: {
            labels: labels,
            datasets: [{
                label: 'Notes Uploaded',
                data: data,
                backgroundColor: 'rgba(75, 192, 192, 0.2)',
                borderColor: 'rgba(75, 192, 192, 1)',
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                x: {
                    type: 'time',
                    time: {
                        unit: 'day'
                    }
                },
                y: {
                    beginAtZero: true
                }
            }
        }
    });
});
