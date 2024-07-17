<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Navigation Example</title>
  <!-- CSS styles (tailwind classes for example) -->
  <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
</head>
<body>

  <!-- Navigation -->
  <nav class="container relative my-4 lg:my-10">
    <div class="flex flex-col justify-between w-full lg:flex-row lg:items-center">
      <!-- Logo & Toggler Button -->
      <div class="flex items-center justify-between">
        <a href="{{ route('dashboard') }}">
          <img src="{{ asset('assets/svgs/logo.svg') }}" alt="stream">
        </a>
        <div class="block lg:hidden">
          <button class="p-1 outline-none mobileMenuButton" id="navbarToggler" data-target="#navigation">
            <svg class="text-dark w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 8h16M4 16h16"></path>
            </svg>
          </button>
        </div>
      </div>

      <!-- Nav Menu -->
      <div class="hidden w-full lg:block" id="navigation">
        <div class="flex flex-col items-baseline gap-4 mt-6 lg:justify-between lg:flex-row lg:items-center lg:mt-0">
          <div class="flex flex-col w-full ml-auto lg:w-auto gap-4 lg:gap-[50px] lg:items-center lg:flex-row">
            <a href="{{ route('dashboard') }}" class="nav-link-item {{ Request::is('/') ? 'active' : '' }}">Landing</a>
            @auth
              @if (auth()->user()->hasRole('admin'))
                <a href="{{ route('vehicles.index') }}" class="nav-link-item">Dashboard</a>
                <a href="{{ route('admin.bookings.index') }}" class="nav-link-item">Lihat Permintaan</a>
              @elseif (auth()->user()->hasRole('approver'))
                <a href="{{ route('approvals.index') }}" class="nav-link-item">Permintaan</a>
              @else
                <a href="#!" class="nav-link-item">Katalog</a>
                <a href="{{route('my-bookings')}}" class="nav-link-item">Booking</a>
              @endif
            @else
              <a href="#!" class="nav-link-item">Maps</a>
            @endauth
          </div>
          <div class="flex flex-col w-full ml-auto lg:w-auto lg:gap-12 lg:items-center lg:flex-row">
            @auth
              <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="btn-secondary">Log Out</a>
              <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
              </form>
            @else
              <a href="{{ route('login') }}" class="btn-secondary">Log In</a>
            @endauth
          </div>
        </div>
      </div>
    </div>
  </nav>

  <!-- JavaScript -->
  <script src="{{ asset('js/app.js') }}"></script> <!-- Include your JavaScript file here if needed -->

</body>
</html>
