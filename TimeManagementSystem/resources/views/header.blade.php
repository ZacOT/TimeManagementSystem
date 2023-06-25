<head>
    <link rel="stylesheet" href="<?php echo asset('css/header.css')?>" type="text/css"> 
    <link rel="stylesheet" href="<?php echo asset('css/sidebar.css')?>" type="text/css"> 
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Titillium+Web">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />

    @if(Auth::user())
    <div class="header">
        <div class="header-container">
            <div class="header-icon"><img src="/images/tmsicon.jpg" height=70px width=70px></div>
            <div class="header-title">Time Management System</div>
        </div>

        <div class="header-buttons">
            <a href=""><img src="/images/notification.png" height="30px" width="30px"><text>Notifications</text></a>
        </div>
    </div>
    
    @else
    <div class="header">
        <div class="header-container">
            <div class="header-icon"><img src="/images/tmsicon.jpg" height=70px width=70px></div>
            <div class="header-title">Time Management System</div>
        </div>
    </div>
    @endif