<template>
  <table>
    <thead>
      <tr>
        <th v-if="checkable"></th>
        <th>#</th>
        <th>Photo</th>
        <th>Title</th>
        <th>Category</th>
        <th>Ingredients</th>
        <th>Description</th>
        <th>Created</th>
        <th>Updated</th>
        <th>Actions</th>
      </tr>
    </thead>
    <tbody>
      <tr v-for="pizza in pizzas" :key="pizza.id">
        <td class="image-cell">
          <div class="image">
            <img :src="pizza.photo_url" class="rounded-full" />
          </div>
        </td>
        <td data-label="id">{{ pizza.id }}</td>
        <td data-label="Name">{{ pizza.title }}</td>
        <td data-label="Company">{{ pizza.pizza_category_id }}</td>
        <td data-label="Company">{{ pizza.ingredients }}</td>
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
        <td class="actions-cell">
          <jb-buttons type="justify-start" no-wrap>
            <jb-button
              class="mr-3"
              color="success"
              :icon="mdiBookEdit"
              small
              @click="editCategory(pizza.id)"
            />
            <jb-button
              color="danger"
              :icon="mdiTrashCan"
              small
              @click="deleteCategory(pizza.id)"
            />
          </jb-buttons>
        </td>
      </tr>
    </tbody>
  </table>
  <!-- <div class="table-pagination">
    <level>
      <jb-buttons>
        <jb-button
          v-for="page in pagesList"
          @click="currentPage = page"
          :active="page === currentPage"
          :label="page + 1"
          :key="page"
          small
        />
      </jb-buttons>
      <small>Page {{ currentPageHuman }} of {{ numPages }}</small>
    </level>
  </div> -->
</template>

<script>
// eslint-disable-next-line no-unused-vars
import { mdiBookEdit, mdiTrashCan } from '@mdi/js'
import JbButtons from '@/components/JbButtons'
import JbButton from '@/components/JbButton'

export default {
  name: 'PizzaCategoriesTable',
  components: {
    JbButtons,
    JbButton
  },
  props: {
    checkable: Boolean
  },
  data () {
    return {
      pizzas: []
    }
  },
  setup () {
    return {
      mdiBookEdit,
      mdiTrashCan
    }
  },
  created () {
    this.axios
      .get(
        'http://localhost/pizza-ordering-app-Vue3-Laravel-8-/pizza-ordering-backend/public/api/Pizza'
      )
      .then((response) => {
        console.log(response.data.pizzas_list)
        this.pizzas = response.data.pizzas_list
      })
      .catch((error) => console.log(error))
      .finally(() => (this.loading = false))
  },
  methods: {
    deleteCategory (id) {
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
    editCategory (id) {
      this.$router.push({
        path: `/edit-category/${id}`
      })
    }
  }
}
</script>
