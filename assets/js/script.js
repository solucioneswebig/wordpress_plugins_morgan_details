(function($) {
    $(document).ready(function() {
        let buscarMensaje;
        let buscarNotificacion;

        let id_user;
        let id_post;
        let id_cliente;
        let id_envio;

        const chat = document.querySelector("#chat");
        const enviar = document.querySelector(".send_btn");
        const cerrar = document.querySelector(".cerrar-chat");
        const body_msj = document.querySelector(".msg_card_body");
        const mensaje = document.querySelector(".messenger");
        const notificar = document.querySelector(".notificar");
        const body = document.querySelector(".msg_card_body");

        const burbuja_chat = document.querySelector(".chatGrupal");
        const chat_grupal = document.querySelector("#chat_grupal");
        const cerrar_chat_grupal = document.querySelector(".cerrar_chat_grupal");

        $("#action_menu_btn").click(function() {
            $(".action_menu").toggle();
        });

        if (document.body.contains(mensaje)) {
            mensaje.addEventListener("click", function() {
                chat.classList.remove("d-none");

                id_user = this.getAttribute("id-user");
                id_post = this.getAttribute("id-post");
                id_cliente = this.getAttribute("id-cliente");
                id_envio = this.getAttribute("id_enviado");

                let data = {
                    id_cliente,
                    id_user,
                    id_post,
                    id_envio,
                };
                chat_mensaje(data);
            });
        }

        enviar.addEventListener("click", function() {
            let msg = document.querySelector(".type_msg").value;
            let f = new Date();
            let fecha =
                f.getDate() + "/" + (f.getMonth() + 1) + "/" + f.getFullYear();

            let datos = { mensaje: msg, fecha: fecha };
            const texto = cuerpo_mensaje(datos);

            body.innerHTML += texto;

            $(".msg_card_body").scrollTop($(".msg_card_body").prop("scrollHeight"));

            let data = new FormData();

            data.append("action", "ajax_busqueda");
            data.append("id_cliente", id_cliente);
            data.append("id_user", id_user);
            data.append("id_post", id_post);
            data.append("id_envio", id_envio);
            data.append("mensaje", msg);
            data.append("chat_mensaje", 1);

            fetch(busqueda_vars.ajaxurl, {
                    method: "POST",
                    body: data,
                })
                .then((response) => response.json())
                .then((response) => console.log(response))
                .catch((err) => console.log(err));
        });

        if (document.body.contains(notificar)) {
            buscarNotificacion = setInterval(function() {
                let id_cliente = notificar.getAttribute("id-cliente");

                let data = new FormData();

                data.append("action", "ajax_busqueda");
                data.append("id_cliente", id_cliente);
                data.append("notificacion", 1);

                fetch(busqueda_vars.ajaxurl, {
                        method: "POST",
                        body: data,
                    })
                    .then((response) => response.json())
                    .then((response) => {
                        // console.log(response);
                        let contador = response.length;
                        // console.log(contador);
                        notificar.innerHTML = " " + contador;
                    })
                    .catch((err) => console.log(err));
            }, 10000);

            buscarMensaje = setInterval(function() {
                if (
                    id_cliente != null &&
                    id_user != null &&
                    id_post != null &&
                    document.body.contains(mensaje)
                ) {
                    let data = {
                        id_cliente,
                        id_user,
                        id_post,
                        id_envio,
                    };
                    chat_mensaje(data);
                }
            }, 5000);
        }

        cerrar.addEventListener("click", function() {
            chat.classList.add("d-none");
            clearInterval(buscarMensaje);
        });

        burbuja_chat.addEventListener("click", function() {
            this.classList.add("d-none");
            chat_grupal.classList.remove("d-none");
            chat_grupal_user();
        });

        cerrar_chat_grupal.addEventListener("click", function() {
            burbuja_chat.classList.remove("d-none");
            chat_grupal.classList.add("d-none");
        });

        function chat_mensaje(dato) {
            let data = new FormData();
            let activo;

            data.append("action", "ajax_busqueda");
            data.append("id_cliente", dato.id_cliente);
            data.append("id_user", dato.id_user);
            data.append("id_post", dato.id_post);
            data.append("id_envio", dato.id_envio);
            data.append("abrir_chat", 1);

            fetch(busqueda_vars.ajaxurl, {
                    method: "POST",
                    body: data,
                })
                .then((response) => response.json())
                .then((response) => {
                    // console.log(response);
                    body_msj.innerHTML = "";

                    response.map((data) => {
                        if (data.id_user == data.id_envio) {
                            activo = 1;
                        } else {
                            activo = 0;
                        }
                        let datos = {
                            mensaje: data.mensaje,
                            fecha: data.fecha,
                            activo: activo,
                        };
                        let cuerpo = cuerpo_mensaje(datos);
                        $(".msg_card_body").append(cuerpo);
                    });

                    $(".msg_card_body").scrollTop(
                        $(".msg_card_body").prop("scrollHeight")
                    );
                })
                .catch((err) => console.log(err));
        }

        function cuerpo_mensaje(data) {
            let clase;

            if (data.activo) {
                clase = "justify-content-end";
            } else {
                clase = "justify-content-start";
            }

            let mensaje = `<div class="d-flex ${clase} mb-4">
			    <div class="img_cont_msg">
				    <i class="fas fa-user-circle" style="font-size: 3rem"></i>
								</div>
								<div class="msg_cotainer">
									${data.mensaje}
									<span class="msg_time">${data.fecha}</span>
								</div>
							</div>`;

            return mensaje;
        }

        function chat_grupal_user() {
            let data = new FormData();

            data.append("action", "ajax_busqueda");
            data.append("abrir_chat_grupal", 1);

            fetch(busqueda_vars.ajaxurl, {
                    method: "POST",
                    body: data,
                })
                .then((response) => response.json())
                .then((response) => {
                    console.log(response);
                    body_msj.innerHTML = "";

                    response.map((data) => {
                        let datos = {
                            name: data.display_name,
                            id_user: data.id_user,
                            id_post: data.id_post,
                        };

                        let cuerpo = cuerpo_mensaje_grupal(datos);
                        $(".msg_card_body").append(cuerpo);
                    });
                })
                .catch((err) => console.log(err));
        }

        function cuerpo_mensaje_grupal(data) {
            let mensaje = `<div class="d-flex justify-content-start mb-4">
			    <div class="img_cont_msg">
				    <a href="#" class="user_grupal" id_user="${data.id_user}" id_post="${data.id_post}"><i class="fas fa-user-circle" style="font-size: 3rem"></i></a>
								</div>
								<div class="msg_cotainer"><a href="#" class="user_grupal" id_user="${data.id_user}" id_post="${data.id_post}">${data.name}</a></div>
							</div>`;

            return mensaje;
        }
    });
})(jQuery);