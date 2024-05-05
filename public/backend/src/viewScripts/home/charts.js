var categories;
var categories1;
var expensesData;
var salesData;
var profitData;
var harvestedCrops;
var categories2;
var month;
var totSales;
var seriesData;
var chart;
var chart1;
var chart2;

function charts(year = 0){
    $.ajax({
      url: 'crop-profit',
      method: 'POST',
      data: {
        yr: year
      },
      success: function(res) {
          var resp = JSON.parse(res);
          categories = resp.map(item => item.Type);
          expensesData = resp.map(item => parseFloat(item.totExpenses));  
          salesData = resp.map(item => parseFloat(item.totSales));  
          profitData = resp.map(item => parseFloat(item.profit));

          // Render chart after data is fetched
          barChart();
      }
    })

    $.ajax({
      url: 'harvestCropsChart',
      method: 'POST',
      data: {
        yr: year
      },
      success: function(res) {
          var resp = JSON.parse(res);
          // console.log(resp)
          categories1 = resp.map(item => item.Type);
          harvestedCrops = resp.map(item => parseInt(item.harvestedCrops));
          // Render chart after data is fetched
          pieChart();
      }
    })

    $.ajax({
      url: 'monthlySales',
      method: 'POST',
      data: {
        yr: year
      },
      success: function(res) {
          var resp = JSON.parse(res);
          // console.log(resp)
          // categories2 = resp.map(item => item.Type);
          month = resp.map(item => item.month_format);
          totSales = resp.map(item => parseFloat(item.totSales));

          seriesData = [{
            name: 'Total Sales',
            data: totSales
        }];

        if(month.length === 0){
          month = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
        }
          lineChart();
      }
    })
} 

function cards(year = 0){
  $.ajax({
    url: 'getTotals',
    method: 'POST',
    data: {
      yr: year
    },
    success: function(res) {
      var resp = JSON.parse(res);
      $('#totProfit').html(resp[0].profit);
      $('#totSales').html(resp[0].totSales);
      $('#totExpenses').html(resp[0].totExpenses);
    }
  })

  $.ajax({
    url: 'harvestCrops',
    method: 'POST',
    data: {
      yr: year
    },
    success: function(res) {
      var resp = JSON.parse(res);
      $('#harvestCrops').html(resp[0].harvestedCrops);
    }
  })
}

function barChart() {
  var options = {
      series: [{
          name: 'Sales',
          data: salesData
      }, {
          name: 'Expenses',
          data: expensesData
      }, {
          name: 'Profit',
          data: profitData
      }],
      chart: {
          type: 'bar',
          height: 300,
          toolbar: {
              show: false
          }
      },
      colors: ['#55A6A8', '#D84F81', '#5896BB'],
      plotOptions: {
          bar: {
              horizontal: false,
              columnWidth: '55%'
          },
      },
      dataLabels: {
          enabled: false
      },
      stroke: {
          show: true,
          width: 2,
          colors: ['transparent']
      },
      xaxis: {
          categories: categories,
      },
      yaxis: {
          title: {
              text: 'Amount'
          },labels:{
            formatter: function (value) {
              return new Intl.NumberFormat('en-US', { style: 'currency', currency: 'PHP' }).format(value);
            }
          }
      },
      fill: {
          opacity: 1
      },
  };

  // Check if chart is already initialized
  if (chart) {
    chart.updateOptions(options);
  } else {
    chart = new ApexCharts(document.querySelector("#areaChart"), options);
    chart.render();
  }
}

function pieChart() {

  var options = {
    series: harvestedCrops,
    chart: {
    height: 320,
    type: 'pie',
    },
    colors: ['#e6d075', '#d44848', '#df9253', '#fcbf49', '#e76f51'],
    labels: categories1,
    responsive: [{
      breakpoint: 480,
      options: {
        chart: {
          width: 250,
          height: 320
        },
        legend: {
          position: 'top'
        }
      }
    }]
  };


  if (chart1) {
    chart1.updateOptions(options);
  } else {
    chart1 = new ApexCharts(document.querySelector("#harvestCropsChart"), options);
    chart1.render();
  }
}

function lineChart(){
  var options = {
    series: seriesData,
    chart: {
      height: 450,
      type: 'area',
      zoom: {
        enabled: false,
      },
      dropShadow: {
        enabled: true,
        color: '#000',
        top: 18,
        left: 7,
        blur: 16,
        opacity: 0.2
      },
      toolbar: {
        show: false
      }
    },
    colors: ['#f0746c', '#255cd3'],
    dataLabels: {
      enabled: false,
    },
    stroke: {
      width: [3,3],
      curve: 'smooth'
    },
    grid: {
      show: false,
    },
    markers: {
      colors: ['#f0746c', '#255cd3', ],
      size: 5,
      strokeColors: '#ffffff',
      strokeWidth: 2,
      hover: {
        sizeOffset: 2
      }
    },
    xaxis: {
      categories: month,
      labels:{
        style:{
          colors: '#8c9094'
        }
      }
    },
    yaxis: {
      min: 0,
      labels:{
        style:{
          colors: '#8c9094'
        },formatter: function (value) {
          return new Intl.NumberFormat('en-US', { style: 'currency', currency: 'PHP' }).format(value);
        }
      }
    },
    legend: {
      position: 'top',
      horizontalAlign: 'right',
      floating: true,
      offsetY: 0,
      labels: {
        useSeriesColors: true
      },
      markers: {
        width: 10,
        height: 10,
      }
    }
  };

  if (chart2) {
    chart2.updateOptions(options);
  } else {
    chart2 = new ApexCharts(document.querySelector("#line"), options);
    chart2.render();
  }
}

function tables(year = 0){
  // $('#dashboardTable').DataTable().destroy();
  $('#dashboardTable').DataTable({
    scrollCollapse: true,
    autoWidth: false,
    responsive: true,
    paging: true, // Enable paging
    pageLength: 5,
    searching: false,
    // lengthMenu: [5,10,15,20],
    lengthChange: false,
    columnDefs: [{
        targets: "datatable-nosort",
        orderable: false,
    }],
    "ajax": {
        "url": "get-expenses",
        "type": "POST",
        "dataSrc": "",
        "data": {
          yr: year
        }
    },
    "columns": [{
        "data": null,
            "render": function(data, type, row, meta) {
                return meta.row + 1;
            }
        },
        {
            "data": 'type'
        },
        {
            "data": "item"
        },
        {
            "data": "Formatted_totAmount",
        }
    ]
  });
  // $('#dashboardTable').DataTable().destroy();
}

// Initial chart and cards rendering
charts();
cards();
// tables();
// $('#dashboardTable').DataTable().destroy();
// Event listener for year change
$('#yr').on('change', function(e){
  e.preventDefault();
  let year = $(this).val();

  cards(year);
  charts(year);
  tables(year);
});

