var xValues = ["Italy", "France" ];
var yValues = [55, 49,];
var barColors = ["red", "green"];

new Chart("myChart", {
  type: "bar",
  data: {
    labels: xValues,
    datasets: [{
      backgroundColor: barColors,
      data: yValues
    }]
  },
  options: {
    legend: {display: false},
    title: {
      display: true,
      text: "World Wine Production 2018"
    }
  }
});



var xValuespie = ["Italy", "France"];
var yValuespie = [55, 49,];
var barColors = [
  "#b91d47",
  "#00aba9",
];

new Chart("chartpie", {
  type: "doughnut",
  data: {
    labels: xValuespie,
    datasets: [{
      backgroundColor: barColors,
      data: yValuespie
    }]
  },
  options: {
    title: {
      display: true,
      text: "World Wide Wine Production 2018"
    }
  }
});