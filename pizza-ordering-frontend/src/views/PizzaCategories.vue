<template>
  <title-bar :title-stack="titleStack" />
  <hero-bar>Pizza Categories</hero-bar>
  <main-section>
    <div class="grid grid-cols-1 gap-6 lg:grid-cols-3 mb-6">
    </div>
    <card-component :icon="mdiMonitorCellphone" title="Available Pizza Categories" has-table>
      <PizzaCategoryTable />
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
import PizzaCategoryTable from '../components/PizzaCategoryTable.vue'
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
    PizzaCategoryTable
  },
  setup () {
    const titleStack = ref(['Admin', 'Pizza Categories'])

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
