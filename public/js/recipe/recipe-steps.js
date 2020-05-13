var nbSteps = 1;

function addStep() {
    console.log("Ajouter étape");
    nbSteps = nbSteps + 1;
    var ul = document.getElementById("steps");
    var li = document.createElement("li");
    li.appendChild(document.createTextNode("test"));
    li.setAttribute("id", nbSteps); // added line
    ul.appendChild(li);
}