//*************************************************************************
//            RANGE BAR YOU_PAGE
//*************************************************************************
// Get the canvas element and its context
const ctx = document.getElementById('my_chart').getContext("2d");
// Gradient fill
let gradient = ctx.createLinearGradient(0,0,0,400);
gradient.addColorStop(0,'rgba(58, 123, 213,1)');
gradient.addColorStop(1, 'rgba(0, 210, 255,0.3)');
// Represent data
const labels = [
    'Feeling',
    'Stress',
    'Abuse'
];

// Represent the initial data that goes with the labels
let data = {
    labels,
    datasets: [
        {
            // Initial points on the graph
            data: [25, 67, 85],
            label: 'MoodTastic Data',
            // Adding some colors and other stuff to make the graph look good
            fill: true,
            backgroundColor: gradient,
            pointBackgroundColor: '#fff'
            
        },
    ],
};

// Configuration for the chart
const config = {
    type: 'line',
    data: data,
    options: {
        responsive: true,
        radius: 5,
        hitRadius: 30,
        hoverRadius: 20,
        // Add any other options here as needed
    },
};

// Create instance of the chart
const myChart = new Chart(ctx, config);

// Add event listener to submit button
const submitBtn = document.querySelector('.btn');
submitBtn.addEventListener('click', function() {
    // Retrieve values from range inputs
    const feelingValue = document.getElementById('moodLevelInput').value;
    const stressValue = document.getElementById('stressLevelInput').value;
    const abuseValue = document.getElementById('abuseLevelInput').value;
    
    // Update chart data with new values
    data.datasets[0].data = [feelingValue, stressValue, abuseValue];
    
    // Update the chart with new data
    myChart.update();
});



