<template>
  <div>
    <!-- Navigation Bar -->
    <nav class="navbar navbar-expand-lg navbar-light fixed-top">
      <div class="container-fluid">
        <a class="navbar-brand text-white me-auto" href="#">irochi tech</a>
        <div class="navbar-collapse" id="navbarNav">
          <ul class="navbar-nav ms-auto">
            <!-- ユーザーがログインしているかで表示を切り替え -->
            <li v-if="auth && auth.user" class="nav-item dropdown">
              <a
                class="nav-link dropdown-toggle text-white"
                href="#"
                id="userDropdown"
                role="button"
                data-bs-toggle="dropdown"
                aria-expanded="false"
              >
                <i class="bi bi-person me-2"></i>
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

    <!-- Hero Section -->
    <section class="hero text-white text-center d-flex align-items-center justify-content-center">
      <div class="container">
        <h1 class="display-4">Welcome to irochi tech!</h1>
        <p class="lead">Empowering business professionals and students with effective learning methods.</p>
      </div>
    </section>

    <!-- Content Section -->
    <section class="container my-5">
      <h2 class="mb-4">Recent Articles</h2>
      <div class="row">
        <div class="col-sm-3 col-md-4" v-for="article in articles" :key="article.id">
          <div class="card mb-4">
            <div class="card-body">
              <h5 class="card-title">{{ article.title }}</h5>
              <p class="card-text">{{ article.content.substring(0, 100) }}...</p>
              <a href="#" class="btn btn-success">Read More</a>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- Footer -->
    <footer class="bg-dark text-white text-center p-3">
      <div class="container d-flex align-items-center justify-content-center" style="height: 100%;">
        <p class="mb-0">&copy; 2024 irochi tech. All Rights Reserved.</p>
      </div>
    </footer>
  </div>
</template>

<script>
import axios from 'axios';
import { Inertia } from '@inertiajs/inertia';

export default {
  props: {
    auth: Object, // Inertiaから受け取るauthプロパティを定義
  },
  data() {
    return {
      articles: []
    };
  },
  methods: {
    logout() {
      Inertia.post('/logout'); // ログアウト処理をInertiaで行う
    }
  },
  mounted() {
    axios.get('/api/articles')
      .then(response => {
        this.articles = response.data;
      })
      .catch(error => {
        console.error('Error fetching articles:', error);
      });
  }
}
</script>

<style scoped>
/* ナビゲーションバーのスタイル調整 */
.navbar {
  background-color: rgba(41, 170, 177, 0.95) !important; /* 緑系の色 */
  box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1); /* スクロール時に影を追加 */
}
.nav-link {
  color: white !important; /* リンクテキストを白に */
}
.nav-link:hover {
  color: #e0e0e0 !important; /* ホバー時に少し薄い色に */
}

/* 全体の背景色と調整 */
body {
  background-color: #f0f0f0; /* 全体の背景色 */
  padding-top: 56px; /* ナビゲーションバーの高さを考慮してパディング */
}

/* ヒーローセクションのスタイル */
.hero {
  background: url('/images/siteTop.jpg') no-repeat center center/cover;
  height: 60vh; /* 高さを調整 */
  padding: 60px 20px; /* 全画面でのパディング */
}
@media (max-width: 576px) {
  .hero {
    padding: 30px 10px; /* スマホ画面ではパディングを調整 */
  }
  .hero h1 {
    font-size: 1.8rem; /* スマホ画面ではフォントサイズを縮小 */
  }
  .hero p {
    font-size: 1rem; /* スマホ画面ではフォントサイズを縮小 */
  }
}
</style>
