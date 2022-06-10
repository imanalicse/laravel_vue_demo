<template>
  <PageComponent>
    <template v-slot:header>
       <div class="flex justify-between items-center">
          <h1 class="text-3xl font-bold text-gray-900">Products</h1>
          <router-link
            :to="{ name: 'ProductCreate' }"
            class="py-2 px-2 text-white rounded-md bg-blue-500 hover:bg-blue-700">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 -mt-1 inline-block" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
              <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
            </svg>
            Add new Product
          </router-link>
       </div>
       <br>
       <table>
          <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Price</th>
            <th>Image</th>
            <th>Actions</th>
          </tr>
          <tr v-for="product in products" :key="product.id">
            <td>{{ product.id }}</td>
            <td>{{ product.name }}</td>
            <td>${{ product.price  }}</td>
            <td>
              <img :src=product.image width="50">
            </td>
            <td>
              <div style="display: flex">
                <router-link :to="{ name: 'ProductEdit', params: { id: product.id } }">
                  <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                  <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z" />
                  </svg>
              </router-link>
              <button v-if="product.id" type="button" @click="deleteProduct(product.id)">
                  <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
              </button>
              </div>
            </td>
          </tr>
       </table>

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