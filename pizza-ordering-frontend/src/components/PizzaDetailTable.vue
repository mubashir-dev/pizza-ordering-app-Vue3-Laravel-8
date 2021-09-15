<template>
     <card-component :icon="mdiMonitorCellphone" title="Pizza Image" has-table>
             <div class="image">
          <img :src="pizza.photo" class="w-100 md:w-32 lg:w-48">
        </div>
    </card-component>
    <card-component :icon="mdiMonitorCellphone" title="Pizza Detail" has-table>
       <table>
    <thead>
      <tr>
        <th v-if="checkable"></th>
        <th>#</th>
        <th>Title</th>
        <th>Category</th>
        <th>Description</th>
        <th>Created</th>
        <th>Updated</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td data-label="id">{{ pizza.id }}</td>
        <td data-label="Name">{{ pizza.title }}</td>
        <td data-label="Company">{{ pizza.pizza_category }}</td>
        <!-- <td data-label="Company">{{ pizza.ingredients }}</td> -->
        <td data-label="Company">{{ pizza.description }}</td>
        <td data-label="Created">
          <small class="text-gray-500" :title="pizza.created_at">
            {{ pizza.created_at }}</small
          >
        </td>
        <td data-label="Created">
          <small class="text-gray-500" :title="pizza.updated_at">
            {{ pizza.updated_at }}</small
          >
        </td>
      </tr>
    </tbody>
  </table>
    </card-component>
    <card-component :icon="mdiMonitorCellphone" title="Pizza Ingredients" has-table>
              {{pizza.ingredients}}
    </card-component>
</template>

<script>
// eslint-disable-next-line no-unused-vars
import { mdiBookEdit, mdiTrashCan, mdiBullseye } from '@mdi/js'
import CardComponent from '@/components/CardComponent'

export default {
  name: 'PizzadTable',
  components: {
    CardComponent
  },
  props: {
    checkable: Boolean
  },
  data () {
    return {
      pizza: []
    }
  },
  setup () {
    return {
      mdiBookEdit,
      mdiTrashCan,
      mdiBullseye
    }
  },
  created () {
    this.axios
      .get(
        `http://localhost/pizza-ordering-app-Vue3-Laravel-8-/pizza-ordering-backend/public/api/Pizza/${this.$route.params.id}`
      )
      .then((response) => {
        this.pizza = response.data.pizza
      })
      .catch((error) => console.log(error))
      .finally(() => (this.loading = false))
  },
  methods: {
    deletePizza (id) {
      this.axios
        .delete(
          `http://localhost/pizza-ordering-app-Vue3-Laravel-8-/pizza-ordering-backend/public/api/PizzaCategory/${id}`
        )
        .then((response) => {
          // eslint-disable-next-line eqeqeq
          if (response.data.status == 409) {
            alert(response.data.message)
          } else {
            alert(response.data.message)
            this.axios
              .get(
                'http://localhost/pizza-ordering-app-Vue3-Laravel-8-/pizza-ordering-backend/public/api/PizzaCategory'
              )
              .then((response) => {
                this.pizza_categories = response.data.PizzaCategories
              })
              .catch((error) => console.log(error))
              .finally(() => (this.loading = false))
          }
          //
        })
        .catch((error) => {
          console.log(error)
        })
        .finally(() => (this.loading = false))
    },
    editPizza (id) {
      this.$router.push({
        path: `/edit-category/${id}`
      })
    },
    viewPizza (id) {
      this.$router.push({
        path: `/pizza-detail/${id}`
      })
    }
  }
}
</script>
