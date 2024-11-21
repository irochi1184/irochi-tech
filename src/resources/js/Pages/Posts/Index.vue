<template>
  <div>
    <div class="container my-5">
      <h2 class="mb-4">記事一覧</h2>
      <div class="row">
        <div
          v-for="post in posts"
          :key="post.id"
          class="col-md-4 mb-4"
        >
          <div class="card h-100">
            <div class="card-body">
              <h5 class="card-title"><strong>{{ post.title }}</strong></h5>
              <p class="card-text">{{ post.content.substring(0, 100) }}...</p>
              <a :href="`/posts/${post.id}`" class="btn btn-success mt-3">記事</a>
            </div>
          </div>
        </div>
      </div>
      <div class="text-center mt-5">
        <a href="/posts/create" class="btn btn-success">新しい記事を追加</a>
      </div>
    </div>
  </div>
</template>

<script>
import DefaultLayout from '../../Layouts/DefaultLayout.vue';
export default {
  props: {
    posts: Array,
    auth: Object, // auth情報を受け取る
  },
  layout: DefaultLayout,
};
</script>
