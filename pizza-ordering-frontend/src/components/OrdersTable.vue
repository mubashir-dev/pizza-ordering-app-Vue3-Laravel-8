<template>
  <table class="text-center">
    <thead>
      <tr>
        <th>#</th>
        <th>Order No</th>
        <th>Name</th>
        <th>G.Amount</th>
        <th>G.Tax</th>
        <th>Status</th>
        <th>Order Placed Date</th>
        <th>Actions</th>
      </tr>
    </thead>
    <tbody>
      <tr v-for="order in orders" :key="order.id">
        <td data-label="id">{{ order.id }}</td>
        <td data-label="Name">{{ order.order_no }}</td>
        <td data-label="id"><span class="badge badge-success">{{ order.customer_name }}</span></td>
        <td data-label="Company">{{ order.total_amount }}</td>
        <td data-label="Company">{{ order.total_tax }}</td>
        <td data-label="Company">{{ order.status }}</td>
        <td data-label="Created">
          <small class="text-gray-500" :title="order.created_at">
            {{ order.created_at }}</small>
        </td>
        <td class="actions-cell">
          <jb-buttons type="justify-start" no-wrap>
             <jb-button
              color="warning"
              :icon="mdiEye"
              small
              @click="viewOrder(order.id)"
            />
           <jb-button
              class="mr-3"
              color="success"
              :icon="mdiAccountCheck"
              small
              @click="completeOrder(order.id)"
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
import { mdiBookEdit, mdiAccountCheck, mdiEye } from '@mdi/js'
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
      orders: []
    }
  },
  setup () {
    return {
      mdiBookEdit,
      mdiAccountCheck,
      mdiEye
    }
  },
  created () {
    this.axios
      .get(
        'http://localhost/pizza-ordering-app-Vue3-Laravel-8-/pizza-ordering-backend/public/api/Orders'
      )
      .then((response) => {
        this.orders = response.data.orders
      })
      .catch((error) => console.log(error))
      .finally(() => (this.loading = false))
  },
  methods: {
    completeOrder (id) {
      this.axios
        .get(
          `http://localhost/pizza-ordering-app-Vue3-Laravel-8-/pizza-ordering-backend/public/api/Complete/${id}`
        )
        .then((response) => {
          // eslint-disable-next-line eqeqeq
          if (response.data.status == 409) {
            alert(response.data.message)
          } else {
            alert(response.data.message)
            this.axios
              .get(
                'http://localhost/pizza-ordering-app-Vue3-Laravel-8-/pizza-ordering-backend/public/api/Orders'
              )
              .then((response) => {
                this.orders = response.data.orders
              })
              .catch((error) => console.log(error))
              .finally(() => (this.loading = false))
          }
        })
        .catch((error) => {
          console.log(error)
        })
        .finally(() => (this.loading = false))
    },
    viewOrder (id) {
      this.$router.push({
        path: `/orders-details/${id}`
      })
    }
  }
}
</script>
