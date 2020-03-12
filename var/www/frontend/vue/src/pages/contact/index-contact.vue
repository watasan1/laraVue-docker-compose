<template>
  <div>
    <Header />
    <v-container>
      <v-data-table :headers="headers" :items="contacts" class="elevation-1">
        <template v-slot:item.image="{ item }">
          <v-avatar size="36px">
            <img v-if="item.avatar != ''" :src="item.avatar" />
            <v-icon v-else color="grey"></v-icon>
          </v-avatar>
        </template>
        <template v-slot:item.full_name="{ item }">{{ item.full_name }}</template>
        <template v-slot:item.phone_number="{ item }">{{ item.phone_number}}</template>
        <template v-slot:item.email="{ item }">{{ item.email }}</template>
        <template v-slot:item.gender="{ item }">{{ item.gender | genderFilter }}</template>
        <template v-slot:item.register_date="{ item }">{{ item.created_at }}</template>
        <template v-slot:top>
          <v-toolbar flat color="white">
            <v-spacer></v-spacer>
          </v-toolbar>
        </template>
        <template v-slot:item.actions="{ item }">
          <v-icon small class="mr-4" @click="editContact(item)">edit</v-icon>
          <v-icon small @click="deleteContact(item)">delete</v-icon>
        </template>
      </v-data-table>
    </v-container>
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
  data: () => ({
    contacts: [],
    headers: [
      { text: '画像', align: 'start', value: 'image' },
      { text: '名前', value: 'full_name' },
      { text: '電話番号(携帯)', value: 'phone_number' },
      { text: 'Eメール', value: 'email' },
      { text: '性別', value: 'gender' },
      { text: '誕生日', value: 'birthday' },
      { text: '操作', value: 'actions' }
    ]
  }),
  methods: {
    axiosGetContacts() {
      let endpoint = BASE_URL + '/api/contact'
      axios
        .get(endpoint)
        .then(res => {
          this.contacts = res.data.contacts
          console.log(res)
        })
        .catch(error => {
          console.warn(error)
        })
    },
    editContact() {
      // 編集 追加
    },
    deleteContact() {
      // 削除
    }
  },
  filters: {
    genderFilter(val) {
      let gender = ''

      switch (val) {
        case 1:
          gender = '男性'
          break
        case 2:
          gender = '女性'
          break
        case 3:
          gender = '両方'
          break
        default:
          gender = ''
          break
      }
      return gender
    }
  },
  mounted() {
    this.axiosGetContacts()
  }
}
</script>
