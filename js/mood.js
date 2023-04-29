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
      data: [], // Using Mock Data Set 1 for Feeling Level
      label: 'Feeling Level',
      borderColor: 'rgb(255, 0, 255)', // Set the line color to neon magenta
      pointBackgroundColor: 'rgb(255, 0, 255)', // Set the point color to neon magenta
      pointBorderColor: 'rgb(255, 0, 255)', // Set the point border color to neon magenta
      pointRadius: 4, // Set the point radius to 4
      tension: 0.4, // Set the line tension to 0.4
    },
    {
      data: [], // Using Mock Data Set 1 for Stress Level
      label: 'Stress Level',
      borderColor: 'rgb(0, 255, 255)', // Set the line color to neon cyan
      pointBackgroundColor: 'rgb(0, 255, 255)', // Set the point color to neon cyan
      pointBorderColor: 'rgb(0, 255, 255)', // Set the point border color to neon cyan
      pointRadius: 4, // Set the point radius to 4
      tension: 0.4, // Set the line tension to 0.4
    },
    {
      data: [], // Using Mock Data Set 1 for Abuse Level
      label: 'Abuse Level',
      borderColor: 'rgb(255, 255, 0)', // Set the line color to neon yellow
      pointBackgroundColor: 'rgb(255, 255, 0)', // Set the point color to neon yellow
      pointBorderColor: 'rgb(255, 255, 0)', // Set the point border color to neon yellow
      pointRadius: 4, // Set the point radius to 4
      tension: 0.4, // Set the line tension to 0.4
    },
  ],
};

const config = {
  type: 'line', // Change chart type to line
  data: data,
  options: {
    plugins: {
      datalabels: {
        display: false, // Hide data labels by default
      },
      legend: {
        display: true,
        position: 'top',
        labels: {
          color: 'white',
          usePointStyle: true // use point style to show colored boxes next to labels
        }
      },
      tooltip: {
        callbacks: {
          title: function (context) {
            return `Day ${context[0].dataIndex + 1}`;
          },
          label: function (context) {
            return `${context.dataset.label}: ${context.parsed.y}`;
          },
          afterLabel: function (context) {
            return `Feeling Level: ${context.chart.data.datasets[0].data[context.dataIndex].y}, Stress Level: ${context.chart.data.datasets[1].data[context.dataIndex].y}, Abuse Level: ${context.chart.data.datasets[2].data[context.dataIndex].y}`;
          }
        },
        backgroundColor: 'white',
        titleColor: 'black',
        bodyColor: 'black'
      }
    },
    responsive: true,
    scales: {
      x: {
        title: {
          display: true,
          text: 'Days of the Month'
        },
        grid: {
          color: 'rgba(255, 255, 255, 0.2)' // set the color of the x-axis grid lines to light white
        }
      },
      y: {
        beginAtZero: true,
        max: 100,
        title: {
          display: true,
          text: 'Mood Level'
        },
         ticks: {
          callback: function (value, index, values) {
            return value <= 33 ? labels[0] : (value <= 66 ? labels[1] : labels[2]);
          }
        },
        grid: {
          color: 'rgba(255, 255, 255, 0.2)' // set the color of the y-axis grid lines to light white
        }
      }
    },
    animations: {
      tension: {
        duration: 1000,
        easing: 'linear',
        from: 1,
        to: 0,
        loop: true
      }
    },
    // Add any other options here as needed
  },
};




// Get mood data from PHP controller
fetch('/MoodTastic/user_manager/?controllerRequest=show_user_mood_data_chart')
  .then(response => response.json())
  .then(data => {
    console.log(data); // Add this line to log the data to the console
    // Update data object with fetched data
    

    data.forEach((mood, index) => {
      // Add day to labels array
      config.data.labels.push(`Day ${index + 1}`);
      // Add mood data to respective dataset
      config.data.datasets[0].data.push({
        x: index + 1,
        y: mood.feelingValue,
        r: 10 // Set the radius of the bubble
      });
      config.data.datasets[1].data.push({
        x: index + 1,
        y: mood.stressValue,
        r: 10 // Set the radius of the bubble
      });
      config.data.datasets[2].data.push({
        x: index + 1,
        y: mood.abuseValue,
        r: 10 // Set the radius of the bubble
      });
    });

    // Render chart with updated data
    new Chart(ctx, {
      type: 'line',
      data: config.data,
      options: {
        responsive: true,
        scales: {
          x: {
            title: {
              display: true,
              text: 'Days of the Month',
              color:'white'
            }
          },
          y: {
            beginAtZero: true,
            max: 100,
            title: {
              display: true,
              color:'white',
              text: 'Mood Level'
            },
            ticks: {
              callback: function (value, index, values) {
                //return value <= 33 ? labels[0] : (value <= 66 ? labels[1] : labels[2]);
              }
            }
          }
        },
        plugins: {
          legend: {
            display: true,
            position: 'top',
          },
          tooltip: {
            callbacks: {
              title: function (context) {
                return `Day ${context[0].dataIndex + 1}`;
              },
              label: function (context) {
                return `${context.dataset.label}: ${context.parsed.y}`;
              },
              afterLabel: function (context) {
                return `Feeling Level: ${context.chart.data.datasets[0].data[context.dataIndex].y}, Stress Level: ${context.chart.data.datasets[1].data[context.dataIndex].y}, Abuse Level: ${context.chart.data.datasets[2].data[context.dataIndex].y}`;
              }
            }
          }
        }
      }
    });
  });

