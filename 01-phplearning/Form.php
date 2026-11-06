<?php

    // $index_test = 100; //snake case
    // $index = false; //OK
    // //$index-test= 100;  NO HYPHEN CASE!!!!

    // if ($index_test == 100) { //con == confronta valore, con === confronta tipo e valore, quindi i due operatori possono portare a risultati logici diversi
    //     $index = true;
    // } else {
    //     $index = false;
    // }

    // for($i = 0; $i < 10; $i++) {
    //     echo $i;
    // }

    // $_POST; //---> array associativo --->invece che chiave numerica, usano una stringa come chiave 
    //                                //---> la chiave sarà il valore dell'attributo name
    // $_GET; //---> array associativo

 //    if($_SERVER['REQUEST_METHOD'] === 'POST') {
 //        if(array_key_exists(key: 'lastname', $_POST)){
 //            echo $_POST['lastname'];
 //        }
 //    } //"" in php hanno l'interpolazione, quindi hanno una complessità computazionale maggiore quindi '' hanno minor impatto sulla macchina
 //
    // $haiPostato = 'Hai effettuato una POST!';

    if($_SERVER['REQUEST_METHOD'] === 'POST') {
        echo '<pre>' . print_r($_POST, true) . '</pre>';
    }
    
?>

<html>

    <head>
      
    </head>
    <body>
        
        <form method="POST" onsubmit="return validateForm()"> <!--GET / POST tipi di azione http: GET per ottenere dati, POST per inviarli. GET ha una capacità limitata, la POST ha una capacità di invio dati molto più grandi di una GET-->

            <div id="lastname-container">
                <label>Cognome</label>
                    <input 
                        type="text" 

                        name="lastname"
                        
                        id="lastname"
                    
                        value="<?php 
                            if(array_key_exists( 'lastname', $_POST)) {
                                echo $_POST['lastname'];
                            } 
                        ?>"
                        <?php
                            // if(array_key_exists('lastname',$_POST)) {

                            //     $userInputLastName = trim($_POST['lastname']);

                            //     $invalidLastNameResponse = ' style="border: 1px solid red;"';

                            //     if(isset($userInputLastName) === false || strlen($userInputLastName) < 3) {
                                
                            //         echo $invalidLastNameResponse;
                            //     }
                            // }
                        ?>
                    > 
                    <span id="lastname-error"></span>
            </div>

            <div id="firstname-container">
                    <label>Nome</label>
                    <input 
                        type="text"

                        name="firstname" 

                        id="firstname"

                        value="<?php 
                            if(array_key_exists( 'firstname', $_POST)) {
                                echo $_POST['firstname'];
                            } 
                        ?>"
                        <?php
                            // if(array_key_exists('firstname', $_POST)) {

                            //     $userInputFirstName = trim($_POST['firstname']);

                            //     $invalidFirstNameResponse = ' style="border: 1px solid red;"';

                            //     if(isset($userInputFirstName) === false || strlen($userInputFirstName) < 3) {
                                
                            //         echo $invalidFirstNameResponse;
                            //     }
                            // }
                        ?>       
                    >
                    <span id="firstname-error"></span>
                <?php
                
                    // if(array_key_exists('firstname', $_POST)) {

                    //     $userInputFirstName = trim($_POST['firstname']);

                    //     $invalidFirstNameResponse = '<div style="color: red; display: inline-block;"><h5 style="margin: 0;">Il nome inserito non è valido!</h5></div>';

                    //     if(isset($userInputFirstName) === false || strlen($userInputFirstName) < 3) {
                                    
                    //         echo $invalidFirstNameResponse;
                    //     }
                    // }    

                ?>
            </div>

            <div style="display: inline-block;">
                <label>Data di Nascita: </label>
                <select type="text" name="birth-day" id="birth-day">
                <?php
                    
                    for($i = 1; $i < 32; $i++) {

                        $userSelectedDay = (int) $_POST['birth-day'];

                        $selectedString = '';

                        if( $userSelectedDay === $i) {
                            $selectedString = 'selected="selected"';
                        }
                        echo '<option id="birth-day-'.$i.'" value="'.$i.'" ' . $selectedString . '>' . $i . '</option>';
                    }
                ?>
                </select>
                <select type="text" name="birth-month" id="birth-month">
                    <?php
                    
                        for($i = 1; $i < 13; $i++) {
                            $month = date("F", mktime(0, 0, 0, $i, 1, 2000));
                            $userSelection = (int) $_POST['birth-month'];

                            $selectedString = '';

                            if( $userSelection === $i) {
                                $selectedString = 'selected="selected"';
                            }
                            echo '<option id="birth-month-'.$i.'" value="' . $i . '" '.$selectedString.'>' . $month . '</option>';
                        }
                    ?>
                </select>
                <select type="text" name="birth-year" id="birth-year"> 
                    <?php
                    //<select type="text" name="birth-year selected= "' . $userSelection . '"">
                        $currentYear = (int) date('Y');
                        
                        for($i = $currentYear - 100; $i <= $currentYear; $i++) {
                            
                            $userSelection = (int) $_POST['birth-year'];

                            $selectedString = '';

                            if( $userSelection === $i) {
                                $selectedString = 'selected="selected"';
                            }
                            echo '<option id="birth-year-'.$i.'" value="' . $i . '" '.$selectedString.' >' . $i . '</option>';
                        }
                    ?>
                </select>
                <span id="birthdate-error" style="color: red"></span>
            </div>
            <?php

                // $invalidDateResponse = '<span style="color: red; display: inline-block;"><h5>La data inserita non è valida!</h5></span>';

                // if(array_key_exists('birth-day', $_POST)) {

                //     $userSelectedDay = (int) $_POST['birth-day'];

                //     $userSelectedYear = (int) $_POST['birth-year'];

                //     $userSelectedMonth = (int) $_POST['birth-month'];

                //     if(checkdate($userSelectedMonth, $userSelectedDay, $userSelectedYear) === false) {
                                
                //         echo $invalidDateResponse;
                //     }
                // }
            ?>
            <div>
                <label>Altezza</label>
                <select name="height">
                    <?php
                    
                        for($i = 100; $i < 240; $i++) {
                            $height = number_format($i/100, 2);
                            $userSelection = (int) $_POST['height'];

                        $selectedString = '';

                        if( $userSelection === $i) {
                            $selectedString = 'selected="selected"';
                        }
                            echo '<option value="' . $i . '" '.$selectedString.'>' . $height . ' m </option>';
                        }
                    ?>
                </select>
            </div>
            <div style="display: inline-block;">
                <label>Data di Scadenza</label>
                <select id="expiry-day" name="expiry-day">
                    <?php
                            
                        for($i = 1; $i < 32; $i++) {

                            $userSelection = (int) $_POST['expiry-day'];

                            $selectedString = '';

                            if( $userSelection === $i) {
                                $selectedString = 'selected="selected"';
                            }
                            echo '<option value="' . $i . '" ' . $selectedString . '>' . $i . '</option>';
                        }
                    ?>
                </select>
                <select id="expiry-month" name="expiry-month">
                    <?php
                            
                        for($i = 1; $i < 13; $i++) {

                            $month = date("F", mktime(0, 0, 0, $i, 1, 2000));

                            $userSelection = (int) $_POST['expiry-month'];

                            $selectedString = '';

                            if( $userSelection === $i) {
                                $selectedString = 'selected="selected"';
                            }
                            echo '<option value="' . $i . '" ' . $selectedString . '>' . $month . '</option>';
                        }
                    ?>
                </select>
                <select id="expiry-year" name="expiry-year">
                    <?php
                        $currentYear = (int) date('Y');
                        for($i = $currentYear + 10; $i < $currentYear + 110; $i++) {
                                
                            $userSelection = (int) $_POST['expiry-year'];

                            $selectedString = '';

                            if($userSelection === $i) {
                                $selectedString = 'selected="selected"';
                            }

                            echo '<option value="' . $i . '" ' . $selectedString . '>' . $i . '</option>';
                        } 
                    ?>
                </select>
                <span id="expirydate-error"></span>
            </div>
            <?php

                // $invalidDateResponse = '<span style="color: red; display: inline-block;"><h5>La data inserita non è valida!</h5></span>';

                // if(array_key_exists('expiry-day', $_POST)) {
                //     $userSelectedDay = (int) $_POST['expiry-day'];

                //     $userSelectedYear = (int) $_POST['expiry-year'];

                //     $userSelectedMonth = (int) $_POST['expiry-month'];

                //     if(checkdate($userSelectedMonth, $userSelectedDay, $userSelectedYear) === false) {
                                
                //         echo $invalidDateResponse;
                //     }
                // }  
            ?>
            <div>
                <input type="submit" id="submit-button" value="Invia">
            </div> 
        </form> 
        <!-- //campo nome vuoto == false
                //il valore di un campo type text si estrae dalla proprietà value del tag
                //la lunghezza di una stringa si accede dalla proprietà "lenght" della stringa stessa 
                // perchè in js le stringhr sono oggetti di tipo primitivo -->
        <script>
            function validateForm() {

                const inputLastNameStyle = document.getElementById('lastname').style;

                const inputLastName = document.getElementById('lastname').value;

                const inputFirstNameStyle = document.getElementById('firstname').style;

                const inputFirstName = document.getElementById('firstname').value;

                const firstNameError = document.getElementById('firstname-error');

                const lastNameError = document.getElementById('lastname-error');

                const errorMessageFirstName = '<span style="color: red;">Il nome inserito non è valido!</span>';

                const errorMessageLastName = '<span style="color: red;">Il cognome inserito non è valido!</span>';

                let birthDateValid = isBirthDateValid();

                let expiryDateValid = isExpiryDateValid();

                let isLastNameValid = true;

                let isFirstNameValid = true;

                let isFormValid = true;

                if(inputLastName.length == 0 || inputLastName.length < 3) {
                    inputLastNameStyle.border = '1px solid red';
                    lastNameError.innerHTML = errorMessageLastName;
                    isLastNameValid = false;
                    
                }
                if(inputFirstName.length == 0 || inputFirstName.length < 3) {
                    inputFirstNameStyle.border = '1px solid red';
                    firstNameError.innerHTML = errorMessageFirstName;
                    isFirstNameValid = false;
                }

                if(isLastNameValid) {
                    inputLastNameStyle.removeProperty('border');
                    lastNameError.innerHTML = '';
                }

                if(isFirstNameValid) {
                    inputFirstNameStyle.removeProperty('border');
                    firstNameError.innerHTML = '';
                }

                if(isLastNameValid == false || isFirstNameValid == false || birthDateValid == false || expiryDateValid == false) {
                    isFormValid = false;
                }

                return isFormValid;

            }

            function isBirthDateValid() {

                let birthDateValid = true;

                const birthDateError = document.getElementById('birthdate-error');

                let userInputBirthDay = document.getElementById('birth-day').value;

                let userInputBirthMonth = document.getElementById('birth-month').value;

                let userInputBirthYear = document.getElementById('birth-year').value;

                userDate = userInputBirthYear + '/' + userInputBirthMonth + '/' + userInputBirthDay;
                
                dateToCheck = new Date(userDate)

                if(
                    (dateToCheck.getMonth()+1!=userInputBirthMonth) ||
                    (dateToCheck.getDate()!=userInputBirthDay) ||
                    (dateToCheck.getFullYear()!=userInputBirthYear)) 
                {
                    birthDateValid = false;
                }
                if(birthDateValid == false) {            
                    birthDateError.innerText = 'Data non valida!';
                    birthDateError.classList.add("red-text");
                } else {
                    birthDateError.innerText = '';
                    birthDateError.classList.remove("red-text");
                }

                return birthDateValid;
            }

            function isExpiryDateValid() {

                let expiryDateValid = true;

                const expiryDateError = document.getElementById('expirydate-error');

                let userInputExpiryDay = document.getElementById('expiry-day').value;

                let userInputExpiryMonth = document.getElementById('expiry-month').value;

                let userInputExpiryYear = document.getElementById('expiry-year').value;

                userDate = userInputExpiryYear + '/' + userInputExpiryMonth + '/' + userInputExpiryDay;
                
                dateToCheck = new Date(userDate)

                if((dateToCheck.getMonth()+1!=userInputExpiryMonth)||
                    (dateToCheck.getDate()!=userInputExpiryDay)||
                    (dateToCheck.getFullYear()!=userInputExpiryYear)) 
                {
                    expiryDateValid = false;
                }
                if(expiryDateValid == false) {            
                    expiryDateError.innerHTML = 'Data non valida!';
                    expiryDateError.classList.add("red-text");
                } else {
                    expiryDateError.innerHTML = '';
                    expiryDateError.classList.remove("red-text");
                }

                return expiryDateValid;
            }
        </script>      
    </body>
</html>