import { defineConfig } from 'vite'

// https://vitejs.dev/config/
export default defineConfig({
  build: {
    watch: {
      include: 'includes/frontend/assets/src/**'
    },
    rollupOptions: {
      input: '/includes/frontend/assets/src/main.js',
      output: {
        dir: 'includes/frontend/assets/build/',
        entryFileNames: 'index.js',
        assetFileNames: 'index.css'
      }
    }
  }
});