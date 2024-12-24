<template>
  <div class="container mx-auto">
    <h1 class="text-2xl font-bold mt-16">{{ post.title }}</h1>
    <div class="flex justify-between text-gray-500">
      <!-- 作成者と投稿日 -->
      <span style="padding: 10px;">作成者: {{ post.user.name }} | 投稿日: {{ post.created_at }}</span>
      <!-- 編集・削除ボタン -->
      <div v-if="auth.user.id == post.user.id">
        <a :href="`/posts/${post.id}/edit`" class="btn btn-primary me-2">記事を編集</a>
        <button @click="deletePost" class="btn btn-danger">削除</button>
      </div>
    </div>
    <hr class="my-2"/>
    <div class="content">
      <div v-html="markdownContent" class="content"></div>
    </div>
    <hr>
    <RelatedPosts :posts="relatedPosts" />
  </div>
</template>

<script>
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