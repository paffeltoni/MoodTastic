// Get the canvas element and its context
const ctx = document.getElementById('my_chart').getContext("2d");

// Represent data
const labels = [
  'Not Hot',
  'Feeling Good',
  'Amazing'
];

// Represent the initial data that goes with the labels
let data = {
  labels: [],
  datasets: [
    {
      data: [],
      label: 'Feeling Level',
      backgroundColor: 'pink',
      borderColor: 'rgba(58, 123, 213,1)',
      hoverBackgroundColor: 'rgba(0, 210, 255,0.7)',
      hoverBorderColor: 'rgba(0, 210, 255,1)',
    },
    {
      data: [],
      label: 'Stress Level',
      backgroundColor: 'lightblue',
      borderColor: 'rgba(58, 123, 213,1)',
      hoverBackgroundColor: 'rgba(0, 210, 255,0.7)',
      hoverBorderColor: 'rgba(0, 210, 255,1)',
    },
    {
      data: [],
      label: 'Abuse Level',
      backgroundColor: 'lightgreen',
      borderColor: 'rgba(58, 123, 213,1)',
      hoverBackgroundColor: 'rgba(0, 210, 255,0.7)',
      hoverBorderColor: 'rgba(0, 210, 255,1)',
    },
  ],
};

// Configuration for the chart
const config = {
  type: 'line', // Change chart type to line
  data: data,
  options: {
    responsive: true,
    scales: {
      x: {
        title: {
          display: true,
          text: 'Days of the Month'
        }
      },
      y: {
        beginAtZero: true,
        max: 4,
        title: {
          display: true,
          text: 'Mood Level'
        },
        ticks: {
          callback: function (value, index, values) {
            return labels[value - 1];
          }
        }
      }
    }
    // Add any other options here as needed
  },
};

// Create instance of the chart
const myChart = new Chart(ctx, config);

// Load data from server and update the chart
fetch('user_manager/index.php', {
  method: 'POST',
  body: new URLSearchParams({
    controllerRequest: 'user_mood_levels',
  }),
})
.then(response => response.json())
.then(data => {
  // Clear previous chart data and labels
myChart.data.labels = [];
myChart.data.datasets[0].data = [];
myChart.data.datasets[1].data = [];
myChart.data.datasets[2].data = [];

// Add sample data
myChart.data.labels = ['Day 1', 'Day 2', 'Day 3', 'Day 4', 'Day 5'];
myChart.data.datasets[0].data = [3, 2, 1, 2, 3]; // Feeling Level
myChart.data.datasets[1].data = [2, 1, 3, 1, 2]; // Stress Level
myChart.data.datasets[2].data = [1, 2, 2, 3, 1]; // Abuse Level

myChart.update(); // Update chart with new data

})
.catch(error => console.error(error));
