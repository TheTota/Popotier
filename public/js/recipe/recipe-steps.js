var nbSteps = 1;

function addStep() {
    nbSteps = nbSteps + 1;
    var ol_step = document.getElementById("steps");
    var desc = ol_step.lastElementChild;
    var desc_clone = desc.cloneNode(true);
    desc_clone.setAttribute("id", nbSteps);
    desc_clone.placeholder = "Description de l'étape";
    document.getElementById("steps").appendChild(desc_clone);
}

function deleteStep(stepToDelete) {
    var firtsIndexToChange = parseInt(stepToDelete);

    if (firtsIndexToChange > 1) {
        document.getElementById(stepToDelete).setAttribute("id", "toRemove");
        for (let i = firtsIndexToChange; i < nbSteps; i++) {
            document.getElementById(i + 1).setAttribute("id", i);
        }
        document.getElementById("toRemove").remove();
        nbSteps = nbSteps - 1;
    } 
   
}