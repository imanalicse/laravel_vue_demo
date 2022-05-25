<template xmlns="http://www.w3.org/1999/html">
  <PageComponent>
      <template v-slot:header>
          <div class="flex items-center justify-between">
              <h1 class="text-3xl font-bold text-gray-900">
                  {{ model.id ? model.title : 'Create a Product' }}
              </h1>
          </div>
      </template>
      <form @submit.prevent="saveProduct">
        <div class="shadow sm:rounded-md sm:overflow-hidden text-left">
          <div class="px-4 py-5 bg-white space-y-6 sm:px-6">
              <div class="col-span-6 sm:col-span-4">
                <label for="name" class="block text-sm text-left font-medium text-gray-700">Name</label>
                <input type="text" name="name" v-model="model.name" id="name" autocomplete="name" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" />
              </div>

               <div class="col-span-6 sm:col-span-4">
                <label for="description" class="block text-sm text-left font-medium text-gray-700">Description</label>
                 <textarea id="description" name="description" v-model="model.description" rows="3" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 mt-1 block w-full sm:text-sm border border-gray-300 rounded-md"
                 placeholder="" />
              </div>
              <div class="col-span-6 sm:col-span-4">
                <label for="price" class="block text-sm text-left font-medium text-gray-700">Price</label>
                <input type="text" name="price" v-model="model.price" id="price" autocomplete="price" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" />
              </div>

              <div class="px-4 py-3 bg-gray-50 text-right sm:px-6">
                <button type="submit" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                  Save
                </button>
              </div>

          </div>
        </div>
      </form>
  </PageComponent>
</template>

<script setup>
import PageComponent from "../components/PageComponent.vue";
import { ref } from "vue";
import {useRoute, useRouter} from "vue-router";
import store from "../store";
import axiosClient from "../axios";

const route = useRoute();
const router = useRouter();

let model = {
  name: '',
  description: '',
  price: 0,
};

// if (route.params.id) {
//   model.value = store.state.surveys.find(
//       (s) => s.id === parseInt(route.params.id)
//   );
// }

function saveProduct(ev) {
    axiosClient.post('/products', model)
     .then(({data}) => {
          console.log(data)
          router.push({
            name: 'Products'
          })
     });
  }

</script>

<style scoped>

</style>