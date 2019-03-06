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
       if(dat[0] != -1)
       {
          buildGraph(dat, "canv", id);
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
        label: "Space(s) Selected",
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
