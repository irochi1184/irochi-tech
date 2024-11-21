<template>
  <div>
    <h1>新しい記事を作成</h1>
    <form @submit.prevent="submit">
      <div class="mb-3">
        <label for="title" class="form-label">タイトル</label>
        <input
          type="text"
          id="title"
          v-model="form.title"
          class="form-control"
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
          required
        ></textarea>
      </div>
      <button type="submit" class="btn btn-success">投稿する</button>
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
