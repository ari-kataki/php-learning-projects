let currentNumber = '';
const numberDisplay = document.getElementById('numberDisplay');


function handleImageError() {

    const img = document.getElementById('televideoImage');
    const contentArea = document.getElementById('contentArea');
    
    if (img) {
        img.style.display = 'none';
    }
    
    if (!document.getElementById('testCard')) {
        const testCard = document.createElement('div');
        testCard.id = 'testCard';
        testCard.className = 'test-card';
        testCard.innerHTML = `
            <div class="color-bar" style="background: #c0c0c0;"></div>
            <div class="color-bar" style="background: #ffff00;"></div>
            <div class="color-bar" style="background: #00ffff;"></div>
            <div class="color-bar" style="background: #00ff00;"></div>
            <div class="color-bar" style="background: #ff00ff;"></div>
            <div class="color-bar" style="background: #ff0000;"></div>
            <div class="color-bar" style="background: #0000ff;"></div>
            
            <div class="color-bar-bottom" style="background: #0000ff;"></div>
            <div class="color-bar-bottom" style="background: #000000;"></div>
            <div class="color-bar-bottom" style="background: #ff00ff;"></div>
            <div class="color-bar-bottom" style="background: #000000;"></div>
            <div class="color-bar-bottom" style="background: #00ffff;"></div>
            <div class="color-bar-bottom" style="background: #000000;"></div>
            <div class="color-bar-bottom" style="background: #ffffff;"></div>
            
            <div class="color-bar-bottom2" style="background: #001a4d;"></div>
            <div class="color-bar-bottom2" style="background: #ffffff;"></div>
            <div class="color-bar-bottom2" style="background: #330066;"></div>
            <div class="color-bar-bottom2" style="background: #000000;"></div>
            <div class="color-bar-bottom2" style="background: #0d0d0d;"></div>
            <div class="color-bar-bottom2" style="background: #1a1a1a;"></div>
            <div class="color-bar-bottom2" style="background: #000000;"></div>
        `;
        contentArea.appendChild(testCard);
    }
}


function pressNumber(digit) {
    
    if (currentNumber.length < 3) {
        currentNumber += digit;
        numberDisplay.textContent = currentNumber;
    }
}


function clearNumber() {
    currentNumber = '';
    numberDisplay.textContent = '';
}


function goToPage() {
    if (currentNumber === '') return;
    
    const pageNumber = parseInt(currentNumber);
    window.location.href = 'televideo.php?page=' + pageNumber;
}


function pressOK() {
    goToPage();
}


function channelUp() {
    let nextPage = CURRENT_PAGE + 1;
    
    
    if (nextPage > 800) {
        nextPage = 100;
    }
    
    window.location.href = 'televideo.php?page=' + nextPage;
}


function channelDown() {
    let prevPage = CURRENT_PAGE - 1;
    
    
    if (prevPage < 100) {
        prevPage = 800;
    }
    
    window.location.href = 'televideo.php?page=' + prevPage;
}


function togglePower() {
    window.location.href = 'televideo.php?page=off';
}


function switchSource() {
    if (IS_VALID_PAGE) {
       
        window.location.href = 'televideo.php?page=1';
    } else {
        
        window.location.href = 'televideo.php?page=100';
    }
}
