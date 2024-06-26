import Chart from 'chart.js/auto';

function numeroCasuale(min, max) {
    return Math.floor(Math.random() * (max - min + 1)) + min;
}


document.addEventListener('DOMContentLoaded', (event) => {
    const ctx = document.getElementById('dataMes');
    if (ctx) {
        const data = [
            { label: 'Jun 23', count: numeroCasuale(1,100) },
            { label: 'Jul 23', count: numeroCasuale(1,100) },
            { label: 'Aug 23', count: numeroCasuale(1,100) },
            { label: 'Sep 23', count: numeroCasuale(1,100) },
            { label: 'Oct 23', count: numeroCasuale(1,100) },
            { label: 'Nov 23', count: numeroCasuale(1,100) },
            { label: 'Dec 23', count: numeroCasuale(1,100) },
            { label: 'Jan 24', count: numeroCasuale(1,100) },
            { label: 'Feb 24', count: numeroCasuale(1,100) },
            { label: 'Mar 24', count: numeroCasuale(1,100) },
            { label: 'Apr 24', count: numeroCasuale(1,100) },
            { label: 'May 24', count: numeroCasuale(1,100) },
            { label: 'Jun 24', count: numeroCasuale(1,100) },

        ];

        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: data.map(row => row.label),
                datasets: [{
                    label: 'Messaggi mensili',
                    data: data.map(row => row.count),
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(255, 159, 64, 0.2)',
                        'rgba(255, 205, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(153, 102, 255, 0.2)',
                        'rgba(201, 203, 207, 0.2)',
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(255, 159, 64, 0.2)',
                        'rgba(255, 205, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(153, 102, 255, 0.2)',
                        'rgba(201, 203, 207, 0.2)',
                    ],
                    borderColor: [
                        'rgb(255, 99, 132)',
                        'rgb(255, 159, 64)',
                        'rgb(255, 205, 86)',
                        'rgb(75, 192, 192)',
                        'rgb(54, 162, 235)',
                        'rgb(153, 102, 255)',
                        'rgb(201, 203, 207)',
                        'rgb(255, 99, 132)',
                        'rgb(255, 159, 64)',
                        'rgb(255, 205, 86)',
                        'rgb(75, 192, 192)',
                        'rgb(54, 162, 235)',
                        'rgb(153, 102, 255)',
                        'rgb(201, 203, 207)',
                    ],
                    borderWidth: 1,

                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true,
                        max:100
                    }
                }
            }
        });
    }
});
document.addEventListener('DOMContentLoaded', (event) => {
    const ctx = document.getElementById('dataVis');
    if (ctx) {
        const data = [
            { label: 'Jun 23', count: numeroCasuale(1,1000) },
            { label: 'Jul 23', count: numeroCasuale(1,1000) },
            { label: 'Aug 23', count: numeroCasuale(1,1000) },
            { label: 'Sep 23', count: numeroCasuale(1,1000) },
            { label: 'Oct 23', count: numeroCasuale(1,1000) },
            { label: 'Nov 23', count: numeroCasuale(1,1000) },
            { label: 'Dec 23', count: numeroCasuale(1,1000) },
            { label: 'Jan 24', count: numeroCasuale(1,1000) },
            { label: 'Feb 24', count: numeroCasuale(1,1000) },
            { label: 'Mar 24', count: numeroCasuale(1,1000) },
            { label: 'Apr 24', count: numeroCasuale(1,1000) },
            { label: 'May 24', count: numeroCasuale(1,1000) },
            { label: 'Jun 24', count: numeroCasuale(1,1000) },

        ];

        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: data.map(row => row.label),
                datasets: [{
                    label: 'Visualizzazioni mensili',
                    data: data.map(row => row.count),
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(255, 159, 64, 0.2)',
                        'rgba(255, 205, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(153, 102, 255, 0.2)',
                        'rgba(201, 203, 207, 0.2)',
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(255, 159, 64, 0.2)',
                        'rgba(255, 205, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(153, 102, 255, 0.2)',
                        'rgba(201, 203, 207, 0.2)',
                    ],
                    borderColor: [
                        'rgb(255, 99, 132)',
                        'rgb(255, 159, 64)',
                        'rgb(255, 205, 86)',
                        'rgb(75, 192, 192)',
                        'rgb(54, 162, 235)',
                        'rgb(153, 102, 255)',
                        'rgb(201, 203, 207)',
                        'rgb(255, 99, 132)',
                        'rgb(255, 159, 64)',
                        'rgb(255, 205, 86)',
                        'rgb(75, 192, 192)',
                        'rgb(54, 162, 235)',
                        'rgb(153, 102, 255)',
                        'rgb(201, 203, 207)',
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true,
                        max:1000
                    }
                }
            }
        });
    }
});
document.addEventListener('DOMContentLoaded', (event) => {
    const ctx = document.getElementById('dataSpo');
    if (ctx) {
        const data = [
            { label: 'Jun 23', count: numeroCasuale(1,31) },
            { label: 'Jul 23', count: numeroCasuale(1,31) },
            { label: 'Aug 23', count: numeroCasuale(1,31) },
            { label: 'Sep 23', count: numeroCasuale(1,31) },
            { label: 'Oct 23', count: numeroCasuale(1,31) },
            { label: 'Nov 23', count: numeroCasuale(1,31) },
            { label: 'Dec 23', count: numeroCasuale(1,31) },
            { label: 'Jan 24', count: numeroCasuale(1,31) },
            { label: 'Feb 24', count: numeroCasuale(1,31) },
            { label: 'Mar 24', count: numeroCasuale(1,31) },
            { label: 'Apr 24', count: numeroCasuale(1,31) },
            { label: 'May 24', count: numeroCasuale(1,31) },
            { label: 'Jun 24', count: numeroCasuale(1,31) },

        ];

        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: data.map(row => row.label),
                datasets: [{
                    label: 'Sponsorizzazioni mensili',
                    data: data.map(row => row.count),
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(255, 159, 64, 0.2)',
                        'rgba(255, 205, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(153, 102, 255, 0.2)',
                        'rgba(201, 203, 207, 0.2)',
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(255, 159, 64, 0.2)',
                        'rgba(255, 205, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(153, 102, 255, 0.2)',
                        'rgba(201, 203, 207, 0.2)',
                    ],
                    borderColor: [
                        'rgb(255, 99, 132)',
                        'rgb(255, 159, 64)',
                        'rgb(255, 205, 86)',
                        'rgb(75, 192, 192)',
                        'rgb(54, 162, 235)',
                        'rgb(153, 102, 255)',
                        'rgb(201, 203, 207)',
                        'rgb(255, 99, 132)',
                        'rgb(255, 159, 64)',
                        'rgb(255, 205, 86)',
                        'rgb(75, 192, 192)',
                        'rgb(54, 162, 235)',
                        'rgb(153, 102, 255)',
                        'rgb(201, 203, 207)',
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true,
                        max:31
                    }
                }
            }
        });
    }
});

