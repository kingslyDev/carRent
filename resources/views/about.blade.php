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

<nav class="container relative my-4 lg:my-10">
    @include('components.navbar')
  </nav>

    <section class="map_sec">
      <div class="container">
        <div class="row">
          <div class="col-md-10 offset-md-1">
            <div class="map_inner">
              <h4>Temukan kami di Google Maps!</h4>
              <div class="map_bind">
                <iframe
                  src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d15808.48879565961!2d112.6369922!3d-7.8822814!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e7881c52a038bb5%3A0xd24cd72fd10ca707!2sSekawan%20Media!5e0!3m2!1sid!2sid!4v1721259609840!5m2!1sid!2sid"
                  width="100%"
                  height="450"
                  frameborder="0"
                  style="border: 0"
                  allowfullscreen=""
                  aria-hidden="false"
                  tabindex="0"
                ></iframe>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
</section>
  
  



  </body>
</html>