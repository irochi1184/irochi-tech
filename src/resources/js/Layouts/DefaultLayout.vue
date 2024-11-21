<template>
  <div>
    <!-- ヘッダー -->
    <Header :auth="auth" />

    <!-- ページ固有のコンテンツ -->
    <slot />

    <!-- フッター -->
    <footer class="bg-dark text-white text-center p-3">
      <p class="mb-0">&copy; 2024 irochi tech. All Rights Reserved.</p>
    </footer>
  </div>
</template>

<script>
import Header from '../Pages/Components/Header.vue';

export default {
  props: {
    auth: Object,
  },
  components: {
    Header,
  },
};
</script>

<style scoped>
main {
  min-height: calc(100vh - 140px); /* ヘッダーとフッターの高さを考慮 */
}
</style>
