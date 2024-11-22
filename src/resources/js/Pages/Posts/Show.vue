<template>
  <div class="container my-5">
    <h2>{{ post.title }}</h2>
    <p class="text-muted">作成者: {{ post.user.name }} | 投稿日: {{ post.created_at }}</p>
    <hr>
    <div class="content">
      <p>{{ post.content }}</p>
    </div>
    <hr>
    <RelatedPosts :posts="relatedPosts" />
  </div>
</template>

<script>
import DefaultLayout from '@/Layouts/DefaultLayout.vue';
import RelatedPosts from '@/Pages/Components/RelatedPosts.vue';

export default {
  props: {
    post: Object, // 現在表示している記事
    relatedPosts: Array, // 最近投稿された記事（現在の投稿を除く）
    auth: Object, // auth情報を受け取る
  },
  components: {
    RelatedPosts, // コンポーネントを登録
  },
  layout: DefaultLayout,
};
</script>