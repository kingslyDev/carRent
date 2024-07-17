<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Details</title>

    <link rel="stylesheet" href="{{ asset('assets/css/main.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
</head>
<body>
<nav class="container relative my-4 lg:my-10">
    @include('components.navbar')
</nav>

<section class="bg-darkGrey relative py-[70px]">
    <div class="container">
        <header class="mb-[30px]">
            <h2 class="font-bold text-dark text-[26px] mb-1">
                Checkout & Drive Faster
            </h2>
            <p class="text-base text-secondary">We will help you get ready today</p>
        </header>

        <div class="flex items-center gap-5 lg:justify-between">
            <!-- Form Card -->
            <form id="myForm" action="{{ route('booking_requests.store') }}" method="POST" class="bg-white p-[30px] pb-10 rounded-3xl max-w-[490px] w-full">
    @csrf
    <div class="grid grid-cols-2 items-center gap-y-6 gap-x-4 lg:gap-x-[30px]">
        <!-- Hidden Inputs -->
        <input type="hidden" name="vehicle_id" value="{{ $vehicle ? $vehicle->id : '' }}">
        <input type="hidden" name="user_id" value="{{ auth()->id() }}">

        <!-- Date From and Until -->
        <div class="col-span-2 grid-cols-2 gap-y-6 gap-x-4 lg:gap-x-[30px]">
            <div class="flex flex-col col-span-1 gap-3">
                <label for="dateFrom" class="text-base font-semibold text-dark">
                    From
                </label>
                <input type="text" name="start_time" id="dateFrom"
                       class="text-base font-medium focus:border-primary focus:outline-none placeholder-text-secondary placeholder-font-normal px-[26px] py-4 border border-grey rounded-[50px]"
                       placeholder="Select Date" readonly>
            </div>
            <div class="flex flex-col col-span-1 gap-3">
                <label for="dateUntil" class="text-base font-semibold text-dark mt-5">
                    Until
                </label>
                <input type="text" name="end_time" id="dateUntil"
                       class="text-base font-medium focus:border-primary focus:outline-none placeholder-text-secondary placeholder-font-normal px-[26px] py-4 border border-grey rounded-[50px]"
                       placeholder="Select Date" readonly>
            </div>
        </div>

        <!-- CTA Button -->
        <div class="col-span-2 mt-[26px]">
            <!-- Button Primary -->
            <button type="submit" class="p-1 rounded-full bg-primary group">
                <!-- Menggunakan elemen <a> -->
                <a class="btn-primary">
                    <p>Pesan Sekarang</p>
                    <img src="../assets/svgs/ic-arrow-right.svg" alt="" />
                </a>
            </button>
        </div>
    </div>
</form>

            @if ($vehicle)
                <img src="{{ asset('storage/' . $vehicle->thumbnail) }}" class="max-w-[50%] hidden lg:block -mr-[100px]" alt="" />
            @else
                <p>No vehicle selected.</p>
            @endif
        </div>
    </div>
</section>

<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script>


function submitForm(event) {
        event.preventDefault(); // Menghentikan perilaku default dari anchor tag
        document.getElementById('myForm').submit(); // Menjalankan submit form
    }

    document.addEventListener('DOMContentLoaded', function () {
        flatpickr('#dateFrom', {
            enableTime: false,
            dateFormat: "Y-m-d",
            onClose: function (selectedDates, dateStr, instance) {
                // Handle close event if needed
            }
        });

        flatpickr('#dateUntil', {
            enableTime: false,
            dateFormat: "Y-m-d",
            onClose: function (selectedDates, dateStr, instance) {
                // Handle close event if needed
            }
        });
    });
</script>

</body>
</html>
