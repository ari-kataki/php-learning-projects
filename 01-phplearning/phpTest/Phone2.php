<?php
	$showResult = false;
	$HasNumberError = false;
	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		$showResult = true;
	   if (strlen($_POST['phone-Number']) !== 10 ){
			$HasNumberError = true;
	   } else {
			$HasNumberError = false;
	   }
	}
?>
<html>
	<head>
	</head>
	<body>
		<form method="POST">
			<div style ="width: 300px; border: 5px solid black; border-radius: 40px">
				<div style=" height: 100px">
					<input type="text" name="phone-Number" id="phoneNumber-input" style="width: 99.9%; height: 100%; border-radius: 40px;  font-size: 40px; text-align: center" readonly value="<?php
						if ($_SERVER['REQUEST_METHOD'] === 'POST'){
							echo $_POST['phone-Number'];
						}
					?>">
				</div>
				<div style=" text-align: center">
					<?php if ($HasNumberError == false){
						echo 'STA SQUILLANDO';
					} else {
						echo 'NON ESISTENTE';
					}
				?>
				</div>
				<div style="text-align: right">
					<button type="button" onclick="delNum()" id="delPhoneNumber-input" style="background-size: contain; font-size: 50px; width: 50px; height: 50px; border-radius: 50%; background-image: url(https://www.svgrepo.com/show/476605/left-arrow.svg)"></button>
				</div>
				<div style=" text-align: center ">
					<button type="button" onclick="addNum(1)" id="button-1" style="margin: 10px; padding: 10px; font-size: 40px; width: 65px; border-radius: 50%">1</button>
					<button type="button" onclick="addNum(2)" id="button-2" style="margin: 10px; padding: 10px; font-size: 40px; width: 65px; border-radius: 50%">2</button>
					<button type="button" onclick="addNum(3)" id="button-3" style="margin: 10px; padding: 10px; font-size: 40px; width: 65px; border-radius: 50%">3</button>
				</div>
				<div style=" text-align: center ">
					<button type="button" onclick="addNum(4)" id="button-4" style="margin: 10px; padding: 10px; font-size: 40px; width: 65px; border-radius: 50%">4</button>
					<button type="button" onclick="addNum(5)" id="button-5" style="margin: 10px; padding: 10px; font-size: 40px; width: 65px; border-radius: 50%">5</button>
					<button type="button" onclick="addNum(6)" id="button-6" style="margin: 10px; padding: 10px; font-size: 40px; width: 65px; border-radius: 50%">6</button>
				</div>
				<div style=" text-align: center ">
					<button type="button" onclick="addNum(7)" id="button-7" style="margin: 10px; padding: 10px; font-size: 40px; width: 65px; border-radius: 50%">7</button>
					<button type="button" onclick="addNum(8)" id="button-8" style="margin: 10px; padding: 10px; font-size: 40px; width: 65px; border-radius: 50%">8</button>
					<button type="button" onclick="addNum(9)" id="button-9" style="margin: 10px; padding: 10px; font-size: 40px; width: 65px; border-radius: 50%">9</button>
				</div>
				<div style=" text-align: center ">
					<button type="button" onclick="addNum('*')" id="button-*" style="margin: 10px; padding: 10px; font-size: 40px; width: 65px; border-radius: 50%">*</button>
					<button type="button" onclick="addNum(0)" id="button-0" style="margin: 10px; padding: 10px; font-size: 40px; width: 65px; border-radius: 50%">0</button>
					<button type="button" onclick="addNum('#')" id="button-#" style="margin: 10px; padding: 10px; font-size: 40px; width: 65px; border-radius: 50%">#</button>
				</div>
				<div style="text-align: center">
					<button type="submit" name="chiama" id="chiama" style="background-size: contain; width: 70px; height: 70px; border-radius: 50%; background-image: url(https://www.svgrepo.com/show/258860/phone-call-telephone.svg)"></button>
				</div>
			</div>
		</form>
<script>
function addNum(Number){
    document.getElementById('phoneNumber-input').value += Number;
    // Optional: you can add live length feedback here later if you want
}

function delNum() {
    const input = document.getElementById('phoneNumber-input');
    input.value = input.value.slice(0, -1);
    
    const bSubmit = document.getElementById('chiama');
    // Fixed typo: lenght → length
    if (input.value.length === 0) {
        bSubmit.disabled = true;
    } else {
        bSubmit.disabled = false;   // ← important: re-enable when there's text
    }
}

// Optional: enable/disable call button on page load too
window.onload = function() {
    const input = document.getElementById('phoneNumber-input');
    const bSubmit = document.getElementById('chiama');
    if (input.value.length === 0) {
        bSubmit.disabled = true;
    }
}
</script>  
	</body>
</html>