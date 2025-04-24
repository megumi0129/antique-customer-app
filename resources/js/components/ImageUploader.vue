<!-- resources/js/components/ImageUploader.vue -->
<template>
  <div>
    <h3>来店画像アップロード</h3>

    <label>画像1</label>
    <input type="file" @change="preview($event, 'image1')" />
    <img v-if="previewImages.image1" :src="previewImages.image1" class="preview-img" />

    <label>画像2</label>
    <input type="file" @change="preview($event, 'image2')" />
    <img v-if="previewImages.image2" :src="previewImages.image2" class="preview-img" />

    <label>画像3</label>
    <input type="file" @change="preview($event, 'image3')" />
    <img v-if="previewImages.image3" :src="previewImages.image3" class="preview-img" />

  </div>
</template>

<script>
export default {
  data() {
    return {
      files: {},
      previewImages: {}
    };
  },
  methods: {
    preview(event, key) {
      const file = event.target.files[0];
      if (!file) return;
      this.files[key] = file;
      const reader = new FileReader();
      reader.onload = e => {
        this.previewImages[key] = e.target.result;
      };
      reader.readAsDataURL(file);
    },
    async submit() {
      const formData = new FormData();
      Object.entries(this.files).forEach(([key, file]) => {
        formData.append(key, file);
      });

      try {
        const response = await axios.post('/api/visit-image-upload', formData);
        alert('保存完了！');
      } catch (err) {
        console.error(err);
        alert('エラーが発生しました');
      }
    }
  }
};
</script>

<style scoped>
.preview-img {
  margin-top: 10px;
  max-width: 100%;
  height: auto;
  border: 1px solid #ccc;
}
</style>
