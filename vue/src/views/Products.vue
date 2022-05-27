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
            <th>Name</th>
            <th>Price</th>
            <th>description</th>
          </tr>
          <tr v-for="product in products" :key="product.id">
            <td>{{ product.name }}</td>
            <td>${{ product.price  }}</td>
            <td>{{ product.description }}</td>
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
       axiosClient.get('/products')
       .then((resp) => {
            this.products = resp.data.data.data
            console.log(this.products)
       })
       .catch(err => {
        console.log(err);
       })
       ;
    },
    methods: {

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