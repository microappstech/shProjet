const ctx = document.getElementById('donutChart').getContext('2d');

const data = {
  labels: ['Data 1', 'Data 2'],
  datasets: [{
    data: [70, 30], // Put your data values here (e.g., 70% and 30%)
    backgroundColor: ['#FF5733', '#E0E0E0'],
    borderWidth: 0,
  }]
};

const options = {
     circumference: 180,
        aspectRation: 2,
        rotation: 270,
         
  legend: {
    display: false,
  },
};

const donutChart = new Chart(ctx, {
  type: 'doughnut',
  data: data,
  options: options,
});
