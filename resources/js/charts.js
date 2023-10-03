google.charts.load('current', { 'packages': ['corechart'] });
google.charts.setOnLoadCallback(drawChart);

function drawChart() {

    var data = new google.visualization.DataTable();

    data.addColumn('number', 'Month');
    Object.entries(dispatchers).forEach(([key, value]) => {
        data.addColumn('number', value.name);
    });

    let result = [];
    Object.entries(groupedLoads).forEach(([monthNumber, loads]) => {

        if (!result[monthNumber]) {
            result[monthNumber] = [];
            result[monthNumber][0] = Number(monthNumber);
        }

        Object.entries(dispatchers).forEach(([key, value]) => {
            if (!result[monthNumber][value.id]) {
                result[monthNumber][value.id] = 0;
            }
        });

        Object.entries(loads).forEach(([key, load]) => {
            result[monthNumber][load.dispatcher_id]++;
        });

    });

    let compactArray = [];
    for (var i in result) {
        compactArray.push(result[i]);
    }

    console.log(compactArray);

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
            gridlines: { color: '#364050' },
            minorGridlines: { color: '#364050' },
        },
        vAxis: {
            textStyle: { color: '#9ca3af' },
            gridlines: { color: '#364050' },
            minorGridlines: { color: '#364050' },
        },
        legend: {
            position: 'top',
            textStyle: { color: '#9ca3af' },
            maxLines: 4,
        },
    };

    var chart = new google.visualization.LineChart(document.getElementById('chart_div'));

    chart.draw(data, options);
}