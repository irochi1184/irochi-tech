<template>
  <div class="container my-5">
    <h1>{{ post.title }}</h1>
    <div class="d-flex align-items-center justify-content-between text-muted">
      <!-- 作成者と投稿日 -->
      <div>
        作成者: {{ post.user.name }} | 投稿日: {{ post.created_at }}
      </div>
      <!-- 編集・削除ボタン -->
      <div v-if="auth.user.id == post.user.id">
        <a :href="`/posts/${post.id}/edit`" class="btn btn-primary me-2">記事を編集</a>
        <button @click="deletePost" class="btn btn-danger">削除</button>
      </div>
    </div>
    <hr>
    <div class="content">
      <div v-html="markdownContent" class="content"></div>
    </div>
    <hr>
    <RelatedPosts :posts="relatedPosts" />
  </div>
</template>

<script>
import { Inertia } from '@inertiajs/inertia';
import DefaultLayout from '@/Layouts/DefaultLayout.vue';
import RelatedPosts from '@/Pages/Components/RelatedPosts.vue';
import MarkdownIt from 'markdown-it';
import markdownItLinkAttributes from 'markdown-it-link-attributes';
import markdownItHighlight from 'markdown-it-highlightjs';

export default {
  props: {
    post: Object, // 現在表示している記事
    relatedPosts: Array, // 最近投稿された記事（現在の投稿を除く）
    auth: Object, // auth情報を受け取る
  },
  computed: {
    markdownContent() {
      const md = new MarkdownIt({
        linkify: true, // URLをリンクとして処理
      })
        .use(markdownItLinkAttributes, {
          attrs: {
            target: '_blank',
            rel: 'noopener noreferrer',
          },
        })
        .use(markdownItHighlight);
      return md.render(this.post.content);
    },
  },
  components: {
    RelatedPosts, // コンポーネントを登録
  },
  layout: DefaultLayout,
  methods: {
    deletePost() {
      if (confirm('この記事を削除してもよろしいですか？')) {
        Inertia.delete(`/posts/${this.post.id}`, {
          onSuccess: () => {
            alert('記事が削除されました');
            window.location.href = '/posts'; // 記事一覧にリダイレクト
          },
          onError: (errors) => {
            console.error(errors);
            alert('削除に失敗しました');
          },
        });
      }
    },
  },
};
</script>

<style scoped>
.content {
  font-size: 1.2rem;
  line-height: 1.8;
}
pre {
  background-color: #444e57;
  padding: 10px;
  border-radius: 5px;
  overflow-x: auto;
}
code {
  color: #33d69d;
}
a {
  color: #086e67;
  text-decoration: none;
}
a:hover {
  text-decoration: underline;
}
</style>