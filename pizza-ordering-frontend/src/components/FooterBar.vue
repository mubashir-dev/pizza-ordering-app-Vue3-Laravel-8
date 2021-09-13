<template>
  <footer v-show="isFooterBarVisible" class="bg-white py-3 px-6">
    <level>
      <div>
        <b>&copy; {{ year }}</b> &mdash; Pizza Ordering App
      </div>
    </level>
  </footer>
</template>

<script>
import { computed } from 'vue'
import { useStore } from 'vuex'
import Level from '@/components/Level'

export default {
  name: 'FooterBar',
  components: {
    Level
  },
  setup () {
    const store = useStore()

    const year = computed(() => new Date().getFullYear())

    const isFooterBarVisible = computed(() => !store.state.isFormScreen)

    return {
      year,
      isFooterBarVisible
    }
  }
}
</script>
