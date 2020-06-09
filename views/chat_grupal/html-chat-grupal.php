<a href="#" class="chatGrupal"><i class="fas fa-comment-alt"></i></a>
<?php

  $cu = wp_get_current_user(); 
?>

<div class="container-fluid d-none posision-chat" id="chat_grupal">
  <div class="row justify-content-center">
    
    <div class="chat posicion-caja-grupal">
      <div class="card">
        <div class="card-header msg_head">
          <div class="d-flex bd-highlight justify-content-between">
            <div class="img_cont d-flex justify-content-center align-items-center">
              <!-- <img src="https://static.turbosquid.com/Preview/001292/481/WV/_D.jpg" class="rounded-circle user_img"> -->
              <i class="fas fa-user-circle" style="font-size: 3rem"></i>
              <span class="online_icon"></span>
            </div>
            <div class="user_info">
              <span><?php 
                if(!empty($cu)){
                  echo $cu->user_firstname; 
                }
              ?></span>
              <p class="contar-mensage"></p>
            </div>
            <div class="video_cam">
              <span><i class="fas fa-times-circle cerrar_chat_grupal"></i></span>
            </div>
          </div>
          <!-- <span id="action_menu_btn"><i class="fas fa-ellipsis-v"></i></span>
          <div class="action_menu">
            <ul>
              <li><i class="fas fa-user-circle"></i> View profile</li>
              <li><i class="fas fa-users"></i> Add to close friends</li>
              <li><i class="fas fa-plus"></i> Add to group</li>
              <li><i class="fas fa-ban"></i> Block</li>
            </ul>
          </div> -->
        </div>
        <div class="card-body msg_card_body_grupal">
          
          
        </div>
        <div class="card-footer">
          <div class="input-group">
            <!-- <textarea name="" class="form-control type_msg" placeholder="Buscar"></textarea> -->
            <input type="text" class="form-control" placeholder="Buscar Clientes">
            <div class="input-group-append">
              <span class="input-group-text send_btn" id-post="" id-user="<?php echo $cu->ID; ?>" id-cliente=""><i class="fas fa-location-arrow"></i></span>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>