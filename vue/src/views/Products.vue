<template>
  <PageComponent>
    <template v-slot:header>
       <div class="flex justify-between items-center">
          <h1 class="text-3xl font-bold text-gray-900">Products</h1>
          <router-link
            :to="{ name: 'ProductCreate' }"
            class="py-2 px-2 text-white bg-emerald-500 rounded-md hover:bg-emerald-600"
          >
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
            <th>description</th>
            <th>Action</th>
          </tr>
          <tr v-for="product in products" :key="product.id">
            <td>{{ product.id }}</td>
            <td>{{ product.name }}</td>
            <td>${{ product.price  }}</td>
            <td>{{ product.description }}</td>
            <td>

              <router-link :to="{ name: 'ProductEdit', params: { id: product.id } }"
                class="flex py-2 px-4 border border-transparent text-sm rounded-md
                text-white bg-indigo-600 hover:bg-indigo-700 focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" >
                <svg style="display: inline" xmlns="http://www.w3.org/2000/svg" class="h-8 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                </svg>
              </router-link>

              <button style="display: inline" v-if="product.id" type="button" @click="deleteProduct(product.id)" class="h-8 w-8 flex items-center
              rounded-full border border-transparent text-sm text-red-500 focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                </svg>
              </button>
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