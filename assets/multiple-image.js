var xp = 0;
var input_btn = 0;
var dts = [];
var productId = $("#product_id").val();
$(document).on("click", ".imgbuts", function (e) {
  input_btn++;
  $("#form-upload-file").append(
    "<input type='file' style='display:none;' name='upload_files[]' id='filenumber" +
      input_btn +
      "' class='img_file upload_files' accept='.gif,.jpg,.jpeg,.png,' multiple/>"
  );
  $("#filenumber" + input_btn).click();
});

$(document).on("change", ".upload_files", function (e) {
  files = e.target.files;
  filesLength = files.length;
  for (var i = 0; i < filesLength; i++) {
    xp++;
    var f = files[i];
    var res_ext = files[i].name.split(".");
    var img_or_video = res_ext[res_ext.length - 1];
    var fileReader = new FileReader();
    fileReader.name = f.name;
    fileReader.onload = function (e) {
      var file = e.target;
      $("#message_box").append(
        "<article class='suggested-posts-article remove_artical" +
          xp +
          "' data-file='" +
          file.name +
          "'><div class='posts_article background_v" +
          xp +
          "' style='background-image: url(" +
          e.target.result +
          ")'></div><div class='p_run_div'><span class='pp_run progress_run" +
          xp +
          "' style='opacity: 1;'></span></div><p class='fa_p p_for_fa" +
          xp +
          "'><span class='cancel_mutile_image btnxc cancel_fa" +
          xp +
          "' deltsid='" +
          0 +
          "'>&#10006;</span><span class='btnxc btnxc_r' >&#10004;</span></p></article>"
      );
    };
    fileReader.readAsDataURL(f);
  }
});

function save_muliple_image() {
  suggested = $(".suggested-posts-article").length;
  if (suggested > 0) {
    $(".cancel_mutile_image").prop("disabled", true);
    $("#post_send").prop("disabled", true);
    var formData = new FormData(document.getElementById("form-upload-file"));
    formData.append("dts", dts);
    formData.append("productId", productId);
    var xhr = new window.XMLHttpRequest();
    $.ajax({
      url: "upload_ajax.php",
      type: "POST",
      data: formData,
      processData: false,
      contentType: false,
      success: function (data) {
        $(".main-content").find(".message-loading-overlay2").remove();
      },
      error: function (e) {
        $("#preview_file_div ul").html(
          "<li class='text-danger'>Something wrong! Please try again.</li>"
        );
      },
      xhr: function (e) {
        xhr.upload.addEventListener(
          "progress",
          function (e) {
            console.log(e);
            if (e.lengthComputable) {
              var percentComplete = ((e.loaded || e.position) * 100) / e.total;
              if (percentComplete == 100) {
                $(".progress-bar")
                  .width(percentComplete + "%")
                  .html("99" + "%");
              } else {
                $(".progress-bar")
                  .width(percentComplete + "%")
                  .html(percentComplete + "%");
              }
            }
          },
          false
        );
        xhr.addEventListener("load", function (e) {
          $(".progress-bar")
            .css("background", "#5cb85c")
            .html("100" + "%");
          $(".btnxc_r").show();
          $(".success_msg").show();
          $(".btns").hide();
          $(".go-back").show();
          $(".cancel_mutile_image").remove();
        });
        return xhr;
      },
    });
  } else {
    $(".messaf").show();
  }
}
var rty = 0;
$(document).on("click", ".cancel_mutile_image", function (e) {
  $(".cancel_mutile_image").each(function () {
    chk_id = $(this).attr("deltsid");
    if (chk_id == 0) {
      rty++;
      $(this).attr("deltsid", rty);
    }
  });
  deltsid = $(this).attr("deltsid");
  dts.push(deltsid);
  $(this).parents(".suggested-posts-article").remove();
});
