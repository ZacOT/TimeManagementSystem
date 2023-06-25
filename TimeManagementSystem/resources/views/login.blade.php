<!DOCTYPE html>
<html lang="en">

    @include('header')

    <title>TMS - Kanban Board</title>

</head>

<body>
    <link rel="stylesheet" href="<?php echo asset('css/dashboard.css') ?>" type="text/css">
    <link rel="stylesheet" href="<?php echo asset('css/login.css') ?>" type="text/css">
    <body>
        <div class="login-container">
            <div class="login-header">
                <div class="text-header">Login</div>
            </div>
            <form action="{{ route('login') }}" method="post">
            @csrf
            @if (session('status'))
                <p style="text-align:center; color:red; font-family: Arial, Helvetica, sans-serif;">{{ session('status') }}</p>
            @endif
            <div class="username">
                <input type="text" name="username" placeholder="Username" style="text-align:center;"/>
                @error('username')
                    <div class="error">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="password">
                <input type="text" name="password" placeholder="Password" style="text-align:center;"/>
                @error('password')
                    <div class="error">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <button type="submit">Login</button>
            <div class="forget">
                <a href="#">Forget your password?</a>
            </div>
            </form>
    </div>
    </body>


</body>

</html>