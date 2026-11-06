<html>
<head>
	<meta name='viewport' content='width=device-width, initial-scale=1' />
</head>
<style>
	.div-outer-border{
		text-align: center;
	}
	.div-outer-border{
			border-radius: 50px;
			border: 5px solid gray;
	}
	.div-inner-border{
			border: 10px solid black;
			border-radius: 45px;
	}
	.output-screen{
		border: none;
		margin-top: 5%;
		width: 90%;
		height: 10%;
		text-align: center;
		font-size: 150%;
	}
	.div-input-button{
		margin-top: 10%;
	}
	.button-phone, .button-phone-call, .button-phone-stop-call{
	margin: 2%;
	border-radius: 50%;
	width: 20%;
	height: 9%;
	vertical-align: middle;
	background: white;
	}
	.div-button-add, .div-button-delete{
		display: inline-block;
		box-sizing: border-box;
	}
	.div-button-add{
		padding-right: 60%;
	}
	
	.button-add, .button-delete{
		width: 100%;
		height: 3%;
	}
	.button-phone-call{
		margin: 10%;
		background: green;
	}
	.button-phone-stop-call{
		margin: 10%;
		background: red;
		
	}
	.button-asterisk, .button-hash{
		font-size: 300%;
	
	}

</style>
<body>
	<form method = 'post'>
		<div class = 'div-outer-border'>
			<div class = 'div-inner-border'>
				<div class = 'div-output-screen'>
					<input type = 'text' class = 'output-screen' id = 'id-output-screen' name = 'name-output-screen'
					value = "<?php
						if(array_key_exists('name-output-screen', $_POST)){
							$flagCall = False; #senza variabile appoggio flagCall, non si gestisce bene il bottone di chiamata e i testi non vengono eliminati nel modo giusto
							$outputMessage = '';
							$phoneString = $_POST['name-output-screen']; #questo variabile può essere considerato un vettore di caratteri stranamente e sotto ho usato il primo carattere la condizione riga 74
							if(strlen($phoneString) != 0){ #verifica lunghezza != 0, per evitare messaggio 'NUMERO INESISTENTE' quando viene conclusa la chiamata
								if($_POST['name-button-call'] == 'EnableCall' && strlen($phoneString) == 10 && $phoneString[0] == 3){ #controllo se numero valido e usato phoneString come vettore in questa riga!
									$outputMessage = 'STA SQUILLANDO';
									$flagCall = True;
									echo $phoneString;
								}
								else{
									if($_POST['name-button-call'] == 'EnableCall'){ #"NUMERO INESISTENTE" appare solo quando è stato premuto bottone verde
										echo $phoneString;
										$outputMessage = 'NUMERO INESISTENTE';
									}
								}
								
							}
						}
						?>"
					>
					<div></div>
					<?php echo $outputMessage; ?>
				</div>
				<div class = 'div-add-delete'>
					<div class = 'div-button-add'>
						<button type = 'button' class = 'button-add'>
						+
						</button>
					</div><!--
				 --><div class = 'div-button-delete'>
						<button type = 'button' class = 'button-delete' onclick = "removeDigit()">
						X
						</button>
					</div>
				</div>
				<div class = 'div-input-button'>
					<div class = 'div-input-row1'>
						<button type = 'button' class = 'button-phone' onclick = 'writeNumber("1")'> 
							1
							<div>
							o_o
							<div>
						</button>
						<button type = 'button' class = 'button-phone' onclick = 'writeNumber("2")'> 
							2
							<div>
							ABC
							</div>
						</button>
						<button type = 'button' class = 'button-phone' onclick = 'writeNumber("3")'> 
							3
							<div>
							DEF
							</div>
						</button>
					</div>
					<div class = 'div-input-row2'>
						<button type = 'button' class = 'button-phone' onclick = 'writeNumber("4")'> 
							4
							<div>
							GHI
							</div>
						</button>
						<button type = 'button' class = 'button-phone' onclick = 'writeNumber("5")'> 
							5
							<div>
							JKL
							</div>
						</button>
						<button type = 'button' class = 'button-phone' onclick = 'writeNumber("6")'> 
							6
							<div>
							MNO
							</div>
						</button>
					</div>
					<div class = 'div-input-row3'>
						<button type = 'button' class = 'button-phone' onclick = 'writeNumber("7")'> 
							7
							<div>
							PQRS
							</div>
						</button>
						<button type = 'button' class = 'button-phone' onclick = 'writeNumber("8")'> 
							8
							<div>
							TUV
							</div>
						</button>
						<button type = 'button' class = 'button-phone' onclick = 'writeNumber("9")'> 
							9
							<div>
							WXYZ
							</div>
						</button>
					</div>
					<div class = 'div-input-row4'>
						<button type = 'button' class = 'button-phone button-asterisk' onclick = 'writeNumber("*")'> 
							<div>
							*
							</div>
						</button>
						<button type = 'button' class = 'button-phone' onclick = 'writeNumber("0")'>
							0
							<div>
							+
							</div>
						</button>
						<button type = 'button' class = 'button-phone button-hash' onclick = 'writeNumber("#")'>
							<div>
							#
							</div>
						</button>
					</div>
				</div>
				<div class = 'div-call-button'>
				<?php
				if(array_key_exists('name-button-call', $_POST)){
					$hideCallButton1 = '';
					$hideCallButton2 = '';
					$htmlStopCallButton = '';
					
					if($_POST['name-button-call'] == 'EnableCall' && $flagCall == True){ #bottone rosso deve apparire solo se il numero chiamato è valido(flagCall == True) altrimenti rimane verde
						$hideCallButton1 = '<!--'; #hideCallButton 1 e 2 servono per nascondere bottone verde iniziale mediante sintassi commento di html
						$hideCallButton2 = '-->';
						$htmlStopCallButton = "<button type = 'submit' class = 'button-phone-stop-call' name = 'name-button-call' value = 'DisableCall'></button>";
						echo $hideCallButton1; #echo tag apertura commento html
					}
				}	
				
				?>
					<button type = 'submit' class = 'button-phone-call' id = 'id-button-call' name = 'name-button-call' disabled value = 'EnableCall'></button>
				<?php echo $hideCallButton2; ?> <!-- echo tag chiusura html --> 
				<?php echo $htmlStopCallButton; ?>
				</div>
			</div>
		</div>
	</form>
<script>
	function writeNumber(buttonInput){
		let output = document.getElementById('id-output-screen');
		output.value += buttonInput;
		if(output.value.length > 0){ <!-- se campo di testo ha almento un numero, viene abilitato il bottone call
			document.getElementById('id-button-call').disabled = false;
			
		}
	}
	function removeDigit(){
		let output = document.getElementById('id-output-screen');
		let currentOutput = output.value;
		let newOutput = currentOutput.slice(0, -1);
		output.value = newOutput;
		if(output.value.length == 0){ <!-- se utente cancella tutte le cifre, bottone call viene disabilitato
			document.getElementById('id-button-call').disabled = true;
		}
	}
	
</script>
</body>
</html>