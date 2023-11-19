import $ from 'jquery';

$(function () {
    $.ajax({
        type: 'GET',
        url: '/ajax/address/zip/12345',
        success: data =>  {
            console.log(data);
        },
        error: msg => {
            console.log(msg);
        },
    });
});

google.charts.load('current', { 'packages': ['corechart'] });
google.charts.setOnLoadCallback(drawChart);

function drawChart() {

    var data = new google.visualization.DataTable();

    data.addColumn('number', 'Month');
    data.addColumn('number', 'Gross');

    let result = [];
    Object.entries(groupedLoads).forEach(([groupIdx, loads]) => {
        result[groupIdx] = [];
        result[groupIdx][0] = Number(groupIdx);
        result[groupIdx].push(loads.reduce((n, { actual_price }) => n + Number(actual_price), 0));
    });

    let compactArray = [];
    for (var i in result) {
        compactArray.push(result[i]);
    }

    data.addRows(compactArray);

    var options = {
        backgroundColor: {
            fillOpacity: 0,
        },
        titleTextStyle: {
            color: '#FFF',
        },
        hAxis: {
            textStyle: { color: '#9ca3af' },
            minorGridlines: { color: '#364050' },
            gridlines: {
                color: '#364050',
                interval: 1,
            },
        },
        vAxis: {
            textStyle: { color: '#9ca3af' },
            minorGridlines: { color: '#364050' },
            gridlines: {
                color: '#364050',
                interval: 1,
            },
        },
        legend: {
            position: 'none',
            textStyle: { color: '#9ca3af' },
            maxLines: 4,
        },
    };

    var chart = new google.visualization.LineChart(document.getElementById('chart_div'));

    chart.draw(data, options);
}