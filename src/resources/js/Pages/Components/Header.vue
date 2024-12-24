<template>
  <nav class="bg-teal-700/80 text-white fixed w-full shadow z-10">
    <div class="container mx-auto flex justify-between items-center px-6 py-3">
      <!-- 左端: タイトル -->
      <a href="/" class="text-lg font-bold flex items-center space-x-2 hover:text-teal-300">
        <span>irochi tech</span>
      </a>

      <!-- ハンバーガーメニュー（モバイル） -->
      <button
        @click="toggleMenu"
        class="lg:hidden text-white focus:outline-none"
      >
        <i class="bi bi-list text-2xl"></i>
      </button>

      <!-- ナビゲーションメニュー -->
      <div
        :class="menuOpen ? 'block' : 'hidden'"
        class="absolute lg:relative top-full left-0 lg:top-auto lg:left-auto w-full lg:w-auto bg-teal-700/80 lg:bg-transparent text-white lg:flex lg:items-center lg:space-x-8 px-6 lg:px-2 py-0"
      >
        <ul class="flex flex-col lg:flex-row lg:space-x-6">
          <li>
            <a href="/posts" class="flex items-center space-x-2 hover:text-teal-300">
              <i class="bi bi-card-list"></i> <!-- メニューアイコン -->
              <span>記事一覧を見る</span>
            </a>
          </li>
          <li v-if="auth && auth.user">
            <div class="relative">
              <button
                @click="toggleDropdown"
                class="flex items-center space-x-2 focus:outline-none hover:text-teal-300"
              >
                <i class="bi bi-person-circle"></i> <!-- ユーザーアイコン -->
                <span>{{ auth.user.name }}</span>
              </button>
              <div
                v-if="dropdownOpen"
                class="absolute right-0 mt-2 w-48 bg-white text-black shadow-lg rounded"
              >
                <a href="/profile" class="flex items-center space-x-2 px-4 py-2 hover:bg-gray-200">
                  <i class="bi bi-person"></i>
                  <span>プロフィール</span>
                </a>
                <a
                  href="#"
                  @click.prevent="logout"
                  class="flex items-center space-x-2 px-4 py-2 hover:bg-gray-200"
                >
                  <i class="bi bi-box-arrow-right"></i>
                  <span>ログアウト</span>
                </a>
              </div>
            </div>
          </li>
          <template v-else>
            <li>
              <a href="/login" class="flex items-center space-x-2 hover:text-teal-300">
                <i class="bi bi-box-arrow-in-right"></i> <!-- ログインアイコン -->
                <span>ログイン</span>
              </a>
            </li>
            <li>
              <a href="/register" class="flex items-center space-x-2 hover:text-teal-300">
                <i class="bi bi-person-plus"></i> <!-- 新規登録アイコン -->
                <span>新規登録</span>
              </a>
            </li>
          </template>
        </ul>
      </div>
    </div>
  </nav>
</template>

<script>
import { Inertia } from '@inertiajs/inertia';

export default {
  props: {
    auth: Object,
  },
  data() {
    return {
      menuOpen: false,
      dropdownOpen: false,
    };
  },
  methods: {
    toggleMenu() {
      this.menuOpen = !this.menuOpen;
    },
    toggleDropdown() {
      this.dropdownOpen = !this.dropdownOpen;
    },
    logout() {
      Inertia.post('/logout');
    },
  },
};
</script>
