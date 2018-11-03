// Chart options

const options = {
  chart: {
    height: 450,
    width: "100%",
    type: "bar",
    background: "#f4f4f4",
    foreColor: "#333"
  },
  plotOptions: {
    bar: {
      horizontal: false
    }
  },
  series: [series_data],
  xaxis: xaxis_data,
  fill: {
    colors: ["#F44336"]
  },
  dataLabels: {
    enabled: false
  },

  title: title_data
};

// Init chart
const chart = new ApexCharts(document.querySelector("#chart"), options);

// Render chart
chart.render();

// Event example
document.getElementById("change").addEventListener("click", () =>
  chart.updateOptions({
    plotOptions: {
      bar: {
        horizontal: true
      }
    }
  })
);

/*
let ownerId = document.getElementById("ownerId").value;
let title = document.getElementById("title").value;
let type = document.getElementById("type").value;
let isPublic = document.getElementById("isPublic").value;
let xAxisName = document.getElementById("xAxisName").value;
//let xyAxisName = document.getElementById("yAxisName").value;

var xAxis = [];
var yAxis = [];
for (i = 1; i < 13; i++) {
  if (
    document.getElementById("xAxis" + i) !== null ||
    document.getElementById("yAxis" + i) !== null
  ) {
    xAxis[i] = document.getElementById("xAxis" + i);
    yAxis[i] = document.getElementById("yAxis" + i);
  } else {
    break;
  }
}

// Chart options
const options = {
  chart: {
    height: 450,
    width: "100%",
    type: type,
    background: "#f4f4f4",
    foreColor: "#333"
  },
  plotOptions: {
    bar: {
      horizontal: false
    }
  },
  series: [
    {
      name: xAxisName,
      data: [
        8550405,
        3971883,
        2720546,
        2296224,
        1567442,
        1563025,
        1469845,
        1394928,
        1300092,
        1026908
      ]
    }
  ],
  xaxis: {
    categories: [
      "New York",
      "Los Angeles",
      "Chicago",
      "Houston",
      "Philadelphia",
      "Phoenix",
      "San Antonio",
      "San Diego",
      "Dallas",
      "San Jose"
    ]
  },
  fill: {
    colors: ["#F44336"]
  },
  dataLabels: {
    enabled: false
  },

  title: {
    text: title,
    align: "center",
    margin: 20,
    offsetY: 20,
    style: {
      fontSize: "25px"
    }
  }
};

// Init chart
const chart = new ApexCharts(document.querySelector("#chart"), options);

// Render chart
chart.render();

// Event example
document.getElementById("change").addEventListener("click", () =>
  chart.updateOptions({
    plotOptions: {
      bar: {
        horizontal: true
      }
    }
  })
);
*/
