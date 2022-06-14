<template>
  <PageComponent>
    <template v-slot:header>
       <div class="flex justify-between items-center">
          <h1 class="text-3xl font-bold text-gray-900">Products</h1>
       </div>
       <br>

       <div class="grid grid-cols-4 gap-4">
          <div v-for="product in products" :key="product.id" class="relative card flex flex-col justify-center2 p-5 bg-white rounded-lg shadow-2xl">
            <div class="prod-title">
              <p class="text-2xl text-gray-900 font-bold">{{ product.name }}</p>
            </div>
            <div class="prod-img">
                   <img :src=product.image class="w-full object-cover object-center">
            </div>
            <div style="height:50px; border: 0px solid red;"></div>
            <div class="flex flex-col md:flex-row justify-between items-center text-gray-900 py-4 px-5 absolute inset-x-0 bottom-0 h-16">
              <p class="font-bold text-xl">${{ product.price }}</p>
              <button class="px-4 py-1 transition ease-in duration-200 rounded-full hover:bg-gray-800 hover:text-white border-2 border-gray-900 focus:outline-none">
                Add to cart
              </button>
            </div>
          </div>
        </div>
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