jQuery(document).ready(function() {
    // MORRIS CHARTS DEMOS

    // LINE CHART
    // new Morris.Line({
    // 	// ID of the element in which to draw the chart.
    // 	element: 'morris_chart_1',
    // 	// Chart data records -- each entry in this array corresponds to a point on
    // 	// the chart.
    // 	data: [
    // 		{ y: '1', a: 90, b: 90 },
    // 	    { y: '2', a: 75,  b: 65 },
    // 	{ y: '3', a: 75,  b: 65 },
    // 	{ y: '4', a: 75,  b: 65 },
    // 	{ y: '5', a: 75,  b: 65 },
    // 	    // { y: '2008', a: 50,  b: 40 },
    // 	    // { y: '2009', a: 75,  b: 65 },
    // 	    // { y: '2010', a: 50,  b: 40 },
    // 	    // { y: '2011', a: 75,  b: 65 },
    // 	    // { y: '2012', a: 90, b: 90 }
    // 	],
    // 	// The name of the data record attribute that contains x-values.
    // 	xkey: 'y',
    // 	// A list of names of data record attributes that contain y-values.
    // 	ykeys: ['a', 'b'],
    // xLabelFormat: function (x) { return 'Janeiro'; },
    // 	// Labels for the ykeys -- will be displayed when you hover over the
    // 	// chart.
    // 	labels: ['Recebido', 'Tarifas']
    // });


    // BAR CHART
    new Morris.Bar({
        element: 'morris_chart_1',
        data: totalRecebidoMes,
        xkey: 'y',
        ykeys: ['a'],
        labels: ['Total R$']
    });

});
