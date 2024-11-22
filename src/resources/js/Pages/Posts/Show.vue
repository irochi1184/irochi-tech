<template>
  <div class="container my-5">
    <h2>{{ post.title }}</h2>
    <p class="text-muted">作成者: {{ post.user.name }} | 投稿日: {{ post.created_at }}</p>
    <hr>
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