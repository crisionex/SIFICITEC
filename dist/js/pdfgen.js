//generacion de grafica
var per = [];
$(document).ready(function () {
  $("#periodo").change(function () {
    per = [];
    $("input:checked").each(function () {
      per.push($(this).val());
    });
  });
});

const variable = [];
let NTemp;
var nombreM = "";
var trs = [];
var total_temp = [];
function graficacion(datax) {
  var jkeys = Object.keys(datax);
  var ne1 = 0;
  var ctx1 = 0;
  var bgc = [
    "rgb(50, 168, 82)",
    "rgb(230, 200, 7)",
    "rgb(13, 107, 38)",
    "rgb(78, 181, 105)",
    "rgb(240, 224, 81)",
    "rgb(222, 200, 0)",
  ];

  for (var i = 0; i < jkeys.length; i++) {
    variable[i] = [];
    total_temp[i] = 0;
  }

  for (let j = 0; j < jkeys.length; j++) {
    NTemp = jkeys[j];
    for (let i = 0; i < Object.keys(datax[NTemp]).length; i++) {
      for (let k = 0; k < Object.keys(datax[NTemp][0]).length; k++) {
        if (ne1 < Object.keys(datax[NTemp][0]).length) {
          variable[j][k] = datax[NTemp][i]["n" + k];
          if(datax[NTemp][i]["n" + k]!=null){
            total_temp[j] += datax[NTemp][i]["n" + k];
          }
          ne1++;
        } else {
          variable[j][k] = variable[j][k] + datax[NTemp][i]["n" + k];
          if((variable[j][k] + datax[NTemp][i]["n" + k])!=null){
          total_temp[j] = total_temp[j] + datax[NTemp][i]["n" + k];
          }
        }
      }
    }
    ne1 = 0;
    ctx1 = 0;
  }

  for (var i = 0; i < jkeys.length; i++) {
    jkeys[i] = jkeys[i] + " (" + total_temp[i] + ")";
  }
  // console.log(Object.entries(datax));
  // pruebaarray = Object.entries(datax);

  trs = variable.reduce((r, a, i, { length }) => {
    a.forEach((v, j) => {
      r[j] = r[j] || new Array(length).fill(0);
      r[j][i] = v;
    });
    return r;
  }, []);


  var id = document.getElementById("etiqueta").value;
  var idn = document.getElementById("desgregar").value;

  let labels = [];
  $.ajax({
    url: "query/netqt.php",
    method: "POST",
    data: {
      id: id,
    },
    success: function (data) {
      nombreM = data;
    },
  });

  $.ajax({
    url: "query/getn.php",
    method: "POST",
    data: {
      idn: idn,
      id,
      id,
      per: per,
    },
    success: function (datad) {
      if (per.length == 1) {
        labels = datad.split(",");
      } else if (per.length > 1) {
        labels = datad.split("\n");
      }

      var ctx = document.getElementById("myChart").getContext("2d");

      const data = {
        labels: jkeys,
        datasets: [{}],
      };

      const config = {
        type: "bar",
        data: data,
        options: {
          plugins: {
            title: {
              display: true,
              text: nombreM,
            },
          },
          responsive: true,
          maintainAspectRatio: false,
          scales: {
            x: {
              stacked: true,
            },
            y: {
              stacked: true,
            },
          },
        },
      };
      chart = new Chart(ctx, config);
      if (labels.length > 0) {
        for (let w = 0; w < labels.length; w++) {
          chart.data.datasets[w] = {
            label: labels[w],
            data: trs[w],
            backgroundColor: bgc[w],
          };
          chart.update();
        }
      }
    },
  });
}
