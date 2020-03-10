<template>
  <div>
    <Header />
  </div>
</template>

<script>
import Header from '../../components/Header'
import axios from 'axios' // 7_11 add

const BASE_URL = 'http://localhost:8000'

export default {
  components: {
    Header
  },
  // 以下add
  data: () => ({}),
  methods: {
    axiosGetContacts() {
      let endpoint = BASE_URL + '/api/contact'
      axios
        .get(endpoint)
        .then(res => {
          console.log(res)
        })
        .catch(error => {
          console.warn(error)
        })
    }
  },
  mounted() {
    this.axiosGetContacts()
  }
}
</script>
