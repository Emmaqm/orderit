const radioNo = document.getElementById('es-nuevo-establecimiento-no');
const radioSi = document.getElementById('es-nuevo-establecimiento-si');
const input = document.getElementById('id-establecimiento');

radioNo.addEventListener('change', checkRadio);
radioSi.addEventListener('change', checkRadio);

function checkRadio(){
    if(radioNo.checked){
        input.style.display = "block";
    }else{
        input.style.display = "none";
    }
};