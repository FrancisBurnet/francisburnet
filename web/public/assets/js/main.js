document.addEventListener('DOMContentLoaded', () => {
    const chartCanvas = document.getElementById('demoChart');

    if (!chartCanvas) {
        return;
    }

    // Demo chart while API integration is wired for each capstone.
    const labels = ['Baseline', 'Model A', 'Model B', 'Best'];
    const maeData = [1230, 980, 865, 810];

    new Chart(chartCanvas, {
        type: 'bar',
        data: {
            labels,
            datasets: [
                {
                    label: 'MAE (USD)',
                    data: maeData,
                    backgroundColor: ['#0b3c5d', '#328cc1', '#d9b310', '#16a34a'],
                    borderRadius: 8,
                },
            ],
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    display: false,
                },
                title: {
                    display: true,
                    text: 'Sample Capstone Metrics Preview',
                },
            },
            scales: {
                y: {
                    title: {
                        display: true,
                        text: 'MAE (USD)',
                    },
                },
            },
        },
    });
});
