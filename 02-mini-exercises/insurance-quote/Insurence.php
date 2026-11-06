<?php
require_once 'Functions_php.php';

$age = '';

$typeVechicle = '';

$yearsLicense = '';

$previousClaims = false;

$errors = [];

$result = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    $age = $_POST['age'] ?? '';
    
    $typeVechicle = $_POST['type-vechicle'] ?? '';
    
    $yearsLicense = $_POST['years-licensed'] ?? '';
    
    $previousClaims = array_key_exists('previous-claims', $_POST);

    $errors = validateForm($age, $yearsLicense);

    if (count($errors) === 0) {
        
        $age = (int) $age;
        
        $yearsLicense = (int) $yearsLicense;

        $basicPremium = calculateBasicPremium($typeVechicle);
        
        $surcharges = calculateSurcharges($age, $yearsLicense, $previousClaims, $basicPremium);

        $totalSurcharges = 0;
        
        foreach ($surcharges as $amount) {
        
            $totalSurcharges += $amount;
        
        }

        $totalFinal = $basicPremium + $totalSurcharges;

        $result = [
        
            'basicPremium' => $basicPremium,
        
            'surcharges' => $surcharges,
        
            'totalSurcharges' => $totalSurcharges,
        
            'totalFinal' => $totalFinal
        ];
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>insurance quote</title>
    <link rel="stylesheet" href="Insurence.css">
</head>
<body>
    <div class="card">
    <div class="title">Insurance Quote</div>

        <form method="post" action="" onsubmit="return validateFormJS()">

            <div class="field">
                <label for="age">Age</label>
                <input
                    class="input-age" 
                    type="text"
                    id="age"
                    name="age" 
                    placeholder="E.g. 32"
                    style="<?php
                        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                            if ($age === '' || (int)$age < 18) {
                                echo 'border: 2px solid red;';
                            }
                        }
                    ?>"
                    value="<?php
                        if (array_key_exists('age', $_POST)) {
                            echo $_POST['age'];
                        }
                    ?>"
                />
                <span class="error-message" id="error-age"></span>
            </div>

            <div class="field">
                <label for="type-vechicle">Type of Vehicle</label>
                <select name="type-vechicle" id="type-vechicle">
                    <?php
                        $vehicleOptions = ['Auto', 'Moto'];
                        foreach ($vehicleOptions as $v) {
                            $selected = '';
                            if ($v === $typeVechicle) {
                                $selected = 'selected=selected';
                            }
                            echo '<option value="' . $v . '" ' . $selected . '>' . $v . '</option>';
                        }
                    ?>
                </select>
            </div>

            <div class="field">
                <label for="years-licensed">Years licensed</label>
                <input
                    class="years-licensed" 
                    type="text"
                    id="years-licensed" 
                    name="years-licensed" 
                    placeholder="E.g. 10"
                    style="<?php
                        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                            if ($yearsLicense === '' || (int)$yearsLicense <= 0) {
                                echo 'border: 2px solid red;';
                            }
                        }
                    ?>"
                    value="<?php
                        if (array_key_exists('years-licensed', $_POST)) {
                            echo $_POST['years-licensed'];
                        }
                    ?>"
                />
                <span class="error-message" id="error-years-licensed"></span>
            </div> 

            <div class="field field-checkbox">
                <input
                    type="checkbox"
                    id="previous-claims" 
                    name="previous-claims" 
                    <?php
                        if ($previousClaims) {
                            echo 'checked';
                        }
                    ?>
                />
                <label for="previous-claims">Previous Claims</label>
            </div>

            <button type="submit" class="btn-calculate">Calculate Quote</button>
        
        </form>

        <?php if (count($errors) > 0): ?>
            <div class="error-summary">
                <?php foreach ($errors as $error): ?>
                    <p style="color: red;"><?php echo $error; ?></p>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>

        <?php if ($result !== null): ?>
            <div class="result">
                <h3>Quote Result:</h3>

                <div class="result-item">
                    <span>Basic Premium (<?php echo $typeVechicle; ?>)</span>
                    <span><?php echo $result['basicPremium']; ?> €</span>
                </div>

                <?php if (count($result['surcharges']) > 0): ?>
                    <h3>Surcharges:</h3>
                    <?php foreach ($result['surcharges'] as $label => $amount): ?>
                        <div class="result-increment">
                            <span><?php echo $label; ?></span>
                            <span><?php echo $amount; ?> €</span>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <div class="no-surcharges">
                        <span>No surcharges applied.</span>
                    </div>
                <?php endif; ?>

                <div class="result-total">
                    <span>Final Quote</span>
                    <span><?php echo $result['totalFinal']; ?> €</span>
                </div>
            </div>
        <?php endif; ?>

    </div>

    <script src="Insurence.js"></script>
</body>
</html>