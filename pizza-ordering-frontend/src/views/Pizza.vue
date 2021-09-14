<template>
  <title-bar :title-stack="titleStack" />
  <hero-bar>Available Pizza's</hero-bar>
  <main-section>
    <div class="grid grid-cols-1 gap-6 lg:grid-cols-3 mb-6">
      <!-- <card-widget
        class="tile"
        color="text-green-500"
        :icon="mdiAccountMultiple"
        :number="512"
        label="Total In Stock"
      />
      <card-widget
        class="tile"
        color="text-blue-500"
        :icon="mdiCartOutline"
        :number="7770"
        prefix="PKR "
        label="Categories"
      />
      <card-widget
        class="tile"
        color="text-red-500"
        :icon="mdiChartTimelineVariant"
        :number="Ffsfjklsdj"
        label="Famous Category"/> -->
    </div>
    <card-component :icon="mdiMonitorCellphone" title="Available Pizza's" has-table>
      <pizzas-table />
    </card-component>
  </main-section>
</template>

<script>
// @ is an alias to /src
import { ref, onMounted } from 'vue'
import {
  mdiAccountMultiple,
  mdiCartOutline,
  mdiChartTimelineVariant,
  mdiFinance,
  mdiMonitorCellphone,
  mdiReload,
  mdiGithub
} from '@mdi/js'
import * as chartConfig from '@/components/Charts/chart.config'
// import LineChart from '@/components/Charts/LineChart'
import MainSection from '@/components/MainSection'
import TitleBar from '@/components/TitleBar'
import HeroBar from '@/components/HeroBar'
// import CardWidget from '@/components/CardWidget'
import CardComponent from '@/components/CardComponent'
// import ClientsTable from '@/components/ClientsTable'
import PizzasTable from '../components/PizzaTable.vue'
// import Notification from '@/components/Notification'
// import JbButton from '@/components/JbButton'

export default {
  name: 'Home',
  components: {
    MainSection,
    CardComponent,
    // CardWidget,
    HeroBar,
    TitleBar,
    PizzasTable
  },
  setup () {
    const titleStack = ref(['Admin', 'Pizzas List'])

    const chartData = ref(null)

    const fillChartData = () => {
      chartData.value = chartConfig.sampleChartData()
    }

    onMounted(() => {
      fillChartData()
    })

    return {
      titleStack,
      chartData,
      fillChartData,
      mdiAccountMultiple,
      mdiCartOutline,
      mdiChartTimelineVariant,
      mdiFinance,
      mdiMonitorCellphone,
      mdiReload,
      mdiGithub
    }
  }
}
</script>
