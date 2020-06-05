(function ($) {
  $(document).ready(function () {
    let buscarMensaje;
    let buscarNotificacion;

    $("#action_menu_btn").click(function () {
      $(".action_menu").toggle();
    });

    if ($(".notificar").length) {
      buscarNotificacion = setInterval(function () {
        let id_cliente = $(".notificar").attr("id-cliente");

        let data = {
          action: "ajax_busqueda",
          id_cliente: id_cliente,
          notificacion: 1,
        };

        $.ajax({
          url: busqueda_vars.ajaxurl,
          type: "post",
          data: data,
          beforeSend: function () {},
          success: function (result) {
            let resp = JSON.parse(result.slice(0, -1));
            let contador = resp.length;
            $(".notificar").html(" " + contador);
          },
        });
      }, 5000);
    }
    $(document).on("click", ".messenger", function () {
      $("#chat").removeClass("d-none");

      let id_user = $(this).attr("id-user");
      let id_post = $(this).attr("id-post");
      let id_cliente = $(this).attr("id-cliente");
      let id_enviado = $(this).attr("id_enviado");

      $(".send_btn").attr("id-user", id_user);
      $(".send_btn").attr("id-post", id_post);
      $(".send_btn").attr("id-cliente", id_cliente);
      $(".send_btn").attr("id_enviado", id_enviado);

      buscarMensaje = setInterval(function () {
        let id_user = $(".send_btn").attr("id-user");
        let id_post = $(".send_btn").attr("id-post");
        let id_cliente = $(".send_btn").attr("id-cliente");
        let id_enviado = $(".send_btn").attr("id_enviado");

        let data = {
          id_user,
          id_post,
          id_cliente,
          id_enviado,
        };
        chat_mensaje(data);
      }, 2000);
    });

    $(".cerrar-chat").click(function () {
      $("#chat").addClass("d-none");
      clearInterval(buscarMensaje);
    });

    let contar_mensajes = 0;

    function chat_mensaje(dato) {
      let id_user = dato.id_user;
      let id_post = dato.id_post;
      let id_cliente = dato.id_cliente;
      let id_enviado = dato.id_enviado;

      let data = {
        action: "ajax_busqueda",
        id_user,
        id_cliente,
        id_post,
        id_enviado,
        abrir_chat: 1,
      };

      $.ajax({
        url: busqueda_vars.ajaxurl,
        type: "post",
        data: data,
        beforeSend: function () {},
        success: function (result) {
          console.log(result);
          let resp = JSON.parse(result.slice(0, -1));
          let contador = resp.length;
          $(".contar-mensage").html(contador + " mensajes");
          // console.log(contador);
          // console.log(contar_mensajes);
          if (contar_mensajes != contador) {
            contar_mensajes = contador;
            $(".msg_card_body").html("");
            resp.map((data) => {
              let mensaje = `<div class="d-flex justify-content-start mb-4">
								<div class="img_cont_msg">
									<i class="fas fa-user-circle" style="font-size: 3rem"></i>
								</div>
								<div class="msg_cotainer">
									${data.mensaje}
									<span class="msg_time">${data.fecha}</span>
								</div>
              </div>`;

              $(".msg_card_body").append(mensaje);
              $(".msg_card_body").scrollTop(
                $(".msg_card_body").prop("scrollHeight")
              );
            });
          }
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

    $(".send_btn").click(function () {
      let mensaje = $(".type_msg").val();
      let id_user = $(this).attr("id-user");
      let id_post = $(this).attr("id-post");
      let id_cliente = $(this).attr("id-cliente");

      let body = $(".msg_card_body");

      let texto = `<div class="d-flex justify-content-start mb-4">
								<div class="img_cont_msg">
									<i class="fas fa-user-circle" style="font-size: 3rem"></i>
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
        id_user: id_user,
        id_cliente: id_cliente,
        id_post: id_post,
        mensaje: mensaje,
        chat_mensaje: 1,
      };

      // console.log(data);

      $.ajax({
        url: busqueda_vars.ajaxurl,
        type: "post",
        data: data,
        beforeSend: function () {},
        success: function (result) {
          // console.log(result);
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

    $(".type_msg").keydown(function (e) {
      if (e.keyCode == 13) {
        // console.log("presiono enter");
        let mensaje = $(".type_msg").val();
        let id_user = $(this).attr("id-user");
        let id_post = $(this).attr("id-post");
        let id_cliente = $(this).attr("id-cliente");

        let body = $(".msg_card_body");
        // console.log(mensaje.length);
        // console.log(mensaje);
        if (mensaje != "" && mensaje != null && mensaje.trim().length >= 1) {
          let texto = `<div class="d-flex justify-content-start mb-4">
								<div class="img_cont_msg">
									<i class="fas fa-user-circle" style="font-size: 3rem"></i>
								</div>
								<div class="msg_cotainer">
									${mensaje}
									<span class="msg_time">9:12 AM, Today</span>
								</div>
              </div>`;

          body.append(texto);
          $(".type_msg").val("");

          $(".msg_card_body").scrollTop(
            $(".msg_card_body").prop("scrollHeight")
          );

          let data = {
            action: "ajax_busqueda",
            id_user: id_user,
            id_cliente: id_cliente,
            id_post: id_post,
            mensaje: mensaje,
            chat_mensaje: 1,
          };

          // console.log(data);

          $.ajax({
            url: busqueda_vars.ajaxurl,
            type: "post",
            data: data,
            beforeSend: function () {},
            success: function (result) {
              // console.log(result);
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
      }
    });
  });
})(jQuery);
