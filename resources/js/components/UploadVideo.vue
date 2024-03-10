<template>
  <div class="content-widget">
    <div
      class="container"
      :class="classActive"
      @dragover.prevent="dragOver"
      @dragleave.prevent="dragLeave"
      @drop.prevent="drop($event)"
    >
      <div class="drop" v-show="dropped == 2"></div>
      <!-- Error Message -->
      <div v-show="error" class="error">
        {{ error }}
      </div>

      <!-- To inform user how to upload image -->
      <div v-show="Imgs.length == 0" class="beforeUpload">
        <input
          type="file"
          style="z-index: 1"
          accept="video/mp4,video/x-m4v,video/*"
          ref="uploadInput"
          @change="previewImgs"
        />

        <p class="mainMessage">
          <svg
            width="22"
            height="18"
            viewBox="0 0 22 18"
            fill="none"
            xmlns="http://www.w3.org/2000/svg"
          >
            <path
              fill-rule="evenodd"
              clip-rule="evenodd"
              d="M14.5179 15.1618H3.17871C1.55148 15.1618 0.700195 14.3181 0.700195 12.7059V4.79576C0.700195 3.18359 1.55148 2.33984 3.17871 2.33984H5.14495C5.73256 2.33984 5.92843 2.23437 6.29004 1.8577L6.88518 1.21735C7.27693 0.803013 7.6762 0.599609 8.44461 0.599609H11.5409C12.3093 0.599609 12.7086 0.803013 13.1003 1.21735L13.6955 1.8577C14.0646 2.24191 14.2529 2.33984 14.8405 2.33984H16.8444C18.4717 2.33984 19.3305 3.18359 19.3305 4.79576V10.5365C19.1473 10.5122 18.9606 10.4996 18.7712 10.4996C16.4256 10.4996 14.5002 12.4307 14.5002 14.7739C14.5002 14.9046 14.5062 15.034 14.5179 15.1618ZM5.95103 8.72824C5.95103 10.9883 7.75907 12.7963 10.0116 12.7963C12.2716 12.7963 14.0797 10.9883 14.0797 8.72824C14.0797 6.46066 12.2716 4.65262 10.0116 4.65262C7.75907 4.65262 5.95103 6.46066 5.95103 8.72824ZM15.5713 4.95396C15.0213 4.95396 14.5618 5.42104 14.5618 5.95591C14.5618 6.52093 15.0213 6.95787 15.5713 6.95787C16.1137 6.95033 16.5732 6.51339 16.5732 5.95591C16.5732 5.42104 16.1137 4.95396 15.5713 4.95396ZM12.7161 8.72824C12.7161 10.2274 11.5107 11.4328 10.0116 11.4328C8.52748 11.4328 7.31459 10.2274 7.31459 8.72824C7.31459 7.22154 8.51995 6.01618 10.0116 6.01618C11.5107 6.01618 12.7161 7.22154 12.7161 8.72824Z"
              fill="#2D2D2D"
            />
            <path
              d="M18.6836 17.9931C20.4984 17.9931 21.9963 16.4952 21.9963 14.6836C21.9963 12.872 20.4952 11.374 18.6804 11.374C16.8688 11.374 15.374 12.872 15.374 14.6836C15.374 16.4952 16.872 17.9931 18.6836 17.9931ZM17.1344 14.6868C17.1344 14.4979 17.2689 14.3667 17.4545 14.3667H18.3667V13.4545C18.3667 13.2689 18.4947 13.1376 18.6772 13.1376C18.866 13.1376 18.9973 13.2689 18.9973 13.4545V14.3667H19.9127C20.0951 14.3667 20.2295 14.4979 20.2295 14.6868C20.2295 14.8692 20.0951 15.0005 19.9127 15.0005H18.9973V15.9127C18.9973 16.0951 18.866 16.2295 18.6772 16.2295C18.4947 16.2295 18.3667 16.0951 18.3667 15.9127V15.0005H17.4545C17.2689 15.0005 17.1344 14.8692 17.1344 14.6868Z"
              fill="#2D2D2D"
            />
          </svg>

          {{
            uploadMsg ? uploadMsg : "Click to upload or drop you video here"
          }}
        </p>
      </div>
      <div class="imgsPreview" v-show="Imgs.length > 0">
        <div class="imageHolder" v-for="(img, i) in Imgs" :key="i">
          <video width="350"  controls>
            <source :src="img" type="video/mp4" />
            Your browser does not support the video tag.
          </video>
          <span
            class="delete"
            style="color: #eb090a"
            @click="
              deleteImg(--i);
              $emit('cleanImg');
            "
          >
            <svg
              class="icon"
              xmlns="http://www.w3.org/2000/svg"
              fill="none"
              viewBox="0 0 24 24"
              stroke="currentColor"
            >
              <path
                stroke-linecap="round"
                stroke-linejoin="round"
                stroke-width="2"
                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"
              />
            </svg>
          </span>
        </div>
      </div>
    </div>

    <div
      v-if="Imgs.length > 0"
      type="button"
      class="clearButton"
      @click="reset"
    >
      {{ clearAll ? clearAll : "Clear" }}
    </div>
  </div>
</template>
<script>
export default {
  name: "VueUploadImages", // vue component name
  data() {
    return {
      error: "",
      files: [],
      dropped: 0,
      Imgs: [],
    };
  },
  props: {
    max: Number,
    uploadMsg: String,
    maxError: String,
    fileError: String,
    clearAll: String,
  },
  emits: ["cleanImg"],
  computed: {
    classActive() {
      return {
        active: this.Imgs.length > 0,
      };
    },
  },
  methods: {
    dragOver() {
      this.dropped = 2;
    },
    dragLeave() {},
    drop(e) {
      let status = true;
      let files = Array.from(e.dataTransfer.files);
      if (e && files) {
        if (status == true) {
          if (
            this.$props.max &&
            files.length + this.files.length > this.$props.max
          ) {
            this.error = this.$props.maxError
              ? this.$props.maxError
              : `Maximum files is` + this.$props.max;
          } else {
            this.files.push(...files);
            this.previewImgs();
          }
        } else {
          this.error = this.$props.fileError
            ? this.$props.fileError
            : `Unsupported file type`;
        }
      }
      this.dropped = 0;
    },
    append() {
      this.$refs.uploadInput.click();
    },
    readAsDataURL(file) {
      return new Promise(function (resolve, reject) {
        let fr = new FileReader();
        fr.onload = function () {
          resolve(fr.result);
        };
        fr.onerror = function () {
          reject(fr);
        };
        fr.readAsDataURL(file);
      });
    },
    deleteImg(index) {
      this.Imgs.splice(index, 1);
      this.files.splice(index, 1);
      this.$emit("changed", this.files);
      this.$refs.uploadInput.value = null;
    },
    previewImgs(event) {
      if (
        this.$props.max &&
        event &&
        event.currentTarget.files.length + this.files.length > this.$props.max
      ) {
        this.error = this.$props.maxError
          ? this.$props.maxError
          : `Maximum files is` + this.$props.max;
        return;
      }
      if (this.dropped == 0) this.files.push(...event.currentTarget.files);
      this.error = "";
      this.$emit("changed", this.files);
      let readers = [];
      if (!this.files.length) return;
      for (let i = 0; i < this.files.length; i++) {
        readers.push(this.readAsDataURL(this.files[i]));
      }
      Promise.all(readers).then((values) => {
        this.Imgs = values;
      });
    },
    reset() {
      this.$refs.uploadInput.value = null;
      this.Imgs = [];
      this.files = [];
      this.$emit("changed", this.files);
    },
  },
};
</script>
<style scoped>
.container {
  width: 100%;
  height: 255px;
  background: #f7fafc;
  display: flex;
  place-items: center;
  background-image: url("data:image/svg+xml,%3csvg width='100%25' height='100%25' xmlns='http://www.w3.org/2000/svg'%3e%3crect width='100%25' height='100%25' fill='none' rx='10' ry='10' stroke='%23BABABAFF' stroke-width='1' stroke-dasharray='8' stroke-dashoffset='0' stroke-linecap='square'/%3e%3c/svg%3e");
  border-radius: 10px;
  border-radius: 10px;
  padding: 10px;
  position: relative;
}
.drop {
  width: 100%;
  height: 100%;
  top: 0;
  border-radius: 10px;
  position: absolute;
  background-color: #f4f6ff;
  left: 0;
  border: 3px dashed #a3a8b1;
}
.error {
  text-align: center;
  color: red;
  font-size: 15px;
}
.beforeUpload {
  position: relative;
  text-align: center;
  height: 100%;
  width: 100%;
  display: flex;
  place-items: center;
}
.beforeUpload input {
  width: 100%;
  margin: auto;
  height: 100%;
  opacity: 0;
  position: absolute;
  background: red;
  display: block;
}
.beforeUpload input:hover {
  cursor: pointer;
}
.beforeUpload .icon {
  width: 150px;
  margin: auto;
  display: block;
}
/* .imgsPreview .imageHolder {
  width: 150px;
  height: 150px;
  background: #fff;
  position: relative;
  border-radius: 10px;
  margin: 5px 5px;
  display: inline-block;
}
.imgsPreview .imageHolder img {
  object-fit: cover;
  width: 100%;
  height: 100%;
} */
.imgsPreview .imageHolder .delete {
  position: absolute;
  top: calc(50% - 14px);
  right: 4px;
  width: 29px;
  height: 29px;
  color: #eb090a;
  border-radius: 50%;
}
.imgsPreview .imageHolder .delete:hover {
  cursor: pointer;
}
.imgsPreview .imageHolder .delete .icon {
  width: 66%;
  height: 66%;
  display: block;
  margin: 4px auto;
}
.imgsPreview .imageHolder .plus {
  color: #2d3748;
  background: #f7fafc;
  border-radius: 50%;
  font-size: 21pt;
  height: 30px;
  width: 30px;
  text-align: center;
  border: 1px dashed;
  line-height: 23px;
  position: absolute;
  right: -42px;
  bottom: 43%;
}
.plus:hover {
  cursor: pointer;
}
.clearButton {
  color: #222;
  font-weight: 800;
  font-size: 16px;
  margin-top: 12px;
  text-decoration: underline;
  background: transparent;
}
.span-delete {
  position: absolute;
  top: calc(50% - 5px);
  right: 26px;
}
.mainMessage {
  font-weight: 600;
  color: #2d2d2d;
  font-size: 14px;
  margin-bottom: 0px !important;
}
.container.active {
  background: #faf2f8 !important;
  border: 1px solid #dc39c6 !important;
  box-shadow: 5px 10px 30px rgba(0, 0, 0, 0.25);
}
.beforeUpload .icon {
  width: 35px !important;
  margin: auto;
  display: block;
}
.imageHolder img {
  width: 64px !important;
  height: 64px !important;
  border-radius: 10px;
}
.imgsPreview .imageHolder {
  width: 100% !important;
  height: 100% !important;
}
textarea.input.error {
  border: 1px solid #fe1616;
}
.contianer {
  position: relative;
}
span.delete {
  right: -700px !important;
}
</style>
