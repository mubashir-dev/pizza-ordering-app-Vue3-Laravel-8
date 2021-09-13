<template>
  <title-bar :title-stack="titleStack" />
  <hero-bar>Edit Pizza Category</hero-bar>
  <main-section>
    <card-component
      title="Edit Pizza Category"
      :icon="mdiBallot"
      @submit.prevent="addCategory"
      form
    >
      <field label="Category Title" help="">
        <control v-model="PizzaCategory.title" placeholder="Pizza Category Title" />
      </field>
      <field label="Category Description" help="" >
        <control type="textarea" placeholder="Pizza Category Description"  v-model="PizzaCategory.description"/>
      </field>
      <divider />
      <jb-buttons>
        <jb-button type="submit" color="info" label="Submit" />
        <jb-button type="reset" color="info" outline label="Reset" />
      </jb-buttons>
    </card-component>
  </main-section>
</template>

<script>
import { ref, reactive } from 'vue'
import {
  mdiBallot,
  mdiBallotOutline,
  mdiAccount,
  mdiMail,
  mdiCheck
} from '@mdi/js'
import MainSection from '@/components/MainSection'
import TitleBar from '@/components/TitleBar'
import CardComponent from '@/components/CardComponent'
import HeroBar from '@/components/HeroBar'
import Field from '@/components/Field'
import Control from '@/components/Control'
import Divider from '@/components/Divider.vue'
import JbButton from '@/components/JbButton'
import JbButtons from '@/components/JbButtons'

export default {
  name: 'Create Pizza',
  components: {
    Divider,
    MainSection,
    HeroBar,
    CardComponent,
    TitleBar,
    Field,
    Control,
    JbButton,
    JbButtons
  },
  setup () {
    const titleStack = ref(['Admin', 'Create Pizza'])

    const selectOptions = [
      { id: 1, label: 'Business development' },
      { id: 2, label: 'Marketing' },
      { id: 3, label: 'Sales' }
    ]

    const PizzaCategory = reactive({
      title: '',
      description: ''

    })

    const customElementsForm = reactive({
      checkbox: ['lorem'],
      radio: 'one',
      switch: ['one'],
      file: null
    })
    return {
      titleStack,
      selectOptions,
      PizzaCategory,
      customElementsForm,
      mdiBallot,
      mdiBallotOutline,
      mdiAccount,
      mdiMail,
      mdiCheck
    }
  },
  methods: {
    addCategory () {
      console.log(this.axios)
      this.axios.post('http://localhost/pizza-ordering-app-Vue3-Laravel-8-/pizza-ordering-backend/public/api/PizzaCategory', this.PizzaCategory)
        .then((response) => {
          console.log(response)
          if (response.status === 201) {
            //   console.log(this.$router);
            this.$router.push('/pizza-categories')
          }
        })
        .catch((error) => {
          this.errors = error
          console.log(this.errors)
        })
        .finally(() => (this.loading = false))
    },
    addCategory () {
      console.log(this.axios)
      this.axios.post('http://localhost/pizza-ordering-app-Vue3-Laravel-8-/pizza-ordering-backend/public/api/PizzaCategory', this.PizzaCategory)
        .then((response) => {
          console.log(response)
          if (response.status === 201) {
            //   console.log(this.$router);
            this.$router.push('/pizza-categories')
          }
        })
        .catch((error) => {
          this.errors = error
          console.log(this.errors)
        })
        .finally(() => (this.loading = false))
    }
  }
}
</script>
