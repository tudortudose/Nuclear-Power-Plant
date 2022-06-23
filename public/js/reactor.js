function showValue(val, slidernum) {
  /* setup variables for the elements of our slider */
  var thumb = document.getElementById("sliderthumb" + slidernum);
  var shell = document.getElementById("slidershell" + slidernum);
  var track = document.getElementById("slidertrack" + slidernum);
  var fill = document.getElementById("sliderfill" + slidernum);
  var slider = document.getElementById("slider" + slidernum);
  var pc = val / (slider.max - slider.min); /* the percentage slider value */
  var thumbsize = 30; /* must match the thumb size in css */
  var bigval = 350; /* widest or tallest value depending on orientation */
  var smallval = 30; /* narrowest or shortest value depending on orientation */
  var tracksize = bigval - thumbsize;
  var fillsize = 12;
  var filloffset = 7;
  var bordersize = 2;
  var loc = pc * tracksize;

  document
    .getElementById("blur" + slidernum)
    .setAttribute("stdDeviation", val / 10);
  thumb.style.top = "0px";
  thumb.style.left = loc + "px";
  fill.style.top = filloffset + bordersize + "px";
  fill.style.left = "0px";
  fill.style.width = loc + thumbsize / 2 + "px";
  fill.style.height = fillsize + "px";
  shell.style.height = smallval + "px";
  shell.style.width = bigval + "px";
  shell.style.filter = "url(#goo" + slidernum + ")";
  track.style.height = fillsize + "px"; /* adjust for border */
  track.style.width = bigval - 4 + "px"; /* adjust for border */
  track.style.left = "0px";
  track.style.top = filloffset + bordersize + "px";
}

/*function to set the slider values on page load */
function setValue(val, num) {
  document.getElementById("slider" + num).value = val;
  showValue(val, num);
}

setValue(0, 1);
setValue(50, 2);
setValue(100, 3);

var modal = document.getElementById("reactor_modal");
var btn = document.getElementById("reactor_btn");
var span = document.getElementsByClassName("close")[0];

btn.onclick = function () {
  const params = new URLSearchParams(window.location.search);
  var idCentrala = 13; //valoare default pentru id centrala
  if (params.has("id")) {
    idCentrala = params.get("id");
  }

  var xhr = new XMLHttpRequest();
  xhr.withCredentials = false;

  xhr.addEventListener("readystatechange", function () {
    if (this.readyState === 4) {
      console.log(this.status + " " + this.responseText);
    }
  });

  var coreTemperature = document.getElementById("slider2").value;
  var coolTemperature = document.getElementById("slider1").value;
  var powerOutput = document.getElementById("slider3").value;
  var powerDemand = document.getElementById("nuclear_demand").value;
  if (powerDemand === "") {
    powerDemand = 0;
  }

  xhr.open(
    "PUT",
    "http://localhost/NuclearGitProject/Nuclear-Power-Plant/states/insert?id_centrala=" +
      idCentrala +
      "&temperatura_nucleu=" +
      coreTemperature +
      "&putere_racire=" +
      coolTemperature +
      "&putere_energie=" +
      powerOutput +
      "&putere_ceruta=" +
      powerDemand +
      "&putere_produsa=" +
      coreTemperature * coolTemperature * powerOutput,
    true
  );
  xhr.setRequestHeader("Content-Type", "application/json");
  xhr.send();

  //then show statistics of current nuclear plant:
  modal.style.display = "block";

  // if (document.getElementById("nuclear_demand").value === "") {
  //   document.getElementById("nuclear_demand").value = "0";
  // }
  // //values for ajax post request: ----------------------------
  // console.log(
  //   "power demand: " + document.getElementById("nuclear_demand").value
  // );
  // console.log(
  //   "cooling temperature: " + document.getElementById("slider1").value
  // );
  // console.log("core temperature: " + document.getElementById("slider2").value);
  // console.log("power output: " + document.getElementById("slider3").value);
};

span.onclick = function () {
  modal.style.display = "none";
};

window.onclick = function (event) {
  if (event.target == modal) {
    modal.style.display = "none";
  }
};

//----------------------------------------
function weather_chart() {
  var xhr = new XMLHttpRequest();
  xhr.withCredentials = false;

  xhr.addEventListener("readystatechange", function () {
    if (this.readyState === 4) {
      var xValues = [];
      var yValues = [];
      var barColors = [
        "#b91d47",
        "#00aba9",
        "#2b5797",
        "#e8c3b9",
        "#1e7145",
        "#A52A2A",
        "#D2691E",
        "#00FFFF",
        "#8B008B",
        "#8B0000",
        "#2F4F4F",
        "#1E90FF",
        "#FFD700",
      ];

      JSON.parse(this.responseText).forEach((element) => {
        //console.log(element.number+' '+element.vreme);
        xValues.push(element.vreme);
        yValues.push(element.number);
      });

      var myChart = new Chart("weather_chart", {
        type: "pie",
        data: {
          labels: xValues,
          datasets: [
            {
              backgroundColor: barColors,
              data: yValues,
            },
          ],
        },
        options: {
          title: {
            display: true,
            text: "Running reactors days in weather conditions",
          },
        },
      });

      var image = myChart.toBase64Image();
      //console.log(image);

      document.getElementById("weather_chart_export").onclick = function () {
        // Trigger the download
        var a = document.createElement("a");
        a.href = myChart.toBase64Image();
        a.download = "weather_chart.png";
        a.click();
      };
    }
  });

  const params = new URLSearchParams(window.location.search);
  var idCentrala = 13; //valoare default pentru id centrala
  if (params.has("id")) {
    idCentrala = params.get("id");
  }

  xhr.open(
    "GET",
    "http://localhost/NuclearGitProject/Nuclear-Power-Plant/configurations/weather?id=" +
      idCentrala,
    true
  );
  xhr.setRequestHeader("Content-Type", "application/json");

  xhr.send();
}

function reactor_config_chart() {
  var xhr = new XMLHttpRequest();
  xhr.withCredentials = false;

  xhr.addEventListener("readystatechange", function () {
    if (this.readyState === 4) {
      var xValues = Array.from(
        { length: JSON.parse(this.responseText).length },
        (x, i) => i
      );

      var powerData = [];
      var coreData = [];
      var coolData = [];

      JSON.parse(this.responseText).forEach((element) => {
        powerData.push(element.putere_energie);
        coreData.push(element.temperatura_nucleu);
        coolData.push(element.putere_racire);
      });

      var myChart = new Chart("reactor_config_chart", {
        type: "line",
        data: {
          labels: xValues,
          datasets: [
            {
              label: "Power energy",
              data: powerData.reverse(),
              borderColor: "red",
              fill: true,
            },
            {
              label: "Core temperature",
              data: coreData.reverse(),
              borderColor: "green",
              fill: false,
            },
            {
              label: "Coolant volume",
              data: coolData.reverse(),
              borderColor: "blue",
              fill: false,
            },
          ],
        },
        options: {
          title: {
            display: true,
            text: "Reactors functionality over the last 30 days",
          },
        },
      });

      var image = myChart.toBase64Image();
      //console.log(image);

      document.getElementById("reactor_config_chart_export").onclick =
        function () {
          // Trigger the download
          var a = document.createElement("a");
          a.href = myChart.toBase64Image();
          a.download = "reactor_config_chart.png";
          a.click();
        };
    }
  });

  const params = new URLSearchParams(window.location.search);
  var idCentrala = 13; //valoare default pentru id centrala
  if (params.has("id")) {
    idCentrala = params.get("id");
  }

  xhr.open(
    "GET",
    "http://localhost/NuclearGitProject/Nuclear-Power-Plant/configurations/info?id=" +
      idCentrala,
    true
  );
  xhr.setRequestHeader("Content-Type", "application/json");

  xhr.send();
}

function efficency_chart() {
  var xhr = new XMLHttpRequest();
  xhr.withCredentials = false;

  xhr.addEventListener("readystatechange", function () {
    if (this.readyState === 4) {
      var powerData = [];
      var demandData = [];

      JSON.parse(this.responseText).forEach((element) => {
        powerData.push(element.putere_produsa);
        demandData.push(element.putere_ceruta);
      });

      var chartData = {
        labels: Array.from(
          { length: JSON.parse(this.responseText).length },
          (x, i) => i
        ),
        datasets: [
          {
            type: "line",
            label: "Power output",
            backgroundColor: "green",
            borderColor: "green",
            borderWidth: 4,
            fill: false,
            data: powerData.reverse(),
          },
          {
            type: "bar",
            label: "Power demand",
            backgroundColor: "orange",
            data: demandData.reverse(),
            borderColor: "white",
            borderWidth: 2,
          },
        ],
      };

      var myChart = new Chart("efficiency_chart", {
        type: "bar",
        data: chartData,
        options: {
          responsive: true,
          title: {
            display: true,
            text: "Power output vs power demand",
          },
          tooltips: {
            mode: "index",
            intersect: true,
          },
        },
      });

      var image = myChart.toBase64Image();
      //console.log(image);

      document.getElementById("efficiency_chart_export").onclick = function () {
        // Trigger the download
        var a = document.createElement("a");
        a.href = myChart.toBase64Image();
        a.download = "efficiency_chart.png";
        a.click();
      };
    }
  });

  const params = new URLSearchParams(window.location.search);
  var idCentrala = 13; //valoare default pentru id centrala
  if (params.has("id")) {
    idCentrala = params.get("id");
  }

  xhr.open(
    "GET",
    "http://localhost/NuclearGitProject/Nuclear-Power-Plant/configurations/info?id=" +
      idCentrala,
    true
  );
  xhr.setRequestHeader("Content-Type", "application/json");

  xhr.send();
}

function health_chart() {
  var xhr = new XMLHttpRequest();
  xhr.withCredentials = false;

  xhr.addEventListener("readystatechange", function () {
    if (this.readyState === 4) {
      var healthData = [];

      JSON.parse(this.responseText).forEach((element) => {
        healthData.push(element.reactoare_active);
      });

      var chartData = {
        labels: Array.from(
          { length: JSON.parse(this.responseText).length },
          (x, i) => i
        ),
        datasets: [
          {
            type: "line",
            label: "Health",
            backgroundColor: "blue",
            borderColor: "purple",
            borderWidth: 4,
            fill: false,
            data: healthData.reverse(),
          },
        ],
      };
      var myChart = new Chart("health_chart", {
        type: "bar",
        data: chartData,
        options: {
          responsive: true,
          title: {
            display: true,
            text: "Health of power plant over the 30 days",
          },
          tooltips: {
            mode: "index",
            intersect: true,
          },
        },
      });
      var image = myChart.toBase64Image();
      //console.log(image);

      document.getElementById("health_chart_export").onclick = function () {
        // Trigger the download
        var a = document.createElement("a");
        a.href = myChart.toBase64Image();
        a.download = "health_chart.png";
        a.click();
      };

      //web notifications in case health is low:
      if(healthData.length>0){
        var health_check = healthData[healthData.length-1];
        console.log(health_check);
        if(health_check>=75){
          alert('Power Plant Reactors working normally.');
        }
        else if(health_check>=50){
          alert('Power Plant Reactors working at half power.');
        }
        else if(health_check>=25){
          alert('Power Plant Reactors are running abnormally low.');
        }
        else{
          alert('Power Plant Reactors in critical situation, please invoke maintenance.');
        }
      }
    }
  });

  const params = new URLSearchParams(window.location.search);
  var idCentrala = 13; //valoare default pentru id centrala
  if (params.has("id")) {
    idCentrala = params.get("id");
  }

  xhr.open(
    "GET",
    "http://localhost/NuclearGitProject/Nuclear-Power-Plant/configurations/info?id=" +
      idCentrala,
    true
  );
  xhr.setRequestHeader("Content-Type", "application/json");

  xhr.send();
}

weather_chart();
reactor_config_chart();
efficency_chart();
health_chart();


