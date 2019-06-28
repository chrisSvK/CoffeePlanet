
function openFilter(){
    var filterMode = document.getElementById("filterMode")
    filterMode.style.display='initial';
}

function closeFilter(){
    var filterMode = document.getElementById("filterMode")
    filterMode.style.display='none';
}

var slider = document.getElementById("myRange");
var output = document.getElementById("demo");
output.innerHTML = slider.value+"€";

slider.oninput = function() {
    output.innerHTML = this.value+"€";
}