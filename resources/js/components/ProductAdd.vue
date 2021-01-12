<template>
  <div> 
    <h1>Add a new product</h1>
    <button @click="isOpen = !isOpen">ADD NEW PRODUCT TOGGLE</button>

    <form v-show="isOpen" @submit.prevent="storeProduct">
        <!-- form 2xx -->
        <div v-if="status != null" class="done">
          Done
        </div>
        <!-- form errors -->
        <div v-if="errors.length != 0" class="error">
          <div v-for="(v, k) in errors" :key="k">
            <b>+ {{k}}</b>
            <p v-for="error in v" :key="error" class="text-sm"> - {{ error }}</p>
          </div>
        </div>
        <!-- form inputs -->
        <input type="text" placeholder="Name" v-model="name"/><br/>
        <input type="text" placeholder="Description" v-model="description"/><br/>
        <input type="number" step="0.01" placeholder="Price" v-model="price"/><br/>
        <input type="file" placeholder="Image" ref="image" @change="handleImageUpload()" /><br/>
        
        <select  multiple="multiple" v-model="formCategories"><br/>
            <option v-for="cat in categories" :key="cat.id" :value="cat.id">{{cat.name}}</option>
        </select><br/>
        <button type="submit">SAVE PRODUCT</button>
    </form>
  </div>
</template>

<script>
  import {mapGetters} from "vuex";

  export default {
    name: 'product-add',
    data() {
      return {
        // show adding form or not
        isOpen: false,
        
        // form filling variables
        name: "",
        description: "",
        price: "",
        image: null,
        formCategories:[],
        
      };
    }, 
    mounted() {
      this.$store.dispatch("fetchCategories");
    },
    computed: {
        ...mapGetters({
            categories: "categories",
            errors: "errors",
            status: "status"
        })
    },
    methods: {
      handleImageUpload(){
        this.image = this.$refs.image.files[0];
      },
      storeProduct(){
        const data = new FormData();
        data.append('name', this.name);
        data.append('description', this.description);
        data.append('price', this.price);
        data.append('categories', this.formCategories);
        data.append('image', this.image);

        this.$store.dispatch("storeProduct", data);
      }
    }
  }
</script>

<style>
form *{
  padding: 5px;
  margin: 2px;
}
.error {
  background-color: #f99;
  margin: 10px 0;
}
.done{
  background-color: green;
  margin: 10px 0;
}
</style>