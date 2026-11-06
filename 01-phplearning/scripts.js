const inputNumber = document.getElementById('input-number');

const pickupButton = document.getElementById('pick-up-call-button');

const hangupButton = document.getElementById('hang-up-call-button');

function buttonClicked(buttonValue) {
    inputNumber.Value = buttonValue;

    if(inputNumber.Value.length < 3) {

        pickupButton.disabled = true
    } else {
        pickupButton.disabled = false  
    }
}

function startPhoneCall() {
    hangupButton.classList.remove('hangup-call-button-under');
    hangupButton.classList.add('hangup-call-button-under');
    hangupButton.hidden = false;
    hangupButton.disabled = false;
    pickupButton.classList.add('pickup-call-button-under');
    pickupButton.hiden = true;
    
}