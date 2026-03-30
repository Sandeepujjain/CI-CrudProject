<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>
<script src="https://cdn.tailwindcss.com"></script>
<style>
  .owl-dots {
    display: none;
  }

  .divide_border {
    border-bottom: 1px solid #ffd701;
  }
</style>
<div class="content_wrapper">

  <div class="row">
    <!-- Overall Finance Chart - 4 columns -->
    <div class="mb-5 col-md-5 divide_border p-3 shadow-md">
      <h4>Overall Financial Report</h4>
      <div class="py-4" id="Finance_chart"></div>
    </div>

    <!-- Head Wise Fees Report - 8 columns -->
    <div class="mb-5 col-md-7 divide_border p-3 shadow-md">
      <div class="flex justify-between">
        <h4>Head Wise Fees Report</h4>
        <a href="<?= base_url('AccountAdmin/StudentFeesReceipt'); ?>">
          <div class="flex items-center text-sm text-gray-600 font-semibold gap-1 mb-[2px]">
            <span>View All</span>
            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3" />
            </svg>
          </div>
        </a>
      </div>

      <!-- Chart description under heading -->
      <p class="text-sm text-gray-500 mt-1">
        This chart displays the head-wise fee amounts for the selected school and active academic year,
        showing how much is expected from each fee head. The amounts increase as more students are assigned
        to the school and academic year.
        For more detailed information, click the <a href="<?= base_url('AccountAdmin/StudentFeesReceipt'); ?>" class="text-blue-600 underline">View All</a> link.
      </p>

      <div class="py-4" id="Fee_report_chart" title="This chart displays the head-wise fee amounts for the selected school and active academic year, showing how much is expected from each fee head. The amounts increase as more students are assigned to the school and academic year."></div>
    </div>

  </div>
  <div class="row row-cols-2">
    <!-- Purchase Report-->
    <div class="mb-5 divide_border p-3 shadow-md">
      <div class="flex justify-between">
        <h4 class="">Purchase Report</h4>
        <a href="<?php echo base_url('AccountAdmin/purchase_payment'); ?>">
          <div class="flex items-center justify-center text-sm text-gray-600 font-semibold  gap-1 mb-[2px]">
            <span class="text-sm">View All</span>
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
              <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3" />
            </svg>

          </div>
        </a>
      </div>
      <div class="py-4 " id="purchase_chart"></div>
    </div>

    <!-- Purchase SubCategories Report-->
    <div class="mb-5 divide_border p-3 shadow-md">
      <div class="flex justify-between">
        <h4 class="">Purchase Sub-Category Report</h4>
      </div>
      <div class="flex justify-between gap-1.5 mt-1">
        <?php foreach ($purchase_report_data as $purchase) { ?>
          <div class="flex items-center gap-2 px-1.5 py-1 mt-2 border-gray-300 rounded-md border-solid border-[1px] text-sm text-[#0b8d74] hover:bg-[#0b8d7f] hover:text-white border:[#0b8d7f]"
            onclick='SubCategoryChart(<?= json_encode($purchase["subcategories"]) ?>)'>
            <?= $purchase['category_name']; ?>
          </div>
        <?php } ?>
      </div>

      <div class="py-4 " id="Subcategory-chart"></div>
    </div>


    <!-- Earning Report-->
    <div class="mb-5 divide_border p-3 shadow-md">
      <div class="flex justify-between">
        <h4 class="">Earning Report</h4>
        <a href="<?php echo base_url('AccountAdmin/FeeCollection'); ?>">
          <div class="flex items-center justify-center text-sm text-gray-600 font-semibold  gap-1 mb-[2px]">
            <span class="text-sm">View All</span>
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
              <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3" />
            </svg>

          </div>
        </a>
      </div>
      <div class="py-4 " id="earning_chart"></div>
    </div>

    <!-- Expense Report-->
    <div class="mb-5 divide_border p-3 shadow-md">
      <div class="flex justify-between">
        <h4 class="">Expense Report</h4>
        <a href="<?php echo base_url('AccountAdmin/AccountEntry'); ?>">
          <div class="flex items-center justify-center text-sm text-gray-600 font-semibold  gap-1 mb-[2px]">
            <span class="text-sm">View All</span>
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
              <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3" />
            </svg>

          </div>
        </a>
      </div>
      <div class="py-4 " id="expense_chart"></div>
    </div>
  </div>


</div>




<script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>

<!-- overall finance chart -->
<script>
  var totalexpenseamount = <?= json_encode($totalexpenseamount) ?>;
  var totalpurchaseexpenseamount = <?= json_encode($totalpurchaseexpenseamount) ?>;
  var totalearningamount = <?= json_encode($totalearningamount) ?>;

  // Total sum calculate karna
  var totalSum = totalexpenseamount + totalpurchaseexpenseamount + totalearningamount;

  // Series data aur labels
  var seriesData = [totalpurchaseexpenseamount, totalearningamount, totalexpenseamount];
  var labelsData = ["Purchase", "Earning", "Expense"];

  var options = {
    series: seriesData,
    chart: {
      width: 350,
      type: 'donut',
      dropShadow: {
        enabled: true,
        color: '#111',
        top: -1,
        left: 3,
        blur: 3,
        opacity: 0.5
      }
    },
    stroke: {
      width: 0,
    },
    plotOptions: {
      pie: {
        donut: {
          labels: {
            show: true,
            total: {
              show: true,
              label: "Total",
              formatter: function() {
                return totalSum; // Total sum show karega
              }
            }
          }
        }
      }
    },
    labels: labelsData,
    legend: {
      position: 'bottom', // <-- This ensures labels are shown below the chart
    },
    dataLabels: {
      dropShadow: {
        blur: 3,
        opacity: 1
      }
    },
    fill: {
      type: 'pattern',
      opacity: 1,
      pattern: {
        enabled: true,
        style: ['verticalLines', 'horizontalLines', 'slantedLines'],
      },
    },
    tooltip: {
      y: {
        formatter: function(value, {
          seriesIndex
        }) {
          var percentage = ((value / totalSum) * 100).toFixed(2); // Percentage calculation
          return value + " (" + percentage + "%)"; // Value + Percentage show karega
        }
      }
    },
    states: {
      hover: {
        filter: 'none'
      }
    },
    theme: {
      palette: 'palette2'
    },
    responsive: [{
      breakpoint: 480,
      options: {
        chart: {
          width: 200
        },
        legend: {
          position: 'bottom'
        }
      }
    }]
  };

  var chart = new ApexCharts(document.querySelector("#Finance_chart"), options);
  chart.render();
</script>

<!-- Purchase Report-->
<script>
  var purchaseReport = <?= json_encode($responseData['purchase_report_data']) ?>;
  const total_amount = purchaseReport.map((item) => ({
    x: item.category_name,
    y: item.category_total_amount
  }));
  var chartOptions = {
    series: [{
      name: 'Data',
      data: total_amount // Data values
    }],
    chart: {
      height: 350,
      type: 'area' // Changed to 'area' chart
    },
    dataLabels: {
      enabled: false
    },
    stroke: {
      curve: 'smooth' // Makes the area chart smooth
    },
    xaxis: {
      type: 'category', // Correct type for categorical x-axis
      categories: purchaseReport.map((item) => item.category_name), // Categories
    },
    fill: {
      type: 'gradient', // Adds gradient effect to the area chart
      gradient: {
        shadeIntensity: 1,
        opacityFrom: 0.7,
        opacityTo: 0.9,
        stops: [0, 90, 100]
      }
    }
  };

  var chart = new ApexCharts(document.querySelector("#purchase_chart"), chartOptions);
  chart.render();
</script>

<!-- Earning Report -->
<script>
  var total_paid_late_fees = <?= json_encode($responseData['total_paid_late_fees']) ?>;
  var total_paid_fees = <?= json_encode($responseData['total_paid_fees']) ?>;
  var total_library_fine_earning_amount = <?= json_encode($responseData['total_library_fine_earning_amount']) ?>;
  var chartOptions = {
    series: [{
      name: "Earning",
      data: [total_paid_fees, total_paid_late_fees, total_library_fine_earning_amount]
    }],
    chart: {
      height: 350,
      type: "bar"
    },
    plotOptions: {
      bar: {
        dataLabels: {
          position: "top"
        }
      }
    },
    dataLabels: {
      enabled: true,
      formatter: function(val) {
        if (val >= 1000000) {
          return (val / 1000000).toFixed(1) + "M";
        } else if (val >= 1000) {
          return (val / 1000).toFixed(1) + "k";
        }
        return val;
      },
      offsetY: -20,
      style: {
        fontSize: "12px",
        colors: ["#304758"]
      }
    },
    xaxis: {
      categories: ["Student Fee", "Late Fee", "Library Fine"],
      labels: {
        show: true,
        rotate: -45,
        style: {
          fontSize: "12px",
          colors: ["#333"]
        }
      },
      axisBorder: {
        show: true
      },
      axisTicks: {
        show: true
      }
    },
    colors: ["#03a9f4"]
  };

  var chart = new ApexCharts(document.querySelector("#earning_chart"), chartOptions);
  chart.render();
</script>

<!-- Expense Chart -->
<script>
  // JSON data from PHP (Make sure it's rendered properly)
  const purchase_expense = <?= json_encode($responseData['purchase_payment_amount_data']) ?>;
  const salary = <?= json_encode($responseData['salary_payment_amount_data']) ?>;
  const other_expense = <?= json_encode($responseData['other_expense_amount_data']) ?>;

  // Store unique ledger names and map of ledger -> [purchase, salary, other]
  const allLedgers = new Set();
  const ledgerMap = {};

  function getLedgerData(data, map, index) {
    data.forEach(function(entry) {
      const ledgerName = entry.ledger_name;
      const amount = parseFloat(entry.total_amount) || 0;

      // Skip if ledger name is null or empty
      if (!ledgerName) return;

      allLedgers.add(ledgerName);

      if (!map[ledgerName]) {
        map[ledgerName] = [0, 0, 0]; // [purchase, salary, other]
      }

      map[ledgerName][index] = amount;
    });
  }

  // Process each type of expense
  getLedgerData(purchase_expense, ledgerMap, 0);
  getLedgerData(salary, ledgerMap, 1);
  getLedgerData(other_expense, ledgerMap, 2);

  // Prepare series data for ApexCharts
  const chartSeriesData = Object.keys(ledgerMap).map(function(ledgerName) {
    return {
      name: ledgerName,
      data: ledgerMap[ledgerName]
    };
  });

  // Only render chart if element exists
  document.addEventListener("DOMContentLoaded", function() {
    const chartContainer = document.querySelector("#expense_chart");
    if (!chartContainer) {
      console.error("Chart container not found.");
      return;
    }

    const expenseChartOptions = {
      series: chartSeriesData,
      chart: {
        type: 'bar',
        height: 350
      },
      plotOptions: {
        bar: {
          horizontal: false,
          columnWidth: "60%",
        }
      },
      dataLabels: {
        enabled: false
      },
      xaxis: {
        categories: ["Purchase Expense", "Salary", "Other Expense"],
        labels: {
          style: {
            fontSize: "12px",
            colors: ["#333"]
          }
        }
      },
      yaxis: {
        min: 0
      },
      tooltip: {
        y: {
          formatter: function(val) {
            return "₹ " + val.toLocaleString("en-IN");
          }
        }
      },
      colors: ["#FFD700", "#6A0DAD", "#4CAF50", "#FF0000", "#ff9843", "#43fff4"]
    };

    const expenseChart = new ApexCharts(chartContainer, expenseChartOptions);
    expenseChart.render();
  });
</script>

<script>
  // Global variable to store current chart instance
  let currentSubcategoryChart = null;

  function SubCategoryChart(SubCategory) {
    const categories = SubCategory.map((item) => item.sub_category_name.trim());
    const quantityData = SubCategory.map((item) => parseFloat(item.subcategory_total_quantity));
    const amountData = SubCategory.map((item) => parseFloat(item.subcategory_total_amount));

    const chartOptions = {
      series: [{
        name: "Amount",
        data: quantityData
      }],
      chart: {
        height: 300,
        type: "bar"
      },
      plotOptions: {
        bar: {
          columnWidth: "30%",
          dataLabels: {
            position: "top"
          }
        }
      },
      dataLabels: {
        enabled: true,
        formatter: function(val) {
          return val + " Qty";
        },
        offsetY: -20,
        style: {
          fontSize: "12px",
          colors: ["#304758"]
        }
      },
      xaxis: {
        categories: categories,
        position: "bottom",
        labels: {
          offsetY: 0
        },
        axisBorder: {
          show: false
        },
        axisTicks: {
          show: false
        }
      },
      tooltip: {
        y: {
          formatter: function(val, opts) {
            const index = opts.dataPointIndex;
            return `₹${amountData[index]}`;
          }
        }
      },
      fill: {
        colors: ['#beff33']
      },
      yaxis: {
        axisBorder: {
          show: false
        },
        axisTicks: {
          show: false
        },
        labels: {
          show: false,
          formatter: function(val) {
            return val + " Qty";
          }
        }
      }
    };

    // ✅ Destroy existing chart before rendering new one
    if (currentSubcategoryChart !== null) {
      currentSubcategoryChart.destroy();
    }

    // ✅ Create and render new chart
    currentSubcategoryChart = new ApexCharts(document.querySelector("#Subcategory-chart"), chartOptions);
    currentSubcategoryChart.render();
  }
</script>
<!-- Head Wise Fees Report -->
<script>
  var academic_year_id = "<?= @$academic_year_id ?>";
  var school_id = "<?= @$school_id ?>";

  // Extract chart data from API response
  function prepareChartData(data) {
    return {
      categories: data.map(item => item.fees_head_name),
      amounts: data.map(item => parseFloat(item.total_head_amount))
    };
  }

  // Create ApexCharts options
  function getChartOptions(categories, amounts) {
    return {
      series: [{
        name: 'Amount',
        data: amounts
      }],
      chart: {
        height: 350,
        type: 'bar',
      },
      colors: ["#FFC300"],
      plotOptions: {
        bar: {
          borderRadius: 10,
          dataLabels: {
            position: 'top'
          }
        }
      },
      dataLabels: {
        enabled: true,
        formatter: val => (val >= 1000) ? (val / 1000).toFixed(1).replace('.0', '') + 'k' : val,
        offsetY: -20,
        style: {
          fontSize: '12px',
          colors: ["#304758"]
        }
      },
      xaxis: {
        categories: categories,
        position: 'top',
        axisBorder: {
          show: false
        },
        axisTicks: {
          show: false
        }
      },
      yaxis: {
        labels: {
          show: true,
          formatter: val => val.toLocaleString(),
          style: {
            colors: '#777',
            fontSize: '12px'
          }
        }
      },
      title: {
        text: 'Fees Report',
        floating: true,
        offsetY: 330,
        align: 'center',
        style: {
          color: '#444'
        }
      }
    };
  }

  // Render the chart
  function renderChart(options) {
    $("#Fee_report_chart").html(""); // Clear old chart
    var chart = new ApexCharts(document.querySelector("#Fee_report_chart"), options);
    chart.render();
  }

  // Fetch data and build chart
  function getHeadWiseFeesReportChart() {
    if (school_id && academic_year_id) {
      $.ajax({
        url: "<?= base_url('HR/getHeadWiseFeesReportDataApi') ?>",
        method: 'POST',
        data: {
          school_id: school_id,
          academic_year_id: academic_year_id,
        },
        dataType: "json",
        success: function(response) {
          if (response.ApiResponseStatusCode === 200 && response.data.length > 0) {
            var chartData = prepareChartData(response.data);
            var options = getChartOptions(chartData.categories, chartData.amounts);
            renderChart(options);
          } else {
            $("#Fee_report_chart").html("<p class='text-center text-red-500'>No data available for the selected filters.</p>");
          }
        },
        error: function(xhr, status, error) {
          console.error("Error:", error);
          $("#Fee_report_chart").html("<p class='text-center text-red-500'>An error occurred while fetching the data.</p>");
        }
      });
    }
  }

  // Auto-load on page ready
  $(document).ready(function() {
    getHeadWiseFeesReportChart();
  });
</script>