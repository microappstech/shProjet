// Set new default font family and font color to mimic Bootstrap's default styling
Chart.defaults.global.defaultFontFamily = 'Nunito', '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
Chart.defaults.global.defaultFontColor = '#858796';

// Pie Chart Example
var ctx = document.getElementById("myPieChart");
var myPieChart = new Chart(ctx, {
  type: 'doughnut',
  data: {
    labels: ["Terminé", "Sur Ordre de Travail"],
    datasets: [{
      data: [84,13,3,1.9,0.6],
      borderWidth: 0,
      backgroundColor: ['#055255', '#ADC2AD'],
      hoverBackgroundColor: ['#055255', '#ADC2AD'],
      hoverBorderColor: "rgba(234, 236, 244, 1)",
      
    }],
  },
  options: {
    maintainAspectRatio: false,
    tooltips: {
      backgroundColor: "rgb(255,255,255)",
      bodyFontColor: "#858796",
      
      displayColors: false,
      caretPadding: 10,
    },
    legend: {
      display: false
    },
    cutoutPercentage: 70,
  },
});

//-----------------------



//////////////////////////////

// Pie Chart Example
var ctx = document.getElementById("myPieChart7");
var myPieChart = new Chart(ctx, {
  type: 'doughnut',
  data: {
    labels: ["OT type inspection ", "OT Realiser de type inspection"],
    datasets: [{
      data: [84,13],
      borderWidth: 0,
      backgroundColor: ['#326633', '#D49419'],
      hoverBackgroundColor: ['#326633', '#D49419'],
      hoverBorderColor: "rgba(234, 236, 244, 1)",
    }],
  },
  options: {
    maintainAspectRatio: false,
    tooltips: {
      backgroundColor: "rgb(255,255,255)",
      bodyFontColor: "#858796",
      
      displayColors: false,
      caretPadding: 10,
    },
    legend: {
      display: false
    },
    cutoutPercentage: 70,
  },
});
var ctx = document.getElementById("myPieChart11");
var myPieChart = new Chart(ctx, {
  type: 'doughnut',
  data: {
    labels: ["DI terminer cree par l'inspcteur ", "DI cree par l'inspctuer"],
    datasets: [{
      data: [70,30],
      borderWidth: 0,
      backgroundColor: ['#8E3258', '#CEA26B'],
      hoverBackgroundColor: ['#8E3258', '#CEA26Bs'],
      hoverBorderColor: "rgba(234, 236, 244, 1)",
    }],
  },
  options: {
    maintainAspectRatio: false,
    tooltips: {
      backgroundColor: "rgb(255,255,255)",
      bodyFontColor: "#858796",
      
      displayColors: false,
      caretPadding: 10,
    },
    legend: {
      display: false
    },
    cutoutPercentage: 70,
  },
});
