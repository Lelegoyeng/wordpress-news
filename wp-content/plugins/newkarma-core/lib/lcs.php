<?php
/* Exit if accessed directly */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if(!function_exists("\x6e\145\167\x6b\141\162\155\141\x5f\x63\x6f\162\145\137\147\145\164\x5f\x68\x6f\155\x65")){function newkarma_core_get_home(){$dNPug=array("\150\164\x74\x70\72\x2f\57","\x68\164\164\160\163\72\57\x2f","\x68\x74\164\x70\x3a\x2f\57\x77\x77\x77\56","\150\x74\164\160\x73\72\x2f\57\167\167\167\56","\x77\x77\x77\x2e");return str_replace($dNPug,'',home_url());}}if(!function_exists("\x6e\x65\x77\153\141\162\x6d\x61\137\143\x6f\x72\145\x5f\x6c\151\143\145\156\x73\x65\137\x6d\145\x6e\165")){function newkarma_core_license_menu(){add_plugins_page(__("\x4e\x65\x77\153\x61\x72\x6d\x61\x20\x4c\151\x63\145\156\x73\x65","\x6e\x65\x77\x6b\141\162\x6d\x61\55\143\157\x72\x65"),__("\116\x65\167\x6b\141\162\x6d\x61\40\114\151\143\x65\156\x73\x65","\156\x65\167\153\141\162\x6d\141\x2d\x63\157\x72\145"),"\x6d\141\156\x61\x67\x65\137\157\x70\164\151\x6f\x6e\163",NEWKARMA_PLUGIN_LICENSE_PAGE,"\156\x65\x77\x6b\x61\x72\x6d\x61\x5f\143\157\162\x65\137\x6c\x69\x63\x65\156\x73\x65\137\160\x61\x67\145");}}add_action("\141\144\155\x69\156\137\155\x65\156\165","\156\x65\167\x6b\141\162\x6d\141\x5f\x63\x6f\162\x65\x5f\x6c\151\143\x65\x6e\163\x65\x5f\155\x65\156\x75");if(!function_exists("\x6e\x65\x77\x6b\x61\x72\x6d\141\137\143\x6f\x72\x65\x5f\154\151\x63\x65\156\x73\145\137\160\x61\x67\x65")){function newkarma_core_license_page(){$rxUAZ=md5(newkarma_core_get_home());$FdC_Z=trim(get_option("\x6e\x65\x77\153\141\x72\155\x61\137\x63\157\x72\145\137\154\151\143\145\x6e\x73\x65\x5f\163\x74\141\164\165\x73".$rxUAZ));echo "\11\11\x3c\x64\x69\x76\40\x63\x6c\141\x73\x73\x3d\42\167\x72\141\160\42\x3e\xa\11\x9\x9\x3c\x68\62\76";esc_attr_e("\x4e\x65\167\153\x61\x72\x6d\x61\40\114\x69\x63\x65\x6e\163\x65\x20\x4f\x70\164\151\x6f\156\x73","\156\145\x77\x6b\141\x72\155\141\x2d\x63\x6f\x72\x65");echo "\x3c\x2f\x68\62\76\xa\11\11\11\74\146\157\162\155\x20\155\x65\164\x68\157\144\75\42\160\157\x73\164\42\40\141\143\164\151\x6f\x6e\75\x22\x6f\160\164\x69\x6f\x6e\163\56\x70\150\x70\x22\76\xa\x9\x9\x9\11";settings_fields("\x6e\145\x77\x6b\x61\x72\x6d\x61\x5f\x63\x6f\162\x65\137\x6c\151\143\145\x6e\x73\145");echo "\11\11\11\x9\x3c\x74\x61\142\x6c\x65\x20\x63\x6c\x61\x73\x73\75\x22\146\157\162\155\x2d\x74\x61\x62\x6c\145\x22\x3e\12\x9\11\x9\11\x9\74\x74\x62\x6f\144\171\76\xa\x9\11\x9\x9\11\x9\74\164\x72\x20\x76\x61\154\151\147\156\x3d\42\x74\157\x70\x22\x3e\xa\11\x9\11\11\11\x9\x9\x3c\164\150\40\x73\x63\x6f\x70\x65\x3d\x22\162\x6f\167\42\40\x76\x61\154\151\x67\156\75\x22\164\x6f\x70\x22\76\12\11\x9\x9\x9\11\11\11\11";esc_attr_e("\114\x69\143\145\156\x73\x65\40\113\x65\x79","\156\145\167\x6b\x61\162\155\141\55\x63\157\162\x65");echo "\11\x9\x9\x9\11\x9\x9\74\x2f\164\x68\76\12\x9\11\11\11\11\11\x9\74\164\144\x3e\xa\x9\11\11\x9\11\11\11\11\x3c\151\156\160\x75\x74\x20\x69\x64\75\42\x6e\145\167\153\141\x72\x6d\141\137\x63\157\x72\145\x5f\x6c\x69\x63\145\156\x73\x65\x5f\153\145\x79\x22\x20\x6e\x61\155\145\75\42\156\x65\167\x6b\x61\162\x6d\x61\137\x63\x6f\162\x65\x5f\x6c\x69\x63\x65\x6e\x73\x65\137\153\x65\171\x22\40\164\171\x70\145\75\42\164\x65\170\164\x22\40\x70\x6c\141\143\x65\x68\x6f\x6c\x64\145\162\75\42\130\x58\x58\130\130\137\x78\x78\x78\170\x78\x78\x78\170\x78\170\170\170\170\x78\x78\42\x20\143\x6c\x61\x73\163\x3d\x22\x72\x65\147\165\154\141\x72\55\164\145\x78\164\42\40\57\76\x3c\x62\x72\x20\57\x3e\12\11\x9\11\x9\x9\x9\x9\x9\74\154\141\x62\x65\x6c\x20\143\154\141\163\x73\75\42\x64\145\163\143\162\151\160\x74\x69\x6f\156\42\40\x66\x6f\x72\x3d\42\156\x65\167\x6b\141\x72\155\141\137\x63\157\162\145\137\x6c\x69\x63\x65\x6e\x73\x65\137\153\145\171\42\x3e";esc_attr_e("\105\156\164\x65\162\x20\x79\157\165\162\40\154\151\143\x65\156\163\x65\x20\153\145\171\x20\150\145\x72\145","\156\x65\167\153\141\x72\x6d\141\x2d\x63\157\x72\145");echo "\74\x2f\x6c\141\x62\x65\x6c\76\12\x9\11\x9\11\x9\x9\11\x3c\57\x74\144\76\12\11\x9\11\x9\x9\11\74\x2f\164\162\76\12\xa\11\11\x9\x9\11\11\74\x74\x72\40\166\x61\x6c\151\147\x6e\x3d\42\164\x6f\x70\42\x3e\12\11\11\x9\11\11\x9\x9\74\x74\x68\40\x73\143\157\160\x65\75\x22\x72\157\167\x22\x20\166\x61\x6c\x69\x67\x6e\x3d\42\164\157\160\x22\x3e\xa\x9\11\11\11\11\11\11\x9";esc_attr_e("\x41\143\164\x69\x76\141\x74\145\40\x4c\151\x63\x65\156\x73\x65","\156\145\167\153\141\x72\155\x61\55\143\x6f\162\x65");echo "\11\x9\11\11\11\11\x9\x3c\57\164\x68\76\12\xa\11\11\x9\x9\x9\11\11\x3c\164\x64\x3e\12\x9\11\x9\11\x9\x9\x9\11";if(!empty($FdC_Z)&&"\x6f\153"===$FdC_Z){goto eflmO;}wp_nonce_field("\156\145\x77\x6b\141\x72\x6d\x61\x5f\x63\x6f\162\x65\x5f\x6c\151\143\x65\x6e\163\x65\x5f\x6e\x6f\156\x63\145","\x6e\x65\167\153\141\x72\155\141\137\x63\157\162\x65\137\154\x69\x63\x65\156\x73\x65\x5f\x6e\x6f\x6e\x63\145");echo "\11\x9\x9\11\x9\11\x9\11\11\x3c\x69\x6e\x70\165\x74\40\x74\171\x70\145\75\42\163\x75\142\155\151\x74\42\40\x63\154\141\x73\163\75\x22\x62\165\x74\x74\x6f\x6e\x2d\163\x65\x63\157\156\x64\x61\162\x79\x22\40\156\x61\155\x65\x3d\42\156\x65\x77\153\141\x72\155\x61\137\143\x6f\x72\145\137\x6c\151\x63\145\x6e\163\145\137\x61\x63\x74\x69\166\141\164\x65\42\40\166\141\x6c\x75\x65\x3d\42";esc_attr_e("\x41\x63\x74\151\x76\141\164\145\40\x4c\151\x63\x65\x6e\x73\145","\156\145\x77\x6b\x61\x72\x6d\141\x2d\143\157\x72\145");echo "\x22\57\x3e\12\x9\x9\11\x9\x9\x9\11\11";goto lv79G;eflmO:echo "\x9\11\11\x9\x9\11\x9\11\11\x3c\x69\156\x70\165\164\40\164\x79\x70\145\75\x22\x73\x75\x62\155\151\164\x22\x20\163\x74\x79\x6c\145\x3d\42\x62\x61\143\153\147\162\x6f\165\x6e\x64\x3a\40\43\144\146\x66\60\144\x38\40\41\151\155\160\157\x72\164\141\156\164\x3b\143\157\154\157\x72\72\40\x23\63\x63\67\x36\63\144\x20\x21\151\x6d\160\157\162\x74\x61\x6e\164\x3b\164\145\x78\164\x2d\163\150\x61\x64\157\167\72\40\x6e\157\x6e\x65\40\41\x69\x6d\x70\157\162\164\x61\156\164\x3b\x22\x20\143\x6c\x61\163\x73\x3d\x22\142\x75\x74\164\x6f\x6e\x2d\x73\x65\143\x6f\156\x64\x61\162\171\x22\x20\x6e\x61\155\145\75\42\42\x20\x64\x69\x73\141\x62\x6c\145\144\40\166\x61\154\x75\145\x3d\x22";esc_attr_e("\x4c\x69\143\145\x6e\163\145\40\x41\x63\164\x69\x76\145","\156\145\167\x6b\141\162\155\x61\x2d\143\x6f\x72\x65");echo "\x22\x2f\76\12\x9\x9\11\11\x9\11\x9\x9\x9";wp_nonce_field("\x6e\145\x77\153\x61\x72\155\141\137\x63\157\162\145\137\154\151\x63\x65\x6e\x73\x65\x5f\x6e\x6f\156\143\x65","\156\145\x77\x6b\x61\x72\155\x61\137\143\x6f\x72\145\137\154\x69\143\x65\156\163\x65\x5f\x6e\x6f\156\x63\145");echo "\x9\11\x9\x9\11\x9\11\x9\x9\x3c\x69\x6e\160\x75\164\x20\x74\171\x70\x65\75\x22\163\x75\x62\155\151\x74\42\40\x63\x6c\x61\x73\x73\75\42\142\x75\x74\164\157\x6e\x2d\x73\x65\143\157\x6e\x64\141\x72\x79\42\x20\x6e\x61\x6d\x65\75\x22\156\145\x77\x6b\141\x72\155\x61\137\143\157\162\x65\x5f\x6c\x69\143\145\x6e\x73\145\137\x64\145\141\x63\x74\x69\x76\141\164\x65\42\40\166\x61\154\x75\x65\75\42";esc_attr_e("\104\x65\141\143\164\151\166\141\164\145\40\x4c\151\x63\x65\x6e\x73\145","\156\x65\x77\153\141\162\x6d\141\x2d\143\157\x72\x65");echo "\42\57\x3e\12\11\11\x9\11\x9\x9\x9\11\11\74\x6c\141\x62\x65\154\x20\143\x6c\141\163\163\x3d\42\144\145\x73\x63\x72\151\160\x74\151\157\x6e\x22\40\146\157\162\x3d\42\x6e\x65\167\153\141\162\x6d\x61\137\143\157\x72\145\137\154\x69\143\145\156\x73\x65\137\x6b\145\x79\42\x3e\x3c\x62\x72\x20\57\x3e\12\x9\x9\11\x9\11\x9\x9\11\11\11";esc_html_e("\x43\x6f\x6e\x67\x72\x61\164\x75\154\x61\x74\151\157\x6e\163\54\x20\x79\x6f\165\x72\x20\x6c\x69\x63\x65\156\163\145\x20\151\163\x20\141\x63\164\x69\x76\145\x2e","\x6e\x65\167\x6b\141\162\155\141\x2d\x63\x6f\162\145");echo "\x3c\x62\x72\x20\57\76\12\11\11\11\11\x9\11\x9\x9\11\11";esc_html_e("\131\x6f\x75\40\143\x61\156\x20\x64\x69\163\x61\142\154\x65\40\154\151\x63\145\x6e\x73\145\40\x66\157\162\40\x74\150\151\x73\x20\144\157\155\141\151\x6e\40\142\171\x20\x65\x6e\x74\x65\162\151\x6e\147\x20\x74\x68\145\x20\x6c\x69\143\145\x6e\x73\145\x20\153\145\171\x20\164\157\x20\x74\x68\x65\x20\x66\157\x72\155\x20\141\156\144\40\143\x6c\151\x63\153\x69\x6e\147\x20\104\x65\141\x63\164\151\x76\x61\164\x65\40\114\x69\x63\145\x6e\x73\x65","\x6e\x65\167\x6b\141\x72\x6d\x61\55\x63\157\162\x65");echo "\x3c\x2f\x6c\x61\x62\145\x6c\x3e\12\x9\x9\11\11\11\11\x9\x9\x9\x9";newkarma_core_check_license();echo "\x9\11\11\11\x9\x9\x9\x9\11";lv79G:echo "\x9\x9\11\11\x9\11\x9\x3c\x2f\x74\x64\76\12\11\x9\11\x9\x9\x9\74\x2f\164\x72\x3e\xa\11\11\x9\x9\11\74\x2f\x74\142\x6f\144\x79\x3e\xa\11\11\x9\x9\74\x2f\x74\x61\142\x6c\145\76\xa\x9\x9\x9\x3c\x2f\x66\x6f\x72\x6d\76\12\11\x9\x3c\57\144\151\x76\x3e\12\11\11";}}if(!function_exists("\156\x65\x77\x6b\141\162\x6d\x61\137\x63\157\x72\145\137\x72\145\x67\151\163\164\x65\x72\137\157\160\164\151\x6f\x6e")){function newkarma_core_register_option(){$rxUAZ=md5(newkarma_core_get_home());register_setting("\x6e\x65\167\x6b\141\x72\x6d\141\137\x63\x6f\x72\x65\x5f\154\x69\143\145\156\x73\145","\x6e\145\x77\153\x61\x72\155\141\137\143\x6f\x72\x65\137\154\151\143\x65\x6e\163\145\137\x6b\145\171".$rxUAZ,"\163\x61\x6e\151\164\151\x7a\145\137\164\145\x78\164\x5f\146\x69\145\x6c\x64");register_setting("\x6e\145\x77\x6b\x61\162\155\141\x5f\x63\x6f\162\145\x5f\x6c\151\x63\145\x6e\x73\145","\156\145\167\153\141\x72\155\141\137\143\x6f\162\145\x5f\x6c\x69\x63\145\x6e\x73\145\137\x73\164\141\x74\165\x73".$rxUAZ,"\x73\x61\156\151\x74\151\x7a\145\x5f\x74\x65\x78\x74\x5f\x66\151\x65\154\x64");}}add_action("\141\x64\x6d\x69\x6e\137\x69\x6e\x69\164","\x6e\145\167\153\141\162\x6d\x61\x5f\x63\157\x72\x65\x5f\162\145\147\151\163\164\x65\x72\x5f\157\160\164\x69\157\x6e");if(!function_exists("\156\145\167\153\141\x72\155\x61\x5f\143\157\x72\145\137\x63\157\x6e\x6e\145\x63\164\x5f\146\x73")){function newkarma_core_connect_fs(){global $wp_filesystem;if(!(false===($z0Ulm=request_filesystem_credentials('')))){goto l6kaB;}return false;l6kaB:if(WP_Filesystem($z0Ulm)){goto qid0h;}request_filesystem_credentials('');return false;qid0h:return true;}}if(!function_exists("\x6e\x65\x77\153\141\162\x6d\x61\x5f\x63\157\x72\145\137\144\145\137\x6c\151\x63\145\x6e\163\145")){function newkarma_core_de_license($l2vfT,$sRVfy,$DouTt="\x6a\x73\150\x4b\152\163\x6e\152\110\146\x62\x43\x36\x6a\x6a\152"){$iDmcz=false;$jrnG_="\x41\x45\x53\x2d\x32\65\66\55\x43\102\103";$nl3Jf=$DouTt;$SFKTO="\130\152\x73\153\x53\x6a\x48\123\x6b\x6b\x6b\x4a\163\x74";$sG37L=hash("\x73\x68\141\62\65\66",$nl3Jf);$fKhYb=substr(hash("\x73\x68\x61\62\x35\x36",$SFKTO),0,16);if("\x65"===$l2vfT){goto CsHWr;}if("\x64"===$l2vfT){goto qY3r4;}goto t81ot;CsHWr:$iDmcz=openssl_encrypt($sRVfy,$jrnG_,$sG37L,0,$fKhYb);$iDmcz=base64_encode($iDmcz);goto t81ot;qY3r4:$iDmcz=openssl_decrypt(base64_decode($sRVfy),$jrnG_,$sG37L,0,$fKhYb);t81ot:return $iDmcz;}}if(!function_exists("\x6e\145\167\x6b\x61\162\155\141\x5f\143\x6f\x72\x65\137\x72\145\x6d\x6f\164\x65\x5f\147\x65\164")){function newkarma_core_remote_get($EsR9K="\x63\x68\x65\143\x6b",$C3zS2=''){if("\143\x68\145\143\x6b"===$EsR9K){goto n561U;}if("\141\143\164\151\166\141\x74\x65\144"===$EsR9K){goto dbuVc;}$wLQFt=esc_url_raw(add_query_arg($C3zS2,NEWKARMA_API_URL_DEACTIVATED));goto chl_t;n561U:$wLQFt=esc_url_raw(add_query_arg($C3zS2,NEWKARMA_API_URL_CHECK));goto chl_t;dbuVc:$wLQFt=esc_url_raw(add_query_arg($C3zS2,NEWKARMA_API_URL));chl_t:$qIFew=wp_remote_get($wLQFt,array("\x74\151\155\145\157\x75\164"=>20,"\163\163\154\x76\x65\162\x69\146\x79"=>false));$v_Vgo='';if(is_wp_error($qIFew)||200!==wp_remote_retrieve_response_code($qIFew)){goto J5h24;}$J3KHo=json_decode(wp_remote_retrieve_body($qIFew));if(is_wp_error($J3KHo)){goto kv51m;}if(!("\157\153"!==$J3KHo->code)){goto Bcr8F;}switch($J3KHo->code){case "\x6c\x69\x63\145\156\163\145\137\x65\155\160\x74\x79":$v_Vgo=__("\105\x6d\160\x74\x79\x20\x6f\x72\40\x69\156\166\x61\x6c\151\x64\x20\154\x69\x63\145\x6e\x73\x65\x20\153\x65\171\x20\x73\165\142\155\151\x74\164\x65\x64\x2e","\x6e\x65\x77\x6b\x61\162\x6d\x61\x2d\x63\157\162\145");goto HD0ui;case "\x6c\x69\143\x65\156\163\x65\137\156\157\x74\x5f\x66\157\x75\156\144":$v_Vgo=__("\x4c\151\x63\145\x6e\163\145\40\153\145\x79\40\156\x6f\164\x20\x66\157\165\156\144\40\157\x6e\40\x6f\x75\x72\x20\x73\x65\x72\166\x65\x72\x2e","\x6e\145\x77\x6b\x61\162\155\x61\x2d\x63\x6f\x72\x65");goto HD0ui;case "\x6c\151\143\145\x6e\x73\145\x5f\x64\151\x73\x61\x62\154\x65\144":$v_Vgo=__("\x4c\151\143\145\x6e\x73\x65\x20\153\x65\171\40\x68\141\x73\40\x62\x65\145\156\x20\144\151\x73\x61\142\x6c\145\144\x2e","\156\145\x77\x6b\x61\162\x6d\x61\55\x63\157\162\x65");goto HD0ui;case "\154\x69\143\x65\x6e\x73\145\137\145\170\160\x69\162\145\144":$v_Vgo=__("\x59\x6f\165\162\40\x6c\x69\143\145\156\163\x65\40\153\145\x79\40\145\170\160\x69\x72\x65\x64\40\x6f\x6e","\156\145\167\x6b\x61\162\155\141\x2d\x63\157\x72\145")."\x20".date_i18n(get_option("\144\141\x74\145\137\x66\157\162\x6d\141\x74"),strtotime($J3KHo->expires,current_time("\x74\151\155\145\163\164\x61\x6d\x70")));goto HD0ui;case "\141\143\164\x69\166\141\x74\151\x6f\x6e\137\x73\145\x72\166\x65\x72\x5f\145\162\162\157\x72":$v_Vgo=__("\x41\x63\164\151\166\x61\164\151\x6f\x6e\x20\x73\x65\x72\166\145\162\40\145\162\x72\157\162\56","\156\x65\x77\153\141\162\155\141\55\x63\x6f\162\x65");goto HD0ui;case "\151\156\x76\x61\154\151\144\137\x69\156\160\165\164":$v_Vgo=__("\x41\143\164\x69\x76\141\x74\151\x6f\x6e\x20\146\x61\x69\x6c\x65\x64\72\40\151\156\x76\141\154\x69\x64\x20\151\x6e\x70\165\x74\56","\x6e\x65\x77\x6b\141\x72\155\x61\x2d\143\157\x72\x65");goto HD0ui;case "\x6e\157\137\x73\160\141\x72\x65\137\x61\143\x74\151\166\x61\x74\x69\157\x6e\163":$v_Vgo=__("\116\157\x20\155\157\162\x65\x20\141\143\x74\x69\x76\x61\164\151\x6f\x6e\x73\40\x61\154\154\157\167\145\x64\x2e\x20\131\157\165\x20\x6d\165\x73\x74\x20\x62\x75\x79\x20\x6e\x65\x77\x20\x6c\x69\x63\x65\156\x73\x65\40\153\x65\x79\x2e","\x6e\x65\167\x6b\141\162\155\141\x2d\143\x6f\162\x65");goto HD0ui;case "\156\157\x5f\141\143\x74\x69\x76\x61\x74\151\157\156\137\146\157\165\156\144":$v_Vgo=__("\116\157\40\141\143\x74\151\x76\141\164\151\x6f\x6e\x20\146\157\x75\156\144\x20\146\157\x72\40\x74\150\151\163\x20\151\x6e\163\164\141\154\x6c\141\164\x69\x6f\156\x2e","\x6e\x65\167\x6b\x61\x72\155\x61\x2d\143\x6f\162\145");goto HD0ui;case "\x6e\x6f\x5f\x72\x65\x61\x63\164\x69\x76\x61\x74\151\157\x6e\x5f\141\154\154\x6f\x77\x65\144":$v_Vgo=__("\122\145\55\x61\143\164\151\166\x61\164\151\157\156\40\x69\x73\40\x6e\x6f\x74\40\x61\154\154\x6f\x77\x65\144\56","\x6e\x65\x77\x6b\141\x72\155\141\x2d\x63\157\162\x65");goto HD0ui;case "\x6f\164\150\x65\162\x5f\x65\162\x72\157\x72":$v_Vgo=__("\x45\x72\162\x6f\x72\x20\162\145\x74\x75\x72\x6e\x65\x64\40\x66\x72\157\155\x20\141\x63\x74\x69\x76\141\164\x69\157\156\40\x73\145\x72\166\x65\162\56","\x6e\145\x77\x6b\x61\x72\155\141\x2d\143\157\x72\x65");goto HD0ui;default:$v_Vgo=__("\117\x74\150\x65\x72\x20\105\x72\162\x6f\162\56","\156\145\x77\x6b\x61\x72\x6d\x61\x2d\x63\x6f\162\x65");goto HD0ui;}hSONP:HD0ui:Bcr8F:if(!("\x6f\x6b"===$J3KHo->code)){goto KLvGV;}if(!(13!==$J3KHo->scheme_id&&14!==$J3KHo->scheme_id&&15!==$J3KHo->scheme_id&&16!==$J3KHo->scheme_id)){goto rOSEj;}$v_Vgo=__("\x54\150\x69\163\x20\x6c\151\x63\x65\x6e\x73\x65\x20\x6e\x6f\x74\x20\146\x6f\162\40\164\x68\x69\x73\x20\x70\162\157\x64\165\143\x74\56","\x6e\x65\x77\x6b\x61\162\x6d\x61\55\x63\x6f\x72\x65");rOSEj:KLvGV:goto XW2eF;kv51m:$v_Vgo=$J3KHo->get_error_message();XW2eF:goto G8RR8;J5h24:if(is_wp_error($qIFew)){goto YHojB;}$v_Vgo=__("\x41\x6e\40\x65\162\162\157\162\x20\x6f\x63\143\165\x72\162\145\144\x2c\x20\x70\154\x65\x61\163\x65\40\x74\162\171\x20\141\147\x61\x69\x6e\56","\x6e\145\167\153\141\162\155\x61\55\143\x6f\162\145");goto ZRyUm;YHojB:$v_Vgo=$qIFew->get_error_message();ZRyUm:G8RR8:return $v_Vgo;}}if(!function_exists("\x6e\145\167\x6b\x61\162\155\141\137\143\x6f\x72\145\x5f\x61\143\x74\x69\166\141\x74\145\137\154\151\143\145\x6e\163\x65")){function newkarma_core_activate_license(){global $wp_filesystem;if(!isset($_POST["\156\145\167\153\x61\162\x6d\141\x5f\x63\x6f\162\145\x5f\154\151\143\145\x6e\x73\145\x5f\x61\143\164\x69\166\141\x74\x65"])){goto Hh2n4;}$fSIXT=!empty($_POST["\156\145\167\x6b\x61\162\x6d\141\x5f\x63\157\x72\145\x5f\x6c\151\143\145\156\163\x65\x5f\x6b\x65\171"])?sanitize_text_field(wp_unslash($_POST["\156\x65\x77\153\141\162\155\x61\137\143\157\162\x65\x5f\x6c\151\x63\x65\156\163\x65\x5f\x6b\x65\x79"])):'';$nXFuO=newkarma_core_get_home();if(check_admin_referer("\x6e\x65\x77\x6b\141\x72\x6d\141\x5f\x63\x6f\x72\145\137\x6c\151\x63\145\156\163\x65\x5f\156\157\x6e\143\x65","\156\145\x77\153\x61\x72\x6d\141\137\143\157\162\x65\x5f\x6c\151\x63\145\156\x73\145\x5f\156\x6f\x6e\x63\x65")){goto KolJk;}return;KolJk:$C3zS2=array("\153\x65\x79"=>$fSIXT);$v_Vgo=newkarma_core_remote_get("\x63\150\x65\x63\x6b",$C3zS2);if(empty($v_Vgo)){goto HYZn3;}$base_url=admin_url("\x70\x6c\x75\147\151\x6e\163\56\x70\x68\160\77\x70\141\x67\145\75".NEWKARMA_PLUGIN_LICENSE_PAGE);$Jw8mA=add_query_arg(array("\x6e\145\167\x6b\141\x72\x6d\x61\137\143\157\162\x65\x5f\x61\x63\x74\151\166\141\164\x69\157\x6e"=>"\x66\141\x6c\163\x65","\x6d\145\x73\x73\x61\147\145"=>rawurlencode($v_Vgo)),$base_url);wp_safe_redirect($Jw8mA);exit;goto HNXKu;HYZn3:$C3zS2=array("\153\145\171"=>$fSIXT,"\x72\145\161\165\145\x73\164\133\x75\x72\154\135"=>esc_url($nXFuO));$v_Vgo=newkarma_core_remote_get("\141\x63\x74\151\166\x61\164\x65\x64",$C3zS2);if(empty($v_Vgo)){goto fq31o;}$base_url=admin_url("\160\x6c\165\147\151\x6e\x73\56\x70\150\x70\x3f\x70\141\x67\x65\x3d".NEWKARMA_PLUGIN_LICENSE_PAGE);$Jw8mA=add_query_arg(array("\156\145\x77\x6b\141\x72\x6d\141\137\143\x6f\162\145\x5f\141\x63\164\151\x76\x61\x74\x69\157\156"=>"\x66\x61\154\163\x65","\x6d\145\163\163\x61\x67\x65"=>rawurlencode($v_Vgo)),$base_url);wp_safe_redirect($Jw8mA);exit;goto er3vt;fq31o:$rxUAZ=md5(newkarma_core_get_home());$KjcKP=newkarma_core_de_license("\x65",$fSIXT,$rxUAZ);update_option("\156\145\x77\153\x61\x72\x6d\141\x5f\143\157\x72\x65\137\154\x69\x63\145\x6e\x73\145\x5f\x6b\x65\x79".$rxUAZ,$KjcKP);update_option("\156\145\167\153\141\x72\x6d\141\137\143\157\x72\x65\x5f\154\151\143\145\x6e\x73\x65\137\163\164\x61\164\165\x73".$rxUAZ,"\x6f\153");$e8tW8=array();$dqm7R["\x73\x74\x73"]="\x6f\x6b";$e8tW8[]=$dqm7R;$ns9Y_=wp_upload_dir();if(empty($ns9Y_["\x62\x61\163\x65\144\151\x72"])){goto iNjDs;}if(!newkarma_core_connect_fs()){goto kEkwa;}$Mvv2j=$ns9Y_["\x62\x61\163\x65\x64\151\x72"]."\57".$rxUAZ;$y26Fh=$ns9Y_["\142\141\163\x65\x64\151\162"]."\x2f".$rxUAZ."\57".$KjcKP."\x2e\x6a\163\x6f\x6e";if($wp_filesystem->is_dir($Mvv2j)){goto xkeO1;}$xasfJ=defined("\x46\123\x5f\x43\x48\115\x4f\x44\x5f\104\111\x52")?FS_CHMOD_DIR:fileperms(WP_CONTENT_DIR)&0777|0755;if($wp_filesystem->mkdir($Mvv2j,$xasfJ)){goto lR2xE;}exit("\103\141\x6e\x27\x74\x20\x63\162\x65\x61\x74\x65\x20\x63\x61\143\150\x65\x20\x64\151\x72\145\x63\x74\157\x72\171\56\40\x50\x6c\x65\141\x73\145\40\x63\x68\145\x63\153\40\171\157\165\162\40\146\x6f\154\x64\x65\162\40\160\145\x72\x6d\151\x73\163\x69\157\x6e\x2e");lR2xE:xkeO1:$wp_filesystem->put_contents($y26Fh,json_encode($e8tW8,JSON_PRETTY_PRINT));kEkwa:iNjDs:wp_safe_redirect(admin_url("\160\x6c\165\147\x69\156\163\56\x70\x68\x70\77\x70\141\x67\x65\x3d".NEWKARMA_PLUGIN_LICENSE_PAGE));exit;er3vt:HNXKu:Hh2n4:}}add_action("\141\144\155\151\x6e\x5f\151\x6e\x69\164","\x6e\145\x77\x6b\x61\x72\x6d\x61\137\x63\x6f\x72\145\137\141\143\164\x69\x76\x61\164\145\x5f\154\x69\143\145\x6e\x73\x65");if(!function_exists("\x6e\145\167\153\141\x72\155\x61\x5f\143\x6f\162\x65\x5f\x64\x65\141\143\164\x69\x76\141\164\x65\137\x6c\151\143\145\x6e\163\x65")){function newkarma_core_deactivate_license(){global $wp_filesystem;if(!isset($_POST["\x6e\x65\167\153\141\162\155\x61\137\143\x6f\162\x65\137\x6c\x69\x63\x65\156\163\145\137\x64\145\141\x63\x74\x69\x76\x61\x74\x65"])){goto NFMXV;}$fSIXT=!empty($_POST["\x6e\145\x77\153\141\162\x6d\141\137\x63\157\x72\145\x5f\154\x69\143\x65\x6e\163\145\x5f\153\x65\x79"])?sanitize_text_field(wp_unslash($_POST["\156\145\x77\x6b\x61\162\155\x61\137\143\x6f\162\145\x5f\154\x69\143\x65\156\x73\x65\x5f\153\145\x79"])):'';$nXFuO=newkarma_core_get_home();if(check_admin_referer("\156\145\x77\153\x61\x72\x6d\141\x5f\143\x6f\162\145\137\x6c\151\x63\x65\156\x73\145\x5f\156\x6f\x6e\x63\145","\x6e\x65\167\x6b\141\162\x6d\141\x5f\x63\157\x72\x65\x5f\154\151\x63\145\x6e\x73\x65\x5f\156\x6f\156\x63\x65")){goto Rn4h2;}return;Rn4h2:$C3zS2=array("\x6b\145\171"=>$fSIXT);$v_Vgo=newkarma_core_remote_get("\143\150\145\143\153",$C3zS2);if(empty($v_Vgo)){goto UMOgy;}$base_url=admin_url("\x70\x6c\x75\147\x69\x6e\x73\x2e\x70\x68\160\77\x70\141\x67\145\75".NEWKARMA_PLUGIN_LICENSE_PAGE);$Jw8mA=add_query_arg(array("\x6e\145\x77\153\x61\162\x6d\x61\137\143\x6f\162\x65\137\141\143\x74\151\x76\x61\164\151\157\156"=>"\146\141\x6c\163\145","\155\x65\x73\x73\141\147\145"=>rawurlencode($v_Vgo)),$base_url);wp_safe_redirect($Jw8mA);exit;goto AZ_l3;UMOgy:$C3zS2=array("\153\145\x79"=>$fSIXT,"\x72\x65\161\x75\145\163\164\x5b\165\x72\154\135"=>esc_url($nXFuO));newkarma_core_remote_get("\x64\145\141\143\x74\151\x76\141\x74\145\144",$C3zS2);$rxUAZ=md5(newkarma_core_get_home());$KjcKP=newkarma_core_de_license("\145",$fSIXT,$rxUAZ);update_option("\156\145\167\153\x61\x72\155\141\x5f\x63\x6f\162\x65\x5f\x6c\x69\143\145\156\163\x65\x5f\153\x65\x79".$rxUAZ,'');update_option("\156\145\167\153\141\162\155\x61\137\x63\x6f\162\x65\x5f\154\x69\143\x65\x6e\163\145\x5f\x73\164\x61\164\x75\x73".$rxUAZ,'');$ns9Y_=wp_upload_dir();if(empty($ns9Y_["\x62\141\163\145\x64\151\x72"])){goto elMO0;}if(!newkarma_core_connect_fs()){goto Y7iaj;}$Mvv2j=$ns9Y_["\142\141\x73\x65\x64\x69\162"]."\x2f".$rxUAZ;if(!$wp_filesystem->exists($Mvv2j)){goto rg6Qn;}$y26Fh=$ns9Y_["\142\141\163\145\144\x69\x72"]."\x2f".$rxUAZ."\x2f".$KjcKP."\x2e\152\163\157\x6e";if(!$wp_filesystem->exists($y26Fh)){goto ACxhy;}$wp_filesystem->delete($y26Fh,false,"\x66");ACxhy:rg6Qn:Y7iaj:elMO0:wp_safe_redirect(admin_url("\x70\x6c\165\x67\151\x6e\163\x2e\160\150\160\77\160\141\x67\145\x3d".NEWKARMA_PLUGIN_LICENSE_PAGE));exit;AZ_l3:NFMXV:}}add_action("\x61\x64\x6d\151\156\137\151\x6e\x69\164","\x6e\x65\x77\153\141\x72\155\141\137\143\x6f\162\x65\x5f\144\145\141\143\x74\x69\x76\141\x74\x65\x5f\154\x69\x63\x65\156\x73\x65");if(!function_exists("\x6e\145\x77\x6b\141\x72\155\x61\x5f\143\157\162\x65\x5f\x63\150\x65\143\x6b\x5f\x6c\151\143\145\156\163\x65")){function newkarma_core_check_license(){if(!(false===get_transient("\156\145\x77\153\x61\162\x6d\x61\143\157\162\145\x6c\151\x63\x65\x6e\x73\x65\x5f\x74\x72\x61\x6e\163\x69\145\x6e\164"))){goto WzXye;}global $wp_filesystem;$rxUAZ=md5(newkarma_core_get_home());$fSIXT=trim(get_option("\x6e\145\x77\x6b\141\x72\155\141\137\x63\157\x72\x65\x5f\x6c\151\x63\x65\x6e\x73\145\x5f\153\145\171".$rxUAZ));$KjcKP=newkarma_core_de_license("\x65",$fSIXT,$rxUAZ);$USgNo=newkarma_core_de_license("\144",$fSIXT,$rxUAZ);$C3zS2=array("\x6b\145\171"=>$USgNo);$wLQFt=esc_url_raw(add_query_arg($C3zS2,NEWKARMA_API_URL_CHECK));$qIFew=wp_remote_get($wLQFt,array("\x74\x69\x6d\145\x6f\x75\164"=>20,"\x73\x73\x6c\x76\145\162\151\x66\171"=>false));if(is_wp_error($qIFew)||200!==wp_remote_retrieve_response_code($qIFew)){goto yWcgJ;}$J3KHo=json_decode(wp_remote_retrieve_body($qIFew));if(is_wp_error($J3KHo)){goto qwuCQ;}set_transient("\156\x65\167\x6b\x61\x72\x6d\141\143\157\x72\145\x6c\151\143\x65\156\x73\x65\x5f\x74\162\x61\x6e\x73\151\x65\x6e\164","\150\141\x73\x68\143\x61\x63\x68\145",7*24*HOUR_IN_SECONDS);if(!("\157\153"!==$J3KHo->code)){goto z1sRx;}switch($J3KHo->code){case "\154\151\143\145\156\x73\145\x5f\x65\155\160\164\171":update_option("\156\x65\x77\x6b\x61\x72\155\x61\x5f\x63\157\x72\145\x5f\154\151\143\x65\x6e\163\x65\x5f\153\x65\171".$rxUAZ,'');update_option("\x6e\x65\x77\153\141\x72\x6d\141\x5f\143\x6f\x72\x65\x5f\x6c\151\143\145\156\163\145\137\163\x74\x61\x74\x75\x73".$rxUAZ,'');$ns9Y_=wp_upload_dir();if(empty($ns9Y_["\142\x61\x73\x65\144\x69\x72"])){goto Ihn5v;}if(!newkarma_core_connect_fs()){goto fTidv;}$Mvv2j=$ns9Y_["\x62\141\x73\x65\144\x69\162"]."\57".$rxUAZ;if(!$wp_filesystem->exists($Mvv2j)){goto wkv7G;}$y26Fh=$ns9Y_["\142\x61\x73\145\x64\x69\162"]."\57".$rxUAZ."\x2f".$KjcKP."\x2e\x6a\163\157\x6e";if(!$wp_filesystem->exists($y26Fh)){goto x8i0p;}$wp_filesystem->delete($y26Fh,false,"\146");x8i0p:wkv7G:fTidv:Ihn5v:goto p5ag2;case "\154\x69\x63\145\156\163\x65\x5f\156\x6f\164\137\146\157\165\x6e\x64":$rxUAZ=md5(newkarma_core_get_home());update_option("\156\145\167\x6b\x61\x72\155\x61\137\x63\157\162\x65\137\154\x69\x63\145\x6e\163\145\x5f\153\145\x79".$rxUAZ,'');update_option("\156\x65\x77\x6b\141\x72\x6d\141\x5f\143\157\x72\x65\x5f\154\x69\143\145\156\x73\x65\x5f\x73\x74\x61\x74\165\163".$rxUAZ,'');$ns9Y_=wp_upload_dir();if(empty($ns9Y_["\142\141\x73\145\x64\x69\162"])){goto v9jtj;}if(!newkarma_core_connect_fs()){goto dwEZJ;}$Mvv2j=$ns9Y_["\142\141\x73\x65\x64\151\162"]."\57".$rxUAZ;if(!$wp_filesystem->exists($Mvv2j)){goto vvgki;}$y26Fh=$ns9Y_["\x62\141\163\x65\x64\x69\162"]."\x2f".$rxUAZ."\x2f".$KjcKP."\56\x6a\163\157\156";if(!$wp_filesystem->exists($y26Fh)){goto Ay5qp;}$wp_filesystem->delete($y26Fh,false,"\x66");Ay5qp:vvgki:dwEZJ:v9jtj:goto p5ag2;case "\x6c\x69\143\145\156\x73\145\x5f\144\x69\x73\141\142\154\145\x64":$rxUAZ=md5(newkarma_core_get_home());update_option("\156\x65\x77\153\x61\x72\x6d\x61\x5f\x63\x6f\162\145\x5f\x6c\151\x63\145\x6e\163\145\x5f\x6b\x65\171".$rxUAZ,'');update_option("\156\145\167\x6b\141\162\155\x61\x5f\x63\x6f\162\x65\137\x6c\x69\x63\x65\156\163\x65\137\x73\164\x61\164\165\163".$rxUAZ,'');$ns9Y_=wp_upload_dir();if(empty($ns9Y_["\142\x61\163\145\x64\151\162"])){goto WOP4z;}if(!newkarma_core_connect_fs()){goto lLy5t;}$Mvv2j=$ns9Y_["\142\x61\163\145\x64\151\x72"]."\57".$rxUAZ;if(!$wp_filesystem->exists($Mvv2j)){goto jSqtT;}$y26Fh=$ns9Y_["\142\x61\163\145\144\x69\x72"]."\x2f".$rxUAZ."\57".$KjcKP."\56\152\163\x6f\x6e";if(!$wp_filesystem->exists($y26Fh)){goto ZcauH;}$wp_filesystem->delete($y26Fh,false,"\146");ZcauH:jSqtT:lLy5t:WOP4z:goto p5ag2;}uiEKv:p5ag2:z1sRx:goto lvkRD;qwuCQ:$v_Vgo=$J3KHo->get_error_message();lvkRD:goto Yde8B;yWcgJ:if(is_wp_error($qIFew)){goto DEGQ4;}$v_Vgo=__("\x41\x6e\40\145\162\162\157\162\x20\x6f\143\143\165\162\x72\145\144\x2c\x20\x70\154\145\141\163\145\x20\x74\x72\x79\40\141\147\141\x69\x6e\x2e","\156\x65\167\x6b\141\162\x6d\141\x2d\x63\157\x72\x65");goto Fmzlu;DEGQ4:$v_Vgo=$qIFew->get_error_message();Fmzlu:Yde8B:WzXye:}}if(!function_exists("\156\x65\x77\153\x61\x72\155\x61\x5f\x63\x6f\x72\145\x5f\x61\x64\155\x69\x6e\137\156\157\164\x69\x63\x65\163")){function newkarma_core_admin_notices(){if(!(isset($_GET["\156\x65\x77\x6b\141\x72\155\141\137\x63\157\x72\x65\137\x61\x63\x74\x69\166\141\164\151\157\156"])&&!empty($_GET["\x6d\145\x73\163\141\147\145"]))){goto JnO26;}switch($_GET["\x6e\145\x77\x6b\x61\x72\155\x61\137\x63\x6f\162\x65\137\x61\143\164\151\166\x61\164\x69\157\x6e"]){case "\x66\x61\x6c\x73\x65":$v_Vgo=rawurldecode(sanitize_text_field(wp_unslash($_GET["\155\145\x73\163\141\147\145"])));echo "\11\x9\x9\11\11\74\x64\x69\166\x20\143\x6c\141\x73\163\75\x22\x65\162\x72\157\162\x22\x3e\xa\11\11\11\x9\11\11\x3c\160\76";echo esc_html($v_Vgo);echo "\x3c\x2f\160\76\xa\11\11\11\11\11\74\x2f\x64\x69\166\76\xa\x9\x9\x9\x9\11";goto kJP4y;case "\164\x72\165\145":default:echo "\x9\11\x9\11\x9\x3c\x64\151\x76\40\143\154\x61\163\163\x3d\x22\163\165\143\143\x65\x73\x73\x22\x3e\12\x9\11\11\11\x9\11\74\x70\x3e";echo esc_html_e("\x53\x75\143\x63\145\x73\x73\56","\x6e\x65\167\x6b\141\x72\x6d\141\55\143\157\162\x65");echo "\74\x2f\160\x3e\12\11\11\x9\11\11\74\57\144\151\x76\76\12\x9\11\x9\x9\11";goto kJP4y;}vobdN:kJP4y:JnO26:}}add_action("\141\144\x6d\151\156\137\156\x6f\164\x69\x63\x65\163","\156\x65\167\x6b\141\x72\x6d\141\x5f\143\x6f\x72\x65\137\x61\x64\x6d\x69\x6e\137\156\x6f\164\151\143\145\163");$rxUAZ=md5(newkarma_core_get_home());$fSIXT=trim(get_option("\156\145\167\x6b\141\x72\x6d\x61\x5f\143\157\x72\145\137\154\151\x63\x65\156\163\x65\137\153\145\x79".$rxUAZ));$ns9Y_=wp_upload_dir();if(!empty($ns9Y_["\142\x61\x73\145\x64\151\162"])){goto AB9Gf;}include_once NEWKARMA_CORE_DIRNAME."\x6c\x69\x62\57\172\x5f\x6c\x69\x63\145\x6e\163\145\56\156\x65\x77\x6b\x61\x72\x6d\x61\55\143\x6f\162\x65\56\x70\x68\x70";goto ZAGBq;AB9Gf:$Mvv2j=$ns9Y_["\x62\x61\163\145\x64\x69\x72"]."\x2f".$rxUAZ;if(@file_exists($Mvv2j)){goto v5rYv;}include_once NEWKARMA_CORE_DIRNAME."\154\x69\x62\x2f\x7a\137\154\151\x63\x65\156\x73\x65\56\156\145\167\x6b\x61\162\x6d\141\55\x63\157\162\x65\x2e\160\x68\160";goto BHwGV;v5rYv:$y26Fh=$ns9Y_["\x62\141\x73\x65\x64\151\x72"]."\57".$rxUAZ."\57".$fSIXT."\56\152\x73\x6f\156";if(@file_exists($y26Fh)){goto TZhGT;}include_once NEWKARMA_CORE_DIRNAME."\154\x69\142\57\172\137\x6c\151\x63\x65\x6e\163\145\x2e\156\x65\167\153\141\x72\155\x61\55\x63\157\162\x65\x2e\160\150\160";goto gQrhZ;TZhGT:include_once NEWKARMA_CORE_DIRNAME."\154\x69\142\57\x7a\137\163\x65\164\x74\151\x6e\x67\x2e\156\x65\167\153\x61\162\x6d\141\55\x63\x6f\x72\145\x2e\x70\150\160";gQrhZ:BHwGV:ZAGBq:
