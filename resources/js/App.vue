<template>
  <div> 
    <header>
      <h1><i>Software Engineer - Coding challenge</i></h1>
    </header>
    
    <main>
      <!-- new product component -->
      <product-add></product-add> 
      <!-- products list component -->
      <products-list></products-list>
    </main>

    <footer>
      <h1><i>MADE WITH/FROM &lt;3</i></h1>
    </footer>
  </div>
</template>

<script>
  import Vue from 'vue';
  
  import ProductAdd from './components/ProductAdd';
  import ProductsList from './components/ProductsList';
  
  Vue.component(ProductAdd.name, ProductAdd);
  Vue.component(ProductsList.name, ProductsList);
  export default {

  }
</script>

<style>
  body{
    background-color:#565656;
  }
  main{
    background-color: #ccc;
    padding: 10px;
  }
</style>