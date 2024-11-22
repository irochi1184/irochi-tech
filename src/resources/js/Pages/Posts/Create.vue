<template>
  <div class="container my-5">
    <h2 class="mb-4 text-center">新しい記事を作成</h2>
    <div class="row">
      <!-- 左半分：記事入力フォーム -->
      <div class="col-md-6">
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
            <label for="content" class="form-label">本文 (マークダウン形式)</label>
            <textarea
              id="content"
              v-model="form.content"
              class="form-control"
              rows="10"
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

      <!-- 右半分：マークダウンガイドとプレビュー -->
      <div class="col-md-6">
        <!-- 折りたたみ式マークダウンガイド -->
        <div class="accordion mb-3" id="markdownGuideAccordion">
          <div class="accordion-item">
            <h2 class="accordion-header" id="headingGuide">
              <button
                class="accordion-button collapsed"
                type="button"
                data-bs-toggle="collapse"
                data-bs-target="#collapseGuide"
                aria-expanded="false"
                aria-controls="collapseGuide"
              >
                マークダウンガイド
              </button>
            </h2>
            <div
              id="collapseGuide"
              class="accordion-collapse collapse"
              aria-labelledby="headingGuide"
              data-bs-parent="#markdownGuideAccordion"
            >
              <div class="accordion-body">
                <ul>
                  <li><strong>見出し</strong>: <code># 見出し1</code>, <code>## 見出し2</code>, ...</li>
                  <li><strong>太字</strong>: <code>**太字**</code></li>
                  <li><strong>斜体</strong>: <code>*斜体*</code></li>
                  <li><strong>リンク</strong>: <code>[リンクテキスト](URL)</code></li>
                  <li><strong>コードブロック</strong>: <code>```コード```</code></li>
                </ul>
              </div>
            </div>
          </div>
        </div>

        <!-- プレビューエリア -->
        <div class="bg-light p-3 shadow-sm rounded">
          <h4>プレビュー</h4>
          <div v-html="highlightedMarkdown" class="border p-3 rounded"></div>
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
/* プレビューエリアのスタイル */
pre {
  background-color: #f8f9fa;
  padding: 10px;
  border-radius: 5px;
  overflow-x: auto;
}

code {
  font-family: 'Source Code Pro', monospace;
  color: #d63384;
}

/* 全体レイアウト調整 */
.container {
  max-width: 1200px;
}

.shadow-sm {
  box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
}

ul {
  padding-left: 20px;
  margin: 0;
}

ul li {
  margin-bottom: 10px;
}

.border {
  border: 1px solid #ddd;
}
</style>
