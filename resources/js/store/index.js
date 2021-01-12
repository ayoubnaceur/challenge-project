import Vue from "vue";
import Vuex from "vuex";
import axios from "axios";

Vue.use(Vuex);
export default new Vuex.Store({

state: {
	products: [],
	categories: [],
	errors: [],
	status: null
},

getters: {
	products: state => state.products,
	categories: state => state.categories,
	errors: state => state.errors,
	status: state => state.status
},

mutations: {

	// fetching mutations

	fetchProductsSuccess(state, { products }) {
		state.products = products.data;
	},
	fetchCategoriesSuccess(state, { categories }) {
		state.categories = categories.data;
	},

	fetchProductSuccess(state, { product, status }) {
		state.products.push(product.data);
		state.status = status;
	},

	// error mutation
	fetchErrors(state, { errors }) {
		state.errors= errors.data.errors;
	},

	clearErrors(state) {
		if(state.errors != null)
		state.errors = null;
	}

},

actions: {

	// fetching data

	async fetchProducts({ commit }) {
		try {
			const { data } = await axios.get("/api/products");
			commit("fetchProductsSuccess", { products: data })
		} catch (err) {
			console.log(err)
		}
	},
	async fetchCategories({ commit }) {
		try {
			const { data } = await axios.get("/api/categories");
			commit("fetchCategoriesSuccess", { categories: data })
		} catch (err) {
			console.log(err)
		}
	},

	// storing the data

	async storeProduct({ commit }, data) {
		commit("clearErrors")
		await axios.post("/api/products", data).then(function (response) {
			commit("fetchProductSuccess", { product: response.data, status: response.status })
			console.log("Storing product... DONE")
		}).catch(function (error) {
			commit("fetchErrors", { errors: error.response })
		});
		
	}

}

});

