// Charts
// Extract labels (level_name)
var baseLabels = data.diaspora_by_level.map(item => item.level_name);

// Extract values (ensure numbers, default 0 if invalid)
var values = data.diaspora_by_level.map(item => {
  let val = parseFloat(item.percentage);
  return isNaN(val) ? 0 : val;
});

// Calculate total (safe)
var total = values.reduce((a, b) => a + b, 0);
if (isNaN(total)) total = 0;

// Create labels with percentages (safe)
var labelsWithPercent = baseLabels.map((label, i) => {
  let percent = total > 0 ? ((values[i] / total) * 100).toFixed(1) : 0;
  if (isNaN(percent)) percent = 0;
  return `${label} ${percent}%`;
});

// Use 6 colors for 6 data points
var colors = ["#05B448", "#0C5B2C", "#0ED95D", "#79FCAA", "#B4FECF", "#96E2D6"];

var paymentOptions = {
  series: values,
  chart: {
    width: 550,
    type: "donut",
  },
  labels: labelsWithPercent,
  colors: colors,
  legend: {
    position: "right",
  },
  dataLabels: {
    enabled: false,
  },
  plotOptions: {
    pie: {
      donut: {
        labels: {
          show: true,
          total: {
            show: true,
            label: "",
            formatter: function (w) {
              let totalVal = w.globals.seriesTotals.reduce((a, b) => a + b, 0);
              return "Total Diapsora: " + (isNaN(totalVal) ? 0 : totalVal);
            },
          },
        },
      },
    },
  },
  tooltip: {
    custom: function ({ series, seriesIndex }) {
      let value = series[seriesIndex];
      value = isNaN(value) ? 0 : value;
      return `<div style="padding: 5px;">
                <strong>${baseLabels[seriesIndex]}:</strong> ${value}
              </div>`;
    },
  },
  responsive: [
    {
      breakpoint: 480,
      options: {
        chart: {
          width: 200,
        },
        legend: {
          position: "bottom",
        },
      },
    },
  ],
};

var payment = new ApexCharts(
  document.querySelector("#payment"),
  paymentOptions
);
payment.render();

var options = {
  series: [
    {
      name: "L1 Customers",
      data: [30000, 31000, 32000, 34000, 35000], // Example data points
    },
  ],
  chart: {
    type: "area",
    height: 100,
    sparkline: {
      enabled: true, // Minimal design without axes or legends
    },
  },
  stroke: {
    curve: "smooth",
    width: 2,
    colors: ["#00C851"], // Green line color
  },
  markers: {
    size: [0, 0, 0, 0, 5],
    colors: ["#00C851"],
    strokeColors: "#ffffff",
    strokeWidth: 2,
    hover: {
      size: 6,
    },
  },
  fill: {
    type: "gradient",
    gradient: {
      shadeIntensity: 1,
      opacityFrom: 0.3,
      opacityTo: 0.1,
      stops: [0, 90, 100],
      colorStops: [
        { offset: 0, color: "#00C851", opacity: 0.3 },
        { offset: 100, color: "#FFFFFF", opacity: 0 },
      ],
    },
  },
  tooltip: {
    enabled: false, // Disable tooltip for cleaner look
  },
};

var chart = new ApexCharts(document.querySelector("#customer-chart"), options);
chart.render();

var options = {
  series: [
    {
      name: "L1 Customers",
      data: [30000, 31000, 32000, 34000, 32000], // Example data points
    },
  ],
  chart: {
    type: "area",
    height: 100,
    sparkline: {
      enabled: true, // Minimal design without axes or legends
    },
  },
  stroke: {
    curve: "smooth",
    width: 2,
    colors: ["#EF4242"], // Green line color
  },
  markers: {
    size: [0, 0, 0, 0, 5],
    colors: ["#EF4242"],
    strokeColors: "#ffffff",
    strokeWidth: 2,
    hover: {
      size: 6,
    },
  },
  fill: {
    type: "gradient",
    gradient: {
      shadeIntensity: 1,
      opacityFrom: 0.3,
      opacityTo: 0.1,
      stops: [0, 90, 100],
      colorStops: [
        { offset: 0, color: "#EF4242", opacity: 0.3 },
        { offset: 100, color: "#FFFFFF", opacity: 0 },
      ],
    },
  },
  tooltip: {
    enabled: false, // Disable tooltip for cleaner look
  },
};

var chart = new ApexCharts(
  document.querySelector("#ultraCustomers-chart"),
  options
);
chart.render();

var options = {
  series: [
    {
      name: "L1 Customers",
      data: [30000, 31000, 32000, 34000, 35000], // Example data points
    },
  ],
  chart: {
    type: "area",
    height: 100,
    sparkline: {
      enabled: true, // Minimal design without axes or legends
    },
  },
  stroke: {
    curve: "smooth",
    width: 2,
    colors: ["#00C851"], // Green line color
  },
  markers: {
    size: [0, 0, 0, 0, 5],
    colors: ["#00C851"],
    strokeColors: "#ffffff",
    strokeWidth: 2,
    hover: {
      size: 6,
    },
  },
  fill: {
    type: "gradient",
    gradient: {
      shadeIntensity: 1,
      opacityFrom: 0.3,
      opacityTo: 0.1,
      stops: [0, 90, 100],
      colorStops: [
        { offset: 0, color: "#00C851", opacity: 0.3 },
        { offset: 100, color: "#FFFFFF", opacity: 0 },
      ],
    },
  },
  tooltip: {
    enabled: false, // Disable tooltip for cleaner look
  },
};

var chart = new ApexCharts(document.querySelector("#active-chart"), options);
chart.render();

var options = {
  series: [
    {
      name: "L1 Customers",
      data: [30000, 31000, 32000, 34000, 32000], // Example data points
    },
  ],
  chart: {
    type: "area",
    height: 100,
    sparkline: {
      enabled: true, // Minimal design without axes or legends
    },
  },
  stroke: {
    curve: "smooth",
    width: 2,
    colors: ["#EF4242"], // Green line color
  },
  markers: {
    size: [0, 0, 0, 0, 5],
    colors: ["#EF4242"],
    strokeColors: "#ffffff",
    strokeWidth: 2,
    hover: {
      size: 6,
    },
  },
  fill: {
    type: "gradient",
    gradient: {
      shadeIntensity: 1,
      opacityFrom: 0.3,
      opacityTo: 0.1,
      stops: [0, 90, 100],
      colorStops: [
        { offset: 0, color: "#EF4242", opacity: 0.3 },
        { offset: 100, color: "#FFFFFF", opacity: 0 },
      ],
    },
  },
  tooltip: {
    enabled: false, // Disable tooltip for cleaner look
  },
};

var chart = new ApexCharts(document.querySelector("#NonActive-chart"), options);
chart.render();

let maxVal = Math.max(
  ...data.companiesDisporaMonthlyCounts.map(
    item => Math.max(item.individual, item.organization_admin)
  )
);

let minVal = 0



let range = maxVal - minVal;
let tickAmount = Math.ceil(range / 2); // dynamic spacing

var options = {

  series: [
    {
      name: "Diaspora",
      data: data.companiesDisporaMonthlyCounts.map(item => item.individual),
    },
    {
      name: "Companies",
      data: data.companiesDisporaMonthlyCounts.map(item => item.organization_admin),
    },
  ],
  plotOptions: {
    bar: {
      borderRadius: 2, // Optional, makes space more visible
      columnWidth: "70%",
    },
  },

  chart: {
    height: 478,
    type: "bar",
    zoom: {
      enabled: false, // Disable zoom on mouse actions
    },
    toolbar: {
      show: false, // Hide zooming and panning toolbar
    },
    dropShadow: {
      enabled: false,
    },
  },
  colors: ["#38F07E", "#0C5B2C"],
  dataLabels: {
    enabled: false,
  },
  // stroke: {
  //     curve: 'smooth',
  //     width: 4,
  //     lineCap: 'round',
  //     shadow: {
  //         enabled: false
  //     }
  // },
  // fill: {
  //     type: 'gradient',
  //     gradient: {
  //         shadeIntensity: 1,
  //         opacityFrom: 0,
  //         opacityTo: 0,
  //         stops: [0, 0, 0],
  //         colorStops: [
  //             { offset: 0, color: '#EF4242', opacity: 0 },
  //             { offset: 0, color: '#FFFFFF', opacity: 0 }
  //         ]
  //     }
  // },
  xaxis: {
    categories: [
      "Jan",
      "Feb",
      "Mar",
      "Apr",
      "May",
      "Jun",
      "Jul",
      "Aug",
      "Sep",
      "Oct",
      "Nov",
      "Dec",
    ],
  },
};

var chart = new ApexCharts(document.querySelector("#monthly-trans"), options);
chart.render();

var options = {
  series: [
    {
      data: data.diasporaByAbility.map(item => item.percentage),
    },
  ],
  plotOptions: {
    bar: {
      borderRadius: 2, // Optional, makes space more visible
      columnWidth: "30%",
      distributed: true,
    },
  },

  chart: {
    height: 350,
    type: "bar",
    zoom: {
      enabled: false, // Disable zoom on mouse actions
    },
    toolbar: {
      show: false, // Hide zooming and panning toolbar
    },
    dropShadow: {
      enabled: false,
    },
  },
  legend: {
    show: false,
  },
  colors: [
    "#0C5B2C",
    "#05B448",
    "#0ED95D",
    "#79FCAA",
    "#79FCAA",
    "#96E2D6",
    "#94E9A1",
  ],
  dataLabels: {
    enabled: false,
  },

  xaxis: {
    categories: data.diasporaByAbility.map(item => item.ability_name),
    labels: {
      rotate: 0,
      style: { fontSize: "12px" },
      formatter: function (val) {
        return val.length > 10 ? val.substring(0, 10) + "…" : val;
      }
    },
  },
};

var chart = new ApexCharts(document.querySelector("#disporaAbility"), options);
chart.render();

// Convert response to arrays
var months = Object.keys(data.matchmaking.monthly_breakdown);
var monthlyData = Object.values(data.matchmaking.monthly_breakdown);

var options = {
  series: [
    {
      name: "Matches",
      data: monthlyData,
    },
  ],
  chart: {
    height: 350,
    type: "bar",
    zoom: { enabled: false },
    toolbar: { show: false },
  },
  plotOptions: {
    bar: {
      borderRadius: 2,
      columnWidth: "30%",
    },
  },
  colors: ["#0C5B2C"],
  dataLabels: { enabled: false },
  xaxis: {
    categories: months, // ✅ Jan–Dec from backend
    labels: { rotate: 0, style: { fontSize: "12px" } },
  },
  yaxis: {
    tickAmount: 5,
    labels: {
      formatter: function (value) {
        return value.toLocaleString();
      },
    },
  },
  tooltip: {
    x: {
      formatter: function (val, opts) {
        return months[opts.dataPointIndex] + " " + response.year;
      },
    },
  },
};

var chart = new ApexCharts(document.querySelector("#totalMatchmaking"), options);
chart.render();

var options = {
  chart: {
    type: 'line',
    height: 130,
    toolbar: {
      show: false
    },
    background: 'transparent'
  },
  series: [{
    name: 'Data',
    data: [10, 100, 30, 100]
  }],
  stroke: {
    curve: 'straight', // ✅ Straight line between points
    width: 3,
    colors: ['#000']   // Black line
  },
  markers: {
    size: 8,
    colors: ['#0B3D0B'],      // Fill color: dark green
    strokeColors: '#0B3D0B',  // Border color
    strokeWidth: 2
  },
  grid: {
    show: false
  },
  xaxis: {
    labels: { show: false },
    axisBorder: { show: false },
    axisTicks: { show: false }
  },
  yaxis: {
    show: false
  },
  tooltip: {
    enabled: false
  },
  dataLabels: {
    enabled: false
  }
};

var chart = new ApexCharts(document.querySelector("#chart-sm"), options);
chart.render();

var options = {
  series: [
    {
      name: "Leads",
      data: [3000, 5000, 3500, 5000, 4200, 1500, 2500, 4000, 3200, 3400, 4500, 5000]
    },
    {
      name: "Matchmakings",
      data: [3000, 3400, 2800, 3200, 3500, 2000, 2000, 2200, 2800, 3000, 3200, 3400]
    },
    {
      name: "Meetings",
      data: [2000, 2200, 1800, 2000, 2300, 3500, 1800, 2000, 2500, 2300, 2500, 2800]
    }
  ],
  chart: {
    type: "line",
    height: 400,
    toolbar: { show: false },
    zoom: { enabled: false },
    padding: { bottom: 40 }
  },
  stroke: {
    curve: "smooth",
    width: 2
  },
  markers: { size: 0 },
  colors: ["#0ED95D", "#0C5B2C", "#EB0D0D"],
  dataLabels: { enabled: false },
  xaxis: {
    categories: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"]
  },
  yaxis: {
    min: 1000,
    max: 6000,
    tickAmount: 5
  },
  legend: {
    position: "bottom",
    horizontalAlign: "left",
    offsetX: 20,
    offsetY: 16
  }
};

var chart = new ApexCharts(document.querySelector("#monthly-trans-bars"), options);
chart.render();

var values = [data.leads.pendingLeadsCount, data.leads.matureLeadsCount]; // Just 2 data points
var baseLabels = ["Total Pending Leads", "Total Leads Matured"];
var labelsWithPercent = ["Total Pending Leads", "Total Leads Matured"];
var colors = ["#003C1A", "#38F07E"];

var paymentOptions = {
  series: values,
  chart: {
    width: 500,
    type: "donut",
  },
  labels: labelsWithPercent,
  colors: colors,
  legend: {
    position: "left",
  },
  dataLabels: {
    enabled: false,
  },
  plotOptions: {
    pie: {
      donut: {
        size: '80%',
        labels: {
          show: true,
          total: {
            show: true,
            label: "",
            formatter: function (w) {
              return (
                "Total Leads Generated " +
                w.globals.seriesTotals.reduce((a, b) => a + b, 0)
              );
            },
          },
        },
      },
    },
  },
  tooltip: {
    custom: function ({ series, seriesIndex }) {
      return `<div style="padding: 5px;">
                <strong>${baseLabels[seriesIndex]}:</strong> ${series[seriesIndex]}
              </div>`;
    },
  },
  responsive: [
    {
      breakpoint: 480,
      options: {
        chart: {
          width: 200,
        },
        legend: {
          position: "bottom",
        },
      },
    },
  ],
};

var payment = new ApexCharts(
  document.querySelector("#totalLeads"),
  paymentOptions
);
payment.render();
