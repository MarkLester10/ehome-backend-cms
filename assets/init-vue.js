new Vue({
  el: "#app",
  data: {
    productId: null,
    categoryId: null,
    productsImages: [],
    subCategoryId: document.querySelector("#subCategoryId")
      ? parseInt(document.querySelector("#subCategoryId").value)
      : "",
    tags: [],
    subcategories: [],
    productUrl:
      "http://localhost:8080/app/Controllers/api/CategoryController.php",
  },
  methods: {
    loadProductImages() {
      this.productId = this.$refs.productId.value;
      axios
        .get(
          `${this.productUrl}?action=loadproductimages&product_id=${this.productId}`
        )
        .then((res) => {
          this.productsImages = res.data.productImages;
        });
    },
    loadSubCategories() {
      this.categoryId = this.$refs.categoryId.value;
      axios
        .get(
          `${this.productUrl}?action=loadsubcategories&category_id=${this.categoryId}`
        )
        .then((res) => {
          this.subcategories = res.data.subcategories;
          this.loadTags();
        });
    },
    loadTags() {
      axios
        .get(
          `${this.productUrl}?action=loadtags&subcategory_id=${this.subCategoryId}`
        )
        .then((res) => {
          this.tags = res.data.tags;
        });
    },
    toFormData: function (obj) {
      var fd = new FormData();
      for (var i in obj) {
        fd.append(i, obj[i]);
      }
      return fd;
    },
  },
  mounted: function () {
    this.loadSubCategories();
  },
});
