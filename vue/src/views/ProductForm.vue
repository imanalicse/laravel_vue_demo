<template xmlns="http://www.w3.org/1999/html">
  <PageComponent>
      <template v-slot:header>
          <div class="flex items-center justify-between">
              <h1 class="text-3xl font-bold text-gray-900">
                  {{ pageTitle }}
              </h1>
          </div>
      </template>
      <form @submit.prevent="saveProduct" enctype="multipart/form-data" id="productForm">
        <div class="shadow sm:rounded-md sm:overflow-hidden text-left">
          <div class="px-4 py-5 bg-white space-y-6 sm:px-6">
              <div class="col-span-6 sm:col-span-4">
                <label for="name" class="block text-sm text-left font-medium text-gray-700">Name</label>
                <input type="text" name="name" v-model="model.name" id="name" autocomplete="name" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" />
              </div>

              <div class="col-span-6 sm:col-span-4">
                <label for="price" class="block text-sm text-left font-medium text-gray-700">Price</label>
                <input type="text" name="price" v-model="model.price" id="price" autocomplete="price" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" />
              </div>

              <div class="col-span-6 sm:col-span-4">
                <label for="description" class="block text-sm text-left font-medium text-gray-700">Description</label>
                 <textarea id="description" name="description" v-model="model.description" rows="3" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 mt-1 block w-full sm:text-sm border border-gray-300 rounded-md"
                 placeholder="" />
              </div>

              <div>
                <label class="block text-sm text-left font-medium text-gray-700"> Image </label>
                <div class="mt-1 flex items-center">
                  <img v-if="model.image" :src="model.image" :alt="model.name" class="w-64 h48 object-cover" />
                  <span v-else class="inline-block h-12 w-12 rounded-full overflow-hidden bg-gray-100">
                    <svg class="h-full w-full text-gray-300" fill="currentColor" viewBox="0 0 24 24">
                      <path d="M24 20.993V24H0v-2.996A14.977 14.977 0 0112.004 15c4.904 0 9.26 2.354 11.996 5.993zM16.002 8.999a4 4 0 11-8 0 4 4 0 018 0z" />
                    </svg>
                  </span>
                  <button type="button" class="relative ml-5 bg-white py-2 px-3 border border-gray-300 rounded-md shadow-sm text-sm leading-4 font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    Change
                    <input type="file" @change="onChangeFile($event)" class="absolute left-0 top-0 right-0 bottom-0 opacity-0 cursor-pointer">
                  </button>
                </div>
              </div>

              <!--Status-->
              <div class="flex items-start">
                <div class="flex items-center h-5">
                  <input id="status" name="status" type="checkbox" v-model="model.status" class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300 rounded" />
                </div>
                <div class="ml-3 text-sm">
                  <label for="status" class="font-medium text-gray-700">Active</label>
                </div>
              </div>


              <div class="px-4 py-3 bg-gray-50 text-right sm:px-6">
                <button type="button" @click.prevent="cancel" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-gray-500 hover:bg-gray-600">
                  Cancel
                </button> &nbsp;
                <button type="submit" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-blue-500 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                  Save
                </button>
              </div>

          </div>
        </div>
      </form>
  </PageComponent>
</template>

<script>
import PageComponent from "../components/PageComponent.vue";
import {useRouter} from "vue-router";
import axiosClient from "../axios";

export default {
     components: {
      PageComponent
    },
    data() {
        return {
            pageTitle: 'Create Product',
            model: {
              id: null,
              name: '',
              description: '',
              price: '',
              image: null
            },
            router: useRouter()
        }
    },
    created() {
    },
     mounted() {
      if (this.$route.params && this.$route.params.id) {
        this.pageTitle = 'Edit Product'
        let id = this.$route.params.id;
        axiosClient.get(`/products/${id}`)
         .then((resp) => {
            this.model = resp.data.data
         });
      }
    },
    methods: {
        onChangeFile(event) {
           this.model.image = event.target.files[0];
        },
        saveProduct(ev) {
          document.querySelectorAll(".validate_error").forEach(ele =>{
            ele.remove();
          });

          let fd = new FormData(document.getElementById('productForm'));
          fd.append('image', this.model.image);
          for (const keyValue of fd) {
            console.log(keyValue[0] + ': ',  keyValue[1]);
          }

          let action;
          if (this.$route.params && this.$route.params.id) {
               action = axiosClient.patch(`/products/${this.$route.params.id}`, fd);
          }
          else {
             action = axiosClient.post(`/products`, fd, {
                onUploadProgress: uploadEvent => {
                  console.log("Upload Progress: " + Math.round(uploadEvent.loaded / uploadEvent.total) * 100);
                }
             });
          }

          action
           .then(resp => {
                  this.afterSaveAction(resp);
                  console.log('response')
              },
              error => {
                console.log(error);
              }
           )
           .catch((err) => {
              console.log('catch error', err)
           });
        },
        cancel(e) {
           this.router.push({
                'name': "Products"
           })
        },
        afterSaveAction(resp) {
          if (resp.data.status === true) {
                this.router.push({
                  'name': "Products"
                })
              }
              else if (resp.data.status === false) {
                let errors = resp.data.message;
                Object.entries(errors).forEach(item => {
                  let field_name = item[0];
                  let error_msg = item[1][0];
                  let error = document.createElement('span');
                  error.classList.add("validate_error");
                  error.textContent = error_msg;
                  document.querySelector("input[name='"+ field_name +"'").parentElement.appendChild(error);
                });
              }
        }
    }
}

</script>

<style>
  .validate_error {
    color: red;
  }
</style>