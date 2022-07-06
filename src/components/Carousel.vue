<template>
    <div class="d-flex ullist">
        <div class="slide w-100">
          <div id="carouselExampleControls" class="carousel w-100" data-bs-ride="carousel">
            <div class="carousel-indicators">
              <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
              <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
              <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
            </div>            
            <div class="carousel-inner w-100">
              <div class="carousel-item active"><!--^, image 1-->
                <img src="../assets/images/carousel1.svg" class="d-block w-100" alt="image-carousel-1">
              </div>
              <div class="carousel-item"><!--^, image 2-->
                <img src="../assets/images/carousel2.svg" class="d-block w-100" alt="image-carousel-2">
              </div>
              <div class="carousel-item"><!--^, image 3-->
                <img src="../assets/images/carousel3.svg" class="d-block w-100" alt="image-carousel3">
              </div>
            </div>
            <!--^, carousel nav back-->
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev">
              <span class="carousel-control-prev-icon" aria-hidden="true"></span>
              <span class="visually-hidden">Previous</span>
            </button>
            <!--^, carousel nav foward-->
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next">
              <span class="carousel-control-next-icon" aria-hidden="true"></span>
              <span class="visually-hidden">Next</span>
            </button>
          </div>
        </div>
    </div>
</template>