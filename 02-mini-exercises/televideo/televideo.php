<?php
require_once 'televideo_functions.php';

$page = getPageNumber();
$isValidPage = isValidPage($page);
$televideoImageUrl = getTelevideoImageUrl($page);
?>
<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TelevideoRAI-Pagina <?php echo $page; ?></title>
    <link rel="stylesheet" href="televideo.css">
</head>
<body>
    <div class="container">
        <!-- TV -->
        <div class="tv-outer">
            <div class="tv-bezel">
                <div class="tv-screen">
                    <!-- Numbers -->
                    <div class="number-display" id="numberDisplay"></div>
                    
                    <!-- Content-->
                    <div class="content-area" id="contentArea">
                        <?php if ($isValidPage): ?>
                            <!-- valid pages -->
                            <img id="televideoImage" 
                                 src="<?php echo $televideoImageUrl; ?>" 
                                 alt="Televideo pagina <?php echo $page; ?>"
                                 onerror="handleImageError();">
                        <?php else: ?>
                            <!-- Test Card -->
                            <div class="test-card" id="testCard">
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
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="tv-stand"></div>
            </div>
        </div>

        <!-- Remote Control -->
        <div class="remote">
            <div class="remote-top">
                <button class="btn-small" onclick="switchSource()">1-2</button>
                <button class="btn-power" onclick="togglePower()">⏻</button>
            </div>

            <div class="remote-row">
                <button class="btn-round" onclick="pressOK()">OK</button>
                <button class="btn-round">AV</button>
            </div>

            <div class="remote-row">
                <button class="btn-vol">+</button>
                <button class="btn-ch" onclick="channelUp()">up</button>
            </div>
            <div class="remote-label">
                <span>Volume</span>
                <span>Channel</span>
            </div>

            <div class="remote-row">
                <button class="btn-vol">-</button>
                <button class="btn-ch" onclick="channelDown()">down</button>
            </div>

            <!-- Number Pad -->
            <div class="number-pad">
                <button class="btn-num" onclick="pressNumber('1')">1</button>
                <button class="btn-num" onclick="pressNumber('2')">2</button>
                <button class="btn-num" onclick="pressNumber('3')">3</button>
                
                <button class="btn-num" onclick="pressNumber('4')">4</button>
                <button class="btn-num" onclick="pressNumber('5')">5</button>
                <button class="btn-num" onclick="pressNumber('6')">6</button>
                
                <button class="btn-num" onclick="pressNumber('7')">7</button>
                <button class="btn-num" onclick="pressNumber('8')">8</button>
                <button class="btn-num" onclick="pressNumber('9')">9</button>
                
                <button class="btn-num" onclick="clearNumber()">⌫</button>
                <button class="btn-num" onclick="pressNumber('0')">0</button>
                <button class="btn-num" onclick="goToPage()">Send</button>
            </div>

            <div class="remote-brand">geemarc</div>
        </div>
    </div>

    <script>
        const CURRENT_PAGE = <?php echo $page; ?>;
        const IS_VALID_PAGE = <?php echo $isValidPage ? 'true' : 'false'; ?>;
    </script>
    
    <script src="televideo_script.js"></script>
</body>
</html>
