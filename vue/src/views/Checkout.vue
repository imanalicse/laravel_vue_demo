<template>
  <PageComponent>
    <template v-slot:header>
       <div class="flex justify-between items-center">
          <h1 class="text-3xl font-bold text-gray-900">Checkout</h1>
       </div>
       <br>

    <main class="max-w-7xl mx-auto pt-16 pb-24 px-4 sm:px-6 lg:px-8">
      <div class="max-w-2xl mx-auto lg:max-w-none">
        <h1 class="sr-only">Checkout</h1>

        <form class="lg:grid lg:grid-cols-2 lg:gap-x-12 xl:gap-x-16">
          <div>
            <div>
              <h2 class="text-lg font-medium text-gray-900">Contact information</h2>

              <div class="mt-4">
                <label for="email-address" class="block text-sm font-medium text-gray-700">Email address</label>
                <div class="mt-1">
                  <input type="email" id="email-address" name="email-address" autocomplete="email" class="block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                </div>
              </div>
            </div>

            <div class="mt-10 border-t border-gray-200 pt-10">
              <h2 class="text-lg font-medium text-gray-900">Shipping information</h2>

              <div class="mt-4 grid grid-cols-1 gap-y-6 sm:grid-cols-2 sm:gap-x-4">
                <div>
                  <label for="first-name" class="block text-sm font-medium text-gray-700">First name</label>
                  <div class="mt-1">
                    <input type="text" id="first-name" name="first-name" autocomplete="given-name" class="block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                  </div>
                </div>

                <div>
                  <label for="last-name" class="block text-sm font-medium text-gray-700">Last name</label>
                  <div class="mt-1">
                    <input type="text" id="last-name" name="last-name" autocomplete="family-name" class="block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                  </div>
                </div>

                <div class="sm:col-span-2">
                  <label for="company" class="block text-sm font-medium text-gray-700">Company</label>
                  <div class="mt-1">
                    <input type="text" name="company" id="company" class="block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                  </div>
                </div>

                <div class="sm:col-span-2">
                  <label for="address" class="block text-sm font-medium text-gray-700">Address</label>
                  <div class="mt-1">
                    <input type="text" name="address" id="address" autocomplete="street-address" class="block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                  </div>
                </div>

                <div class="sm:col-span-2">
                  <label for="apartment" class="block text-sm font-medium text-gray-700">Apartment, suite, etc.</label>
                  <div class="mt-1">
                    <input type="text" name="apartment" id="apartment" class="block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                  </div>
                </div>

                <div>
                  <label for="city" class="block text-sm font-medium text-gray-700">City</label>
                  <div class="mt-1">
                    <input type="text" name="city" id="city" autocomplete="address-level2" class="block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                  </div>
                </div>

                <div>
                  <label for="country" class="block text-sm font-medium text-gray-700">Country</label>
                  <div class="mt-1">
                    <select id="country" name="country" autocomplete="country-name" class="block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                      <option>United States</option>
                      <option>Canada</option>
                      <option>Mexico</option>
                    </select>
                  </div>
                </div>

                <div>
                  <label for="region" class="block text-sm font-medium text-gray-700">State / Province</label>
                  <div class="mt-1">
                    <input type="text" name="region" id="region" autocomplete="address-level1" class="block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                  </div>
                </div>

                <div>
                  <label for="postal-code" class="block text-sm font-medium text-gray-700">Postal code</label>
                  <div class="mt-1">
                    <input type="text" name="postal-code" id="postal-code" autocomplete="postal-code" class="block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                  </div>
                </div>

                <div class="sm:col-span-2">
                  <label for="phone" class="block text-sm font-medium text-gray-700">Phone</label>
                  <div class="mt-1">
                    <input type="text" name="phone" id="phone" autocomplete="tel" class="block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                  </div>
                </div>
              </div>
            </div>

            <div class="mt-10 border-t border-gray-200 pt-10">
              <fieldset>
                <legend class="text-lg font-medium text-gray-900">Delivery method</legend>

                <div class="mt-4 grid grid-cols-1 gap-y-6 sm:grid-cols-2 sm:gap-x-4">
                  <!--
                    Checked: "border-transparent", Not Checked: "border-gray-300"
                    Active: "ring-2 ring-indigo-500"
                  -->
                  <label class="relative bg-white border rounded-lg shadow-sm p-4 flex cursor-pointer focus:outline-none">
                    <input type="radio" name="delivery-method" value="Standard" class="sr-only" aria-labelledby="delivery-method-0-label" aria-describedby="delivery-method-0-description-0 delivery-method-0-description-1">
                    <div class="flex-1 flex">
                      <div class="flex flex-col">
                        <span id="delivery-method-0-label" class="block text-sm font-medium text-gray-900"> Standard </span>
                        <span id="delivery-method-0-description-0" class="mt-1 flex items-center text-sm text-gray-500"> 4–10 business days </span>
                        <span id="delivery-method-0-description-1" class="mt-6 text-sm font-medium text-gray-900"> $5.00 </span>
                      </div>
                    </div>
                    <!--
                      Not Checked: "hidden"

                      Heroicon name: solid/check-circle
                    -->
                    <svg class="h-5 w-5 text-indigo-600" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                      <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                    </svg>
                    <!--
                      Active: "border", Not Active: "border-2"
                      Checked: "border-indigo-500", Not Checked: "border-transparent"
                    -->
                    <div class="absolute -inset-px rounded-lg border-2 pointer-events-none" aria-hidden="true"></div>
                  </label>

                  <!--
                    Checked: "border-transparent", Not Checked: "border-gray-300"
                    Active: "ring-2 ring-indigo-500"
                  -->
                  <label class="relative bg-white border rounded-lg shadow-sm p-4 flex cursor-pointer focus:outline-none">
                    <input type="radio" name="delivery-method" value="Express" class="sr-only" aria-labelledby="delivery-method-1-label" aria-describedby="delivery-method-1-description-0 delivery-method-1-description-1">
                    <div class="flex-1 flex">
                      <div class="flex flex-col">
                        <span id="delivery-method-1-label" class="block text-sm font-medium text-gray-900"> Express </span>
                        <span id="delivery-method-1-description-0" class="mt-1 flex items-center text-sm text-gray-500"> 2–5 business days </span>
                        <span id="delivery-method-1-description-1" class="mt-6 text-sm font-medium text-gray-900"> $16.00 </span>
                      </div>
                    </div>
                    <!--
                      Not Checked: "hidden"

                      Heroicon name: solid/check-circle
                    -->
                    <svg class="h-5 w-5 text-indigo-600" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                      <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                    </svg>
                    <!--
                      Active: "border", Not Active: "border-2"
                      Checked: "border-indigo-500", Not Checked: "border-transparent"
                    -->
                    <div class="absolute -inset-px rounded-lg border-2 pointer-events-none" aria-hidden="true"></div>
                  </label>
                </div>
              </fieldset>
            </div>

            <!-- Payment -->
            <div class="mt-10 border-t border-gray-200 pt-10">
              <h2 class="text-lg font-medium text-gray-900">Payment</h2>

              <fieldset class="mt-4">
                <legend class="sr-only">Payment type</legend>
                <div class="space-y-4 sm:flex sm:items-center sm:space-y-0 sm:space-x-10">
                  <div class="flex items-center">
                    <input id="credit-card" name="payment-type" type="radio" checked class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300">
                    <label for="credit-card" class="ml-3 block text-sm font-medium text-gray-700"> Credit card </label>
                  </div>

                  <div class="flex items-center">
                    <input id="paypal" name="payment-type" type="radio" class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300">
                    <label for="paypal" class="ml-3 block text-sm font-medium text-gray-700"> PayPal </label>
                  </div>

                  <div class="flex items-center">
                    <input id="etransfer" name="payment-type" type="radio" class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300">
                    <label for="etransfer" class="ml-3 block text-sm font-medium text-gray-700"> eTransfer </label>
                  </div>
                </div>
              </fieldset>

              <div class="mt-6 grid grid-cols-4 gap-y-6 gap-x-4">
                <div class="col-span-4">
                  <label for="card-number" class="block text-sm font-medium text-gray-700">Card number</label>
                  <div class="mt-1">
                    <input type="text" id="card-number" name="card-number" autocomplete="cc-number" class="block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                  </div>
                </div>

                <div class="col-span-4">
                  <label for="name-on-card" class="block text-sm font-medium text-gray-700">Name on card</label>
                  <div class="mt-1">
                    <input type="text" id="name-on-card" name="name-on-card" autocomplete="cc-name" class="block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                  </div>
                </div>

                <div class="col-span-3">
                  <label for="expiration-date" class="block text-sm font-medium text-gray-700">Expiration date (MM/YY)</label>
                  <div class="mt-1">
                    <input type="text" name="expiration-date" id="expiration-date" autocomplete="cc-exp" class="block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                  </div>
                </div>

                <div>
                  <label for="cvc" class="block text-sm font-medium text-gray-700">CVC</label>
                  <div class="mt-1">
                    <input type="text" name="cvc" id="cvc" autocomplete="csc" class="block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                  </div>
                </div>
              </div>
            </div>
          </div>

          <!-- Order summary -->
          <div class="mt-10 lg:mt-0">
            <h2 class="text-lg font-medium text-gray-900">Order summary</h2>

            <div class="mt-4 bg-white border border-gray-200 rounded-lg shadow-sm">
              <h3 class="sr-only">Items in your cart</h3>
              <ul role="list" class="divide-y divide-gray-200">
                <li v-for="product in products" :key="product.id" class="flex py-6 px-4 sm:px-6">
                  <div class="flex-shrink-0">
                    <img :src=product.image class="w-20 rounded-md">
                  </div>

                  <div class="ml-6 flex-1 flex flex-col">
                    <div class="flex">
                      <div class="min-w-0 flex-1">
                        <h4 class="text-sm">
                          <a href="#" class="font-medium text-gray-700 hover:text-gray-800"> {{product.name}} </a>
                        </h4>
                      </div>

                      <div class="ml-4 flex-shrink-0 flow-root">
                        <button type="button" @click="removeFromCart(product.id)" class="-m-2.5 bg-white p-2.5 flex items-center justify-center text-gray-400 hover:text-gray-500">
                          <span class="sr-only">Remove</span>
                          <!-- Heroicon name: solid/trash -->
                          <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                            <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd" />
                          </svg>
                        </button>
                      </div>
                    </div>

                    <div class="flex-1 pt-2 flex items-end justify-between">
                      <p class="mt-1 text-sm font-medium text-gray-900"> ${{ product.price }} </p>
                      <div class="ml-4">
                         <label class="sr-only2">Quantity: {{ product.cart_qtry }}</label>
                      </div>
                    </div>
                  </div>
                </li>
                <!-- More products... -->
              </ul>
              <dl class="border-t border-gray-200 py-6 px-4 space-y-6 sm:px-6">
                <div class="flex items-center justify-between">
                  <dt class="text-sm">Subtotal</dt>
                  <dd class="text-sm font-medium text-gray-900">$64.00</dd>
                </div>
                <div class="flex items-center justify-between">
                  <dt class="text-sm">Shipping</dt>
                  <dd class="text-sm font-medium text-gray-900">$5.00</dd>
                </div>
                <div class="flex items-center justify-between">
                  <dt class="text-sm">Taxes</dt>
                  <dd class="text-sm font-medium text-gray-900">$5.52</dd>
                </div>
                <div class="flex items-center justify-between border-t border-gray-200 pt-6">
                  <dt class="text-base font-medium">Total</dt>
                  <dd class="text-base font-medium text-gray-900">$75.52</dd>
                </div>
              </dl>

              <div class="border-t border-gray-200 py-6 px-4 sm:px-6">
                <button type="submit" class="w-full bg-indigo-600 border border-transparent rounded-md shadow-sm py-3 px-4 text-base font-medium text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-gray-50 focus:ring-indigo-500">Confirm order</button>
              </div>
            </div>
          </div>
        </form>
      </div>
    </main>

    </template>
  </PageComponent>
</template>

<script>
import PageComponent from "../components/PageComponent.vue"
import cart from '../utils/cart';
import axiosClient from "../axios";

export default {
     components: {
      PageComponent
    },
    data() {
        return {
            products: [],
        }
    },
    created() {
    },
    mounted() {
      this.loadCartInfo();
    },
    methods: {
      loadCartInfo() {
        const cartData = cart.getCart();
          if (cartData && cartData['products']) {
              const cart_products = cartData['products'];
              const productIds = this.extractColumn(cart_products, 'productId');
              axiosClient.post('/products_by_ids', {
                productIds: productIds
              })
             .then((resp) => {
                  const data = resp.data.data.data;
                  if (data && data.length > 0) {
                      this.products = data.map((p, i, productIds) => {
                        p.cart_qtry = 1;
                        cart_products.forEach(cart_product => {
                            if (cart_product.productId === p.id) {
                                p.cart_qtry = cart_product.quantity;
                            }
                        })
                        return p;
                      });
                  }
             })
             .catch(err => {
                console.log(err);
             });
          }
        },
        extractColumn(arr, column) {
          return arr.map(x => x[column])
        },
        removeFromCart(productId) {
            const cartData = cart.removeProduct(productId);
            setTimeout(() => this.loadCartInfo(), 500)
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