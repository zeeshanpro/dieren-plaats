$(function () {
  'use strict'

  
//---------------------------
  //- END MONTHLY SALES CHART -
  //---------------------------

  //-------------
  //- PIE CHART -
  //-------------
  // Get context with jQuery - using jQuery's .get() method.
    var pieChartCanvas = $('#pieChart').get(0).getContext('2d')
    var pieData        = {
      labels: [
          'IOS', 
          'ANDROID',
      
      ],
      datasets: [
        {
          data: [500,200],
          backgroundColor : ['#00a65a', '#00c0ef'],
        }
      ]
    }
    // , '#00c0ef', '#3c8dbc', '#d2d6de'
    var pieOptions     = {
      legend: {
        display: false
      }
    }
    //Create pie or douhnut chart
    // You can switch between pie and douhnut using the method below.
    var pieChart = new Chart(pieChartCanvas, {
      type: 'doughnut',
      data: pieData,
      options: pieOptions      
    })

  //-----------------
  //- END PIE CHART -
  //-----------------


})
