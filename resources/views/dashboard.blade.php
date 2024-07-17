<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Landing Page</title>
  
  <!-- External CSS -->
  <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
  <link rel="stylesheet" href="../assets/css/main.css">
</head>
<body>

  <!-- Navigation -->
  <nav class="container relative my-4 lg:my-10">
    @include('components.navbar')
  </nav>

  <!-- A -->
  <section class="container relative pb-[100px] pt-[30px]">
      <div class="flex flex-col items-center justify-center gap-[30px]">
        <!-- Preview Image -->
        <div class="relative">
          <div class="absolute z-0 hidden lg:block">
            <div class="font-extrabold text-[220px] text-darkGrey tracking-[-0.06em] leading-[101%]">
              <div data-aos="fade-right" data-aos-delay="300">Toyota</div>
              <div data-aos="fade-left" data-aos-delay="600">Hilux</div>
            </div>
          </div>
          <img src="../assets/images/Toyota-Hilux.png" class="w-full max-w-[963px] z-10 relative" alt="" data-aos="zoom-in" data-aos-delay="950" />
        </div>

        <div class="flex flex-col lg:flex-row items-center justify-around lg:gap-[60px] gap-7">
          <!-- Car Details -->
          <div class="flex items-center gap-y-12">
            <div class="flex flex-col items-center gap-[2px] px-3 md:px-10" data-aos="fade-left" data-aos-delay="1400">
              <h6 class="font-bold text-dark text-xl md:text-[26px] text-center">380</h6>
              <p class="text-sm font-normal text-center md:text-base text-secondary">Horse Power</p>
            </div>
            <span class="vr" data-aos="fade-left" data-aos-delay="1600"></span>
            <div class="flex flex-col items-center gap-[2px] px-3 md:px-10" data-aos="fade-left" data-aos-delay="1900">
              <h6 class="font-bold text-dark text-xl md:text-[26px] text-center">6</h6>
              <p class="text-sm font-normal text-center md:text-base text-secondary">Speed AT</p>
            </div>
            <span class="vr" data-aos="fade-left" data-aos-delay="2100"></span>
            <div class="flex flex-col items-center gap-[2px] px-3 md:px-10" data-aos="fade-left" data-aos-delay="2400">
              <h6 class="font-bold text-dark text-xl md:text-[26px] text-center">AWD</h6>
              <p class="text-sm font-normal text-center md:text-base text-secondary">Drive</p>
            </div>
            <span class="vr" data-aos="fade-left" data-aos-delay="2600"></span>
            <div class="flex flex-col items-center gap-[2px] px-3 md:px-10" data-aos="fade-left" data-aos-delay="2900">
              <h6 class="font-bold text-dark text-xl md:text-[26px] text-center">A.I</h6>
              <p class="text-sm font-normal text-center md:text-base text-secondary">Tracking</p>
            </div>
          </div>
          <!-- Button Primary -->
          <div class="p-1 rounded-full bg-primary group" data-aos="zoom-in" data-aos-delay="3400">
            <a href="checkout.html" class="btn-primary">
              <p>Rent Now</p>
              <img src="../assets/svgs/ic-arrow-right.svg" alt="" />
            </a>
          </div>
        </div>
      </div>
    </section>
  <!-- A -->

  <!-- Popular Cars Section -->
  <section class="bg-darkGrey">
    <div class="container relative py-[100px]">
      <header class="mb-[30px]">
        <h2 class="font-bold text-dark text-[26px] mb-1">Popular Cars</h2>
        <p class="text-base text-secondary">Start your big day</p>
      </header>

   
      <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-[29px]">
      @foreach ($cars as $car)
      <div class="card-popular bg-white rounded-lg shadow-lg p-6">
        <div>
            <h5 class="text-lg text-dark font-bold mb-2">{{ $car->name }}</h5>
            <p class="text-sm font-normal text-secondary">{{ $car->type }}</p>
            <a href="{{ route('vehicles.show', $car->id)}}" class="absolute inset-0"></a>
        </div>
        <img src="{{ asset('storage/' . $car->thumbnail) }}" class="rounded-lg min-w-[216px] w-full h-[150px]" alt="Car Image"> <!-- Menampilkan thumbnail mobil -->
        <div class="flex items-center justify-between mt-3">
            <p class="text-sm font-normal text-secondary"><span class="text-base font-bold text-primary">{{ $car->stock }}</span>/Tersedia</p>
        </div>
    </div>
    @endforeach

      </div>
    </div>
  </section>


  <section class="relative bg-[#060523]">
      <div class="container py-20">
        <div class="flex flex-col">
          <header class="mb-[50px] max-w-[360px] w-full">
            <h2 class="font-bold text-white text-[26px] mb-4">
              Drive Yours Today. <br />
              Drive Faster.
            </h2>
          </header>
        
        </div>
        <div class="absolute bottom-[-30px] right-0 lg:w-[764px] max-h-[332px] hidden lg:block">
          <img src="../assets/images/pajero.png" alt="" />
        </div>
      </div>
    </section>

  <!-- Footer -->
  <footer class="py-10 md:pt-[100px] md:pb-[70px] container">
    <p class="text-base text-center text-secondary">All Rights Reserved Sekawan Media.</p>
  </footer>

  <!-- Scripts -->
  <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
  <script>
    AOS.init({ once: true, duration: 300, easing: 'ease-out' });
  </script>
  <script src="https://code.jquery.com/jquery-3.6.3.min.js" integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>
  <script type="text/javascript" src="../scripts/script.js"></script>
</body>
</html>
