<template>
  <title-bar :title-stack="titleStack" />
  <hero-bar>Edit Pizza</hero-bar>
  <main-section>
    <card-component
      title="Create Pizza"
      :icon="mdiBallot"
      @submit.prevent="editPizza"
      form
    >
      <field label="Title">
        <control type="text" placeholder="Title" v-model="pizza.title" />
      </field>
      <field label="Ingredients">
        <control
          type="text"
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
      <!-- <field label="Photo">
        <file-picker label="Upload Pizza Photo" v-model="pizza.photo_url" />
      </field> -->
      <field label="Price">
        <control type="number" placeholder="Price" v-model="pizza.price" />
      </field>
      <field label="Tax">
        <control type="number" placeholder="Pizza tax" v-model="pizza.tax" />
      </field>
      <field label="Description">
        <control
          type="textarea"
          placeholder="Description About Pizza"
          v-model="pizza.description"
        />
      </field>
      <jb-buttons>
        <jb-button type="submit" color="info" label="Submit" />
        <jb-button type="reset" color="info" outline label="Reset" />
      </jb-buttons>
    </card-component>
    {{ pizza }}
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
// import FilePicker from '@/components/FilePicker'
import HeroBar from '@/components/HeroBar'
import Field from '@/components/Field'
import Control from '@/components/Control'
import JbButton from '@/components/JbButton'
import JbButtons from '@/components/JbButtons'

export default {
  name: 'Create Pizza',
  components: {
    MainSection,
    HeroBar,
    // FilePicker,
    // CheckRadioPicker,
    CardComponent,
    TitleBar,
    Field,
    Control,
    JbButton,
    JbButtons
  },
  setup () {
    const titleStack = ref(['Admin', 'Edit Pizza'])
    return {
      titleStack,
      mdiBallot,
      mdiBallotOutline,
      mdiAccount,
      mdiMail,
      mdiCheck
    }
  },
  data () {
    return {
      pizza: {},
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
    // Fetching Pizza Data
    this.axios
      .get(
        // eslint-disable-next-line quotes
        `http://localhost/pizza-ordering-app-Vue3-Laravel-8-/pizza-ordering-backend/public/api/Pizza/${this.$route.params.id}`
      )
      .then((response) => {
        this.pizza = response.data.pizza
      })
      .catch((error) => {
        this.errors = error
        console.log(this.errors)
      })
      .finally(() => (this.loading = false))
  },
  methods: {
    editPizza () {
      const formData = new FormData()
      formData.append('title', this.pizza.title)
      formData.append('ingredients', this.pizza.ingredients)
      formData.append('pizza_category_id', this.pizza.pizza_category_id)
      formData.append('description', this.pizza.description)
      formData.append('price', this.pizza.price)
      formData.append('tax', this.pizza.tax)
      // formData.append('photo_url', this.pizza.photo_url)
      this.axios
        .patch(
          `http://localhost/pizza-ordering-app-Vue3-Laravel-8-/pizza-ordering-backend/public/api/Pizza/${this.$route.params.id}`,
          formData
        )
        .then((response) => {
          console.log(response)
          if (response.status === 200) {
            this.$router.push('/pizzas')
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
