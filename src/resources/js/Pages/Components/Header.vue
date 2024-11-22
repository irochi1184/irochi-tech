<template>
  <nav class="navbar navbar-expand-lg navbar-light fixed-top">
    <div class="container-fluid">
      <a class="navbar-brand me-auto" href="/">irochi tech</a>

      <button
        class="navbar-toggler"
        type="button"
        data-bs-toggle="collapse"
        data-bs-target="#navbarNav"
        aria-controls="navbarNav"
        aria-expanded="false"
        aria-label="Toggle navigation"
      >
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link" href="/posts">記事一覧を見る</a>
          </li>
          <!-- ログイン状態で表示内容を切り替え -->
          <li v-if="auth && auth.user" class="nav-item dropdown">
            <a
              class="nav-link dropdown-toggle"
              href="#"
              id="userDropdown"
              role="button"
              data-bs-toggle="dropdown"
              aria-expanded="false"
            >
              <i class="bi bi-person"></i>
              {{ auth.user.name }}
            </a>
            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
              <li><a class="dropdown-item" href="/profile">プロフィール</a></li>
              <li><hr class="dropdown-divider"></li>
              <li>
                <a
                  class="dropdown-item"
                  href="#"
                  @click.prevent="logout"
                >
                  ログアウト
                </a>
              </li>
            </ul>
          </li>
          <template v-else>
            <li class="nav-item">
              <a class="nav-link text-white" href="/login">ログイン</a>
            </li>
            <li class="nav-item">
              <a class="nav-link text-white" href="/register">新規登録</a>
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
  methods: {
    logout() {
      Inertia.post('/logout');
    },
  },
};
</script>
