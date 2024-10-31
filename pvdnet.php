<?php
/**The Pvd.net Plugin – a plugin for WordPress that enables get your contacts from Wordpress into pvd.net plataform.

Copyright (c) 2019, Infotechnology Inc.

The Pvd.net Plugin is free software: you can redistribute it and/or modify it under the terms of the GNU General Public License as published by the Free Software Foundation, either version 2 of the License or (at your option) any later version.

This program is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU General Public License for more details.

You should have received a copy of the GNU General Public License along with this program. If not, see <http://www.gnu.org/licenses/>

You can contact us at comercial@infotechnology.com.br

/**
 * Plugin name: pvdnet
 * Description: Esse plugin intercepta o envio do contact form 7 para salvar contatos em pvdnet. É premissa para o funcionamento deste plugin o Contact Form 7 previamente instalado.
 * Version: 1.0
 * Author: Infotechnology
 * License: GPLv2 or later
 */


function pvd_add_contact($WPCF7_ContactForm)
{
    try{
        $submission = WPCF7_Submission::get_instance();
        $posted_data = $submission->get_posted_data();
        $url_origem = $submission->get_meta( 'url' );
        $ip = $submission->get_meta( 'remote_ip' );
        $nome = "";
        $email = "";
        $fone = "";
        $empresa = "";
        $comentario = "";
        foreach ($posted_data as $key => $value) {
            if(strpos($key, 'name') !== false || strpos($key, 'nome') !== false){
                $nome = $value;
            }
            if(strpos($key, 'email') !== false){
                $email = $value;
            }
            if(strpos($key, 'tel') !== false || 
                strpos($key, 'telefone') !== false ||
                strpos($key, 'fone') !== false ||
                strpos($key, 'phone') !== false ||
                strpos($key, 'celular') !== false ||
                strpos($key, 'cel') !== false) {
                    if($value){
                        $fone = $value;
                    }
            }
            if(strpos($key, 'empresa') !== false || 
                strpos($key, 'company') !== false ||
                strpos($key, 'companhia') !== false ||
                strpos($key, 'business') !== false) {
                    if($value){
                        $empresa = $value;
                    }
            }
            if(strpos($key, 'comentario') !== false || 
                strpos($key, 'your-message') !== false ||
                strpos($key, 'message') !== false ||
                strpos($key, 'mensagem') !== false) {
                    if($value){
                        $comentario = $value;
                    }
            }
        }

        if($nome != "" && $email != ""){
            $body = array(
                'nome'          => $nome,
                'email'         => $email,
                'hashtag'       => str_replace(" ", "-", $WPCF7_ContactForm->title()),
                'utm'           => '20',
                'origem'        => 'wordpress',
                'empresa'       => $empresa,
                'url_origem'    => $url_origem,
                'ip'            => $ip,
                'comentario'    => $comentario
            );
            
            if(isset($_COOKIE['PVD_ID'])){
                $body['cookie'] = $_COOKIE['PVD_ID'];
            }

            $args = array(
                'body' => $body,
                'timeout' => '5',
                'redirection' => '5',
                'httpversion' => '1.0',
                'blocking' => true,
                'headers' => array(),
                'cookies' => array()
            );

            $url = "https://pvd.net.br/pvd/api/contatos/store";
            
            $response = wp_remote_post( $url, $args );
        }
    }catch(Exception $e){
    }
  
}

add_action( 'wpcf7_submit' , 'pvd_add_contact'); 
