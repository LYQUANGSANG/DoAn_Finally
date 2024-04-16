<script setup lang="ts">

const props = defineProps({
  height: {
    type: Number,
    default: () => 615
  },
  product: {
    type: Boolean,
    default: () => false
  }
});

</script>

<template>
  <div class="banner">
    <div v-if="!props.product" id="carouselExampleDark" class="carousel carousel-dark slide">
      <div class="carousel-indicators">
        <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="0" class="active"
          aria-current="true"></button>
        <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="1"></button>
        <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="2"></button>
      </div>
      <div class="carousel-inner">
        <div class="carousel-item active" data-bs-interval="10000">
          <img src="https://images.vexels.com/content/126443/preview/macbook-pro-touch-bar-banner-fedf81.png"
            :height="props.height" class="d-block w-100" alt="...">
          <div class="carousel-caption d-none d-md-block">
          </div>
        </div>
        <div class="carousel-item" data-bs-interval="2000">
          <img src="@/assets/banner/banner-macbook-air-2022.jpg" :height="props.height" class="d-block w-100" alt="...">
          <div class="carousel-caption d-none d-md-block">
          </div>
        </div>
        <div class="carousel-item">
          <img src="https://file.hstatic.net/1000347078/collection/banner_macbook_92054b106e2d457f9391d59825973023.jpg"
            :height="props.height" class="d-block w-100" alt="...">
          <div class="carousel-caption d-none d-md-block">
          </div>
        </div>
      </div>
      <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleDark" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
      </button>
      <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleDark" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
      </button>
    </div>

    <div v-if="props.product" id="carouselExampleDark" class="carousel carousel-dark slide">
      <div class="carousel-indicators">
        <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="0" class="active"
          aria-current="true"></button>
        <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="1"></button>
        <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="2"></button>
      </div>
      <div class="carousel-inner">
        <div class="carousel-item active" data-bs-interval="10000">
          <img src="https://www.jumpplus.com/web/image/363705/MacBook%20Pro%20reserve%20banner.png"
            :height="props.height" width="300px" class="d-block w-100" alt="...">
          <div class="carousel-caption d-none d-md-block">
          </div>
        </div>
        <div class="carousel-item" data-bs-interval="2000">
          <img src="https://media.idownloadblog.com/wp-content/uploads/2023/02/Notifications-on-MacBook.jpg"
            :height="props.height" width="300px" class="d-block w-100" alt="...">
          <div class="carousel-caption d-none d-md-block">
          </div>
        </div>
        <div class="carousel-item">
          <img src="https://macone.vn/wp-content/uploads/2019/07/silver_e1e8d34d4c36483b9a0b386aace4aeaf.jpg"
            :height="props.height" width="300px" class="d-block w-100" alt="...">
          <div class="carousel-caption d-none d-md-block">
          </div>
        </div>
      </div>
      <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleDark" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
      </button>
      <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleDark" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
      </button>
    </div>
  </div>
</template>

<style scoped>
.banner {
  .carousel-dark .carousel-indicators [data-bs-target] {
    background-color: hsla(160, 100%, 37%, 1);
    border-radius: 10px;
  }
}
</style>
