<?php 
require_once 'phone.php';
?>
<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Telefono</title>
    <link rel="stylesheet" href="StylePhone1.css">
 
</head>
    <body>
    <div class="outer-frame">
        <div class="container">
            <form method="POST" action="">
                <input type="text" 
                    name="phone" 
                    id="phoneNumber-input" 
                    readonly 
                    value="<?= $inputValue ?>">

                <div class="status <?= $statusClass ?>" id="status">
                    <?= $statusText ?>
                </div>

                <div class="function-box">
                    <button type="button" class="left-btn" onclick="addPlus()"></button>
                    <button type="button" class="right-btn" onclick="delNum()"></button>
                </div>

                <div class="keypad">
                    <div class="key-row">
                        <button type="button" class="number" onclick="addNum('1')">1</button>
                        <button type="button" class="number" onclick="addNum('2')">2</button>
                        <button type="button" class="number" onclick="addNum('3')">3</button>
                    </div>
                    <div class="key-row">
                        <button type="button" class="number" onclick="addNum('4')">4</button>
                        <button type="button" class="number" onclick="addNum('5')">5</button>
                        <button type="button" class="number" onclick="addNum('6')">6</button>
                    </div>
                    <div class="key-row">
                        <button type="button" class="number" onclick="addNum('7')">7</button>
                        <button type="button" class="number" onclick="addNum('8')">8</button>
                        <button type="button" class="number" onclick="addNum('9')">9</button>
                    </div>
                    <div class="key-row">
                        <button type="button" class="number" onclick="addNum('*')">*</button>
                        <button type="button" class="number" onclick="addNum('0')">0</button>
                        <button type="button" class="number" onclick="addNum('#')">#</button>
                    </div>
                </div>

                <div style="text-align: center; margin-top: 25px;">
                    <button type="submit" id="btnCall"class="call-btn" <?= $callDisabled ?>></button>
                    <?php if ($showHangup): ?>
                        <button type="submit" name="hangup" value="1" id="btnHangup" class="hangup-btn">
                        </button>
                    <?php endif; ?>
                </div>
            </form>
        </div>
    </div>
        <script>
            const input = document.getElementById('phoneNumber-input');
            const status = document.getElementById('status');
            const btnCall = document.getElementById('btnCall');
            const btnHangup = document.getElementById('btnHangup');

            function updateButtons() {
                const digits = input.value;
                btnCall.disabled = digits.length < 3 && digits.length > 13; 
            }

            function addNum(n) {
                input.value += n;
                updateButtons();
            }

            function delNum() {
                input.value = input.value.slice(0, -1);
                updateButtons();
            }

            function addPlus() {
                if (!input.value.startsWith('+')) {
                    input.value = '+' + input.value;
                }
                updateButtons();
            }

            function makeCall() {
                const digits = input.value;
                if (digits.length !== 10) {
                    status.innerText = 'NON ESISTENTE';
                    status.className = 'error';
                } else {
                    status.innerText = 'STA SQUILLANDO';
                    status.className = 'ok';
                    btnCall.disabled = true;
                    btnHangup.disabled = false;
                }
            }

            function hangUp() {
                //input.value = ;
                status.innerText = '';
                status.className = 'status';
                btnCall.disabled = true; // Disabled until digits
                btnHangup.disabled = true;
                updateButtons();
            }

            //
            updateButtons();
        </script>
    </body>
</html>