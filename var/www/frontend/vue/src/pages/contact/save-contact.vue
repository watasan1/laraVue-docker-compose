<template>
  <div>
    <Header />
    <v-container>
      <v-row>
        <v-col cols="12" sm="6">
          <v-text-field v-model="contact.first_name" label="姓" outlined></v-text-field>
        </v-col>

        <v-col cols="12" sm="6">
          <v-text-field v-model="contact.last_name" label="名" outlined></v-text-field>
        </v-col>
      </v-row>
      <v-radio-group v-model="contact.gender" row>
        <v-radio label="男性" :value="1"></v-radio>
        <v-radio label="女性" :value="2"></v-radio>
        <v-radio label="両方" :value="3"></v-radio>
      </v-radio-group>
      <v-text-field v-model="contact.phone_number" label="電話番号(携帯)" single-line outlined></v-text-field>
      <v-text-field v-model="contact.house_phone_number" label="電話番号(自宅)" single-line outlined></v-text-field>
      <v-text-field v-model="contact.email" label="Eメール" single-line outlined></v-text-field>
      <v-text-field v-model="contact.address" outlined label="住所"></v-text-field>
      <v-text-field v-model="contact.birthday" label="誕生日" single-line outlined></v-text-field>
      <v-textarea v-model="contact.memo" label="メモ" auto-grow outlined rows="3" row-height="25"></v-textarea>
      <v-file-input accept="image/*" label="avatar"></v-file-input>
      <div class="my-5">
        <v-btn large>登録</v-btn>
      </div>
    </v-container>
  </div>
</template>

<script>
import Header from '../../components/Header'

export default {
  components: {
    Header
  },
  data: () => {
    return {
      contact: {
        first_name: '',
        last_name: '',
        avatar: '',
        gender: '',
        phone_number: '',
        house_phone_number: '',
        email: '',
        address: '',
        birthday: '',
        memo: ''
      }
    }
  }
}
</script>