nbSteps = 1;

function addStep() {
    nbSteps = nbSteps + 1;
    console.log("Ajouter �tape" + nbSteps);

    var ol = document.getElementById("steps");
    var li = document.createElement("li");
    var desc = document.createElement("TEXTAREA");
    desc.placeholder = "Description de l'�tape";
    desc.className = "form-control";
    li.appendChild(desc);
    li.setAttribute("id", nbSteps);
    ol.appendChild(li);
}

function deleteStep($id) {
    //decaler les etapes  a partir de i

}