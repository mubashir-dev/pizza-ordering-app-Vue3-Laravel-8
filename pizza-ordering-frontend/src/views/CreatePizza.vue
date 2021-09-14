<template>
  <title-bar :title-stack="titleStack" />
  <hero-bar>Add Pizza</hero-bar>
  <main-section>
    <card-component
      title="Create Pizza"
      :icon="mdiBallot"
      @submit.prevent="submit"
      form
    >
      <field label="Title">
        <control type="text" placeholder="Title" v-model="pizza.title" />
      </field>
      <field label="Ingredients">
        <control
          type="tel"
          placeholder="Pizza Ingredients"
          v-model="pizza.ingredients"
        />
      </field>
      <field label="Category">
        <control
          :options="this.PizzaCategories"
          v-model="pizza.pizza_category_id"
        />
      </field>
      <field label="Photo">
        <file-picker label="Upload Pizza Photo" v-model="pizza.photo_url" />
      </field>
      <field label="Price">
        <control
          type="number"
          placeholder="Price"
          v-model="pizza.price"
        />
      </field>
      <field label="Tax">
        <control type="number" placeholder="Pizza tax" v-model="pizza.tax" />
      </field>
      <field label="Description">
        <control type="textarea" placeholder="Description About Pizza" />
      </field>
      <jb-buttons>
        <jb-button type="submit" color="info" label="Submit" />
        <jb-button type="reset" color="info" outline label="Reset" />
      </jb-buttons>
    </card-component>
  </main-section>
</template>

<script>
import { ref } from 'vue'
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
// import CheckRadioPicker from '@/components/CheckRadioPicker'
import FilePicker from '@/components/FilePicker'
import HeroBar from '@/components/HeroBar'
import Field from '@/components/Field'
import Control from '@/components/Control'
// import Divider from '@/components/Divider.vue'
import JbButton from '@/components/JbButton'
import JbButtons from '@/components/JbButtons'

export default {
  name: 'Create Pizza',
  components: {
    MainSection,
    HeroBar,
    FilePicker,
    // CheckRadioPicker,
    CardComponent,
    TitleBar,
    Field,
    Control,
    JbButton,
    JbButtons
  },
  setup () {
    const titleStack = ref(['Admin', 'Create Pizza'])
    // const PizzaCategories = []
    // const customElementsForm = reactive({
    //   checkbox: ['lorem'],
    //   radio: 'one',
    //   switch: ['one'],
    //   file: null
    // })

    const submit = () => {
      //
    }

    return {
      titleStack,
      // form,
      // customElementsForm,
      submit,
      mdiBallot,
      mdiBallotOutline,
      mdiAccount,
      mdiMail,
      mdiCheck
    }
  },
  data () {
    return {
      pizza: {
        title: '',
        pizza_category_id: []
      },
      PizzaCategories: []
    }
  },
  created () {
    this.axios
      .get(
        'http://localhost/pizza-ordering-app-Vue3-Laravel-8-/pizza-ordering-backend/public/api/categories'
      )
      .then((response) => {
        this.PizzaCategories = response.data
        console.log(response.data)
      })
      .catch((error) => {
        this.errors = error
        console.log(this.errors)
      })
      .finally(() => (this.loading = false))
  }
}
</script>
