$(document).on("click", ".edit-btn", function () {
  var categoryId = $(this).data("id");
  var categoryName = $(this).data("name");
  var categorySlug = $(this).data("slug");
  $("#id").val(categoryId);
  $("#name").val(categoryName);
  $("#slug2").val(categorySlug);
  $("#modal-edit").modal("show");
});
$(document).on("click", ".productImage", function () {
  var productId = $(this).data("id");
  $("#pid").val(productId);
  $("#pid").click();
});

$(function () {
  $("#example1").DataTable();
});

//slugify
function slugify(str) {
  const slug = document.getElementById("slug");
  const slug2 = document.getElementById("slug2");
  str = str.replace(/^\s+|\s+$/g, ""); // trim
  str = str.toLowerCase();

  // remove accents, swap ñ for n, etc
  var from = "àáäâèéëêìíïîòóöôùúüûñç·/_,:;";
  var to = "aaaaeeeeiiiioooouuuunc------";
  for (var i = 0, l = from.length; i < l; i++) {
    str = str.replace(new RegExp(from.charAt(i), "g"), to.charAt(i));
  }

  str = str
    .replace(/[^a-z0-9 -]/g, "") // remove invalid chars
    .replace(/\s+/g, "-") // collapse whitespace and replace by -
    .replace(/-+/g, "-"); // collapse dashes

  slug.value = str;
  slug2.value = str;
}

// preview image
function displayImage(e) {
  if (e.files[0]) {
    var reader = new FileReader();

    reader.onload = function (e) {
      document
        .querySelector("#imageDisplay")
        .setAttribute("src", e.target.result);
    };
    reader.readAsDataURL(e.files[0]);
  }
}

//multi select
const tags = document.getElementById("tags");
if (tags) {
  new TomSelect("#tags", {
    plugins: ["remove_button"],
    create: true,
  });
}
