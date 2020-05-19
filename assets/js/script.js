(function ($) {
  $(document).ready(function () {
    // $(".table").DataTable();s
    setInterval(chat_mensaje(), 1000);

    function chat_mensaje() {
      let id_user = $(".messenger").attr("id-user");
      let id_post = $(".messenger").attr("id-post");
      let id_autor = $(".messenger").attr("id-autor");

      let data = {
        action: "ajax_busqueda",
        id_user: id_autor,
        id_cliente: id_user,
        id_post: id_post,
        abrir_chat: 1,
      };

      $.ajax({
        url: busqueda_vars.ajaxurl,
        type: "post",
        data: data,
        beforeSend: function () {},
        success: function (result) {
          // console.log(result);
          let resp = JSON.parse(result.slice(0, -1));

          console.log(resp);
          resp.map((data) => {
            let mensaje = `<div class="d-flex justify-content-start mb-4">
								<div class="img_cont_msg">
									<img src="https://static.turbosquid.com/Preview/001292/481/WV/_D.jpg" class="rounded-circle user_img_msg">
								</div>
								<div class="msg_cotainer">
									${data.mensaje}
									<span class="msg_time">${data.fecha}</span>
								</div>
              </div>`;

            $(".msg_card_body").append(mensaje);
          });
        },
        error: function (jqXHR, exception) {
          var msg = "";
          if (jqXHR.status === 0) {
            msg = "Not connect.\n Verify Network.";
          } else if (jqXHR.status == 404) {
            msg = "Requested page not found. [404]";
          } else if (jqXHR.status == 500) {
            msg = "Internal Server Error [500].";
          } else if (exception === "parsererror") {
            msg = "Requested JSON parse failed.";
          } else if (exception === "timeout") {
            msg = "Time out error.";
          } else if (exception === "abort") {
            msg = "Ajax request aborted.";
          } else {
            msg = "Uncaught Error.\n" + jqXHR.responseText;
          }
          console.log(msg);
        },
      });
    }

    $("#action_menu_btn").click(function () {
      $(".action_menu").toggle();
    });

    $(".messenger").click(function () {
      $("#chat").removeClass("d-none");
    });

    $(".send_btn").click(function () {
      let mensaje = $(".type_msg").val();
      let id_user = $(".messenger").attr("id-user");
      let id_post = $(".messenger").attr("id-post");
      let id_autor = $(".messenger").attr("id-autor");
      let body = $(".msg_card_body");

      let texto = `<div class="d-flex justify-content-start mb-4">
								<div class="img_cont_msg">
									<img src="https://static.turbosquid.com/Preview/001292/481/WV/_D.jpg" class="rounded-circle user_img_msg">
								</div>
								<div class="msg_cotainer">
									${mensaje}
									<span class="msg_time">9:12 AM, Today</span>
								</div>
              </div>`;

      body.append(texto);
      $(".type_msg").val("");

      $(".msg_card_body").scrollTop($(".msg_card_body").prop("scrollHeight"));

      let data = {
        action: "ajax_busqueda",
        id_user: id_autor,
        id_cliente: id_user,
        id_post: id_post,
        mensaje: mensaje,
        chat_mensaje: 1,
      };

      console.log(data);

      $.ajax({
        url: busqueda_vars.ajaxurl,
        type: "post",
        data: data,
        beforeSend: function () {},
        success: function (resul) {
          console.log(resul);
        },
        error: function (jqXHR, exception) {
          var msg = "";
          if (jqXHR.status === 0) {
            msg = "Not connect.\n Verify Network.";
          } else if (jqXHR.status == 404) {
            msg = "Requested page not found. [404]";
          } else if (jqXHR.status == 500) {
            msg = "Internal Server Error [500].";
          } else if (exception === "parsererror") {
            msg = "Requested JSON parse failed.";
          } else if (exception === "timeout") {
            msg = "Time out error.";
          } else if (exception === "abort") {
            msg = "Ajax request aborted.";
          } else {
            msg = "Uncaught Error.\n" + jqXHR.responseText;
          }
          console.log(msg);
        },
      });
    });
  });
})(jQuery);
