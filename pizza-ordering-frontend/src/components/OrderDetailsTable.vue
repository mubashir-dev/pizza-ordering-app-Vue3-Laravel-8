<template>
   <card-component :icon="mdiMonitorCellphone" title="Order" has-table>
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
      </tr>
    </thead>
    <tbody>
      <tr>
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
      </tr>
    </tbody>
  </table>
    </card-component>
   <card-component :icon="mdiMonitorCellphone" title="Order Items" has-table>
       <table class="text-center">
    <thead>
      <tr>
        <th>Item</th>
        <th>Qty</th>
      </tr>
    </thead>
    <tbody>
      <!-- <tr v-for="detail in orders.order_details" :key="detail.id">
        <td data-label="id">{{ detail.pizza }}</td>
        <td data-label="Name">{{ detail.qty }}</td>
      </tr> -->
    </tbody>
  </table>
    </card-component>

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
// import JbButtons from '@/components/JbButtons'
// import JbButton from '@/components/JbButton'
import CardComponent from '@/components/CardComponent'

export default {
  name: 'OrderDetails',
  components: {
    // JbButtons,
    // JbButton,
    CardComponent
  },
  props: {
    checkable: Boolean
  },
  data () {
    return {
      order: []
    }
  },
  setup () {
    return {
      mdiBookEdit,
      mdiAccountCheck,
      mdiEye,
      CardComponent
    }
  },
  created () {
    this.axios
      .get(
        `http://localhost/pizza-ordering-app-Vue3-Laravel-8-/pizza-ordering-backend/public/api/Orders/${this.$route.params.id}`
      )
      .then((response) => {
        console.log(response.data.order)
        this.order = response.data.order
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
