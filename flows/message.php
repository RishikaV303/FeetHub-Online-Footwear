<?php 
if (isset($_SESSION['message'])):
    $msg = htmlspecialchars($_SESSION['message']);
?>
    <div id="customAlert">
        <p><?= $msg; ?></p>
        <span class="close-btn" onclick="this.parentElement.style.display='none';">&times;</span>
    </div>

    <style>
        #customAlert {
            background-color: #fff3cd; /* light yellow */
            color: #856404;            /* dark golden text */
            border: 1px solid #ffeeba;
            padding: 12px 16px;
            border-radius: 6px;
            margin: 15px auto;
            width: 500px;
            font-family: "Poppins", sans-serif;
            font-size: 15px;
            text-align: center;
            position: relative;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        }

        #customAlert .close-btn {
            position: absolute;
            right: 30px;
            top: 6px;
            cursor: pointer;
            color: #856404;
            font-weight: bold;
            font-size: 20px;
            transition: 0.2s;
        }

        #customAlert .close-btn:hover {
            color: #000;
        }
    </style>
<?php
    unset($_SESSION['message']);
endif;
?>

