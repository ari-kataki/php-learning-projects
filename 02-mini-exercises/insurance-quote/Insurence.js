function validateFormJS() {

    let valid = true;

    
    const age = document.getElementById('eta');

    const yearsLicensed = document.getElementById('anni-patente');

    const errorAge = document.getElementById('errore-eta');

    const erroryearsLicensed = document.getElementById('errore-anni-patente');

    errorAge.textContent = '';

    erroryearsLicensed.textContent = '';

    age.style.border = '';
    
    yearsLicensed.style.border = '';

   
    if (age.value === '') {

        age.style.border = '2px solid red';

        errorAge.textContent = 'Age is required.';

        valid = false;

    } else if ((age.value) || (age.value) < 18) {

        age.style.border = '2px solid red';

        errorAge.textContent = 'You must be at least 18 years old.';

        valid = false;
    }

   
    if (yearsLicensed.value === '') {

        yearsLicensed.style.border = '2px solid red';

        erroryearsLicensed.textContent = 'Mandatory driving license years.';

        valid = false;

    } else if ((yearsLicensed.value) || (yearsLicensed.value) < 0) {

        yearsLicensed.style.border = '2px solid red';

        erroryearsLicensed.textContent = 'Invalid value.';

        valid = false;

    }

   
    return valid;
}