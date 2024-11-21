<template>
  <div>
    <h1>記事一覧</h1>
    <div v-for="post in posts" :key="post.id" class="card mb-3">
      <div class="card-body">
        <h5 class="card-title">{{ post.title }}</h5>
        <p class="card-text">{{ post.content.substring(0, 100) }}...</p>
        <p class="text-muted">作成者: {{ post.user.name }}</p>
      </div>
    </div>
    <a href="/posts/create" class="btn btn-success mt-3">新しい記事を追加</a>
  </div>
</template>

<script>
export default {
  props: {
    posts: Array,
  },
};
</script>
