$(function(){
  'use strict';

  $('.sparkline1').sparkline('html', {
    type: 'bar',
    barWidth: 5,
    height: 50,
    barColor: '#0083CD',
    chartRangeMin: 0,
    chartRangeMax: 10
  });

  $('.sparkline2').sparkline('html', {
    type: 'bar',
    barWidth: 5,
    height: 50,
    barColor: '#fff',
    lineColor: 'rgba(255,255,255,0.5)',
    chartRangeMin: 0,
    chartRangeMax: 10
  });

  var rs2 = new Rickshaw.Graph({
    element: document.querySelector('#rickshaw2'),
    renderer: 'area',
    max: 100,
    series: [{
      data: [
        { x: 0, y: 40 },
        { x: 1, y: 49 },
        { x: 2, y: 38 },
        { x: 3, y: 30 },
        { x: 4, y: 32 },
        { x: 5, y: 40 },
        { x: 6, y: 20 },
        { x: 7, y: 10 },
        { x: 8, y: 20 },
        { x: 9, y: 25 },
        { x: 10, y: 35 },
        { x: 11, y: 20 },
        { x: 12, y: 40 },
        { x: 13, y: 25 }
      ],
      color: '#2B333E',
    },{
      data: [
        { x: 0, y: 40 },
        { x: 1, y: 49 },
        { x: 2, y: 38 },
        { x: 3, y: 30 },
        { x: 4, y: 32 },
        { x: 5, y: 40 },
        { x: 6, y: 20 },
        { x: 7, y: 10 },
        { x: 8, y: 20 },
        { x: 9, y: 25 },
        { x: 10, y: 35 },
        { x: 11, y: 20 },
        { x: 12, y: 40 },
        { x: 13, y: 25 }
      ],
      color: '#73a9e7',
    }]
  });
  rs2.render();

  // Responsive Mode
  new ResizeSensor($('.br-mainpanel'), function(){
    rs2.configure({
      width: $('#rickshaw2').width(),
      height: $('#rickshaw2').height()
    });
    rs2.render();
  });

  var ctb4 = document.getElementById('chartBar4').getContext('2d');
  new Chart(ctb4, {
    type: 'horizontalBar',
    data: {
      labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'],
      datasets: [{
        label: '# of Votes',
        data: [12, 39, 20, 10, 25, 18],
        backgroundColor: [
          '#324463',
          '#5B93D3',
          '#7CBDDF',
          '#5B93D3',
          '#324463'
        ]
      }]
    },
    options: {
      legend: {
        display: false,
          labels: {
            display: false
          }
      },
      scales: {
        yAxes: [{
          ticks: {
            beginAtZero:true,
            fontSize: 10
          }
        }],
        xAxes: [{
          ticks: {
            beginAtZero:true,
            fontSize: 11,
            max: 80
          }
        }]
      }
    }
  });


});
