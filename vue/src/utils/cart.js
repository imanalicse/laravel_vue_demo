import localStore from "./storage";

const cart = Object.create(null, {
  getCart: {
    value: key => {
      return localStore.get('cart');
    }
  },
  addToCart: {
    value: (productId, qty = 1) => {
      let cart = localStore.get('cart');
      if (cart && cart['products']) {
        let products = cart['products'];
        let exist_product_index = -1;
        for (let i = 0; i < products.length; i++) {
          if (products[i].productId == productId) {
            exist_product_index = i;
          }
        }
        if (exist_product_index > -1) {
          products[exist_product_index]['quantity'] = products[exist_product_index]['quantity'] + qty;
        }
        else {
          products.push({
            productId: productId,
            quantity: qty
          })
        }
        cart['products'] = products;
      }
      else {
        cart = {};
        cart['products'] = [{
          productId: productId,
          quantity: qty
        }]
      }
      localStore.set('cart', cart);
      console.log("cart", localStore.get('cart'));
    },
  },
  removeItem: {
    value: key => {
      console.log('removeItem')
    },
  },
  clear: {
    value: key => {
      localStore.remove('cart')
    }
  }
})


export default cart;