<template>
  <div>
    <h3 class="mt-5">最近投稿された記事</h3>
    <div class="row mt-3">
      <div
        v-for="relatedPost in posts"
        :key="relatedPost.id"
        class="col-md-4 mb-4 col-sm-6 col-12"
      >
        <a :href="`/posts/${relatedPost.id}`" class="card-link">
          <div class="card h-100">
            <div class="card-body">
              <h5 class="card-title">
                {{ relatedPost.title.substring(0, 25) }}...
              </h5>
              <p class="card-text">
                {{ relatedPost.content.substring(0, 54) }}...
              </p>
            </div>
          </div>
        </a>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  props: {
    posts: Array, // 関連記事データを受け取る
  },
};
</script>
