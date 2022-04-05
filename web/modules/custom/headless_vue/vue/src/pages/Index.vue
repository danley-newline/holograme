<template>
  <div>
    <div class="container">
      <div class="text-center">
        <titre-home :title="'Page d\'accueil start'"></titre-home>
      </div>
      <!-- Search info -->
      <div class="w-25">
        <input
          type="search"
          class="form-control mb-2"
          placeholder="Rechercher..."
          autocomplete="off"
          v-model="searchKey"
        />

        <span v-if="searchKey && filteredList.length > 0">
          {{ filteredList.length }} résultat<span v-if="filteredList.length > 1">s</span
          >
        </span>
        <span v-if="searchKey && filteredList.length == 0">
          <h4>Désolé</h4>
          aucun résultat trouvé
        </span>
      </div>

      <!-- cards -->
      <div class="row">
        <div class="col-md-3" v-for="(product, num) in filteredList" :key="num">
          <div class="card text-center m-3">
            <div class="">
              <img
                :src="require(`../assets/img/${product.img}`)"
                class="w-100"
                alt=""
              />
            </div>
            <div class="card-text d-flex px-2 justify-content-between">
              <h3 class="mr-2">{{ product.description }}</h3>
              <span>{{ product.price }}$</span>
            </div>
            <div class="card-icons px-4 d-flex justify-content-between">
              <div class="like-container">
                <input
                  type="checkbox"
                  class="input-check"
                  name="checkbox"
                  :id="product.id"
                  v-model="liked"
                  :value="product.id"
                  @click="setLikeCookie"
                />
                <label :for="product.id">
                  <b-icon icon="heart-fill"></b-icon>
                </label>
              </div>
              <div class="add-to-cart">
                <button @click="addTocart(product)">
                  <b-icon icon="cart-fill"></b-icon>
                </button>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!--CART DISPLAY -->
      <div v-if="cart.length > 0" class="shopping-cart" id="shopping-cart">
        <h2>Panier</h2>
        <div class="item-group">
          <div
            v-for="(shop, index) in cart"
            :key="index"
            class="item m-2 relatif-cart-bloc"
              >
            <div class="img-container">
              <img :src="require(`../assets/img/${shop.img}`)" alt="" />
            </div>
            <div class="item-description-cart">
              <h4>
                {{ shop.description }} <span class="price-cart">{{ shop.price }}£</span>
              </h4>
              <span>quantité : {{ shop.quantity }}</span>
              <span class="icon-place">
              <button @click="cartPlusOne(shop)">
                <b-icon icon="plus-circle-fill"></b-icon>
              </button>
              <button @click="cartMinusOne(shop,index)">
                <b-icon icon="patch-minus-fill"></b-icon>
              </button>
              <button @click="cartRemoveItem(index)">
                <b-icon icon="trash-fill"></b-icon>
              </button>
              
            </span>
            </div>
            
          </div> <hr>
          <div class="total-item d-flex justify-content-between">
            <div class="">
              <p>QUANTITE GLOBAL <br> <span>{{ cartTotalQuantity }}</span></p>
            </div>
            <div class="">
              <p>PRIX TOTAL  <br><span>{{ cartTotalPrice }} euro</span></p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import TitreHome from "../components/TitreHome.vue";
export default {
  
  name: 'Index',
  data() {
    return {
      products: [
        {
          id: 1,
          description: "Quarz Luxe",
          price: 12,
          img: "quarz-luxe.png",
        },
        {
          id: 2,
          description: "Curren Business",
          price: 20,
          img: "curren-business.png",
        },
        {
          id: 3,
          description: "Curren Sport",
          price: 5,
          img: "curren-sport.png",
        },
        {
          id: 4,
          description: "Jaragar Racing",
          price: 8,
          img: "jaragar-racing.png",
        },
        {
          id: 5,
          description: "Liges Hommes",
          price: 3,
          img: "liges-hommes.png",
        },
        {
          id: 6,
          description: "Maserati Mechanical",
          price: 65,
          img: "maserati-mechanical.png",
        },
        {
          id: 7,
          description: "Montre Mecanique",
          price: 25,
          img: "montre-mecanique.png",
        },
        {
          id: 8,
          description: "Brand Designer",
          price: 28,
          img: "brand-designer.png",
        },
        {
          id: 9,
          description: "Relogio Masculino",
          price: 4,
          img: "relogio-masculino.png",
        },
        {
          id: 10,
          description: "Tissot Multifunction",
          price: 29,
          img: "tissot-multifunction.png",
        },
        {
          id: 11,
          description: "Hip Hop Gold",
          price: 87,
          img: "hiphop-gold.png",
        },
        {
          id: 12,
          description: "Mesh Genova",
          price: 6,
          img: "mesh-genova.png",
        },
      ],
      searchKey: "",
      liked: [],
      cart: [],
    };
  },
  components: {
    TitreHome,
  },
  computed: {
    filteredList() {
      return this.products.filter((item) => {
        return item.description
          .toLowerCase()
          .includes(this.searchKey.toLowerCase());
      });
    },
    cartTotalQuantity(){
      let totalquantity = 0;
      for (let item in this.cart) {
        totalquantity = totalquantity + (this.cart[item].quantity);
      }
      return totalquantity;
    },
    cartTotalPrice(){
      let totalitem = 0;
      for(let item in this.cart){
        totalitem = totalitem + (this.cart[item].price * this.cart[item].quantity);
      }
      return totalitem;
    }
  },
  methods: {
    setLikeCookie() {
      document.addEventListener("input", () => {
        setTimeout(() => {
          this.$cookies.set("like", JSON.stringify(this.liked));
        }, 300);
      });
    },
    getLikeCookie() {
      let cookievalue = JSON.parse(this.$cookies.get("like"));
      cookievalue == null ? (this.liked = []) : (this.liked = cookievalue);
    },
    addTocart(event) {
      //check if is already in array
      for (let i = 0; i < this.cart.length; i++) {
        if (this.cart[i].id === event.id) {
            return this.cart[i].quantity++;
        }
      }
      this.cart.push({
        id: event.id,
        img: event.img,
        description: event.description,
        price: event.price,
        quantity: 1,
      });
    },
    cartPlusOne(event){
      event.quantity = event.quantity +1;
    },
    cartMinusOne(event, id){
      if (event.quantity == 1) {
        this.cartRemoveItem(id);
      }else{
        event.quantity = event.quantity -1;

      }
    }
    ,
    cartRemoveItem(event){
      this.$delete(this.cart, event)
    },
    
  },

  mounted() {
    this.getLikeCookie();
  },
};
</script>

<style scoped>
.icon-place{
  margin-left: 1rem;
}
.icon-place button {
    margin: 0 0.2rem !important;
    color: #fff !important;
}
.icon-place button:hover{
  color: #000 !important;
}
.price-cart {
    margin-left: 1rem;
    color: #ea4747;
    font-size: 23px;
    text-shadow: 1px 1px 1px #000;
}
.shopping-cart {
  padding: 2rem 1rem;
  width: 30%;
  background: #069cd6;
  border-radius: 10px;
  color: #fff;
  font-weight: bold;
  position: fixed;
  top: 6rem;
  right: 0;
  animation: slashmac 0.4s linear;
}
@keyframes slashmac {
  0%{
    transform: translateX(400px);
  }
}
.shopping-cart .img-container {
  width: 30%;
}
.shopping-cart img {
  width: 80%;
  border-radius: 50%;
}
.relatif-cart-bloc {
  position: relative;
}
.item-description-cart {
  position: absolute;
  top: 0;
  right: 2rem;
}
.input-check {
  display: none;
}
input[type="checkbox"]:checked + label {
  color: #ff004c;
}
h3 {
  font-size: 20px;
}
</style>