<template>
  <div class="container mb-4">
    <h2 class="text-center text-3xl font-bold mb-8 mt-10">新しい記事を作成</h2>
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">
      <!-- 左半分：記事入力フォーム -->
      <div class="bg-white p-6 shadow rounded">
        <form @submit.prevent="submit">
          <div class="mb-6">
            <label for="title" class="block text-xl font-semibold mb-2">タイトル</label>
            <input
              type="text"
              id="title"
              v-model="form.title"
              class="w-full border border-gray-300 rounded px-4 py-3 focus:ring-2 focus:ring-teal-500 focus:outline-none text-lg"
              placeholder="記事のタイトルを入力してください"
              required
            />
          </div>
          <div class="mb-6">
            <label for="content" class="block text-xl font-semibold mb-2">本文 (マークダウン形式)</label>
            <textarea
              id="content"
              v-model="form.content"
              class="w-full border border-gray-300 rounded px-4 py-3 focus:ring-2 focus:ring-teal-500 focus:outline-none text-lg"
              rows="15"
              placeholder="記事の内容を入力してください"
              required
            ></textarea>
          </div>
          <div class="text-center">
            <button
              type="submit"
              class="bg-teal-500 text-white px-6 py-3 rounded shadow hover:bg-teal-600 transition"
            >
              投稿する
            </button>
            <a
              href="/posts"
              class="ml-4 text-teal-500 border border-teal-500 px-6 py-3 rounded shadow hover:bg-teal-500 hover:text-white transition"
            >
              キャンセル
            </a>
          </div>
        </form>
      </div>

      <!-- 右半分：マークダウンガイドとプレビュー -->
      <div>
        <!-- 折りたたみ式マークダウンガイド -->
        <details class="bg-gray-100 p-4 shadow rounded mb-6">
          <summary class="text-lg font-semibold cursor-pointer">マークダウンガイド</summary>
          <ul class="mt-4 space-y-2">
            <li><strong>見出し</strong>: <code># 見出し1</code>, <code>## 見出し2</code>, ...</li>
            <li><strong>太字</strong>: <code>**太字**</code></li>
            <li><strong>斜体</strong>: <code>*斜体*</code></li>
            <li><strong>リンク</strong>: <code>[リンクテキスト](URL)</code></li>
            <li><strong>コードブロック</strong>: <code>```コード```</code></li>
            <li><strong>水平線</strong>: <code>---</code></li>
          </ul>
        </details>

        <!-- プレビューエリア -->
        <div class="bg-gray-100 p-6 shadow rounded">
          <h4 class="text-xl font-semibold mb-4">プレビュー</h4>
          <div v-html="highlightedMarkdown" class="prose max-w-none"></div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import { Inertia } from '@inertiajs/inertia';
import DefaultLayout from '../../Layouts/DefaultLayout.vue';
import MarkdownIt from 'markdown-it';
import hljs from 'highlight.js';

export default {
  data() {
    return {
      form: {
        title: '',
        content: '',
      },
    };
  },
  computed: {
    highlightedMarkdown() {
      // Markdown プレビューをリアルタイムで更新
      const md = new MarkdownIt({
        linkify: true,
        highlight: (str, lang) => {
          if (lang && hljs.getLanguage(lang)) {
            try {
              return `<pre class="hljs"><code>${hljs.highlight(str, { language: lang }).value}</code></pre>`;
            } catch (__) {}
          }
          return `<pre class="hljs"><code>${md.utils.escapeHtml(str)}</code></pre>`;
        },
      });
      return md.render(this.form.content);
    },
  },
  methods: {
    submit() {
      Inertia.post('/posts', this.form);
    },
  },
  layout: DefaultLayout,
};
</script>

<style scoped>
/* プレビューエリア用スタイル */
.prose pre {
  background-color: #f8f9fa;
  padding: 10px;
  border-radius: 5px;
  overflow-x: auto;
}

/* レイアウト全体の拡大 */
.container {
  max-width: 90%;
}
</style>
