<template>
  <div>
    <!-- Hero Section -->
    <section class="hero text-white text-center d-flex align-items-center justify-content-center">
      <div class="container">
        <h1 class="display-4">あなたの学習を最大限に</h1>
        <p class="lead">Empowering business professionals and students with effective learning methods.</p>
      </div>
    </section>

    <!-- Content Section -->
    <section class="sub-container my-5">
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
      <a href="/posts" class="btn btn-success mt-4">記事一覧を見る</a>
    </section>
  </div>
</template>

<script>
import axios from 'axios';
import { Inertia } from '@inertiajs/inertia';
import DefaultLayout from '../Layouts/DefaultLayout.vue';

export default {
  props: {
    auth: Object, // Inertiaから受け取るauthプロパティを定義
  },
  layout: DefaultLayout,
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

</style>
