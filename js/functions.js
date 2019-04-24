function buildForm(formElement, id) {
  acquireImageURL(formElement, "pic");
  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      var courses = JSON.parse(xhttp.responseText);
      buildDataTable(courses, "placeholder");
      buildCourseDataHeader("title", "placement");
      buildResubmitOption("resubmitLoc");
    }
  };
  xhttp.open(formElement.method, formElement.action, true);
  xhttp.send(new FormData (formElement));
  return false;
}

function goForm(formElement, id) {
  document.getElementById("err").innerHTML = "";
  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
       console.log(xhttp.responseText);
       var dat = JSON.parse(xhttp.responseText);

       if(dat["check"] == 1)
       {
         var el = document.getElementById("err");
         el.innerHTML="<div class='alert alert-warning' role='alert'><strong>Oh snap!</strong>, date bounds not given, providing data for 2019-04-24.</div>";
       }
       else {
         document.getElementById("err").innerHTML = "";
       }
       if(dat[0] != -1)
       {
          buildGraph(dat, "canv", id);
          buildTable(dat, "")
       }
       else
       {
          var el = document.getElementById("err");
          el.innerHTML="<div class='alert alert-danger' role='alert'><strong>Oh snap!</strong>, no data for specified range.</div>";
       }
    }
  };
  xhttp.open(formElement.method, formElement.action, true);
  xhttp.send(new FormData (formElement));
  return false;
}

function goRadar(formElement, id) {
  document.getElementById("err").innerHTML = "";
  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
       console.log(xhttp.responseText);
       var dat = JSON.parse(xhttp.responseText);

       if(dat["err"] != -1)
       {
          document.getElementById("err").innerHTML = "";
          buildRadar(dat["left"], dat["right"], "left", "right");
          updateInfo(dat["DATE"], dat["data"][0], dat["data"][1], dat["data"][2], dat["data"][3]);
       }
       else
       {
          var el = document.getElementById("err");
          el.innerHTML="<div class='alert alert-danger' role='alert'><strong>Oh snap!</strong>, no data for specified range.</div>";
       }
    }
  };
  xhttp.open(formElement.method, formElement.action, true);
  xhttp.send(new FormData (formElement));
  return false;
}

function buildTable(data)
{
  var locMap = {
    "macd": "MacDonough Hall",
    "7": "7th Wing Gym",
    "barb": "Barbershop"
  };
  var x = [];
  var build = document.getElementById("err");
  var d = "<table name = 'myt' id = 'myt'><thead><tr><th>TIME</th><th>COUNT</th><th>LOCATION</th><th>OBJECT TYPE</th></tr></thead><tbody>";
  console.log(data);
  for( var i = 0; i < data.length; i++)
  {
    console.log(data[i]);
    obj = "";
    if(data[i]["object"]=="p")
    {
      obj = "Person";
    }
    else {
      obj = "Backpack";
    }
    d += "<tr><td>" + data[i]["date"] + "</td><td>" + data[i]["count"] + "</td><td>" + locMap[data[i]["location"]] + "</td><td>" + obj + "</td></tr>";
  }
  d+= "</tbody></table>";
  build.innerHTML = d;
  $(document).ready( function () {
    $('#myt').DataTable(
      {
        responsive: true
      }
    );
} );
}

function buildRadar(leftData, rightData, leftID, rightID)
{
var leftChart = new Chart(document.getElementById(leftID),
{"type":"radar",
"data":
  {
    "labels":["0000-0600","0600-1200","1200-1800","1800-2400"],
    "datasets":[{"label":"# Mids","data":leftData,
    "fill":true,
    "backgroundColor":"rgba(255, 99, 132, 0.2)",
    "borderColor":"rgb(255, 99, 132)",
    "pointBackgroundColor":"rgb(255, 99, 132)",
    "pointBorderColor":"#fff",
    "pointHoverBackgroundColor":"#fff",
    "pointHoverBorderColor":"rgb(255, 99, 132)"}]},
    "options":
      {"elements":{"line":{"tension":0,"borderWidth":3}}}});

var rightChart = new Chart(document.getElementById(rightID),
{"type":"radar",
"data":
  {
    "labels":["0000-0600","0600-1200","1200-1800","1800-2400"],
    "datasets":[{"label":"# Detection","data":rightData,
"fill":true,"backgroundColor":"rgba(54, 162, 235, 0.2)","borderColor":"rgb(54, 162, 235)","pointBackgroundColor":"rgb(54, 162, 235)","pointBorderColor":"#fff","pointHoverBackgroundColor":"#fff","pointHoverBorderColor":"rgb(54, 162, 235)"}]},"options":{"elements":{"line":{"tension":0,"borderWidth":3}}}});
}

function updateInfo(date, a, b, c, d)
{
  document.getElementById("DATE_INSERT").innerHTML = date;
  if(a<0)
  {
    document.getElementById("A").innerHTML = (-a)+"% quieter";
  }
  else
  {
    document.getElementById("A").innerHTML = a+"% busier";
  }

  if(b<0)
  {
    document.getElementById("A").innerHTML = (-b)+"% quieter";
  }
  else
  {
    document.getElementById("A").innerHTML = b+"% busier";
  }

  if(c<0)
  {
    document.getElementById("A").innerHTML = (-c)+"% quieter";
  }
  else
  {
    document.getElementById("A").innerHTML = c+"% busier";
  }

  if(d<0)
  {
    document.getElementById("A").innerHTML = (-d)+"% quieter";
  }
  else
  {
    document.getElementById("A").innerHTML = d+"% busier";
  }

}

function buildGraph(data, id, it)
{
  var x = [];
  var lab = []
  for(var i = 0; i < data.length; i++)
  {
    if(data.length <=5)
    {
      lab.push(data[i]["date"]);
    }
    else
    {
      if(i%2==0)
      {
        lab.push(data[i]["date"]);
      }
    }
    x.push(data[i]["count"]);
  }
  console.log(x);
  it.destroy();

  id = new Chart(document.getElementById(id), {
  type: 'line',
  data: {
    labels: lab,
    datasets: [{
        data: x,
        label: "Object count",
        borderColor: "#3e95cd",
        fill: true
      }]
  },
  options: {
    title: {
      display: true,
      text: 'Trends of # of Persons in Space(s) Over Time'
    },
    layout: {
      padding: {
          left: 200,
          right: 0,
          top: 0,
          bottom: 0
      }
    },
    responsive: false
  }
});

}
