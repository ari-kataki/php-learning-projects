<?php

    $showMessage   = $_SERVER["REQUEST_METHOD"] === "POST";
    $hasError      = $showMessage && strlen(trim($_POST["number"] ?? "")) !== 10;
    $displayNumber = $showMessage ? ($_POST["number"] ?? "") : "";
    $message       = $showMessage ? ($hasError ? "NON ESISTENTE" : "STA SQUILLANDO") : "";
?>

<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Telefono</title>
    <link rel="stylesheet" href="StylePhone2.css">

</head>
<body>

<div class="outer-frame">
    <div class="container">
        <form id="phoneForm">
            <input type="text" id="phoneNumber-input" readonly>

            <div class="status" id="status"></div>
                <div style="text-align: right; justify-content: space-between; align-items: center;
                 padding: 0 10px; margin: 10px 0;">
    <!-- left -->
                    <button type="button" onclick="addPlus()"
                        style="width:50px; height:50px; border-radius:50%; font-size:0; 
                        cursor: pointer; center/contain no-repeat; border:none;">
                    </button>
    <!-- right -->
                    <button type="button" onclick="delNum()"
                        style="width:50px; height:50px; border-radius:50%; font-size:0; 
                        cursor: pointer; center/contain no-repeat; border:none;">
                    </button>
            </div>

            <div style="text-align: center;">
                <button type="button" class="number" onclick="addNum('1')">1</button>
                <button type="button" class="number" onclick="addNum('2')">2</button>
                <button type="button" class="number" onclick="addNum('3')">3</button>
            </div>
            <div style="text-align: center;">
                <button type="button" class="number" onclick="addNum('4')">4</button>
                <button type="button" class="number" onclick="addNum('5')">5</button>
                <button type="button" class="number" onclick="addNum('6')">6</button>
            </div>
            <div style="text-align: center;">
                <button type="button" class="number" onclick="addNum('7')">7</button>
                <button type="button" class="number" onclick="addNum('8')">8</button>
                <button type="button" class="number" onclick="addNum('9')">9</button>
            </div>
            <div style="text-align: center;">
                <button type="button" class="number" onclick="addNum('*')">*</button>
                <button type="button" class="number" onclick="addNum('0')">0</button>
                <button type="button" class="number" onclick="addNum('#')">#</button>
            </div>

            <div style="text-align: center; margin-top: 20px;">
                <button type="submit" id="chiama"
                    style="width:70px; height:70px; border-radius:50%;">
                </button>
            </div>
        </form>
    </div>
</div>
        <script>
            const input = document.getElementById('phoneNumber-input');
            const status = document.getElementById('status');
            const chiama = document.getElementById('chiama');

            function updateButtonState() {
                chiama.disabled = input.value.length === 0;
            }

            function addNum(n) {
                input.value += n;
                status.textContent = '';     // clear when typing
                updateButtonState();
            }

            function delNum() {
                input.value = input.value.slice(0, -1);
                status.textContent = '';    // clear when deleting
                updateButtonState();
            }
            function addPlus() {
                const input = document.getElementById('phoneNumber-input');
                input.value += '+';
                status.textContent = '';         
                updateButtonState();
            }

            function handleCall(e) {
                e.preventDefault();
                const num = input.value.trim();
            if (num.length !== 10) {
                status.textContent = 'NON ESISTENTE';
                status.classList.add('error');
            } 
                else {
                    status.textContent = 'STA SQUILLANDO';
                    status.classList.remove('error');
                    // setTimeout(() => { status.textContent = ''; }, 3000);
                }
            }

            // Events
                document.getElementById('phoneForm').addEventListener('submit', handleCall);
                    chiama.disabled = true;  // initial state
                        input.addEventListener('keydown', e => {
                        if (e.key === 'Backspace') {
                            delNum();
                            e.preventDefault();
                        } else if (/[0-9*#]/.test(e.key)) {
                            addNum(e.key);
                            e.preventDefault();
                        }
                    });
        </script>
    </body>
</html>