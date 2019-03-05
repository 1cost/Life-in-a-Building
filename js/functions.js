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
  for(var i = 0; i < data.length; i++)
  {
    x.push(data[i]["count"]);
  }
  console.log(x);
  it.destroy();

  id = new Chart(document.getElementById(id), {
  type: 'line',
  data: {
    labels: [5,10,15,20,25,30],
    datasets: [{
        data: x,
        label: "Mac D",
        borderColor: "#3e95cd",
        fill: false
      }]
  },
  options: {
    title: {
      display: true,
      text: 'Trends of # of Persons in Macdonough Hall Over Time'
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
