<template>
  <div> 
    <h1>Products</h1>
    <div>
      <h2>Filtering</h2>
      <div>
        <input type="checkbox" id="all" value="all" v-model="selectedCategories">
        <label for="all">All</label>
      </div>
      <div v-for="cat in categories" :key="cat.id" :value="cat.id">
        <input type="checkbox" :id="cat.id" :value="cat.id" v-model="selectedCategories">
        <label :for="cat.id">(#{{cat.id}}){{cat.name}}</label>
      </div>
    </div>

    <div>
      <h2>Sorting</h2>
      <button @click="isSortedN = -isSortedN; sortBy = 'name'">Sort by name (ASK/DESC)</button> 
      <button  @click="isSortedP = -isSortedP; sortBy = 'price'">Sort by price (ASK/DESC)</button>
    </div>
    <div>
      <h2>Result</h2>
      <ul>
        <li v-for="product in sortedProducts" :key="product.id">

          <h3>(#{{product.id}}){{ product.name }} </h3> <span><i>{{product.price}} DH</i></span> 
          
          <p>
            <b>Categories: </b>
            <span v-for="category in product.categories.names" >{{category}}; </span>
          </p>

          <img width="50px" height="50px" :src="product.image" :alt="product.image"/>
        </li>
      </ul>
    </div>
  </div>
</template>

<script>
    import {mapGetters} from "vuex";
    export default {
      name: 'products-list',
      data() {
        return {
          // inital data

          // used in filtering
          selectedCategories : ["all"],
          
          // used in sorting (N: name / P: price)
          sortBy:"name",
          // sorting order (ask disk)
          isSortedN : 1,
          isSortedP : 1,
          
        }
      },
      mounted() {
        this.$store.dispatch("fetchProducts");
      },
      computed: {
        ...mapGetters({
          products: "products",
          categories: "categories"
        }),
        sortedProducts(){
          let pro = this.products;

          // unselect all option when something else is selected
          if(this.selectedCategories.length > 1 && this.selectedCategories.includes("all") ){
            this.selectedCategories.splice("all")
          }

          // filtering
          if(!this.selectedCategories.includes("all") ){
            pro = pro.filter((p) => { return p.categories.ids.some(r=> this.selectedCategories.includes(r))!= 0 });
          }

          // sorting
          const comparator = (propName, askDesc) =>
            (p1, p2) => p1[propName] == p2[propName] ? 0 : p1[propName] > p2[propName] ?  askDesc : -askDesc
          
          if (this.sortBy == "name") {
            return  pro.sort(comparator('name',this.isSortedN))
          }

          if (this.sortBy == "price") {
            return  pro.sort(comparator('price', this.isSortedP))
          }
         
        }
      }
    }
</script>

<style>
  ul{
    list-style: none;
    padding: 0;
  }
  li{
    background-color: #f5f5f5;
    padding: 10px;
    margin: 5px;
    width: 46%;
    display: inline-block;
  }
</style>