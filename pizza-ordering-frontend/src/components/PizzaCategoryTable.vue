<template>
  <table>
    <thead>
      <tr>
        <th v-if="checkable"></th>
        <th>#</th>
        <th>Title</th>
        <th>Description</th>
        <th>Created</th>
        <th>Updated</th>
        <th>Actions</th>
      </tr>
    </thead>
    <tbody>
      <tr v-for="category in pizza_categories" :key="category.id">
        <td data-label="id">{{ category.id }}</td>
        <td data-label="Name">{{ category.title }}</td>
        <td data-label="Company">{{ category.description }}</td>
        <td data-label="Created">
          <small class="text-gray-500" :title="category.created_at">
            {{ category.created_at }}</small
          >
        </td>
         <td data-label="Created">
          <small class="text-gray-500" :title="category.updated_at">
            {{ category.updated_at }}</small
          >
        </td>
        <td class="actions-cell">
          <jb-buttons type="justify-start" no-wrap>
            <jb-button
              class="mr-3"
              color="success"
              :icon="mdiBookEdit"
              small
              @click="editCategory(category.id)"
            />
            <jb-button
              color="danger"
              :icon="mdiTrashCan"
              small
              @click="deleteCategory(category.id)"
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
      pizza_categories: []
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
        'http://localhost/pizza-ordering-app-Vue3-Laravel-8-/pizza-ordering-backend/public/api/PizzaCategory'
      )
      .then((response) => {
        this.pizza_categories = response.data.PizzaCategories
      })
      .catch((error) => console.log(error))
      .finally(() => (this.loading = false))
  },
  methods: {
    deleteCategory (id) {
      this.axios
        .delete(`http://localhost/pizza-ordering-app-Vue3-Laravel-8-/pizza-ordering-backend/public/api/PizzaCategory/${id}`)
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
