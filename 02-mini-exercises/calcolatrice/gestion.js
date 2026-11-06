function addToInput(number){
    let input = document.getElementById('inputZone');
    if(input.value == 'NaN'){
        input.value = "" ;
    }
    input.value += number;
}
function deleteLastChar(){
    let input = document.getElementById('inputZone');
    input.value = input.value.slice(0, -1);
}
function resetInput(){
    let input = document.getElementById('inputZone');
    input.value = "";
}
function isValid(){
    return true;
}