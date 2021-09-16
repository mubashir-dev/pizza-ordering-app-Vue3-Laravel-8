<template>
  <title-bar :title-stack="titleStack" />
  <hero-bar>Edit User</hero-bar>
  <main-section>
    <card-component
      title="Edit User"
      :icon="mdiBallot"
      @submit.prevent="editUser"
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
  name: 'Edit User',
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
    const titleStack = ref(['Admin', 'Edit User'])
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
  created () {
    this.axios
      .get(
        `http://localhost/pizza-ordering-app-Vue3-Laravel-8-/pizza-ordering-backend/public/api/users/${this.$route.params.id}`
      )
      .then((response) => {
        this.user = response.data.users
      })
      .catch((error) => {
        this.errors = error
        console.log(this.errors)
      })
      .finally(() => (this.loading = false))
  },
  methods: {
    editUser () {
      this.axios
        .put(
          `http://localhost/pizza-ordering-app-Vue3-Laravel-8-/pizza-ordering-backend/public/api/users/${this.$route.params.id}`,
          this.user
        )
        .then((response) => {
          console.log(response)
          if (response.status === 200) {
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
