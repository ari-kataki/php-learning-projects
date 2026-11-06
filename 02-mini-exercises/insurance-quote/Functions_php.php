<?php

function calculateBasicPremium($typeVechicle) {
    
    if ($typeVechicle === 'Auto') {

        return 500;
    
    }
    
    if ($typeVechicle === 'Moto') {

        return 300;
    
    }
    
    return 0;

}

function calculateSurcharges($age, $yearsLicense, $previousClaims, $basicPremium) {
    
    $surcharges = [];

    if ($age < 25) {

        $surcharges['Age under 25 (+20%)'] = $basicPremium * 0.20;
    }

    if ($previousClaims) {

        $surcharges['Previous claims (+30%)'] = $basicPremium * 0.30;
    }

    if ($yearsLicense < 2) {

        $surcharges['License < 2 years (+15%)'] = $basicPremium * 0.15;
    }

    return $surcharges;

}

function validateForm($age, $yearsLicense) {

    $errors = [];

    if ($age === '') {

        $errors[] = 'Age is required.';

    } elseif (!($age) || (int)$age < 18) {

        $errors[] = 'Invalid age. You must be at least 18 years old.';
    
    }

    if ($yearsLicense === '') {

        $errors[] = 'Years of license are required.';

    } elseif (!($yearsLicense) || (int)$yearsLicense < 0) {

        $errors[] = 'Invalid years of license.';

    }

    return $errors;
}