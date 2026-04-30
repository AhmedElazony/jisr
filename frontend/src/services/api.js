import axios from 'axios'
import { useAuthStore } from '../stores/auth'
import router from '../router'

const api = axios.create({
  baseURL: import.meta.env.VITE_API_URL || '/api/v1',
  headers: {
    'Content-Type': 'application/json',
    'Accept': 'application/json',
    'Accept-Language': 'ar'
  }
})

// Request interceptor
api.interceptors.request.use(
  (config) => {
    let token = localStorage.getItem('token')
    
    if (!token) {
      const authStore = useAuthStore()
      token = authStore.token
    }

    if (token) {
      config.headers.Authorization = `Bearer ${token}`
    }
    return config
  },
  (error) => {
    return Promise.reject(error)
  }
)

// api.interceptors.response.use(
//   (response) => response,
//   (error) => {
//     if (error.response?.status === 401) {
//       const authStore = useAuthStore()
//       authStore.logout()
//       router.push({ name: 'login' })
//     }
//     return Promise.reject(error)
//   }
// )

export default api
