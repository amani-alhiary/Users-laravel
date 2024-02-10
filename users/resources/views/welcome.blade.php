<!DOCTYPE html>
  <head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>travel website</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@5.15.4/css/fontawesome.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="assets/css/header.css">

</head>

  
  <body>
  <section class="header">
    <nav>
    <a href="index.html" style="color:#fff">LARAVEL PROJECT</a>
    <div class="nav-links" id="navLinks">
      <i class="fa fa-times" onclick="hideMenu()" ></i>

      <ul>
      @if (Route::has('login'))
      @auth
        <li><a href="{{ url('/home') }}">HOME</a></li>
        @else
        <li><a href="{{ route('login') }}">LOG IN</a></li>
        @if (Route::has('register'))
        <li><a href="{{ route('register') }}">SIGN UP</a></li>
        @endif
        @endauth
        @endif
      </ul>

    </div>
    <i class="fa fa-bars" onclick="showMenu()"></i>

  </nav>
  <div class="text-box">
    <h1>Full Laravel Assignment</h1>
    <p>Please when you do thefirst register, Don't forget to change the type of your user to admin type using the database<br>hope you like my work.
    </p>
    <a href="https://github.com/amani-alhiary"class="hero-btn">Visit my GitHub to see more </a>
  </div>



