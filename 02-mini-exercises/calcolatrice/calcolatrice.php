<?php
$input = $_POST['numberZone'] ?? '';
$result = 'NaN';
$valid = false;
$operators = ['+', '-', '*', '/'];
$cleanInput = trim($input);
$isValidFormat = true;
if ($cleanInput === '') {
    $isValidFormat = false;
}
$operationIndex = -1;

for ($i = 1; $i < strlen($cleanInput); $i++) {
    if (in_array($cleanInput[$i], $operators)) {
        $operationIndex = $i;
        break;
    }
}
if ($operationIndex !== -1) {
    $firstPart = substr($cleanInput, 0, $operationIndex);
    if (!is_numeric($firstPart)) {
        $isValidFormat = false;
    } else {
        $currentResult = (float)$firstPart;
        $remainingInput = substr($cleanInput, $operationIndex);

        while ($remainingInput !== "" && $isValidFormat) {
            $op = $remainingInput[0];
            $nextOpIndex = -1;
            
            for ($i = 1; $i < strlen($remainingInput); $i++) {
                if (in_array($remainingInput[$i], $operators)) {
                    $nextOpIndex = $i;
                    break;
                }
            }
            if ($nextOpIndex !== -1) {
                $secondNumberStr = substr($remainingInput, 1, $nextOpIndex - 1);
                $remainingInput = substr($remainingInput, $nextOpIndex);
            } else {
                $secondNumberStr = substr($remainingInput, 1);
                $remainingInput = "";
            }
            if (is_numeric($secondNumberStr) && $secondNumberStr !== '') {
                $secondNumber = (float)$secondNumberStr;
                switch ($op) {
                    case '+': $currentResult += $secondNumber; break;
                    case '-': $currentResult -= $secondNumber; break;
                    case '*': $currentResult *= $secondNumber; break;
                    case '/': 
                        if ($secondNumber != 0) {
                            $currentResult /= $secondNumber;
                        } else {
                            $isValidFormat = false;
                        }
                        break;
                }
            } else {
                $isValidFormat = false;
            }
        }
    }
    
    
    if ($isValidFormat) {
        $result = $currentResult;
        $valid = true;
    }

} else if (is_numeric($cleanInput)) {
    
    $result = $cleanInput;
    $valid = true;
} else {
   
    $valid = false;
    $result = "NaN";
}
?>
<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="style.css">
        <script src="gestion.js"></script>
    </head>
    <body>
        <form action="" method="POST">
            <div class="calcolatriceContainer">
                <div class="numberZone">
                    <input type="text" value="<?php echo $valid ? $result :'NaN'; ?>" class="inputZone" id="inputZone" name="numberZone">
                </div>
                <div class="numbersOperations">
                    <div class="horizontalLines">
                        <button type="button" class="butt" onclick="addToInput('7')">7</button>
                        <button type="button" class="butt" onclick="addToInput('8')">8</button>
                        <button type="button" class="butt" onclick="addToInput('9')">9</button>
                        <button type="button" class="butt" onclick="deleteLastChar()">DEL</button>
                    </div>
                    <div class="horizontalLines">
                        <button type="button" class="butt" onclick="addToInput('4')">4</button>
                        <button type="button" class="butt" onclick="addToInput('5')">5</button>
                        <button type="button" class="butt" onclick="addToInput('6')">6</button>
                        <button type="button" class="butt" onclick="addToInput('+')">+</button>
                    </div>
                    <div class="horizontalLines">
                        <button type="button" class="butt" onclick="addToInput('1')">1</button>
                        <button type="button" class="butt" onclick="addToInput('2')">2</button>
                        <button type="button" class="butt" onclick="addToInput('3')">3</button>
                        <button type="button" class="butt" onclick="addToInput('-')">-</button>
                    </div>
                    <div class="horizontalLines">
                        <button type="button" class="butt" onclick="addToInput('.')">.</button>
                        <button type="button" class="butt" onclick="addToInput('0')">0</button>
                        <button type="button" class="butt" onclick="addToInput('/')">/</button>
                        <button type="button" class="butt" onclick="addToInput('*')">*</button>
                    </div>
                    <div class="horizontalLines">
                        <button type="button" class="buttReset" onclick="resetInput()">RESET</button>
                        <button type="submit" class="buttEgale">=</button>
                    </div>
                </div>
            </div>     
        </form> 
    </body>
</html>