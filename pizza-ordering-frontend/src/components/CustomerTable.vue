<template>
  <table class="text-center">
    <thead>
      <tr>
        <th>#</th>
        <th>Name</th>
        <th>Order Placed</th>
        <th>City</th>
        <th>Mobile</th>
        <th>Address</th>
        <th>Order Placed Date</th>
        <th>Actions</th>
      </tr>
    </thead>
    <tbody>
      <tr v-for="customer in customers" :key="customer.id">
        <td data-label="id">{{ customer.id }}</td>
        <td data-label="Name">{{ customer.name }}</td>
        <td data-label="id"><span class="badge badge-success">{{ customer.orders }}</span></td>
        <td data-label="Company">{{ customer.city }}</td>
        <td data-label="Company">{{ customer.mobile }}</td>
        <td data-label="Company">{{ customer.address }}</td>
        <td data-label="Created">
          <small class="text-gray-500" :title="customer.created_at">
            {{ customer.created_at }}</small>
        </td>
        <!-- <td data-label="Created">
          <small class="text-gray-500" :title="customer.updated_at">
            {{ customer.updated_at }}</small>
        </td> -->
        <td class="actions-cell">
          <jb-buttons type="justify-start" no-wrap>
             <jb-button
              color="warning"
              :icon="mdiEye"
              small
              @click="viewPizza(customer.id)"
            />
            <!-- <jb-button
              class="mr-3"
              color="success"
              :icon="mdiBookEdit"
              small
              @click="editPizza(customer.id)"
            />
            <jb-button
              color="danger"
              :icon="mdiTrashCan"
              small
              @click="deletePizza(customer.id)"
            /> -->
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
import { mdiBookEdit, mdiTrashCan, mdiEye } from '@mdi/js'
import JbButtons from '@/components/JbButtons'
import JbButton from '@/components/JbButton'

export default {
  name: 'CustomerTable',
  components: {
    JbButtons,
    JbButton
  },
  props: {
    checkable: Boolean
  },
  data () {
    return {
      customers: []
    }
  },
  setup () {
    return {
      mdiBookEdit,
      mdiTrashCan,
      mdiEye
    }
  },
  created () {
    this.axios
      .get(
        'http://localhost/pizza-ordering-app-Vue3-Laravel-8-/pizza-ordering-backend/public/api/Customer'
      )
      .then((response) => {
        this.customers = response.data.customers
      })
      .catch((error) => console.log(error))
      .finally(() => (this.loading = false))
  },
  methods: {
    deletePizza (id) {
      this.axios
        .delete(
          `http://localhost/pizza-ordering-app-Vue3-Laravel-8-/pizza-ordering-backend/public/api/Pizza/${id}`
        )
        .then((response) => {
          // eslint-disable-next-line eqeqeq
          if (response.data.status == 409) {
            alert(response.data.message)
          } else {
            alert(response.data.message)
            this.axios
              .get(
                'http://localhost/pizza-ordering-app-Vue3-Laravel-8-/pizza-ordering-backend/public/api/Pizza'
              )
              .then((response) => {
                this.pizzas = response.data.pizzas_list
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
        path: `/edit-pizza/${id}`
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
