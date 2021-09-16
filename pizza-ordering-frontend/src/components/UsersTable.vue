<template>
  <table>
    <thead>
      <tr>
        <th v-if="checkable"></th>
        <th>#</th>
        <th>Name</th>
        <th>Email</th>
        <th>Registered At</th>
        <th>Actions</th>
      </tr>
    </thead>
    <tbody>
      <tr v-for="user in users" :key="user.id">
        <td data-label="id">{{ user.id }}</td>
        <td data-label="Name">{{ user.name }}</td>
        <td data-label="Company">{{ user.email }}</td>
        <td data-label="Company">{{ user.created_at }}</td>
        <td class="actions-cell">
          <jb-buttons type="justify-start" no-wrap>
            <jb-button
              class="mr-3"
              color="success"
              :icon="mdiBookEdit"
              small
              @click="editPizza(user.id)"
            />
            <jb-button
              color="danger"
              :icon="mdiTrashCan"
              small
              @click="deleteUser(user.id)"
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
  name: 'PizzadTable',
  components: {
    JbButtons,
    JbButton
  },
  props: {
    checkable: Boolean
  },
  data () {
    return {
      users: []
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
        'http://localhost/pizza-ordering-app-Vue3-Laravel-8-/pizza-ordering-backend/public/api/users'
      )
      .then((response) => {
        this.users = response.data.users_list
      })
      .catch((error) => console.log(error))
      .finally(() => (this.loading = false))
  },
  methods: {
    deleteUser (id) {
      this.axios
        .delete(
          `http://localhost/pizza-ordering-app-Vue3-Laravel-8-/pizza-ordering-backend/public/api/users/${id}`
        )
        .then((response) => {
          // eslint-disable-next-line eqeqeq
          if (response.data.status == 409) {
            alert(response.data.message)
          } else {
            alert(response.data.message)
            this.axios
              .get(
                'http://localhost/pizza-ordering-app-Vue3-Laravel-8-/pizza-ordering-backend/public/api/users'
              )
              .then((response) => {
                this.users = response.data.users_list
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
        path: `/edit-user/${id}`
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
