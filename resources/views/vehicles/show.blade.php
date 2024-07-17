<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Details</title>

    <link rel="stylesheet" href="{{ asset('assets/css/main.css') }}">
</head>

<body>
    <nav class="container relative my-4 lg:my-10">
        @include('components.navbar')
    </nav>

    <!-- Main Content -->
    <section class="bg-darkGrey relative py-[70px]">
        <div class="container">
            <!-- Breadcrumb -->
            <ul class="flex items-center gap-5 mb-[50px]">
                <li class="text-secondary font-normal text-base capitalize after:content-['/'] last:after:content-none inline-flex gap-5">
                    <a href="{{ url('/') }}">Home</a>
                </li>
                <li class="text-secondary font-normal text-base capitalize after:content-['/'] last:after:content-none inline-flex gap-5">
                    <a href="#!">rent</a>
                </li>
                <li class="text-dark font-semibold text-base capitalize after:content-['/'] last:after:content-none inline-flex gap-5">Details</li>
            </ul>

            <div class="grid grid-cols-12 gap-[30px]">
                <!-- Car Preview -->
                <div class="col-span-12 lg:col-span-8">
                    <div class="bg-white p-4 rounded-[30px] flex flex-col gap-4" id="gallery">
                        <img src="{{ asset('storage/' . $vehicle->thumbnail) }}" class="md:h-[490px] rounded-[18px] h-auto w-full" alt="">
                        <div class="grid items-center grid-cols-4 gap-3 md:gap-5">
                            <div>
                                <a href="#!">
                                    <img src="{{ asset('storage/' . $vehicle->thumbnail) }}" alt="" class="thumbnail">
                                </a>
                            </div>
                            <!-- Repeat for other thumbnails -->
                        </div>
                    </div>
                </div>

                <!-- Details -->
                <div class="col-span-12 md:col-start-5 lg:col-start-auto md:col-span-8 lg:col-span-4">
                    <div class="bg-white p-5 pb-[30px] rounded-3xl h-full">
                        <div class="flex flex-col h-full divide-y divide-grey">
                            <!-- Name, Category, Rating -->
                            <div class="max-w-[230px] pb-5">
                                <h1 class="font-bold text-[28px] leading-[42px] text-dark mb-[6px]">{{ $vehicle->name }}</h1>
                                <p class="text-secondary font-normal text-base mb-[10px]">{{ $vehicle->type }}</p>
                            </div>
                            <!-- Features -->
                            <ul class="flex flex-col gap-4 flex-start pt-5 pb-[25px]">
                                <li class="flex items-center gap-3 text-base font-semibold text-dark">
                                    <img src="{{ asset('assets/svgs/ic-checkDark.svg') }}" alt="">
                                    {{ $vehicle->description }} 
                                </li>
                                <li class="flex items-center gap-3 text-base font-semibold text-dark">
                                    <img src="{{ asset('assets/svgs/ic-checkDark.svg') }}" alt="">
                                    {{ $vehicle->type }}
                                </li>
                                <li class="flex items-center gap-3 text-base font-semibold text-dark">
                                    <img src="{{ asset('assets/svgs/ic-checkDark.svg') }}" alt="">
                                    Tersedia
                                </li>
                                <!-- Repeat for other features -->
                            </ul>
                            <!-- Price, CTA Button -->
                            <div class="flex items-center justify-between gap-4 pt-5 mt-auto">
                                <div>
                                    <p class="font-bold text-dark text-[22px]">{{ $vehicle->stock }}</p>
                                    <p class="text-base font-normal text-secondary">/Tersedia</p>
                                </div>
                                <div class="w-full max-w-[70%]">
                                    <!-- Button Primary -->
                                    <div class="p-1 rounded-full bg-primary group">
                                    <a href="{{ route('booking-requests.index', ['vehicle' => $vehicle->id]) }}" class="btn btn-primary">
                                    <p>Pinjam Sekarang</p>
                                    <img src="{{ asset('assets/svgs/ic-arrow-right.svg') }}" alt="Arrow Right Icon">
                                    </a>
                                </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Similar Cars -->
    <section class="bg-darkGrey">
        <div class="container relative py-[100px]">
            <header class="mb-[30px]">
                <p class="text-base text-secondary">Start your big day</p>
            </header>
        </div>
    </section>

    <script src="https://code.jquery.com/jquery-3.6.3.min.js" integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>
    <script type="text/javascript" src="{{ asset('scripts/script.js') }}"></script>
</body>
</html>