<template>
  <div class="container my-5">
    <h2 class="mb-4 text-center">新しい記事を作成</h2>
    <form @submit.prevent="submit" class="bg-white p-4 shadow-sm rounded">
      <div class="mb-3">
        <label for="title" class="form-label">タイトル</label>
        <input
          type="text"
          id="title"
          v-model="form.title"
          class="form-control"
          placeholder="記事のタイトルを入力してください"
          required
        />
      </div>
      <div class="mb-3">
        <label for="content" class="form-label">本文</label>
        <textarea
          id="content"
          v-model="form.content"
          class="form-control"
          rows="5"
          placeholder="記事の内容を入力してください"
          required
        ></textarea>
      </div>
      <div class="text-center">
        <button type="submit" class="btn btn-success">投稿する</button>
        <a href="/posts" class="btn btn-outline-secondary ms-2">キャンセル</a>
      </div>
    </form>
  </div>
</template>

<script>
import { Inertia } from '@inertiajs/inertia';

export default {
  data() {
    return {
      form: {
        title: '',
        content: '',
      },
    };
  },
  methods: {
    submit() {
      Inertia.post('/posts', this.form);
    },
  },
};
</script>

<style scoped>
form {
  max-width: 600px;
  margin: auto;
}
</style>
