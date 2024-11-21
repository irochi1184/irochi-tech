<template>
  <div class="container my-5">
    <h2>{{ post.title }}</h2>
    <p class="text-muted">作成者: {{ post.user.name }} | 投稿日: {{ post.created_at }}</p>
    <hr>
    <div class="content">
      <p>{{ post.content }}</p>
    </div>
    <hr>
    <h3 class="mt-5">最近投稿された記事</h3>
    <div class="row mt-3">
      <div
        v-for="relatedPost in relatedPosts"
        :key="relatedPost.id"
        class="col-md-4 mb-4 col-sm-6 col-12"
      >
      <a :href="`/posts/${relatedPost.id}`" class="card-link">
        <div class="card h-100">
          <div class="card-body">
            <h5 class="card-title">{{ relatedPost.title.substring(0, 25) }}...</h5>
            <p class="card-text">{{ relatedPost.content.substring(0, 54) }}...</p>
          </div>
        </div>
      </a>
      </div>
    </div>
  </div>
</template>

<script>
import DefaultLayout from '@/Layouts/DefaultLayout.vue';

export default {
  props: {
    post: Object, // 現在表示している記事
    relatedPosts: Array, // 最近投稿された記事（現在の投稿を除く）
    auth: Object, // auth情報を受け取る
  },
  layout: DefaultLayout,
};
</script>