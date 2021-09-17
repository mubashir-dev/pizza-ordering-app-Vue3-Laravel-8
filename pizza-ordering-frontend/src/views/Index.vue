<template>
  <h1>Home Page</h1>
</template>

<script>
export default {
  name: 'Home Page',
  components: {},
  data () {
    return {
      pizza: {},
      PizzaCategories: []
    }
  }
  // created () {
  //   this.axios
  //     .get(
  //       'http://localhost/pizza-ordering-app-Vue3-Laravel-8-/pizza-ordering-backend/public/api/categories'
  //     )
  //     .then((response) => {
  //       this.PizzaCategories = response.data
  //     })
  //     .catch((error) => {
  //       this.errors = error
  //       console.log(this.errors)
  //     })
  //     .finally(() => (this.loading = false))
  //   // Fetching Pizza Data
  //   this.axios
  //     .get(
  //       // eslint-disable-next-line quotes
  //       `http://localhost/pizza-ordering-app-Vue3-Laravel-8-/pizza-ordering-backend/public/api/Pizza/${this.$route.params.id}`
  //     )
  //     .then((response) => {
  //       this.pizza = response.data.pizza
  //     })
  //     .catch((error) => {
  //       this.errors = error
  //       console.log(this.errors)
  //     })
  //     .finally(() => (this.loading = false))
  // },
  // methods: {
  //   editPizza () {
  //     // const formData = new FormData()
  //     // formData.append('title', this.pizza.title)
  //     // formData.append('ingredients', this.pizza.ingredients)
  //     // formData.append('pizza_category_id', this.pizza.pizza_category_id)
  //     // formData.append('description', this.pizza.description)
  //     // formData.append('price', this.pizza.price)
  //     // formData.append('tax', this.pizza.tax)
  //     // formData.append('photo_url', this.pizza.photo_url)
  //     this.axios
  //       .put(
  //         `http://localhost/pizza-ordering-app-Vue3-Laravel-8-/pizza-ordering-backend/public/api/Pizza/${this.$route.params.id}`,
  //         this.pizza
  //       )
  //       .then((response) => {
  //         console.log(response)
  //         if (response.status === 200) {
  //           this.$router.push('/pizzas')
  //         }
  //       })
  //       .catch((error) => {
  //         this.errors = error
  //         console.log(this.errors)
  //       })
  //       .finally(() => (this.loading = false))
  //   }
  // }
}
</script>
