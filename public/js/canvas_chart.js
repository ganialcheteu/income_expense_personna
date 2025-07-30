// {
//     Inc : 'Income',
//     Exp : 'Expense'
//     Cat : 'Category'
// }

const chartIncExp = document.getElementById("chartIncExp").getContext("2d");
const lineChartIncExp = document
    .getElementById("lineChartIncExp")
    .getContext("2d");
const doughnutChartIncCat = document
    .getElementById("doughnutChartIncCat")
    .getContext("2d");
const doughnutChartExpCat = document
    .getElementById("doughnutChartExpCat")
    .getContext("2d");

//for income and expense visualization by month of the year
if (
    chartIncExp &&
    window.chartData &&
    window.chartData.totalIncomesPerMonth &&
    window.chartData.totalExpensesPerMonth
) {
    const barChartTotalIncExp = new Chart(chartIncExp, {
        type: "bar",
        data: {
            labels: [
                "Jan.",
                "Feb.",
                "Mar.",
                "Apr.",
                "May.",
                "Jun.",
                "Jul.",
                "Aug.",
                "Sep.",
                "Oct.",
                "Nov.",
                "Dec.",
            ],
            datasets: [
                {
                    data: window.chartData.totalIncomesPerMonth,
                    label: "Incomes",
                    backgroundColor: "rgba(31,59,179,0.85)",
                    hoverBackgroundColor: "rgba(31,59,179,1)",
                    borderRadius: 8,
                    barPercentage: 0.5,
                    categoryPercentage: 0.5,
                    borderSkipped: false,
                },
                {
                    data: window.chartData.totalExpensesPerMonth,
                    label: "Expenses",
                    backgroundColor: "rgba(249,95,83,0.85)",
                    hoverBackgroundColor: "rgba(249,95,83,1)",
                    borderRadius: 8,
                    barPercentage: 0.5,
                    categoryPercentage: 0.5,
                    borderSkipped: false,
                },
            ],
        },
        options: {
            plugins: {
                title: {
                    display: true,
                    text: "Income and Expense Monthly Report /XAF",
                    position: "top",
                    align: "start",
                    font: { size: 14 },
                },
                legend: {
                    labels: {
                        usePointStyle: true,
                        pointStyle: "circle",
                    },
                },
            },
            scales: {
                x: {
                    grid: {
                        display: false,
                    },
                },
                y: {
                    beginAtZero: true,
                    grid: {
                        color: "#f0f0f0",
                    },
                    ticks: {
                        callback: function (value) {
                            if (value >= 1_000_000)
                                return (
                                    (value / 1_000_000)
                                        .toFixed(1)
                                        .replace(/\.0$/, "") + "M"
                                );
                            if (value >= 1_000)
                                return (
                                    (value / 1_000)
                                        .toFixed(1)
                                        .replace(/\.0$/, "") + "k"
                                );
                            return value;
                        },
                    },
                },
            },
        },
    });
}

//for incomes and expenses increase and decrease in visualization period
if (
    lineChartIncExp &&
    window.chartData &&
    window.chartData.totalIncomesPerMonth &&
    window.chartData.totalExpensesPerMonth
) {
    const lineChartTotalIncExp = new Chart(lineChartIncExp, {
        type: "line",
        data: {
            labels: [
                "Jan.",
                "Feb.",
                "Mar.",
                "Apr.",
                "May.",
                "Jun.",
                "Jul.",
                "Aug.",
                "Sep.",
                "Oct.",
                "Nov.",
                "Dec.",
            ],
            datasets: [
                {
                    label: "Incomes",
                    data: window.chartData.totalIncomesPerMonth,
                    borderColor: "#1F3BB3",
                    backgroundColor: "rgba(31,59,179,0.08)",
                    tension: 0.4,
                    fill: true,
                    borderWidth: 2,
                    pointRadius: 4,
                    pointHoverRadius: 6,
                    pointBackgroundColor: "#1F3BB3",
                    pointBorderColor: "#fff",
                    pointStyle: "circle",
                },
                {
                    label: "Expenses",
                    data: window.chartData.totalExpensesPerMonth,
                    borderColor: "#f95f53",
                    backgroundColor: "rgba(249,95,83,0.08)",
                    tension: 0.4,
                    fill: true,
                    borderWidth: 2,
                    pointRadius: 4,
                    pointHoverRadius: 6,
                    pointBackgroundColor: "#f95f53",
                    pointBorderColor: "#fff",
                    pointStyle: "circle",
                },
            ],
        },
        options: {
            plugins: {
                title: {
                    display: true,
                    text: "Incomes And Expenses Evolution Per Month /XAF",
                    align: "start",
                    font: { size: 14 },
                },
                legend: {
                    position: "bottom",
                    labels: {
                        usePointStyle: true,
                        pointStyle: "circle",
                    },
                },
            },
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        callback: function (value) {
                            if (value >= 1_000_000)
                                return (
                                    (value / 1_000_000)
                                        .toFixed(1)
                                        .replace(/\.0$/, "") + "M"
                                );
                            if (value >= 1_000)
                                return (
                                    (value / 1_000)
                                        .toFixed(1)
                                        .replace(/\.0$/, "") + "k"
                                );
                            return value;
                        },
                    },
                },
            },
        },
    });
}

// for expense visualization by expense category
if (
    doughnutChartIncCat &&
    window.chartData &&
    window.chartData.incomesByCategory
) {
    const shadowPlugin = {
        id: "shadowPlugin",
        beforeDraw: (chart) => {
            const ctx = chart.ctx;
            ctx.save();
            ctx.shadowColor = "rgba(215, 215, 215, 0.05)";
            ctx.shadowBlur = 8;
            ctx.shadowOffsetX = 2;
            ctx.shadowOffsetY = 4;
        },
        afterDraw: (chart) => {
            chart.ctx.restore();
        },
    };

    const doughnutChartTotalIncCat = new Chart(doughnutChartIncCat, {
        type: "doughnut",
        data: {
            labels: window.chartData.incomesByCategory.labels,
            datasets: [
                {
                    data: window.chartData.incomesByCategory.data,
                    backgroundColor: [
                        "#1F3BB3",
                        "#FFB200",
                        "#f95f53",
                        "#52CDFF",
                        "#845EC2",
                        "#00C292",
                        "#FF6B6B",
                    ],
                    borderColor: "#fff",
                    borderWidth: 1,
                    hoverOffset: 24,
                    hoverBorderWidth: 1,
                },
            ],
        },
        options: {
            cutout: "65%",
            plugins: {
                title: {
                    display: true,
                    text: "Incomes By Income Category Report /XAF",
                    align: "start",
                    font: { size: 14 },
                },
                legend: {
                    position: "bottom",
                    labels: {
                        usePointStyle: true,
                        pointStyle: "circle",
                        padding: 20,
                        font: { size: 13 },
                    },
                },
            },
        },
        plugins: [shadowPlugin],
    });
}

//for expenses virsualization by epxense category
if (
    doughnutChartExpCat &&
    window.chartData &&
    window.chartData.expensesByCategory
) {
    const shadowPlugin = {
        id: "shadowPlugin",
        beforeDraw: (chart) => {
            const ctx = chart.ctx;
            ctx.save();
            ctx.shadowColor = "rgba(60,60,60,0.04)";
            ctx.shadowBlur = 6;
            ctx.shadowOffsetX = 1;
            ctx.shadowOffsetY = 2;
        },
        afterDraw: (chart) => {
            chart.ctx.restore();
        },
    };

    const doughnutChartTotalExpCat = new Chart(doughnutChartExpCat, {
        type: "doughnut",
        data: {
            labels: window.chartData.expensesByCategory.labels,
            datasets: [
                {
                    data: window.chartData.expensesByCategory.data,
                    backgroundColor: [
                        "#f95f53",
                        "#1F3BB3",
                        "#52CDFF",
                        "#FFB200",
                        "#845EC2",
                        "#00C292",
                        "#FF6B6B",
                    ],
                    borderColor: "#fff",
                    borderWidth: 1,
                    hoverOffset: 24,
                    hoverBorderWidth: 1,
                },
            ],
        },
        options: {
            cutout: "65%",
            plugins: {
                title: {
                    display: true,
                    text: "Expenses By Expense Category Report /XAF",
                    align: "start",
                    font: { size: 14 },
                },
                legend: {
                    position: "bottom",
                    labels: {
                        usePointStyle: true,
                        pointStyle: "circle",
                        padding: 20,
                        font: { size: 13 },
                    },
                },
            },
        },
        plugins: [shadowPlugin],
    });
}
