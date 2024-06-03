//Total transaksi perbulan
//Barchart total transaksi perbulan
var barChart;
var isBarChart = document.getElementById("total_perbulan");
var barChartColors = getJQueryChartColorsArray(isBarChart);
if (barChartColors) {
    isBarChart.setAttribute("width", isBarChart.parentElement.offsetWidth);
    barChart = new Chart(isBarChart, {
        type: "bar",
        data: {
            labels: [
                "Januari",
                "Februari",
                "Maret",
                "April",
                "Mei",
                "Juni",
                "Juli",
                "Agustus",
                "September",
                "Oktober",
                "November",
                "Desember",
            ],
            datasets: [
                {
                    label: "Total Transaksi",
                    backgroundColor: barChartColors[0],
                    borderColor: barChartColors[0],
                    borderWidth: 1,
                    hoverBackgroundColor: barChartColors[1],
                    hoverBorderColor: barChartColors[1],
                    data: [65, 59, 81, 45, 56, 80, 50, 20, 81, 45, 56, 80],
                },
            ],
        },
    });
}

//Barchart total transaksi kamar perbulan
var barChart;
var isBarChart = document.getElementById("kamar_perbulan");
var barChartColors = getJQueryChartColorsArray(isBarChart);
if (barChartColors) {
    isBarChart.setAttribute("width", isBarChart.parentElement.offsetWidth);
    barChart = new Chart(isBarChart, {
        type: "bar",
        data: {
            labels: [
                "Januari",
                "Februari",
                "Maret",
                "April",
                "Mei",
                "Juni",
                "Juli",
                "Agustus",
                "September",
                "Oktober",
                "November",
                "Desember",
            ],
            datasets: [
                {
                    label: "Transaksi kamar",
                    backgroundColor: barChartColors[0],
                    borderColor: barChartColors[0],
                    borderWidth: 1,
                    hoverBackgroundColor: barChartColors[1],
                    hoverBorderColor: barChartColors[1],
                    data: [65, 59, 81, 45, 56, 80, 50, 20, 81, 45, 56, 80],
                },
            ],
        },
    });
}

//Barchart total ruangan transaksi perbulan
var barChart;
var isBarChart = document.getElementById("ruangan_perbulan");
var barChartColors = getJQueryChartColorsArray(isBarChart);
if (barChartColors) {
    isBarChart.setAttribute("width", isBarChart.parentElement.offsetWidth);
    barChart = new Chart(isBarChart, {
        type: "bar",
        data: {
            labels: [
                "Januari",
                "Februari",
                "Maret",
                "April",
                "Mei",
                "Juni",
                "Juli",
                "Agustus",
                "September",
                "Oktober",
                "November",
                "Desember",
            ],
            datasets: [
                {
                    label: "Transaksi Ruangan",
                    backgroundColor: barChartColors[0],
                    borderColor: barChartColors[0],
                    borderWidth: 1,
                    hoverBackgroundColor: barChartColors[1],
                    hoverBorderColor: barChartColors[1],
                    data: [65, 59, 81, 45, 56, 80, 50, 20, 81, 45, 56, 80],
                },
            ],
        },
    });
}


//===============================================================
// Fungsi pertama
function getJQueryChartColorsArray(e) {
    e = $(e).attr("data-colors");
    return (e = JSON.parse(e)).map(function (e) {
        e = e.replace(" ", "");
        if (-1 == e.indexOf("--")) return e;
        e = getComputedStyle(document.documentElement).getPropertyValue(e);
        return e || void 0;
    });
}

// Fungsi kedua
function getChartColorsArrayFromDOM(r) {
    if (null !== document.getElementById(r)) {
        r = document.getElementById(r).getAttribute("data-colors");
        return (r = JSON.parse(r)).map(function (r) {
            var o = r.replace(" ", "");
            if (-1 === o.indexOf(",")) {
                var a = getComputedStyle(
                    document.documentElement
                ).getPropertyValue(o);
                return a || o;
            }
            r = r.split(",");
            return 2 != r.length
                ? o
                : `rgba(${getComputedStyle(
                      document.documentElement
                  ).getPropertyValue(r[0])},${r[1]})`;
        });
    }
}

// Set default Chart properties
Chart.defaults.borderColor = "rgba(133, 141, 152, 0.1)";
Chart.defaults.color = "#858d98";
