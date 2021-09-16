<template>
  <title-bar :title-stack="titleStack" />
  <hero-bar>Add User</hero-bar>
  <main-section>
    <card-component
      title="Create User"
      :icon="mdiBallot"
      @submit.prevent="addUser"
      form
    >
      <field label="Name">
        <control type="text" placeholder="Name" v-model="user.name" />
      </field>
      <field label="Email">
        <control type="email" placeholder="User Email" v-model="user.email" />
      </field>
      <field label="Password">
        <control
          type="password"
          placeholder="Password"
          v-model="user.password"
        />
      </field>
      <field label="Confirm Password">
        <control
          type="password"
          placeholder="Confirm Password"
          v-model="user.password_confirmation"
        />
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
import HeroBar from '@/components/HeroBar'
import Field from '@/components/Field'
import Control from '@/components/Control'
import JbButton from '@/components/JbButton'
import JbButtons from '@/components/JbButtons'

export default {
  name: 'Create User',
  components: {
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
    const titleStack = ref(['Admin', 'Create User'])
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
      user: {}
    }
  },
  methods: {
    addUser () {
      // const formData = new FormData()
      // formData.append('title', this.pizza.title)
      // formData.append('ingredients', this.pizza.ingredients)
      // formData.append('pizza_category_id', this.pizza.pizza_category_id)
      // formData.append('description', this.pizza.description)
      // formData.append('price', this.pizza.price)
      // formData.append('tax', this.pizza.tax)
      // formData.append('photo_url', this.pizza.photo_url)
      this.axios
        .post(
          'http://localhost/pizza-ordering-app-Vue3-Laravel-8-/pizza-ordering-backend/public/api/register',
          this.user
        )
        .then((response) => {
          console.log(response)
          if (response.status === 201) {
            this.$router.push('/user_list')
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
