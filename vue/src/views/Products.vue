<template>
  <PageComponent>
    <template v-slot:header>
       <div class="flex justify-between items-center">
          <h1 class="text-3xl font-bold text-gray-900">Products</h1>
       </div>
       <br>

       <div class="grid grid-cols-4 gap-4">
          <div v-for="product in products" :key="product.id" class="card flex flex-col justify-center2 p-5 bg-white rounded-lg shadow-2xl">
            <div class="prod-title">
              <p class="text-2xl text-gray-900 font-bold">{{ product.name }}</p>
            </div>
            <div class="prod-img">
                   <img :src=product.image class="w-full object-cover object-center">
            </div>

            <div class="flex flex-col md:flex-row justify-between items-center text-gray-900 py-4">
              <p class="font-bold text-xl">${{ product.price }}</p>
              <button
                      class="px-6 py-2 transition ease-in duration-200 uppercase rounded-full hover:bg-gray-800 hover:text-white border-2 border-gray-900 focus:outline-none">Add
                to cart</button>
            </div>
          </div>
        </div>

<!--       <table>-->
<!--          <tr>-->
<!--            <th>ID</th>-->
<!--            <th>Name</th>-->
<!--            <th>Price</th>-->
<!--            <th>Image</th>-->
<!--            <th>Actions</th>-->
<!--          </tr>-->
<!--          <tr v-for="product in products" :key="product.id">-->
<!--            <td>{{ product.id }}</td>-->
<!--            <td>{{ product.name }}</td>-->
<!--            <td>${{ product.price  }}</td>-->
<!--            <td>-->
<!--              <img :src=product.image width="50">-->
<!--            </td>-->
<!--            <td>-->
<!--              <div style="display: flex">-->
<!--                <router-link :to="{ name: 'ProductEdit', params: { id: product.id } }">-->
<!--                  <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">-->
<!--                  <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z" />-->
<!--                  </svg>-->
<!--              </router-link>-->
<!--              <button v-if="product.id" type="button" @click="deleteProduct(product.id)">-->
<!--                  <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">-->
<!--                  <path stroke-linecap="round" stroke-linejoin="round" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />-->
<!--                </svg>-->
<!--              </button>-->
<!--              </div>-->
<!--            </td>-->
<!--          </tr>-->
<!--       </table>-->

    </template>
  </PageComponent>
</template>

<script>
import PageComponent from "../components/PageComponent.vue"
import axiosClient from "../axios";

export default {
     components: {
      PageComponent
    },
    data() {
        return {
            posts: [],
            products: [],
        }
    },
    created() {
    },
     mounted() {
       this.loadProducts();
    },
    methods: {
        loadProducts() {
          axiosClient.get('/products')
           .then((resp) => {
                this.products = resp.data.data.data
           })
           .catch(err => {
              console.log(err);
           });
        },
        deleteProduct(id) {
           axiosClient.delete(`/products/${id}`)
             .then((resp) => {
                  console.log(resp);
                  this.loadProducts();
             });
        },
    }
}

</script>

<style scoped>
table {
  font-family: arial, sans-serif;
  border-collapse: collapse;
  width: 100%;
}
th {
  background-color: #bbb;
}
td, th {
  border: 1px solid #dddddd;
  text-align: left;
  padding: 8px;
}

tr:nth-child(odd) {
  background-color: #eee;
}
</style>