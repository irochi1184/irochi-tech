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
      <h3 class="mt-5">最近投稿された記事</h3>
      <div class="row">
        <div class="col-md-4 mb-4 col-sm-6 col-12" v-for="article in recentPosts" :key="article.id">
          <a :href="`/posts/${article.id}`" class="card-link">
            <div class="card h-100">
              <div class="card-body">
                <h5 class="card-title">{{ article.title.substring(0, 25) }}</h5>
                <p class="card-text">{{ article.content.substring(0, 54) }}...</p>
              </div>
            </div>
          </a>
        </div>
      </div>
    </section>

    <div class="sub-container mb-5">
      <a href="/posts" class="btn btn-success mt-4">記事一覧を見る</a>
    </div>
  </div>
</template>

<script>
import DefaultLayout from '@/Layouts/DefaultLayout.vue';

export default {
  props: {
    auth: Object,
    recentPosts: Array, // サーバーから受け取る最近の投稿データ
  },
  layout: DefaultLayout,
};
</script>
