<template>
  <WebLayout>
    <div class="container">
      <div class="product-grid-container col-6">
        <div class="product-grid" v-for="product in store.product" :key="product.id">
          <div v-if="product.image" class="card-image">
            <img :src="`http://127.0.0.1:8000/storage/${product.image}`" class="img-fluid ml-20" alt="Product Image"
              :width="300" :height="300" />
          </div>
          <div class="product-details-container d-flex flex-column gap-2">
            <div class="product-header">
              <h4 class="product-name fs-3">{{ product.name }}</h4>
            </div>
            <div class="product-pricing">
              <p class="product-price">{{ product.price }} រៀល</p>
            </div>
            <hr />
            <div class="product-info d-flex flex-column gap-2">
              <div class="product-category">
                <span>ប្រភេទ : </span>
                <span class="product-category-name fw-bold">{{ product.category.name }}</span>
              </div>
              <div class="product-stock">
                <span>ចំនួនក្នុងស្តុក : </span>
                <span class="product-stock-quantity fw-bold">{{ product.stock.quantity }} {{
                  product.stock.stock_type.name }}</span>
              </div>
              <div class="product-expiration">
                <span>ផុតកំណត់​ : </span>
                <span class="product-expiration-date text-danger fw-bold">{{
                  product.break_product_at
                }}</span>
              </div>
            </div>
          </div>
          <hr />
          <div class="footer">
            <div class="description-container">
              <h5>គុណភាពនៃផលិតផល</h5>
              <p>{{ product.description }}</p>
            </div>
          </div>
        </div>
      </div>

      <div class="card-user col-5" v-for="product in store.product" :key="product.id">
        <div class="card">
          <router-link :to="{ name: 'userDetail', params: { id: product.frontuser.id } }" class="text-decoration-none">
            <div class="card-body d-flex flex-column align-items-center justify-content-center text-center">
              <img v-if="product.frontuser.profile == null" src="../../src/assets/user.png" alt="Profile Picture"
                class="profile-picture mb-3" />
              <img v-else :src="`http://127.0.0.1:8000/storage/${product.frontuser.profile}`"
                class="profile-picture mb-3" alt="Profile Picture" />
              <div class="user-info">
                <div class="user-header">
                  <h5 class="card-name mb-1 ml-8">{{ product.frontuser.name }}</h5>
                  <span class="badge">Seller</span>
                </div>
                <p v-if="product.frontuser.bio !== null" class="card-text">
                  {{ product.frontuser.bio }}
                </p>
              </div>
            </div>
          </router-link>

          <div class="user-contact">
            <div class="contact-item">
              <i class="bi bi-telephone-outbound-fill"></i>
              <p>{{ product.frontuser.phone }}</p>
            </div>
            <div class="contact-item">
              <i class="bi bi-envelope-at-fill"></i>
              <p>{{ product.frontuser.email }}</p>
            </div>
          </div>
          <div v-if="
            product.frontuser.facebook ||
            product.frontuser.telegram
          " class="user-media">
            <p class="fw-bold text-success">Social Media</p>
            <div class="media-links">
              <a v-if="product.frontuser.facebook !== null"
                :href="'https://www.facebook.com/' + product.frontuser.facebook" target="_blank" class="social-link">
                <i class="fab fa-facebook-square"></i>
              </a>
              <a v-if="product.frontuser.telegram !== null" :href="'https://t.me/' + product.frontuser.telegram"
                target="_blank" class="social-link">
                <i class="fab fa-telegram"></i>
              </a>
            </div>
          </div>
          <div class="chat-container ml-3 mt-5 mb-2">
            <div class="chat-content">
              <div class="chat-message">
                <span style="font-size: 15px">សូមទំនាក់ទំនងអ្នកលក់សម្រាប់ព័ត៌មានលម្អិត។</span>
              </div>
              <div class="chat-button">
                <button class="btn btn-success mt-2">Chat Now</button>
              </div>
            </div>
          </div>
          <hr />
          <div v-if="product.frontuser.location != null" class="mb-2">
            <a :href="'https://www.google.com/maps/search/?api=1&query=' +
              encodeURIComponent(
                product.frontuser.location.latitude + ',' + product.frontuser.location.longitude
              )
              " target="_blank" class="btn w-100 border mb-1">
              <i class="fas fa-map-marker-alt"> View on map</i>
            </a>
            <div id="map" style="width: 290px; height: 150px"></div>
          </div>
        </div>
      </div>
    </div>
  </WebLayout>
</template>

<script>
import { ref, onMounted } from 'vue'
import { useProductsStore } from '@/stores/products-lists.ts'
import WebLayout from '@/Components/Layouts/WebLayout.vue'
import { useRoute } from 'vue-router'
import { useAuthStore } from '@/stores/auth-store'
export default {
  name: 'ListCardProduct',
  components: { WebLayout },
  setup() {
    const route = useRoute()
    const store = useProductsStore()
    const productById = ref(null)
    const user = useAuthStore()
    const fetchProductById = async (id) => {
      productById.value = await store.fetchProductDetail(id)
      initMap()
    }

    onMounted(() => {
      if (route.params.id) {
        fetchProductById(route.params.id)
      }
    })

    const initMap = () => {
      const latitude = parseFloat(store.product.data.frontuser.location.latitude)
      const longitude = parseFloat(store.product.data.frontuser.location.longitude)

      const map = new google.maps.Map(document.getElementById('map'), {
        zoom: 15,
        center: { lat: latitude, lng: longitude }
      })

      new google.maps.Marker({
        position: { lat: latitude, lng: longitude },
        map: map
      })
    }

    const formatPrice = (price) => {
      return new Intl.NumberFormat().format(price) + ' Riels'
    }

    return {
      productById,
      formatPrice,
      store,
      user
    }
  }
}
</script>

<style scoped>
.container {
  display: flex;
  justify-content: space-between;
  flex-wrap: wrap;
  gap: 2rem;
  margin-top: 7rem;
  margin-bottom: 10rem;
  padding: 0 5%;
  margin-left: 10rem;
}

.product-grid-container {
  flex: 3;
}

.product-grid {
  background-color: #f9fafb;
  border-radius: 10px;
  box-shadow: 0 10px 10px rgba(0, 0, 0, 0.1);
  padding: 20px;
  transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.product-grid:hover {
  transform: translateY(-10px);
  box-shadow: 0 15px 30px rgba(0, 0, 0, 0.15);
}

.card-image {
  position: relative;
  overflow: hidden;
  background: #fff;
  text-align: center;
  border-radius: 10px;
  margin-bottom: 15px;
}

.card-image img {
  transition: transform 0.3s ease-in-out;
}

.card-image:hover img {
  transform: scale(1.05);
}

.product-details-container {
  padding: 15px;
  background-color: #ffffff;
  border-radius: 10px;
}

.product-details-container h4 {
  color: #333;
  font-size: 1.5rem;
}

.product-details-container .product-badges .badge {
  background-color: #ff6b6b;
}

.product-details-container .product-pricing p {
  color: #28a745;
  font-size: 1.25rem;
  font-weight: bold;
}

.product-info {
  font-size: 1rem;
  color: #666;
}

.description-container {
  border: 1px solid #e0e0e0;
  border-radius: 10px;
  padding: 15px;
  background-color: #f8f8f8;
}

.description-container h5 {
  color: #333;
  font-size: 1.25rem;
}

.description-container p {
  line-height: 1.6;
}

.card-user .card {
  transition: transform 0.3s ease, box-shadow 0.3s ease;
  background-color: #ffffff;
  border-radius: 10px;
  padding: 20px;
  box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
  width: 70%;
}

.card-user .card:hover {
  transform: translateY(-10px);
  box-shadow: 0 15px 30px rgba(0, 0, 0, 0.15);
}

.card-user .profile-picture {
  border-radius: 50%;
  width: 80px;
  height: 80px;
  transition: transform 0.3s ease;
}

.card-user .profile-picture:hover {
  transform: scale(1.1);
}

.card-user .user-info {
  margin-left: 15px;
}

.card-user .user-header {
  display: flex;
  align-items: center;
  margin-bottom: 10px;
}

.card-user .card-name {
  font-size: 1.25rem;
  font-weight: bold;
  color: #333;
}

.card-user .badge {
  background-color: #007bff;
  color: #fff;
  margin-left: 10px;
}

.card-user .user-contact,
.card-user .user-media {
  background-color: #f8f8f8;
  border-radius: 10px;
  padding: 15px;
  margin-top: 15px;
}

.card-user .user-contact p,
.card-user .user-media p {
  margin: 0;
}

.card-user .user-media .media-links {
  display: flex;
  gap: 1rem;
}

.card-user .user-media .media-links a {
  color: #007bff;
  font-size: 1.5rem;
}

.card-user .user-media .media-links a:hover {
  color: #0056b3;
}

.card-user .user-address i {
  color: #007bff;
  margin-right: 10px;
}

.card-user .user-address .address-link {
  text-decoration: none;
  transition: color 0.3s;
}

.card-user .user-address .address-link:hover {
  text-decoration: underline;
}
</style>
