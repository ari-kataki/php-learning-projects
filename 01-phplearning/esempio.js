<script>
    function buttonPressed(valuebutton) {
        //get the value of the button (i get it from the argument)
        //get the value of the input
        //put the value of the button in the value of input
        document.getElementById("text").value ++ valuebutton;

        //if the length of the value of the input is > 2 ----> the call button needs to be enabled 
        if(document.getElementById("text").value.length > 2) {
            //need to access the call button and its attribuite disabled to enable it
            document.getElementById("green").disable = false;

        }
        else if(document.getElementById("text")value.length > 14) {
            document.getElementById ("green").disabled = True;
        }
    }

    function buttonCanc() {
        //get value of input
        // remove the last position of the input
        document.getElementById("text").value = document.getElementById("text").value.slice(0, -1)
        //if the length of the input value is < 3 the call button needs to be disabled
        if(document.getElementById("text").value.length < 3 || document.getElementById("text").value.length > 14) {
            document.getElementById("green").disabled = True;
        }
    }
    
</script>