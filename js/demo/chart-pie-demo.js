// Set new default font family and font color to mimic Bootstrap's default styling
Chart.defaults.global.defaultFontFamily = 'Nunito', '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
Chart.defaults.global.defaultFontColor = '#858796';

// Pie Chart Example
var ctx = document.getElementById("myPieChart1");
var myPieChart = new Chart(ctx, {
  type: 'doughnut',
  data: {
    labels: ["Terminé", "Sur Ordre de Travail", "En attente d'order", "ouverture", "Rejecté"],
    datasets: [{
      data: [84,13,3,1.9,0.6],
      borderWidth: 0,
      backgroundColor: ['#36b9cc', 'blue', 'orange','purple','rgb(253, 64, 95)'],
      hoverBackgroundColor: ['#36b9cc', 'blue', 'orange','purple','rgb(253, 64, 95)'],
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

var ctx = document.getElementById("myPieChart3");
var myPieChart = new Chart(ctx, {
  type: 'doughnut',
  data: {
    labels: ["Indesponsibilité...", "Indesponsibilité...", "Nécessite arrêtée", "Nécessite arrêtte...","Non mentionné"],
    datasets: [{
      data: [75,25],
      backgroundColor: ['rgb(253, 64, 95)','blue'],
      hoverBackgroundColor: ['pink','blue'],
      borderWidth:0
    }],
  },
  options: {
    maintainAspectRatio: false,
    tooltips: {
      backgroundColor: "rgb(255,255,255)",
      bodyFontColor: "#858796",
      borderWidth: 0,
      //displayColors: false,
      caretPadding: 10,
    },
    legend: {
      display: false
    },
    cutoutPercentage: 70,
  },
});

//////////////////////////////

// Pie Chart Example

var ctx = document.getElementById("myPieChart8");
var myPieChart = new Chart(ctx, {
  type: 'doughnut',
  data: {
    labels: ["Total OT (peventif)", "TOTal OT "],
    datasets: [{
      data: [60,40],
      backgroundColor: ['#055255','#ADC2AD'],
      hoverBackgroundColor: ['pink','blue'],
      borderWidth:0
    }],
  },
  options: {
    maintainAspectRatio: false,
    tooltips: {
      backgroundColor: "rgb(255,255,255)",
      bodyFontColor: "#858796",
      borderWidth: 0,
      //displayColors: false,
      caretPadding: 10,
    },
    legend: {
      display: false
    },
    cutoutPercentage: 70,
  },
});
var ctx = document.getElementById("myPieChart9");
var myPieChart = new Chart(ctx, {
  type: 'doughnut',
  data: {
    labels: ["OT non planifies", "TOTal OT "],
    datasets: [{
      data: [55,45],
      backgroundColor: ['#8E3258','#CEA26B'],
      hoverBackgroundColor: ['pink','blue'],
      borderWidth:0
    }],
  },
  options: {
    maintainAspectRatio: false,
    tooltips: {
      backgroundColor: "rgb(255,255,255)",
      bodyFontColor: "#858796",
      borderWidth: 0,
      //displayColors: false,
      caretPadding: 10,
    },
    legend: {
      display: false
    },
    cutoutPercentage: 70,
  },
});
/////////////////////////////
