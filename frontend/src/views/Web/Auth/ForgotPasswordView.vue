<!-- src/components/Login.vue -->
<template>
  <div class="flex items-center justify-center min-h-screen bg-gray-100">
    <el-card class="w-full max-w-md shadow-lg">
      <h2 class="text-2xl font-bold mb-6 text-center">Forgot Password</h2>
      <p>E-mail Address</p>
      <el-form @submit="onSubmit">
        <el-form-item :error="emailError">
          <el-input placeholder="Email Address" v-model="email" size="large" />
        </el-form-item>

        <div>
          <el-button
            size="large"
            class="mt-3 w-full"
            :disabled="isSubmitting"
            type="primary"
            native-type="submit"
            >Reset Password</el-button
          >
        </div>
      </el-form>
    </el-card>
  </div>
</template>
  
  <script setup lang="ts">
import axiosInstance from '@/plugins/axios'
import { useField, useForm } from 'vee-validate'
import * as yup from 'yup'
import { useRouter } from 'vue-router'

const router = useRouter()

const formSchema = yup.object({
  email: yup.string().required().email().label('Email address')
})

const { handleSubmit, isSubmitting } = useForm({
  initialValues: {
    email: ''
  },
  validationSchema: formSchema
})

const onSubmit = handleSubmit(async (values) => {
  try {
    const { data } = await axiosInstance.post('/forgot/password', values)
    localStorage.setItem('token', JSON.stringify(data.store_token))
    router.push('/reset_password')
  } catch (error) {}
})
const { value: email, errorMessage: emailError } = useField('email')
</script>
  
  <style scoped>
.min-h-screen {
  min-height: 100vh;
}
</style>
