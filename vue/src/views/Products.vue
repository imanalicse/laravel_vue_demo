<template>
  <PageComponent>
    <template v-slot:header>
       <div class="flex justify-between items-center">
          <h1 class="text-3xl font-bold text-gray-900">Products</h1>
       </div>
       <br>

       <div class="product_container grid grid-cols-4 gap-4">
          <div v-for="product in products" :key="product.id" v-bind:id="product.id" class="product_item relative card flex flex-col justify-center2 p-5 bg-white rounded-lg shadow-2xl">
            <div class="prod-title">
              <p class="text-2xl text-gray-900 font-bold">{{ product.name }}</p>
            </div>
            <div class="prod-img">
                   <img :src=product.image class="w-full object-cover object-center">
            </div>
            <div style="height:50px; border: 0px solid red;"></div>
            <div class="flex flex-col md:flex-row justify-between items-center text-gray-900 py-4 px-5 absolute inset-x-0 bottom-0 h-16">
              <p class="font-bold text-xl">${{ product.price }}</p>
              <button @click.prevent="addToCart(product.id, $event)" class="js_add_to_cart px-4 py-1 transition ease-in duration-200 rounded-full hover:bg-gray-800 hover:text-white border-2 border-gray-900 focus:outline-none">
                Add to cart
              </button>
              <div class="js_amount_in_cart d-none">
                <button class="minus" @click.prevent="minusCartQuantity(product.id, $event)">-</button>
                <span>&nbsp;&nbsp; <span class="qty" contenteditable="true"> 1 </span> in cart &nbsp;&nbsp; </span>
                <button class="plus" @click.prevent="plusCartQuantity(product.id, $event)">+</button>
              </div>
            </div>
          </div>
        </div>
    </template>
  </PageComponent>
</template>

<script>
import PageComponent from "../components/PageComponent.vue"
import axiosClient from "../axios";
import cart from '../utils/cart';
import localStore from '../utils/storage';

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
                let _self = this;
                setTimeout(function () {
                  _self.mappingCart();
                }, 100)
           })
           .catch(err => {
              console.log(err);
           });
        },
        addToCart(productId, $event) {
           cart.addToCart(productId);
           $event.target.classList.add("d-none")
           $event.target.nextSibling.classList.remove("d-none");
        },
        plusCartQuantity(productId, $event) {
           cart.addToCart(productId, 1);
          $event.target.parentElement.querySelector(".qty").textContent = this.getCartQtyByProductId(productId);
        },
        minusCartQuantity(productId, $event) {
           cart.addToCart(productId, -1);
           $event.target.parentElement.querySelector(".qty").textContent = this.getCartQtyByProductId(productId);
        },
        getCartQtyByProductId(productId) {
          const products = cart.getCart()['products'];
           let quantity_count = 0;
           for (let i = 0; i < products.length; i++) {
            if (products[i].productId == productId) {
              quantity_count = products[i].quantity;
            }
          }
          return quantity_count;
        },
        mappingCart() {
          const products = cart.getCart()['products'];
            document.querySelectorAll(".product_container .product_item").forEach(productElement => {
              const productId = productElement.getAttribute('id');
              for (let i = 0; i < products.length; i++) {
                  if (products[i].productId == productId) {
                    productElement.querySelector(".js_add_to_cart").classList.add("d-none");
                    productElement.querySelector(".js_amount_in_cart").classList.remove("d-none");
                    productElement.querySelector(".qty").textContent = products[i].quantity;
                  }
                }
            })
        }
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
.d-none {
  display: none;
}
input.qty {
  width: 20px;
  color: #ffffff;
}
</style>