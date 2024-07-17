<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Details</title>

    <link rel="stylesheet" href="../css/main.css" />
  </head>

  <body>
    <nav class="container relative my-4 lg:my-10">@include('components.navbar')</nav>

    <!-- Main Content -->
    <section class="bg-darkGrey relative py-[70px]">
      <div class="container">
        <!-- Breadcrumb -->
        <ul class="flex items-center gap-5 mb-[50px]">
          <li class="text-secondary font-normal text-base capitalize after:content-['/'] last:after:content-none inline-flex gap-5">
            <a href="./index.html">Home</a>
          </li>
          <li class="text-secondary font-normal text-base capitalize after:content-['/'] last:after:content-none inline-flex gap-5">
            <a href="#!">Porsche</a>
          </li>
          <li class="text-dark font-semibold text-base capitalize after:content-['/'] last:after:content-none inline-flex gap-5">Details</li>
        </ul>

        <div class="grid grid-cols-12 gap-[30px]">
          <!-- Car Preview -->
          <div class="col-span-12 lg:col-span-8">
            <div class="bg-white p-4 rounded-[30px] flex flex-col gap-4" id="gallery">
              <img :src="thumbnails[activeThumbnail].url" :key="thumbnails[activeThumbnail].id" class="md:h-[490px] rounded-[18px] h-auto w-full" alt="" />
              <div class="grid items-center grid-cols-4 gap-3 md:gap-5">
                <div v-for="(thumbnail, index) in thumbnails" :key="thumbnail.id">
                  <a href="#!" @click="changeActive(index)">
                    <img :src="thumbnail.url" alt="" class="thumbnail" :class="{selected: index == activeThumbnail}" />
                  </a>
                </div>
              </div>
            </div>
          </div>

          <!-- Details -->
          <div class="col-span-12 md:col-start-5 lg:col-start-auto md:col-span-8 lg:col-span-4">
            <div class="bg-white p-5 pb-[30px] rounded-3xl h-full">
              <div class="flex flex-col h-full divide-y divide-grey">
                <!-- Name, Category, Rating -->
                <div class="max-w-[230px] pb-5">
                  <h1 class="font-bold text-[28px] leading-[42px] text-dark mb-[6px]">Porsche Taycan Mattic 67S</h1>
                  <p class="text-secondary font-normal text-base mb-[10px]">Direksi</p>
                </div>
                <!-- Features -->
                <ul class="flex flex-col gap-4 flex-start pt-5 pb-[25px]">
                  <li class="flex items-center gap-3 text-base font-semibold text-dark">
                    <img src="../assets/svgs/ic-checkDark.svg" alt="" />
                    350 Horse Power
                  </li>
                  <li class="flex items-center gap-3 text-base font-semibold text-dark">
                    <img src="../assets/svgs/ic-checkDark.svg" alt="" />
                    4 Seat People
                  </li>
                  <li class="flex items-center gap-3 text-base font-semibold text-dark">
                    <img src="../assets/svgs/ic-checkDark.svg" alt="" />
                    FWD
                  </li>
                  <li class="flex items-center gap-3 text-base font-semibold text-dark">
                    <img src="../assets/svgs/ic-checkDark.svg" alt="" />
                    8 Speeds AT
                  </li>
                </ul>
                <!-- Price, CTA Button -->
                <div class="flex items-center justify-between gap-4 pt-5 mt-auto">
                  <div>
                    <p class="font-bold text-dark text-[22px]">5</p>
                    <p class="text-base font-normal text-secondary">/Tersedia</p>
                  </div>

                  <div class="w-full max-w-[70%]">
                    <!-- Button Primary -->
                    <div class="p-1 rounded-full bg-primary group">
                      <a href="checkout.html" class="btn-primary">
                        <p>Rent Now</p>
                        <img src="../assets/svgs/ic-arrow-right.svg" alt="" />
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
          <h2 class="font-bold text-dark text-[26px] mb-1">Similar Cars</h2>
          <p class="text-base text-secondary">Start your big day</p>
        </header>

        <!-- Cars -->
        <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-[29px]">
          <!-- Card -->
          <div class="card-popular">
            <div>
              <h5 class="text-lg text-dark font-bold mb-[2px]">Taycan 4S</h5>
              <p class="text-sm font-normal text-secondary">Electric Car</p>
              <a href="./details.html" class="absolute inset-0"></a>
            </div>
            <img src="../assets/images/car-01.webp" class="rounded-[18px] min-w-[216px] w-full h-[150px]" alt="" />
            <div class="flex items-center justify-between gap-1">
              <!-- Price -->
              <p class="text-sm font-normal text-secondary"><span class="text-base font-bold text-primary">$250</span>/day</p>
              <!-- Rating -->
              <p class="text-dark text-xs font-semibold flex items-center gap-[2px]">
                (4.8/5)
                <img src="../assets/svgs/ic-star.svg" alt="" />
              </p>
            </div>
          </div>
          <!-- Card -->
          <div class="card-popular">
            <div>
              <h5 class="text-lg text-dark font-bold mb-[2px]">911 922 RS</h5>
              <p class="text-sm font-normal text-secondary">Sport Car</p>
              <a href="./details.html" class="absolute inset-0"></a>
            </div>
            <img src="../assets/images/car-02.webp" class="rounded-[18px] min-w-[216px] w-full h-[150px]" alt="" />
            <div class="flex items-center justify-between gap-1">
              <!-- Price -->
              <p class="text-sm font-normal text-secondary"><span class="text-base font-bold text-primary">$456</span>/day</p>
              <!-- Rating -->
              <p class="text-dark text-xs font-semibold flex items-center gap-[2px]">
                (5/5)
                <img src="../assets/svgs/ic-star.svg" alt="" />
              </p>
            </div>
          </div>
          <!-- Card -->
          <div class="card-popular">
            <div>
              <h5 class="text-lg text-dark font-bold mb-[2px]">Macan 7S</h5>
              <p class="text-sm font-normal text-secondary">Family Car</p>
              <a href="./details.html" class="absolute inset-0"></a>
            </div>
            <img src="../assets/images/car-03.webp" class="rounded-[18px] min-w-[216px] w-full h-[150px]" alt="" />
            <div class="flex items-center justify-between gap-1">
              <!-- Price -->
              <p class="text-sm font-normal text-secondary"><span class="text-base font-bold text-primary">$190</span>/day</p>
              <!-- Rating -->
              <p class="text-dark text-xs font-semibold flex items-center gap-[2px]">
                (4.3/5)
                <img src="../assets/svgs/ic-star.svg" alt="" />
              </p>
            </div>
          </div>
          <!-- Card -->
          <div class="card-popular">
            <div>
              <h5 class="text-lg text-dark font-bold mb-[2px]">Cayman 992</h5>
              <p class="text-sm font-normal text-secondary">Race Car</p>
              <a href="./details.html" class="absolute inset-0"></a>
            </div>
            <img src="../assets/images/car-04.webp" class="rounded-[18px] min-w-[216px] w-full h-[150px]" alt="" />
            <div class="flex items-center justify-between gap-1">
              <!-- Price -->
              <p class="text-sm font-normal text-secondary"><span class="text-base font-bold text-primary">$899</span>/day</p>
              <!-- Rating -->
              <p class="text-dark text-xs font-semibold flex items-center gap-[2px]">
                (4.9/5)
                <img src="../assets/svgs/ic-star.svg" alt="" />
              </p>
            </div>
          </div>
        </div>
      </div>
    </section>

    <script src="https://unpkg.com/vue@next/dist/vue.global.js"></script>
    <script>
      const { createApp } = Vue;
      createApp({
        data() {
          return {
            activeThumbnail: 0,
            thumbnails: [
              {
                id: 1,
                url: '../assets/images/car-01.webp',
              },
              {
                id: 2,
                url: '../assets/images/thumbnail-02.webp',
              },
              {
                id: 3,
                url: '../assets/images/thumbnail-03.webp',
              },
              {
                id: 4,
                url: '../assets/images/thumbnail-04.webp',
              },
            ],
          };
        },
        methods: {
          changeActive(id) {
            this.activeThumbnail = id;
          },
        },
      }).mount('#gallery');
    </script>

    <script src="https://code.jquery.com/jquery-3.6.3.min.js" integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>
    <script type="text/javascript" src="../scripts/script.js"></script>
  </body>
</html>
