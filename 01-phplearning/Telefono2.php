<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <title>Telefono</title>
    <link rel="stylesheet" href="Stylephone2.css"> 
</head>
<body>
    <div class="container">
        <input type="text" id="input-number" readonly value="">
        <div id="status"></div>
        <div>
            <button id="del-button" onclick="delNum()"></button>
        </div>
        <table>
            <tr>
                <td><button class="number" onclick="buttonClicked('1')"><span>1</span><br><span class="letters"></span></button></td>
                <td><button class="number" onclick="buttonClicked('2')"><span>2</span><br><span class="letters">ABC</span></button></td>
                <td><button class="number" onclick="buttonClicked('3')"><span>3</span><br><span class="letters">DEF</span></button></td>
            </tr>
            <tr>
                <td><button class="number" onclick="buttonClicked('4')"><span>4</span><br><span class="letters">GHI</span></button></td>
                <td><button class="number" onclick="buttonClicked('5')"><span>5</span><br><span class="letters">JKL</span></button></td>
                <td><button class="number" onclick="buttonClicked('6')"><span>6</span><br><span class="letters">MNO</span></button></td>
            </tr>
            <tr>
                <td><button class="number" onclick="buttonClicked('7')"><span>7</span><br><span class="letters">PQRS</span></button></td>
                <td><button class="number" onclick="buttonClicked('8')"><span>8</span><br><span class="letters">TUV</span></button></td>
                <td><button class="number" onclick="buttonClicked('9')"><span>9</span><br><span class="letters">WXYZ</span></button></td>
            </tr>
            <tr>
                <td><button class="number" onclick="buttonClicked('*')"><span>*</span><br><span class="letters"></span></button></td>
                <td><button class="number" onclick="buttonClicked('0')"><span>0</span><br><span class="letters"></span></button></td>
                <td><button class="number" onclick="buttonClicked('#')"><span>#</span><br><span class="letters"></span></button></td>
            </tr>
        </table>
        <div class="call-controls">
            <button id="pick-up-call-button" onclick="startPhoneCall()" disabled></button>
            <button id="hang-up-call-button" onclick="hangUp()" hidden disabled></button>
        </div>
    </div>
    <?php
        $statusText = '';
        $phoneNumber = trim($_POST['phone-number'] ?? '');
        $showHangup = false;

        if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($phoneNumber)) {
            
            if (strlen($clean) === 10) {
                $statusText = 'STA SQUILLANDO';
                $showHangup = true;           
            } else {
                $statusText = 'NUMERO INESISTENTE';
                $showHangup = false;
            }
        }
        ?>

    <script>
        const inputNumber = document.getElementById('input-number');
        const pickupButton = document.getElementById('pick-up-call-button');
        const hangupButton = document.getElementById('hang-up-call-button');
        const status = document.getElementById('status');

        function updatePickupState() {
            pickupButton.disabled = (inputNumber.value.length === 0);
        }

        function buttonClicked(buttonValue) {
            inputNumber.value += buttonValue;

            if (inputNumber.value.length < 3) {
                pickupButton.disabled = true;
            } else {
                pickupButton.disabled = false;
            }
        }

        function delNum() {
            inputNumber.value = inputNumber.value.slice(0, -1);

            if (inputNumber.value.length < 3) {
                pickupButton.disabled = true;
            } else {
                pickupButton.disabled = false;
            }

            status.innerText = '';
        }

        function startPhoneCall() {
            const num = inputNumber.value;

            if (num.length === 10) {
                status.innerText = 'STA SQUILLANDO';
                hangupButton.hidden = false;
                hangupButton.disabled = false;
                pickupButton.hidden = true;
                pickupButton.disabled = true;
            } else {
                status.innerText = 'NUMERO INESISTENTE';
            }
        }

        function hangUp() {
            status.innerText = '';
            inputNumber.value = '';
            hangupButton.hidden = true;
            hangupButton.disabled = true;
            pickupButton.hidden = false;
            pickupButton.disabled = true;
        }
    </script>
</body>
</html>